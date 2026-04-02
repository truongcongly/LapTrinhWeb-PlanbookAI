<?php

namespace App\Controllers\Staff;

use App\Core\Controller;
use App\Core\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::isStaff()) {
            die('403 - Bạn không có quyền truy cập');
        }

        $this->view('staff/dashboard');
    }
}