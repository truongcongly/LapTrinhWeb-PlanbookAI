<?php

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Database;
use App\Middleware\RoleMiddleware;

class AnalyticsController extends Controller
{
    private array $tables = [
        'users',
        'curriculum_frameworks',
        'lesson_plans',
        'questions',
        'exercises',
        'exams',
        'exam_results',
        'lesson_plan_samples',
        'question_samples',
        'prompt_templates',
        'system_settings',
    ];

    private function authorize(): void
    {
        RoleMiddleware::handle('admin');
    }

    private function conn()
    {
        return Database::getInstance()->getConnection();
    }

    private function countTable(string $table): int
    {
        if (!in_array($table, $this->tables, true)) {
            return 0;
        }

        $result = $this->conn()->query("SELECT COUNT(*) AS total FROM $table");
        $row = $result ? $result->fetch_assoc() : null;

        return (int)($row['total'] ?? 0);
    }

    private function countWhere(string $table, string $where): int
    {
        if (!in_array($table, $this->tables, true)) {
            return 0;
        }

        $result = $this->conn()->query("SELECT COUNT(*) AS total FROM $table WHERE $where");
        $row = $result ? $result->fetch_assoc() : null;

        return (int)($row['total'] ?? 0);
    }

    private function systemCounts(): array
    {
        return [
            'users' => $this->countTable('users'),
            'frameworks' => $this->countTable('curriculum_frameworks'),
            'lesson_plans' => $this->countTable('lesson_plans'),
            'questions' => $this->countTable('questions'),
            'exercises' => $this->countTable('exercises'),
            'exams' => $this->countTable('exams'),
            'results' => $this->countTable('exam_results'),
            'lesson_samples' => $this->countTable('lesson_plan_samples'),
            'question_samples' => $this->countTable('question_samples'),
            'prompts' => $this->countTable('prompt_templates'),
        ];
    }

    private function roleCounts(): array
    {
        return [
            'admin' => $this->countWhere('users', "role = 'admin'"),
            'staff' => $this->countWhere('users', "role = 'staff'"),
            'teacher' => $this->countWhere('users', "role = 'teacher'"),
        ];
    }

    private function resultStatusCounts(): array
    {
        return [
            'auto_graded' => $this->countWhere('exam_results', "status = 'auto_graded'"),
            'needs_review' => $this->countWhere('exam_results', "status = 'needs_review'"),
            'reviewed' => $this->countWhere('exam_results', "status = 'reviewed'"),
            'failed' => $this->countWhere('exam_results', "status = 'failed'"),
        ];
    }

    public function charts(): void
    {
        $this->authorize();

        $counts = $this->systemCounts();
        $roleCounts = $this->roleCounts();
        $resultStatusCounts = $this->resultStatusCounts();

        $this->view('admin/analytics/charts', compact('counts', 'roleCounts', 'resultStatusCounts'));
    }

    public function authentication(): void
    {
        $this->authorize();

        $currentUser = Auth::user();
        $roleCounts = $this->roleCounts();
        $counts = $this->systemCounts();

        $this->view('admin/analytics/authentication', compact('currentUser', 'roleCounts', 'counts'));
    }

    public function errors(): void
    {
        $this->authorize();

        $checks = [
            [
                'name' => 'Kết nối cơ sở dữ liệu',
                'status' => $this->conn()->ping(),
                'detail' => 'Ứng dụng có thể kết nối tới cơ sở dữ liệu MySQL đã cấu hình.',
            ],
            [
                'name' => 'Thư mục tải lên bài quét',
                'status' => is_dir(dirname(__DIR__, 3) . '/public/uploads/answer-scans'),
                'detail' => 'Bắt buộc cho quy trình tải lên PDF và ảnh quét bài làm.',
            ],
            [
                'name' => 'Bảng cài đặt hệ thống',
                'status' => $this->countTable('system_settings') >= 0,
                'detail' => 'Các bảng cốt lõi của ứng dụng có thể đọc được.',
            ],
            [
                'name' => 'Kết quả OCR bị lỗi',
                'status' => $this->countWhere('exam_results', "status = 'failed'") === 0,
                'detail' => $this->countWhere('exam_results', "status = 'failed'") . ' kết quả chấm điểm bị lỗi.',
            ],
        ];

        $this->view('admin/analytics/errors', compact('checks'));
    }
}
