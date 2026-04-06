<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Exam;
use App\Models\ExamResult;

class ResultController extends Controller
{
    private $examModel;
    private $resultModel;

    public function __construct()
    {
        $this->examModel  = new Exam();
        $this->resultModel = new ExamResult();
    }

    public function index($examId)
    {
        if (!Auth::check() || !Auth::isTeacher()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $exam    = $this->examModel->getById($examId);
        $results = $this->resultModel->getByExamId($examId);
        $this->view('teacher/result/index', [
            'exam'    => $exam,
            'results' => $results
        ]);
    }
}