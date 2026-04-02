<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $this->view('auth/register');
    }

    public function register()
    {
        Session::start();

        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'role' => $_POST['role'] ?? 'teacher',
        ];

        $userModel = new User();
        $existingUser = $userModel->findByEmail($data['email']);

        if ($existingUser) {
            Session::set('error', 'Email đã tồn tại.');
            $this->redirect('/register');
        }

        $userModel->create($data);
        Session::set('success', 'Đăng ký thành công. Hãy đăng nhập.');
        $this->redirect('/register');
    }
}