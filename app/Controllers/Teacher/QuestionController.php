<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\Question;

class QuestionController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new Question();
        $questions = $model->getAllByTeacher($teacher['id']);

        $this->view('teacher/questions/index', compact('questions'));
    }

    public function create()
    {
        $this->authorize();
        $this->view('teacher/questions/create');
    }

    public function store()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new Question();

        $model->create([
            'teacher_id' => $teacher['id'],
            'question_text' => $_POST['question_text'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'difficulty' => $_POST['difficulty'] ?? 'medium',
            'option_a' => $_POST['option_a'] ?? '',
            'option_b' => $_POST['option_b'] ?? '',
            'option_c' => $_POST['option_c'] ?? '',
            'option_d' => $_POST['option_d'] ?? '',
            'correct_answer' => $_POST['correct_answer'] ?? 'A',
        ]);

        Session::flash('success', 'Tạo câu hỏi thành công.');
        $this->redirect('/teacher/questions');
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Question();
        $question = $model->findById($id);

        if (!$question) {
            Session::flash('error', 'Không tìm thấy câu hỏi.');
            $this->redirect('/teacher/questions');
        }

        $this->view('teacher/questions/show', compact('question'));
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Question();
        $question = $model->findById($id);

        if (!$question) {
            Session::flash('error', 'Không tìm thấy câu hỏi.');
            $this->redirect('/teacher/questions');
        }

        $this->view('teacher/questions/edit', compact('question'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Question();

        $question = $model->findById($id);
        if (!$question) {
            Session::flash('error', 'Không tìm thấy câu hỏi.');
            $this->redirect('/teacher/questions');
        }

        $model->update($id, [
            'question_text' => $_POST['question_text'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'difficulty' => $_POST['difficulty'] ?? 'medium',
            'option_a' => $_POST['option_a'] ?? '',
            'option_b' => $_POST['option_b'] ?? '',
            'option_c' => $_POST['option_c'] ?? '',
            'option_d' => $_POST['option_d'] ?? '',
            'correct_answer' => $_POST['correct_answer'] ?? 'A',
        ]);

        Session::flash('success', 'Cập nhật câu hỏi thành công.');
        $this->redirect('/teacher/questions');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new Question();

        $question = $model->findById($id);
        if (!$question) {
            Session::flash('error', 'Không tìm thấy câu hỏi.');
            $this->redirect('/teacher/questions');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa câu hỏi thành công.');
        $this->redirect('/teacher/questions');
    }
}