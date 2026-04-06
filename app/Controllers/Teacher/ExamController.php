<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Exam;
use App\Models\ExamQuestion;

class ExamController extends Controller
{
    private $examModel;
    private $questionModel;

    public function __construct()
    {
        $this->examModel = new Exam();
        $this->questionModel = new ExamQuestion();
    }

    // Danh sách đề thi
    public function index()
    {
        if (!Auth::check() || !Auth::isTeacher()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $userId = Auth::user()['id'];
        $exams = $this->examModel->getAll($userId);
        $this->view('teacher/exam/index', ['exams' => $exams]);
    }

    // Form tạo đề thi
    public function create()
    {
        if (!Auth::check() || !Auth::isTeacher()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $this->view('teacher/exam/create');
    }

    // Lưu đề thi
    public function store()
    {
        if (!Auth::check() || !Auth::isTeacher()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $userId = Auth::user()['id'];

        $examId = $this->examModel->create([
            'title'            => $_POST['title'],
            'subject'          => $_POST['subject'],
            'duration_minutes' => $_POST['duration_minutes'],
            'total_questions'  => count($_POST['questions']),
            'created_by'       => $userId
        ]);

        foreach ($_POST['questions'] as $q) {
            $this->questionModel->create([
                'exam_id'       => $examId,
                'question_text' => $q['question_text'],
                'option_a'      => $q['option_a'],
                'option_b'      => $q['option_b'],
                'option_c'      => $q['option_c'],
                'option_d'      => $q['option_d'],
                'correct_answer'=> $q['correct_answer']
            ]);
        }

        header('Location: /LAPTRINHWEB-PLANBOOKAI/public/teacher/exams');
        exit;
    }

    // Xem chi tiết đề thi
    public function detail($id)
    {
        if (!Auth::check() || !Auth::isTeacher()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $exam = $this->examModel->getById($id);
        $questions = $this->questionModel->getByExamId($id);
        $this->view('teacher/exam/detail', ['exam' => $exam, 'questions' => $questions]);
    }

    // Xóa đề thi
    public function delete($id)
    {
        if (!Auth::check() || !Auth::isTeacher()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $this->examModel->delete($id);
        header('Location: /LAPTRINHWEB-PLANBOOKAI/public/teacher/exams');
        exit;
    }
}