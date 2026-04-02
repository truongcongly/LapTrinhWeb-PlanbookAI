<?php

namespace App\Core;

class Auth
{
    public static function check()
    {
        Session::start();
        return Session::has('user');
    }

    public static function user()
    {
        Session::start();
        return Session::get('user');
    }

    public static function login($user)
    {
        Session::start();
        Session::set('user', $user);
    }

    public static function logout()
    {
        Session::start();
        Session::destroy();
    }

    public static function role()
    {
        $user = self::user();
        return $user['role'] ?? null;
    }

    public static function isAdmin()
    {
        return self::role() === 'admin';
    }

    public static function isStaff()
    {
        return self::role() === 'staff';
    }

    public static function isTeacher()
    {
        return self::role() === 'teacher';
    }
}