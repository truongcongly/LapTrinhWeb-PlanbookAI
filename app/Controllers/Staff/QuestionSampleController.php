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

        $staff = $_SESSION['user'] ?? null; // hoặc Auth::user(), tùy project bạn

        if (!$staff || !isset($staff['id'])) {
            die('Không xác định được staff đang đăng nhập.');
            }
        $model = new QuestionSamples();

        $model->create([
            'staff_id' => $staff['id'],
            'question_text' => $_POST['question_text'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'difficulty' => $_POST['difficulty'] ?? '',
            'option_a' => $_POST['option_a'] ?? '',
            'option_b' => $_POST['option_b'] ?? '',
            'option_c' => $_POST['option_c'] ?? '',
            'option_d' => $_POST['option_d'] ?? '',
            'correct_answer' => $_POST['correct_answer'] ?? 'A',
            'status' => $_POST['status'] ?? 'draft',
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

    public function import()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;

        $sampleModel = new \App\Models\QuestionSamples();
        $questionModel = new \App\Models\Question();

        $sample = $sampleModel->findById($id);

        if (!$sample) {
            \App\Core\Session::flash('error', 'Không tìm thấy câu hỏi mẫu!');
            return $this->redirect('/staff/question-samples');
        }

    // ⚠️ GÁN tạm teacher_id = 1 (sau sẽ nâng cấp)
        $teacherId = 3;

        $created = $questionModel->create([
            'teacher_id' => $teacherId,
            'question_text' => $sample['question_text'],
            'subject' => $sample['subject'],
            'topic' => $sample['topic'],
            'difficulty' => $sample['difficulty'],
            'option_a' => $sample['option_a'],
            'option_b' => $sample['option_b'],
            'option_c' => $sample['option_c'],
            'option_d' => $sample['option_d'],
            'correct_answer' => $sample['correct_answer'],
        ]);

        if ($created) {
            \App\Core\Session::flash('success', 'Import thành công sang Question Bank!');
        } else {
            \App\Core\Session::flash('error', 'Import thất bại.');
        }
        return $this->redirect('/staff/question-samples');
    }
}