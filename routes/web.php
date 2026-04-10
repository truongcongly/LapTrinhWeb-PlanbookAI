<?php

use App\Controllers\HomeController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Controllers\Teacher\ExamController;
use App\Controllers\Teacher\GradingController;
use App\Controllers\Teacher\ResultController;
use App\Controllers\Teacher\LessonPlanController;
use App\Controllers\Teacher\QuestionController;

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

    // Lesson Plan routes
    ['GET', '/teacher/lesson-plans', [LessonPlanController::class, 'index']],
    ['GET', '/teacher/lesson-plans/create', [LessonPlanController::class, 'create']],
    ['POST', '/teacher/lesson-plans/store', [LessonPlanController::class, 'store']],
    ['GET', '/teacher/lesson-plans/show', [LessonPlanController::class, 'show']],
    ['GET', '/teacher/lesson-plans/edit', [LessonPlanController::class, 'edit']],
    ['POST', '/teacher/lesson-plans/update', [LessonPlanController::class, 'update']],
    ['GET', '/teacher/lesson-plans/delete', [LessonPlanController::class, 'delete']],

    // Question routes
    ['GET', '/teacher/questions', [QuestionController::class, 'index']],
    ['GET', '/teacher/questions/create', [QuestionController::class, 'create']],
    ['POST', '/teacher/questions/store', [QuestionController::class, 'store']],
    ['GET', '/teacher/questions/show', [QuestionController::class, 'show']],
    ['GET', '/teacher/questions/edit', [QuestionController::class, 'edit']],
    ['POST', '/teacher/questions/update', [QuestionController::class, 'update']],
    ['GET', '/teacher/questions/delete', [QuestionController::class, 'delete']],
];