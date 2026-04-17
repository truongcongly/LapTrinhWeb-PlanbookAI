<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\RoleMiddleware;
use App\Models\User;
use App\Models\CurriculumFramework;
use App\Core\Database;

class ReportController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('admin');
    }

    private function countTable($table)
    {
        $conn = Database::getInstance()->getConnection();
        $result = $conn->query("SELECT COUNT(*) as total FROM $table");
        $row = $result->fetch_assoc();
        return (int)$row['total'];
    }

    public function index()
    {
        $this->authorize();

        $userModel = new User();
        $frameworkModel = new CurriculumFramework();

        $stats = [
            'total_users' => $userModel->countAll(),
            'admin_count' => $userModel->countByRole('admin'),
            'staff_count' => $userModel->countByRole('staff'),
            'teacher_count' => $userModel->countByRole('teacher'),
            'framework_count' => $frameworkModel->countAll(),
            'lesson_plan_count' => $this->countTable('lesson_plans'),
            'question_count' => $this->countTable('questions'),
            'exercise_count' => $this->countTable('exercises'),
            'exam_count' => $this->countTable('exams'),
            'result_count' => $this->countTable('exam_results'),
            'sample_lesson_count' => $this->countTable('lesson_plan_samples'),
            'sample_question_count' => $this->countTable('question_samples'),
        ];

        $this->view('admin/reports/index', compact('stats'));
    }
}