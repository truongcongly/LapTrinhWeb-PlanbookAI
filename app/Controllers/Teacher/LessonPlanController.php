<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\LessonPlan;
use App\Models\PromptTemplate;

class LessonPlanController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new LessonPlan();
        $lessonPlans = $model->getAllByTeacher($teacher['id']);

        $this->view('teacher/lesson_plans/index', compact('lessonPlans'));
    }

    public function create()
    {
        $this->authorize();
        $promptModel = new PromptTemplate();
        $promptTemplates = $promptModel->getActiveTemplates('lesson_plan');
        $this->view('teacher/lesson_plans/create', compact('promptTemplates'));
    }

    public function store()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new LessonPlan();

        $model->create([
            'teacher_id' => $teacher['id'],
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'objectives' => $_POST['objectives'] ?? '',
            'activities' => $_POST['activities'] ?? '',
            'assessment' => $_POST['assessment'] ?? '',
            'status' => $_POST['status'] ?? 'draft',
        ]);

        Session::flash('success', 'Tạo lesson plan thành công.');
        $this->redirect('/teacher/lesson-plans');
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new LessonPlan();
        $lessonPlan = $model->findById($id);

        if (!$lessonPlan) {
            Session::flash('error', 'Không tìm thấy lesson plan.');
            $this->redirect('/teacher/lesson-plans');
        }

        $this->view('teacher/lesson_plans/show', compact('lessonPlan'));
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new LessonPlan();
        $lessonPlan = $model->findById($id);

        if (!$lessonPlan) {
            Session::flash('error', 'Không tìm thấy lesson plan.');
            $this->redirect('/teacher/lesson-plans');
        }

        $promptModel = new PromptTemplate();
        $promptTemplates = $promptModel->getActiveTemplates('lesson_plan');
        $this->view('teacher/lesson_plans/edit', compact('lessonPlan', 'promptTemplates'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new LessonPlan();

        $lessonPlan = $model->findById($id);
        if (!$lessonPlan) {
            Session::flash('error', 'Không tìm thấy lesson plan.');
            $this->redirect('/teacher/lesson-plans');
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

        Session::flash('success', 'Cập nhật lesson plan thành công.');
        $this->redirect('/teacher/lesson-plans');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new LessonPlan();

        $lessonPlan = $model->findById($id);
        if (!$lessonPlan) {
            Session::flash('error', 'Không tìm thấy lesson plan.');
            $this->redirect('/teacher/lesson-plans');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa lesson plan thành công.');
        $this->redirect('/teacher/lesson-plans');
    }
}
