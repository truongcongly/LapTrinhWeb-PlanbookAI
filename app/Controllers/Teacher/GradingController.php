<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\Exam;
use App\Models\ExamResult;

class GradingController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    private function normalizeAnswers($raw)
    {
        $raw = strtoupper(trim($raw));
        $parts = array_map('trim', explode(',', $raw));
        $parts = array_filter($parts, fn($item) => $item !== '');
        return array_values($parts);
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examModel = new Exam();
        $exams = $examModel->getAllByTeacher($teacher['id']);

        $this->view('teacher/grading/index', compact('exams'));
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

        $examModel = new Exam();
        $exam = $examModel->findById($examId);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi để chấm.');
            $this->redirect('/teacher/grading/create');
        }

        $answerKeyRaw = $exam['answer_key'] ?? '';

        $scannedAnswers = $this->normalizeAnswers($scannedAnswersRaw);
        $answerKey = $this->normalizeAnswers($answerKeyRaw);

        $totalQuestions = count($answerKey);
        $correctCount = 0;

        for ($i = 0; $i < $totalQuestions; $i++) {
            $studentAnswer = $scannedAnswers[$i] ?? '';
            $correctAnswer = $answerKey[$i] ?? '';

            if ($studentAnswer === $correctAnswer) {
                $correctCount++;
            }
        }

        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 10, 2) : 0;

        $resultModel = new ExamResult();
        $resultModel->create([
            'exam_id' => $examId,
            'teacher_id' => $teacher['id'],
            'student_name' => $studentName,
            'scanned_answers' => implode(',', $scannedAnswers),
            'total_questions' => $totalQuestions,
            'correct_count' => $correctCount,
            'score' => $score,
            'feedback' => '',
            'status' => 'auto_graded',
        ]);

        Session::flash('success', 'Chấm bài tự động thành công.');
        $this->redirect('/teacher/results');
    }
}
