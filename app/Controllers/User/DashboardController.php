<?php

namespace App\Controllers\User;

use App\Core\Controller;
use App\Core\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::isUser()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $this->view('user/dashboard');
    }
}