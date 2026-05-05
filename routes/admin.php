<?php

use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\UserController;
use App\Controllers\Admin\CurriculumFrameworkController;
use App\Controllers\Admin\ReportController;
use App\Controllers\Admin\SystemSettingController;
use App\Controllers\Admin\AnalyticsController;

return [
    ['GET', '/admin/dashboard', [DashboardController::class, 'index']],

    ['GET', '/admin/users', [UserController::class, 'index']],
    ['GET', '/admin/users/create', [UserController::class, 'create']],
    ['POST', '/admin/users/store', [UserController::class, 'store']],
    ['GET', '/admin/users/edit', [UserController::class, 'edit']],
    ['POST', '/admin/users/update', [UserController::class, 'update']],
    ['GET', '/admin/users/delete', [UserController::class, 'delete']],

    ['GET', '/admin/frameworks', [CurriculumFrameworkController::class, 'index']],
    ['GET', '/admin/frameworks/create', [CurriculumFrameworkController::class, 'create']],
    ['POST', '/admin/frameworks/store', [CurriculumFrameworkController::class, 'store']],
    ['GET', '/admin/frameworks/show', [CurriculumFrameworkController::class, 'show']],
    ['GET', '/admin/frameworks/edit', [CurriculumFrameworkController::class, 'edit']],
    ['POST', '/admin/frameworks/update', [CurriculumFrameworkController::class, 'update']],
    ['GET', '/admin/frameworks/delete', [CurriculumFrameworkController::class, 'delete']],

    ['GET', '/admin/reports', [ReportController::class, 'index']],

    ['GET', '/admin/settings', [SystemSettingController::class, 'index']],
    ['POST', '/admin/settings/update', [SystemSettingController::class, 'update']],

    ['GET', '/admin/charts', [AnalyticsController::class, 'charts']],
    ['GET', '/admin/authentication', [AnalyticsController::class, 'authentication']],
    ['GET', '/admin/errors', [AnalyticsController::class, 'errors']],
];
