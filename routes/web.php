<?php

use App\Controllers\HomeController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Controllers\Staff\QuestionSampleController;
use App\Controllers\Staff\LessonPlanSampleController;
use App\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Controllers\Teacher\ExamController;
use App\Controllers\Teacher\GradingController;
use App\Controllers\Teacher\ResultController;
use App\Controllers\Teacher\LessonPlanController;
use App\Controllers\Teacher\QuestionController;
use App\Controllers\Teacher\ExerciseController;
use App\Controllers\Admin\CurriculumFrameworkController;
use App\Controllers\Admin\SystemSettingController;
use App\Controllers\Admin\ReportController;
use App\Controllers\Staff\PromptTemplateController;


return [
    // Staff Prompt routes
    ['GET',  '/staff/prompts',        [PromptTemplateController::class, 'index']],
    ['GET',  '/staff/prompts/create', [PromptTemplateController::class, 'create']],
    ['POST', '/staff/prompts/store',  [PromptTemplateController::class, 'store']],
    ['GET',  '/staff/prompts/show',   [PromptTemplateController::class, 'show']],
    ['GET',  '/staff/prompts/edit',   [PromptTemplateController::class, 'edit']],
    ['POST', '/staff/prompts/update', [PromptTemplateController::class, 'update']],
    ['GET',  '/staff/prompts/delete', [PromptTemplateController::class, 'delete']],
    ['GET',  '/staff/prompts/import', [PromptTemplateController::class, 'import']],

    ['GET', '/giao-vien', [HomeController::class, 'teacher']],
    ['GET', '/truong-hoc', [HomeController::class, 'school']],
    ['GET', '/bang-gia', [HomeController::class, 'pricing']],
    ['GET', '/ung-dung-di-dong', [HomeController::class, 'mobileApp']],
    ['GET', '/lien-he', [HomeController::class, 'contact']],
    ['GET', '/roles', [HomeController::class, 'roles']],
    ['GET', '/workflow', [HomeController::class, 'workflow']],
    ['GET', '/about', [HomeController::class, 'about']],
    ['GET', '/', [HomeController::class, 'index']],
    ['GET', '/login', [LoginController::class, 'index']],
    ['GET', '/staff/dashboard', [StaffDashboardController::class, 'index']],
    ['GET', '/teacher/dashboard', [TeacherDashboardController::class, 'index']],

    // Staff Question Sample routes
    ['GET', '/staff/question-samples', [QuestionSampleController::class, 'index']],
    ['GET', '/staff/question-samples/create', [QuestionSampleController::class, 'create']],
    ['POST', '/staff/question-samples/store', [QuestionSampleController::class, 'store']],
    ['GET', '/staff/question-samples/show', [QuestionSampleController::class, 'show']],
    ['GET', '/staff/question-samples/edit', [QuestionSampleController::class, 'edit']],
    ['POST', '/staff/question-samples/update', [QuestionSampleController::class, 'update']],
    ['GET', '/staff/question-samples/delete', [QuestionSampleController::class, 'delete']],

    ['GET', '/staff/question-samples/import', [QuestionSampleController::class, 'import']],

    // Staff Lesson Sample routes
    ['GET',  '/staff/lesson-samples',              [LessonPlanSampleController::class, 'index']],
    ['GET',  '/staff/lesson-samples/create',       [LessonPlanSampleController::class, 'create']],
    ['POST', '/staff/lesson-samples/store',        [LessonPlanSampleController::class, 'store']],
    ['GET',  '/staff/lesson-samples/show',         [LessonPlanSampleController::class, 'show']],
    ['GET',  '/staff/lesson-samples/edit',         [LessonPlanSampleController::class, 'edit']],
    ['POST', '/staff/lesson-samples/update',       [LessonPlanSampleController::class, 'update']],
    ['GET',  '/staff/lesson-samples/delete',       [LessonPlanSampleController::class, 'delete']],
    ['GET',  '/staff/lesson-samples/grade-levels', [LessonPlanSampleController::class, 'gradeLevels']],

    ['GET', '/staff/lesson-samples/import', [LessonPlanSampleController::class, 'import']],

    // Exam routes
    ['GET', '/teacher/exams', [ExamController::class, 'index']],
    ['GET', '/teacher/exams/create', [ExamController::class, 'create']],
    ['POST', '/teacher/exams/store', [ExamController::class, 'store']],
    ['GET', '/teacher/exams/show', [ExamController::class, 'show']],
    ['GET', '/teacher/exams/edit', [ExamController::class, 'edit']],
    ['POST', '/teacher/exams/update', [ExamController::class, 'update']],
    ['GET', '/teacher/exams/delete', [ExamController::class, 'delete']],

    ['GET', '/teacher/exams/take', [ExamController::class, 'take']],
    ['POST', '/teacher/exams/submit', [ExamController::class, 'submit']],

    // Grading routes
    ['GET', '/teacher/grading', [GradingController::class, 'index']],
    ['GET', '/teacher/grading/create', [GradingController::class, 'create']],
    ['POST', '/teacher/grading/store', [GradingController::class, 'store']],

    // Result routes
    ['GET', '/teacher/results', [ResultController::class, 'index']],
    ['GET', '/teacher/results/show', [ResultController::class, 'show']],
    ['GET', '/teacher/results/edit', [ResultController::class, 'edit']],
    ['POST', '/teacher/results/update', [ResultController::class, 'update']],
    ['GET', '/teacher/results/delete', [ResultController::class, 'delete']],

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

    //Excerise routes 
    ['GET', '/teacher/exercises', [ExerciseController::class, 'index']],
    ['GET', '/teacher/exercises/create', [ExerciseController::class, 'create']],
    ['POST', '/teacher/exercises/store', [ExerciseController::class, 'store']],
    ['GET', '/teacher/exercises/show', [ExerciseController::class, 'show']],
    ['GET', '/teacher/exercises/edit', [ExerciseController::class, 'edit']],
    ['POST', '/teacher/exercises/update', [ExerciseController::class, 'update']],
    ['GET', '/teacher/exercises/delete', [ExerciseController::class, 'delete']],

    // Admin Curriculum Framework routes
    ['GET', '/admin/frameworks', [CurriculumFrameworkController::class, 'index']],
    ['GET', '/admin/frameworks/create', [CurriculumFrameworkController::class, 'create']],
    ['POST', '/admin/frameworks/store', [CurriculumFrameworkController::class, 'store']],
    ['GET', '/admin/frameworks/show', [CurriculumFrameworkController::class, 'show']],
    ['GET', '/admin/frameworks/edit', [CurriculumFrameworkController::class, 'edit']],
    ['POST', '/admin/frameworks/update', [CurriculumFrameworkController::class, 'update']],
    ['GET', '/admin/frameworks/delete', [CurriculumFrameworkController::class, 'delete']],

    // Admin System Setting routes
    ['GET', '/admin/settings', [SystemSettingController::class, 'index']],
    ['POST', '/admin/settings/update', [SystemSettingController::class, 'update']],

    // Admin Report routes
    ['GET', '/admin/reports', [ReportController::class, 'index']],
];
