<?php

use App\Controllers\HomeController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Controllers\Teacher\ExamController;
use App\Controllers\Teacher\GradingController;
use App\Controllers\Teacher\ResultController;

return [
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/login', [LoginController::class, 'index']],
    ['GET', '/staff/dashboard', [StaffDashboardController::class, 'index']],
    ['GET', '/teacher/dashboard', [TeacherDashboardController::class, 'index']],

    // Exam routes
    ['GET',  '/teacher/exams',              [ExamController::class, 'index']],
    ['GET',  '/teacher/exams/create',       [ExamController::class, 'create']],
    ['POST', '/teacher/exams/store',        [ExamController::class, 'store']],
    ['GET',  '/teacher/exams/{id}',         [ExamController::class, 'detail']],
    ['GET',  '/teacher/exams/delete/{id}',  [ExamController::class, 'delete']],

    // Grading routes
    ['GET',  '/teacher/grading/{examId}',             [GradingController::class, 'index']],
    ['POST', '/teacher/grading/{examId}/grade',       [GradingController::class, 'grade']],

    // Result routes
    ['GET',  '/teacher/results/{examId}',  [ResultController::class, 'index']],
];