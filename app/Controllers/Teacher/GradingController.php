<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\ExamResultDetail;

class GradingController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    private function normalizeAnswers($raw)
    {
        $raw = strtoupper(trim((string)$raw));
        if ($raw === '') {
            return [];
        }

        preg_match_all('/(?<![A-Z])[A-D](?![A-Z])/', $raw, $matches);
        if (!empty($matches[0])) {
            return array_values($matches[0]);
        }

        $parts = array_map('trim', preg_split('/[\s,;|]+/', $raw));
        $parts = array_filter($parts, fn($item) => in_array($item, ['A', 'B', 'C', 'D'], true));
        return array_values($parts);
    }

    private function saveScanFile()
    {
        if (empty($_FILES['scan_file']) || ($_FILES['scan_file']['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return ['path' => '', 'error' => ''];
        }

        $file = $_FILES['scan_file'];
        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            return ['path' => '', 'error' => 'Khong the upload file scan.'];
        }

        if (($file['size'] ?? 0) > 5 * 1024 * 1024) {
            return ['path' => '', 'error' => 'File scan vuot qua dung luong 5MB.'];
        }

        $extension = strtolower(pathinfo($file['name'] ?? '', PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];
        if (!in_array($extension, $allowedExtensions, true)) {
            return ['path' => '', 'error' => 'Chi ho tro file JPG, PNG, WEBP hoac PDF.'];
        }

        $allowedMimeTypes = [
            'jpg' => ['image/jpeg'],
            'jpeg' => ['image/jpeg'],
            'png' => ['image/png'],
            'webp' => ['image/webp'],
            'pdf' => ['application/pdf'],
        ];

        $mimeType = function_exists('mime_content_type') ? mime_content_type($file['tmp_name']) : '';
        if ($mimeType !== '' && !in_array($mimeType, $allowedMimeTypes[$extension], true)) {
            return ['path' => '', 'error' => 'Dinh dang file scan khong hop le.'];
        }

        $uploadDir = dirname(__DIR__, 3) . '/public/uploads/answer-scans';
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true)) {
            return ['path' => '', 'error' => 'Khong tao duoc thu muc luu file scan.'];
        }

        $fileName = 'scan_' . date('Ymd_His') . '_' . bin2hex(random_bytes(6)) . '.' . $extension;
        $targetPath = $uploadDir . '/' . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['path' => '', 'error' => 'Khong luu duoc file scan.'];
        }

        return ['path' => 'uploads/answer-scans/' . $fileName, 'error' => ''];
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examModel = new Exam();
        $resultModel = new ExamResult();
        $exams = $examModel->getAllByTeacher($teacher['id']);
        $stats = $resultModel->getStatsByTeacher($teacher['id']);
        $recentResults = $resultModel->getRecentByTeacher($teacher['id'], 5);

        $this->view('teacher/grading/index', compact('exams', 'stats', 'recentResults'));
    }

    public function create()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examModel = new Exam();
        $exams = $examModel->getAllByTeacher($teacher['id']);

        $this->view('teacher/grading/create', compact('exams'));
    }

    public function store()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examId = $_POST['exam_id'] ?? 0;
        $studentName = trim($_POST['student_name'] ?? '');
        $scannedAnswersRaw = $_POST['scanned_answers'] ?? '';
        $gradingNote = trim($_POST['grading_note'] ?? '');
        $scanUpload = $this->saveScanFile();

        $examModel = new Exam();
        $exam = $examModel->findByIdForTeacher($examId, $teacher['id']);

        if (!$exam) {
            Session::flash('error', 'Khong tim thay de thi de cham.');
            $this->redirect('/teacher/grading/create');
        }

        if ($scanUpload['error'] !== '') {
            Session::flash('error', $scanUpload['error']);
            $this->redirect('/teacher/grading/create');
        }

        $scannedAnswers = $this->normalizeAnswers($scannedAnswersRaw);
        $answerKey = $this->normalizeAnswers($exam['answer_key'] ?? '');

        $totalQuestions = count($answerKey);
        $correctCount = 0;
        $missingAnswers = 0;
        $details = [];

        for ($i = 0; $i < $totalQuestions; $i++) {
            $studentAnswer = $scannedAnswers[$i] ?? '';
            $correctAnswer = $answerKey[$i] ?? '';
            $isCorrect = $studentAnswer !== '' && $studentAnswer === $correctAnswer;

            if ($isCorrect) {
                $correctCount++;
            }

            if ($studentAnswer === '') {
                $missingAnswers++;
            }

            $details[] = [
                'question_number' => $i + 1,
                'student_answer' => $studentAnswer,
                'correct_answer' => $correctAnswer,
                'is_correct' => $isCorrect,
                'confidence' => $studentAnswer === '' ? 0 : 100,
                'note' => $studentAnswer === '' ? 'Can review: khong nhan dien duoc dap an.' : '',
            ];
        }

        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 10, 2) : 0;
        $status = $missingAnswers > 0 || $totalQuestions === 0 ? 'needs_review' : 'auto_graded';
        $ocrStatus = $scanUpload['path'] !== '' ? ($status === 'needs_review' ? 'needs_review' : 'uploaded') : 'manual';
        $ocrConfidence = $totalQuestions > 0 ? round((($totalQuestions - $missingAnswers) / $totalQuestions) * 100, 2) : null;

        $resultModel = new ExamResult();
        $resultId = $resultModel->create([
            'exam_id' => $examId,
            'teacher_id' => $teacher['id'],
            'student_name' => $studentName,
            'scan_file' => $scanUpload['path'],
            'scanned_answers' => implode(',', $scannedAnswers),
            'submitted_answers' => $scannedAnswersRaw,
            'total_questions' => $totalQuestions,
            'correct_count' => $correctCount,
            'score' => $score,
            'feedback' => $gradingNote,
            'status' => $status,
            'ocr_status' => $ocrStatus,
            'ocr_confidence' => $ocrConfidence,
            'ocr_error' => $totalQuestions === 0 ? 'De thi chua co answer key.' : '',
        ]);

        if (!$resultId) {
            Session::flash('error', 'Khong luu duoc ket qua cham bai.');
            $this->redirect('/teacher/grading/create');
        }

        $detailModel = new ExamResultDetail();
        foreach ($details as $detail) {
            $detailModel->create([
                'result_id' => $resultId,
                'question_number' => $detail['question_number'],
                'student_answer' => $detail['student_answer'],
                'correct_answer' => $detail['correct_answer'],
                'is_correct' => $detail['is_correct'],
                'confidence' => $detail['confidence'],
                'note' => $detail['note'],
            ]);
        }

        Session::flash('success', 'Cham bai tu dong thanh cong.');
        $this->redirect('/teacher/results');
    }
}
