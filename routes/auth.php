<?php

use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Auth\LogoutController;

return [
    ['GET', '/login', [LoginController::class, 'index']],
    ['POST', '/login', [LoginController::class, 'login']],

    ['GET', '/register', [RegisterController::class, 'index']],
    ['POST', '/register', [RegisterController::class, 'register']],

    ['GET', '/logout', [LogoutController::class, 'index']],
];