<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Controllers\Staff\DashboardController as StaffDashboardController;

return [
    ['GET', '/', [LoginController::class, 'index']],
    ['GET', '/teacher/dashboard', [TeacherDashboardController::class, 'index']],
    ['GET', '/staff/dashboard', [StaffDashboardController::class, 'index']],
];