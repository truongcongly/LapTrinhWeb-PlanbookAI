<?php

namespace App\Controllers\Staff;

use App\Core\Controller;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\QuestionSamples;

class QuestionSampleController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('staff');
    }

    // LIST
    public function index()
    {
        $this->authorize();

        $model = new QuestionSamples();
        $questions = $model->getAll();

        $this->view('staff/question_samples/index', compact('questions'));
    }

    // CREATE VIEW
    public function create()
    {
        $this->authorize();
        $this->view('staff/question_samples/create');
    }

    // STORE
    public function store()
    {
        $this->authorize();

        $model = new QuestionSamples();

        $model->create([
            'question_text' => $_POST['question_text'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'difficulty' => $_POST['difficulty'] ?? '',
            'option_a' => $_POST['option_a'] ?? '',
            'option_b' => $_POST['option_b'] ?? '',
            'option_c' => $_POST['option_c'] ?? '',
            'option_d' => $_POST['option_d'] ?? '',
            'correct_answer' => $_POST['correct_answer'] ?? 'A',
        ]);

        Session::flash('success', 'Tạo câu hỏi mẫu thành công!');
        $this->redirect('/staff/question-samples');
    }

    // SHOW
    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;

        $model = new QuestionSamples();
        $question = $model->findById($id);

        if (!$question) {
            Session::flash('error', 'Không tìm thấy câu hỏi!');
            $this->redirect('/staff/question-samples');
        }

        $this->view('staff/question_samples/show', compact('question'));
    }

    // EDIT VIEW
    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;

        $model = new QuestionSamples();
        $question = $model->findById($id);

        if (!$question) {
            Session::flash('error', 'Không tìm thấy câu hỏi!');
            $this->redirect('/staff/question-samples');
        }

        $this->view('staff/question_samples/edit', compact('question'));
    }

    // UPDATE
    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;

        $model = new QuestionSamples();

        $model->update($id, [
            'question_text' => $_POST['question_text'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'difficulty' => $_POST['difficulty'] ?? '',
            'option_a' => $_POST['option_a'] ?? '',
            'option_b' => $_POST['option_b'] ?? '',
            'option_c' => $_POST['option_c'] ?? '',
            'option_d' => $_POST['option_d'] ?? '',
            'correct_answer' => $_POST['correct_answer'] ?? 'A',
        ]);

        Session::flash('success', 'Cập nhật thành công!');
        $this->redirect('/staff/question-samples');
    }

    // DELETE
    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;

        $model = new QuestionSamples();
        $model->delete($id);

        Session::flash('success', 'Xóa thành công!');
        $this->redirect('/staff/question-samples');
    }
}