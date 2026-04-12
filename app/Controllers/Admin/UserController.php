<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;
use App\Middleware\RoleMiddleware;

class UserController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('admin');
    }

    public function index()
    {
        $this->authorize();

        $keyword = $_GET['keyword'] ?? '';
        $role = $_GET['role'] ?? '';

        $userModel = new User();
        $users = $userModel->search($keyword, $role);

        $this->view('admin/users/index', compact('users', 'keyword', 'role'));
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

        if ($userModel->findByEmail($_POST['email'] ?? '')) {
            Session::flash('error', 'Email đã tồn tại trong hệ thống.');
            $this->redirect('/admin/users/create');
        }

        $userModel->create($_POST);
        Session::flash('success', 'Thêm người dùng thành công.');
        $this->redirect('/admin/users');
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $userModel = new User();
        $user = $userModel->findById($id);

        if (!$user) {
            Session::flash('error', 'Không tìm thấy người dùng.');
            $this->redirect('/admin/users');
        }

        $this->view('admin/users/edit', compact('user'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $userModel = new User();

        $user = $userModel->findById($id);
        if (!$user) {
            Session::flash('error', 'Không tìm thấy người dùng.');
            $this->redirect('/admin/users');
        }

        if ($userModel->findByEmailExceptId($_POST['email'] ?? '', $id)) {
            Session::flash('error', 'Email đã tồn tại ở tài khoản khác.');
            $this->redirect('/admin/users/edit?id=' . $id);
        }

        $userModel->update($id, $_POST);
        Session::flash('success', 'Cập nhật người dùng thành công.');
        $this->redirect('/admin/users');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $userModel = new User();

        $user = $userModel->findById($id);
        if (!$user) {
            Session::flash('error', 'Không tìm thấy người dùng.');
            $this->redirect('/admin/users');
        }

        $userModel->delete($id);
        Session::flash('success', 'Xóa người dùng thành công.');
        $this->redirect('/admin/users');
    }
}