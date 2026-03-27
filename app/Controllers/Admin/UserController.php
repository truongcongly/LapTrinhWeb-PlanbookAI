<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\User;

class UserController extends Controller
{
    private function authorize()
    {
        if (!Auth::check() || !Auth::isAdmin()) {
            die('403 - Bạn không có quyền truy cập');
        }
    }

    public function index()
    {
        $this->authorize();

        $userModel = new User();
        $users = $userModel->getAll();

        $this->view('admin/users/index', compact('users'));
    }

    public function create()
    {
        $this->authorize();
        $this->view('admin/users/create');
    }

    public function store()
    {
        $this->authorize();

        $userModel = new User();
        $userModel->create($_POST);

        $this->redirect('/admin/users');
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $userModel = new User();
        $user = $userModel->findById($id);

        $this->view('admin/users/edit', compact('user'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $userModel = new User();
        $userModel->update($id, $_POST);

        $this->redirect('/admin/users');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $userModel = new User();
        $userModel->delete($id);

        $this->redirect('/admin/users');
    }
}