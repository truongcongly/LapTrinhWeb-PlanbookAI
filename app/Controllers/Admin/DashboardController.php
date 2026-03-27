<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::isAdmin()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $this->view('admin/dashboard');
    }
}