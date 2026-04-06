<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamResult;

class GradingController extends Controller
{
    private $examModel;
    private $questionModel;
    private $resultModel;

    public function __construct()
    {
        $this->examModel    = new Exam();
        $this->questionModel = new ExamQuestion();
        $this->resultModel  = new ExamResult();
    }

    // Form nhập đáp án học sinh
    public function index($examId)
    {
        if (!Auth::check() || !Auth::isTeacher()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $exam      = $this->examModel->getById($examId);
        $questions = $this->questionModel->getByExamId($examId);
        $this->view('teacher/grading/index', [
            'exam'      => $exam,
            'questions' => $questions
        ]);
    }

    // Xử lý chấm điểm
    public function grade($examId)
    {
        if (!Auth::check() || !Auth::isTeacher()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $questions    = $this->questionModel->getByExamId($examId);
        $studentName  = $_POST['student_name'];
        $answers      = $_POST['answers']; // mảng đáp án học sinh
        $correct      = 0;

        foreach ($questions as $i => $q) {
            if (isset($answers[$i]) && strtoupper($answers[$i]) === strtoupper($q['correct_answer'])) {
                $correct++;
            }
        }

        $total = count($questions);
        $score = $total > 0 ? round(($correct / $total) * 10, 2) : 0;

        $this->resultModel->create([
            'exam_id'      => $examId,
            'student_name' => $studentName,
            'answers'      => json_encode($answers),
            'score'        => $score
        ]);

        header('Location: /LAPTRINHWEB-PLANBOOKAI/public/teacher/results/' . $examId);
        exit;
    }
}