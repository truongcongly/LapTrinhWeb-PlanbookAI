<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        Session::start();

        $email = $_POST['email'] ?? '';
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

        Session::set('error', 'Email hoặc mật khẩu không đúng.');
        $this->redirect('/login');
    }
}