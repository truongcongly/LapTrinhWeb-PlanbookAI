<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Controllers\User\DashboardController as UserDashboardController;

return [
    ['GET', '/', [LoginController::class, 'index']],
    ['GET', '/teacher/dashboard', [TeacherDashboardController::class, 'index']],
    ['GET', '/user/dashboard', [UserDashboardController::class, 'index']],
];