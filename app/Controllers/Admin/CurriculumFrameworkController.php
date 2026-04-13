<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\CurriculumFramework;

class CurriculumFrameworkController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('admin');
    }

    public function index()
    {
        $this->authorize();

        $model = new CurriculumFramework();
        $frameworks = $model->getAll();

        $this->view('admin/frameworks/index', compact('frameworks'));
    }

    public function create()
    {
        $this->authorize();
        $this->view('admin/frameworks/create');
    }

    public function store()
    {
        $this->authorize();

        $admin = Auth::user();
        $model = new CurriculumFramework();

        $model->create([
            'admin_id' => $admin['id'],
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'objectives' => $_POST['objectives'] ?? '',
            'activities' => $_POST['activities'] ?? '',
            'assessment' => $_POST['assessment'] ?? '',
            'status' => $_POST['status'] ?? 'draft',
        ]);

        Session::flash('success', 'Tạo curriculum framework thành công.');
        $this->redirect('/admin/frameworks');
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new CurriculumFramework();
        $framework = $model->findById($id);

        if (!$framework) {
            Session::flash('error', 'Không tìm thấy framework.');
            $this->redirect('/admin/frameworks');
        }

        $this->view('admin/frameworks/show', compact('framework'));
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new CurriculumFramework();
        $framework = $model->findById($id);

        if (!$framework) {
            Session::flash('error', 'Không tìm thấy framework.');
            $this->redirect('/admin/frameworks');
        }

        $this->view('admin/frameworks/edit', compact('framework'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new CurriculumFramework();
        $framework = $model->findById($id);

        if (!$framework) {
            Session::flash('error', 'Không tìm thấy framework.');
            $this->redirect('/admin/frameworks');
        }

        $model->update($id, [
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'objectives' => $_POST['objectives'] ?? '',
            'activities' => $_POST['activities'] ?? '',
            'assessment' => $_POST['assessment'] ?? '',
            'status' => $_POST['status'] ?? 'draft',
        ]);

        Session::flash('success', 'Cập nhật framework thành công.');
        $this->redirect('/admin/frameworks');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new CurriculumFramework();
        $framework = $model->findById($id);

        if (!$framework) {
            Session::flash('error', 'Không tìm thấy framework.');
            $this->redirect('/admin/frameworks');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa framework thành công.');
        $this->redirect('/admin/frameworks');
    }
}