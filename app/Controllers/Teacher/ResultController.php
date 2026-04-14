<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\ExamResult;

class ResultController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new ExamResult();
        $results = $model->getAllByTeacher($teacher['id']);

        $this->view('teacher/results/index', compact('results'));
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new ExamResult();
        $result = $model->findById($id);

        if (!$result) {
            Session::flash('error', 'Không tìm thấy kết quả.');
            $this->redirect('/teacher/results');
        }

        $this->view('teacher/results/show', compact('result'));
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new ExamResult();
        $result = $model->findById($id);

        if (!$result) {
            Session::flash('error', 'Không tìm thấy kết quả.');
            $this->redirect('/teacher/results');
        }

        $this->view('teacher/results/edit', compact('result'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new ExamResult();
        $result = $model->findById($id);

        if (!$result) {
            Session::flash('error', 'Không tìm thấy kết quả.');
            $this->redirect('/teacher/results');
        }

        $model->update($id, [
            'student_name' => $_POST['student_name'] ?? '',
            'feedback' => $_POST['feedback'] ?? '',
            'score' => $_POST['score'] ?? 0,
            'status' => $_POST['status'] ?? 'reviewed',
        ]);

        Session::flash('success', 'Cập nhật kết quả thành công.');
        $this->redirect('/teacher/results');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new ExamResult();
        $result = $model->findById($id);

        if (!$result) {
            Session::flash('error', 'Không tìm thấy kết quả.');
            $this->redirect('/teacher/results');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa kết quả thành công.');
        $this->redirect('/teacher/results');
    }
}