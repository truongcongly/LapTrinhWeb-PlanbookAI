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

    public function create($data)
    {
        $teacherId = (int)$data['teacher_id'];
        $questionText = $this->conn->real_escape_string($data['question_text']);
        $subject = $this->conn->real_escape_string($data['subject']);
        $topic = $this->conn->real_escape_string($data['topic']);
        $difficulty = $this->conn->real_escape_string($data['difficulty']);
        $optionA = $this->conn->real_escape_string($data['option_a']);
        $optionB = $this->conn->real_escape_string($data['option_b']);
        $optionC = $this->conn->real_escape_string($data['option_c']);
        $optionD = $this->conn->real_escape_string($data['option_d']);
        $correctAnswer = $this->conn->real_escape_string($data['correct_answer']);

        $sql = "INSERT INTO questions
        (teacher_id, question_text, subject, topic, difficulty, option_a, option_b, option_c, option_d, correct_answer)
        VALUES
        ($teacherId, '$questionText', '$subject', '$topic', '$difficulty', '$optionA', '$optionB', '$optionC', '$optionD', '$correctAnswer')";

        if (!$this->conn->query($sql)) {
            die('SQL ERROR in Question::create(): ' . $this->conn->error);
        }

        return true;
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