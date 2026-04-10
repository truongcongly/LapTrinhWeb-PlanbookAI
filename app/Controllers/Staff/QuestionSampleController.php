<?php

namespace App\Controllers\Staff;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\Question;

class QuestionSampleController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('staff');
    }

    public function index()
    {
        $this->authorize();

        $staff = Auth::user();
        $model = new Question();

        $filters = [
            'subject' => $_GET['subject'] ?? '',
            'topic' => $_GET['topic'] ?? '',
            'difficulty' => $_GET['difficulty'] ?? '',
        ];

        $questions = $model->getAllByTeacherFiltered($staff['id'], $filters);
        $subjects = $model->getDistinctSubjectsByTeacher($staff['id']);
        $topics = $model->getDistinctTopicsByTeacher($staff['id'], trim($filters['subject']) !== '' ? $filters['subject'] : null);

        $this->view('staff/question_samples/index', compact('questions', 'subjects', 'topics', 'filters'));
    }

    public function create()
    {
        $this->authorize();

        $staff = Auth::user();
        $model = new Question();

        $subjects = $model->getDistinctSubjectsByTeacher($staff['id']);
        $topics = $model->getDistinctTopicsByTeacher($staff['id'], null);

        $this->view('staff/question_samples/create', compact('subjects', 'topics'));
    }

    public function store()
    {
        $this->authorize();

        $staff = Auth::user();
        $model = new Question();

        $model->create([
            'teacher_id' => $staff['id'],
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

        Session::flash('success', 'Tạo câu hỏi mẫu thành công.');
        $this->redirect('/staff/question-samples');
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $staff = Auth::user();
        $model = new Question();
        $question = $model->findById($id);

        if (!$question || (int)($question['teacher_id'] ?? 0) !== (int)$staff['id']) {
            Session::flash('error', 'Không tìm thấy câu hỏi mẫu.');
            $this->redirect('/staff/question-samples');
        }

        $subjects = $model->getDistinctSubjectsByTeacher($staff['id']);
        $topics = $model->getDistinctTopicsByTeacher($staff['id'], $question['subject'] ?? null);

        $this->view('staff/question_samples/edit', compact('question', 'subjects', 'topics'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $staff = Auth::user();
        $model = new Question();
        $question = $model->findById($id);

        if (!$question || (int)($question['teacher_id'] ?? 0) !== (int)$staff['id']) {
            Session::flash('error', 'Không tìm thấy câu hỏi mẫu.');
            $this->redirect('/staff/question-samples');
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

        Session::flash('success', 'Cập nhật câu hỏi mẫu thành công.');
        $this->redirect('/staff/question-samples');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $staff = Auth::user();
        $model = new Question();
        $question = $model->findById($id);

        if (!$question || (int)($question['teacher_id'] ?? 0) !== (int)$staff['id']) {
            Session::flash('error', 'Không tìm thấy câu hỏi mẫu.');
            $this->redirect('/staff/question-samples');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa câu hỏi mẫu thành công.');
        $this->redirect('/staff/question-samples');
    }

    public function topics()
    {
        $this->authorize();

        $staff = Auth::user();
        $subject = $_GET['subject'] ?? null;

        $model = new Question();
        $topics = $model->getDistinctTopicsByTeacher($staff['id'], (is_string($subject) && trim($subject) !== '') ? $subject : null);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['topics' => $topics], JSON_UNESCAPED_UNICODE);
        exit();
    }
}
