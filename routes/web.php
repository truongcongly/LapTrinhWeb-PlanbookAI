<?php

use App\Controllers\HomeController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Controllers\Teacher\DashboardController as TeacherDashboardController;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/login', [LoginController::class, 'index']],
    ['GET', '/staff/dashboard', [StaffDashboardController::class, 'index']],
    ['GET', '/teacher/dashboard', [TeacherDashboardController::class, 'index']],
];