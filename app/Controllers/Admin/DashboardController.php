<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Middleware\RoleMiddleware;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        RoleMiddleware::handle('admin');

        $userModel = new User();

        $stats = [
            'total_users' => $userModel->countAll(),
            'admin_count' => $userModel->countByRole('admin'),
            'staff_count' => $userModel->countByRole('staff'),
            'teacher_count' => $userModel->countByRole('teacher'),
            'active_accounts' => $userModel->countAll()
        ];

        $recentUsers = $userModel->getRecentUsers(5);

        $this->view('admin/dashboard', compact('stats', 'recentUsers'));
    }
}