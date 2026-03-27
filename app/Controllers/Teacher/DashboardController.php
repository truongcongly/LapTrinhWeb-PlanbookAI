<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::isTeacher()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $this->view('teacher/dashboard');
    }
}