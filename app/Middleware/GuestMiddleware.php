<?php

namespace App\Middleware;

use App\Core\Auth;

class GuestMiddleware
{
    public static function handle()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user['role'] === 'admin') {
                header('Location: /LapTrinhWeb-PlanbookAI/public/admin/dashboard');
                exit();
            }

            if ($user['role'] === 'staff') {
                header('Location: /LapTrinhWeb-PlanbookAI/public/staff/dashboard');
                exit();
            }

            if ($user['role'] === 'teacher') {
                header('Location: /LapTrinhWeb-PlanbookAI/public/teacher/dashboard');
                exit();
            }
        }
    }
}