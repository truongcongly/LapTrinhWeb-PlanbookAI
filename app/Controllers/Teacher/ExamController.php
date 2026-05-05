<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\Exam;
use App\Models\Question;
use App\Models\ExamQuestion;
use App\Models\ExamResult;

class ExamController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    private function pdfText($text)
    {
        $text = (string)$text;
        if (function_exists('iconv')) {
            $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
            if ($converted !== false) {
                $text = $converted;
            }
        }

        $text = preg_replace('/[^\x09\x0A\x0D\x20-\x7E]/', '', $text);
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }

    private function buildAnswerSheetPdf($exam, $studentName, $questions, $answers)
    {
        $lines = [];
        $addWrappedLine = function ($line = '', $maxLength = 88) use (&$lines) {
            $line = trim((string)$line);
            if ($line === '') {
                $lines[] = '';
                return;
            }

            while (strlen($line) > $maxLength) {
                $breakAt = strrpos(substr($line, 0, $maxLength + 1), ' ');
                $breakAt = $breakAt !== false && $breakAt > 0 ? $breakAt : $maxLength;
                $lines[] = substr($line, 0, $breakAt);
                $line = ltrim(substr($line, $breakAt));
            }

            $lines[] = $line;
        };

        foreach ([
            'PlanbookAI - OCR Answer Sheet',
            'Exam: ' . ($exam['title'] ?? ''),
            'Subject: ' . ($exam['subject'] ?? ''),
            'Grade: ' . ($exam['grade_level'] ?? ''),
            'Student: ' . $studentName,
            'Submitted at: ' . date('Y-m-d H:i:s'),
            '',
            'Questions and answers:',
        ] as $line) {
            $addWrappedLine($line);
        }

        foreach ($questions as $index => $question) {
            $questionId = $question['id'];
            $answer = strtoupper(trim($answers[$questionId] ?? ''));
            $answer = in_array($answer, ['A', 'B', 'C', 'D'], true) ? $answer : '-';

            $addWrappedLine('Question ' . ($index + 1) . ': ' . ($question['question_text'] ?? ''));
            $addWrappedLine('A. ' . ($question['option_a'] ?? ''));
            $addWrappedLine('B. ' . ($question['option_b'] ?? ''));
            $addWrappedLine('C. ' . ($question['option_c'] ?? ''));
            $addWrappedLine('D. ' . ($question['option_d'] ?? ''));
            $addWrappedLine('Selected answer: ' . $answer);
            $addWrappedLine('');
        }

        $content = "BT\n/F1 10 Tf\n50 790 Td\n";
        foreach ($lines as $index => $line) {
            if ($index > 0) {
                $content .= "0 -14 Td\n";
            }
            $content .= '(' . $this->pdfText($line) . ") Tj\n";
        }
        $content .= "ET\n";

        $objects = [
            "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n",
            "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n",
            "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >>\nendobj\n",
            "4 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n",
            "5 0 obj\n<< /Length " . strlen($content) . " >>\nstream\n" . $content . "endstream\nendobj\n",
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $object) {
            $offsets[] = strlen($pdf);
            $pdf .= $object;
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n";
        $pdf .= "0000000000 65535 f \n";
        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }
        $pdf .= "trailer\n<< /Size " . (count($objects) + 1) . " /Root 1 0 R >>\n";
        $pdf .= "startxref\n" . $xrefOffset . "\n%%EOF";

        return $pdf;
    }

    private function saveAnswerSheetPdf($exam, $studentName, $questions, $answers)
    {
        $uploadDir = dirname(__DIR__, 3) . '/public/uploads/answer-scans';
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true)) {
            return ['path' => '', 'absolute_path' => '', 'file_name' => ''];
        }

        $fileName = 'take_exam_' . date('Ymd_His') . '_' . bin2hex(random_bytes(6)) . '.pdf';
        $absolutePath = $uploadDir . '/' . $fileName;
        $pdf = $this->buildAnswerSheetPdf($exam, $studentName, $questions, $answers);

        if (file_put_contents($absolutePath, $pdf) === false) {
            return ['path' => '', 'absolute_path' => '', 'file_name' => ''];
        }

        return [
            'path' => 'uploads/answer-scans/' . $fileName,
            'absolute_path' => $absolutePath,
            'file_name' => $fileName,
        ];
    }

    private function cleanDownloadNamePart($value, $fallback)
    {
        $value = trim((string)$value);
        $value = preg_replace('/[\\\\\/:*?"<>|]+/u', ' ', $value);
        $value = preg_replace('/\s+/u', ' ', $value);
        $value = trim($value, " .\t\n\r\0\x0B");

        return $value !== '' ? $value : $fallback;
    }

    private function asciiDownloadName($fileName)
    {
        $ascii = (string)$fileName;
        if (function_exists('iconv')) {
            $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $ascii);
            if ($converted !== false) {
                $ascii = $converted;
            }
        }

        $ascii = preg_replace('/[^A-Za-z0-9._-]+/', '_', $ascii);
        $ascii = trim($ascii, '._-');

        return $ascii !== '' ? $ascii : 'bai-lam.pdf';
    }

    private function buildSubmissionPdfDownloadName($result)
    {
        $studentName = $this->cleanDownloadNamePart($result['student_name'] ?? '', 'hoc-sinh');
        $subject = $this->cleanDownloadNamePart($result['subject'] ?? $result['exam_title'] ?? '', 'mon-hoc');

        return $studentName . '_' . $subject . '.pdf';
    }

    public function submissionSuccess()
    {
        $this->authorize();

        $teacher = Auth::user();
        $resultId = $_GET['result_id'] ?? 0;
        $resultModel = new ExamResult();
        $result = $resultModel->findByIdForTeacher($resultId, $teacher['id']);

        if (!$result) {
            Session::flash('error', 'Khong tim thay ket qua bai lam.');
            $this->redirect('/teacher/results');
        }

        $this->view('teacher/exams/submission_success', compact('result'));
    }

    public function downloadSubmissionPdf()
    {
        $this->authorize();

        $teacher = Auth::user();
        $resultId = $_GET['result_id'] ?? 0;
        $resultModel = new ExamResult();
        $result = $resultModel->findByIdForTeacher($resultId, $teacher['id']);

        if (!$result || empty($result['scan_file'])) {
            Session::flash('error', 'Khong tim thay file PDF bai lam.');
            $this->redirect('/teacher/results');
        }

        $basePath = dirname(__DIR__, 3);
        $uploadRoot = realpath($basePath . '/public/uploads/answer-scans');
        $absolutePath = realpath($basePath . '/public/' . ltrim($result['scan_file'], '/'));

        if (
            $uploadRoot === false ||
            $absolutePath === false ||
            stripos($absolutePath, $uploadRoot . DIRECTORY_SEPARATOR) !== 0 ||
            strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION)) !== 'pdf' ||
            !is_file($absolutePath)
        ) {
            Session::flash('error', 'File PDF bai lam khong hop le hoac khong ton tai.');
            $this->redirect('/teacher/results');
        }

        $downloadName = $this->buildSubmissionPdfDownloadName($result);
        $fallbackName = $this->asciiDownloadName($downloadName);

        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=\"$fallbackName\"; filename*=UTF-8''" . rawurlencode($downloadName));
        header('Content-Length: ' . filesize($absolutePath));
        header('Cache-Control: private, max-age=0, must-revalidate');
        readfile($absolutePath);
        exit;
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examModel = new Exam();
        $exams = $examModel->getAllSimpleByTeacher($teacher['id']);

        $this->view('teacher/exams/index', compact('exams'));
    }

    public function create()
    {
        $this->authorize();

        $teacher = Auth::user();
        $questionModel = new Question();
        $questions = $questionModel->getAllByTeacherSimple($teacher['id']);

        $this->view('teacher/exams/create', compact('questions'));
    }

    public function store()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();

        $selectedQuestions = $_POST['questions'] ?? [];

        if (empty($selectedQuestions)) {
            Session::flash('error', 'Bạn phải chọn ít nhất 1 câu hỏi cho đề thi.');
            $this->redirect('/teacher/exams/create');
        }

        $examId = $examModel->create([
            'teacher_id' => $teacher['id'],
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'total_questions' => count($selectedQuestions),
            'duration_minutes' => $_POST['duration_minutes'] ?? 45,
            'status' => $_POST['status'] ?? 'draft',
            'instructions' => $_POST['instructions'] ?? '',
        ]);

        $answerKey = [];

        foreach ($selectedQuestions as $questionId) {
            $examQuestionModel->create($examId, $questionId);
        }

        $questionModel = new Question();
        $pickedQuestions = $questionModel->findManyByIds($selectedQuestions);

        foreach ($pickedQuestions as $q) {
            $answerKey[] = $q['correct_answer'];
        }

        $examModel->saveAnswerKey($examId, implode(',', $answerKey));

        Session::flash('success', 'Tạo đề thi thành công.');
        $this->redirect('/teacher/exams');
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();

        $exam = $examModel->findByIdForTeacher($id, $teacher['id']);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $questions = $examQuestionModel->getQuestionsByExam($id);

        $this->view('teacher/exams/show', compact('exam', 'questions'));
    }

    public function edit()
    {
        $this->authorize();

        $teacher = Auth::user();
        $id = $_GET['id'] ?? 0;

        $examModel = new Exam();
        $questionModel = new Question();
        $examQuestionModel = new ExamQuestion();

        $exam = $examModel->findByIdForTeacher($id, $teacher['id']);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $questions = $questionModel->getAllByTeacherSimple($teacher['id']);
        $selectedQuestionIds = $examQuestionModel->getQuestionIdsByExam($id);

        $this->view('teacher/exams/edit', compact('exam', 'questions', 'selectedQuestionIds'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();

        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();
        $questionModel = new Question();

        $exam = $examModel->findByIdForTeacher($id, $teacher['id']);
        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $selectedQuestions = $_POST['questions'] ?? [];

        if (empty($selectedQuestions)) {
            Session::flash('error', 'Bạn phải chọn ít nhất 1 câu hỏi.');
            $this->redirect('/teacher/exams/edit?id=' . $id);
        }

        $examModel->update($id, [
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'total_questions' => count($selectedQuestions),
            'duration_minutes' => $_POST['duration_minutes'] ?? 45,
            'status' => $_POST['status'] ?? 'draft',
            'instructions' => $_POST['instructions'] ?? '',
        ]);

        $examQuestionModel->deleteByExamId($id);

        foreach ($selectedQuestions as $questionId) {
            $examQuestionModel->create($id, $questionId);
        }

        $pickedQuestions = $questionModel->findManyByIds($selectedQuestions);
        $answerKey = [];

        foreach ($pickedQuestions as $q) {
            $answerKey[] = $q['correct_answer'];
        }

        $examModel->saveAnswerKey($id, implode(',', $answerKey));

        Session::flash('success', 'Cập nhật đề thi thành công.');
        $this->redirect('/teacher/exams');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $examModel = new Exam();

        $exam = $examModel->findByIdForTeacher($id, $teacher['id']);
        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $examModel->delete($id);
        Session::flash('success', 'Xóa đề thi thành công.');
        $this->redirect('/teacher/exams');
    }

    public function take()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();

        $exam = $examModel->findByIdForTeacher($id, $teacher['id']);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $questions = $examQuestionModel->getQuestionsByExam($id);

        $this->view('teacher/exams/take', compact('exam', 'questions'));
    }

    public function submit()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examId = $_GET['id'] ?? 0;

        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();
        $resultModel = new ExamResult();

        $exam = $examModel->findByIdForTeacher($examId, $teacher['id']);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $questions = $examQuestionModel->getQuestionsByExam($examId);
        $submittedAnswers = $_POST['answers'] ?? [];
        $studentName = trim($_POST['student_name'] ?? 'Student Demo');

        $totalQuestions = count($questions);
        $submittedAnswerList = [];
        $scannedAnswersList = [];

        foreach ($questions as $q) {
            $qid = $q['id'];
            $studentAnswer = strtoupper(trim($submittedAnswers[$qid] ?? ''));

            $submittedAnswerList[] = $qid . ':' . $studentAnswer;
            $scannedAnswersList[] = $studentAnswer;
        }

        $answerSheet = $this->saveAnswerSheetPdf($exam, $studentName, $questions, $submittedAnswers);

        $resultId = $resultModel->create([
            'exam_id' => $examId,
            'teacher_id' => $teacher['id'],
            'student_name' => $studentName,
            'scan_file' => $answerSheet['path'],
            'scanned_answers' => implode(',', $scannedAnswersList),
            'submitted_answers' => implode('|', $submittedAnswerList),
            'total_questions' => $totalQuestions,
            'correct_count' => 0,
            'score' => 0,
            'feedback' => '',
            'status' => 'needs_review',
            'ocr_status' => $answerSheet['path'] !== '' ? 'uploaded' : 'manual',
            'ocr_confidence' => null,
            'ocr_error' => $answerSheet['path'] === '' ? 'Khong tao duoc PDF bai lam.' : 'Bai lam da nop, chua cham diem. Hay cham bai trong OCR Grading.',
        ]);

        if (!$resultId) {
            Session::flash('error', 'Khong luu duoc ket qua bai lam.');
            $this->redirect('/teacher/exams/take?id=' . $examId);
        }

        Session::flash('success', 'Nộp bài và chấm điểm thành công.');
        Session::flash('success', 'Nop bai thanh cong. Bai lam chua duoc cham diem, hay cham trong OCR Grading.');
        $this->redirect('/teacher/exams/submission-success?result_id=' . $resultId);
    }
}
