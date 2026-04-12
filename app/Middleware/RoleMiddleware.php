<?php

namespace App\Middleware;

use App\Core\Auth;

class RoleMiddleware
{
    public static function handle($role)
    {
        if (!Auth::check()) {
            header('Location: /LapTrinhWeb-PlanbookAI/public/login');
            exit();
        }

        $user = Auth::user();

        if (!isset($user['role']) || $user['role'] !== $role) {
            header('Location: /LapTrinhWeb-PlanbookAI/public/login');
            exit();
        }
    }
}