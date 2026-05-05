<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\Exercise;
use App\Models\ExerciseQuestion;
use App\Models\Question;

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
        $teacher = Auth::user();
        $questionModel = new Question();
        $questions = $questionModel->getAllByTeacherSimple($teacher['id']);
        $this->view('teacher/exercises/create', compact('questions'));
    }

    public function store()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new Exercise();
        $exerciseQuestionModel = new ExerciseQuestion();
        $selectedQuestions = $_POST['questions'] ?? [];

        $exerciseId = $model->create([
            'teacher_id' => $teacher['id'],
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'description' => $_POST['description'] ?? '',
            'content' => '',
            'status' => $_POST['status'] ?? 'draft',
        ]);

        if ($exerciseId) {
            foreach ($selectedQuestions as $questionId) {
                $exerciseQuestionModel->create($exerciseId, $questionId);
            }
        }

        Session::flash('success', 'Tạo bài tập thành công.');
        $this->redirect('/teacher/exercises');
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $model = new Exercise();
        $exercise = $model->findByIdForTeacher($id, $teacher['id']);

        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài tập.');
            $this->redirect('/teacher/exercises');
        }

        $exerciseQuestionModel = new ExerciseQuestion();
        $questions = $exerciseQuestionModel->getQuestionsByExercise($id);

        $this->view('teacher/exercises/show', compact('exercise', 'questions'));
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $model = new Exercise();
        $exercise = $model->findByIdForTeacher($id, $teacher['id']);

        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài tập.');
            $this->redirect('/teacher/exercises');
        }

        $questionModel = new Question();
        $questions = $questionModel->getAllByTeacherSimple($teacher['id']);
        $exerciseQuestionModel = new ExerciseQuestion();
        $selectedQuestionIds = $exerciseQuestionModel->getQuestionIdsByExercise($id);

        $this->view('teacher/exercises/edit', compact('exercise', 'questions', 'selectedQuestionIds'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $model = new Exercise();
        $exercise = $model->findByIdForTeacher($id, $teacher['id']);

        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài tập.');
            $this->redirect('/teacher/exercises');
        }

        $model->update($id, [
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'topic' => $_POST['topic'] ?? '',
            'description' => $_POST['description'] ?? '',
            'content' => $exercise['content'] ?? '',
            'status' => $_POST['status'] ?? 'draft',
        ]);

        $exerciseQuestionModel = new ExerciseQuestion();
        $exerciseQuestionModel->deleteByExerciseId($id);
        foreach (($_POST['questions'] ?? []) as $questionId) {
            $exerciseQuestionModel->create($id, $questionId);
        }

        Session::flash('success', 'Cập nhật bài tập thành công.');
        $this->redirect('/teacher/exercises');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $model = new Exercise();
        $exercise = $model->findByIdForTeacher($id, $teacher['id']);

        if (!$exercise) {
            Session::flash('error', 'Không tìm thấy bài tập.');
            $this->redirect('/teacher/exercises');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa bài tập thành công.');
        $this->redirect('/teacher/exercises');
    }
}
