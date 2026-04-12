<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;
use App\Middleware\GuestMiddleware;

class RegisterController extends Controller
{
    public function index()
    {
        GuestMiddleware::handle();
        $this->view('auth/register');
    }

    public function register()
    {
        GuestMiddleware::handle();

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'role' => $_POST['role'] ?? 'teacher',
        ];

        $userModel = new User();
        $existingUser = $userModel->findByEmail($data['email']);

        if ($existingUser) {
            Session::flash('error', 'Email đã tồn tại.');
            $this->redirect('/register');
        }

        $userModel->create($data);

        Session::flash('success', 'Đăng ký thành công. Hãy đăng nhập.');
        $this->redirect('/register');
    }
}