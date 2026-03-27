<?php

use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\UserController;

return [
    ['GET', '/admin/dashboard', [DashboardController::class, 'index']],

    ['GET', '/admin/users', [UserController::class, 'index']],
    ['GET', '/admin/users/create', [UserController::class, 'create']],
    ['POST', '/admin/users/store', [UserController::class, 'store']],
    ['GET', '/admin/users/edit', [UserController::class, 'edit']],
    ['POST', '/admin/users/update', [UserController::class, 'update']],
    ['GET', '/admin/users/delete', [UserController::class, 'delete']],
];