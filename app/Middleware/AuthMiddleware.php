<?php

namespace App\Middleware;

use App\Core\Auth;

class AuthMiddleware
{
    public static function handle()
    {
        if (!Auth::check()) {
            header('Location: /LapTrinhWeb-PlanbookAI/public/login');
            exit();
        }
    }
}