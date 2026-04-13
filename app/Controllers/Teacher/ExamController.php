<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\Exam;

class ExamController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new Exam();
        $exams = $model->getAllByTeacher($teacher['id']);

        $this->view('teacher/exams/index', compact('exams'));
    }

    public function create()
    {
        $this->authorize();
        $this->view('teacher/exams/create');
    }

    public function store()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new Exam();

        $examId = $model->create([
            'teacher_id' => $teacher['id'],
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'total_questions' => $_POST['total_questions'] ?? 0,
            'duration_minutes' => $_POST['duration_minutes'] ?? 45,
            'status' => $_POST['status'] ?? 'draft',
            'instructions' => $_POST['instructions'] ?? '',
        ]);

        $model->saveAnswerKey($examId, $_POST['answer_key'] ?? '');

        Session::flash('success', 'Tạo đề thi thành công.');
        $this->redirect('/teacher/exams');
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Exam();
        $exam = $model->findById($id);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $this->view('teacher/exams/show', compact('exam'));
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Exam();
        $exam = $model->findById($id);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $this->view('teacher/exams/edit', compact('exam'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Exam();

        $exam = $model->findById($id);
        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $model->update($id, [
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'total_questions' => $_POST['total_questions'] ?? 0,
            'duration_minutes' => $_POST['duration_minutes'] ?? 45,
            'status' => $_POST['status'] ?? 'draft',
            'instructions' => $_POST['instructions'] ?? '',
        ]);

        $model->saveAnswerKey($id, $_POST['answer_key'] ?? '');

        Session::flash('success', 'Cập nhật đề thi thành công.');
        $this->redirect('/teacher/exams');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Exam();

        $exam = $model->findById($id);
        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa đề thi thành công.');
        $this->redirect('/teacher/exams');
    }
}