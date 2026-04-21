<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\Exercise;
use App\Models\PromptTemplate;

class ExerciseController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new Exercise();
        $exercises = $model->getAllByTeacher($teacher['id']);

        $this->view('teacher/exercises/index', compact('exercises'));
    }

    public function create()
    {
        $this->authorize();
        $promptModel = new PromptTemplate();
        $promptTemplates = $promptModel->getActiveTemplates('exercise');
        $this->view('teacher/exercises/create', compact('promptTemplates'));
    }

    public function store()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new Exercise();

        $model->create([
            'teacher_id' => $teacher['id'],
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'description' => $_POST['description'] ?? '',
            'content' => $_POST['content'] ?? '',
            'status' => $_POST['status'] ?? 'draft',
        ]);

        Session::flash('success', 'Tạo bài tập thành công.');
        $this->redirect('/teacher/exercises');
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Exercise();
        $exercise = $model->findById($id);

        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài tập.');
            $this->redirect('/teacher/exercises');
        }

        $this->view('teacher/exercises/show', compact('exercise'));
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Exercise();
        $exercise = $model->findById($id);

        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài tập.');
            $this->redirect('/teacher/exercises');
        }

        $promptModel = new PromptTemplate();
        $promptTemplates = $promptModel->getActiveTemplates('exercise');
        $this->view('teacher/exercises/edit', compact('exercise', 'promptTemplates'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Exercise();
        $exercise = $model->findById($id);

        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài tập.');
            $this->redirect('/teacher/exercises');
        }

        $model->update($id, [
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'description' => $_POST['description'] ?? '',
            'content' => $_POST['content'] ?? '',
            'status' => $_POST['status'] ?? 'draft',
        ]);

        Session::flash('success', 'Cập nhật bài tập thành công.');
        $this->redirect('/teacher/exercises');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Exercise();
        $exercise = $model->findById($id);

        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài tập.');
            $this->redirect('/teacher/exercises');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa bài tập thành công.');
        $this->redirect('/teacher/exercises');
    }
}
