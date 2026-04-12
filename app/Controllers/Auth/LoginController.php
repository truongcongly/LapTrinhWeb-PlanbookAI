<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Models\User;
use App\Middleware\GuestMiddleware;

class LoginController extends Controller
{
    public function index()
    {
        GuestMiddleware::handle();
        $this->view('auth/login');
    }

    public function login()
    {
        GuestMiddleware::handle();

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && $user['password'] === md5($password)) {
            Auth::login($user);

            if ($user['role'] === 'admin') {
                $this->redirect('/admin/dashboard');
            } elseif ($user['role'] === 'staff') {
                $this->redirect('/staff/dashboard');
            } else {
                $this->redirect('/teacher/dashboard');
            }
        }

        Session::flash('error', 'Email hoặc mật khẩu không đúng.');
        $this->redirect('/login');
    }
}