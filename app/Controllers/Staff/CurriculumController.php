<?php
namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Models\LessonPlan;
use App\Models\CurriculumFramework;

class LessonPlanController extends Controller {
    public function index() {
        $model = new LessonPlan();
        $plans = $model->allByTeacher($_SESSION['user']['id']);
        return $this->view('teacher/lesson_plan/index', compact('plans'));
    }

    public function create() {
        $frameworkModel = new CurriculumFramework();
        $frameworks = $frameworkModel->all();
        return $this->view('teacher/lesson_plan/create', compact('frameworks'));
    }

    public function store() {
        $model = new LessonPlan();
        $model->create([
            'framework_id' => $_POST['framework_id'],
            'teacher_id' => $_SESSION['user']['id'],
            'objective' => $_POST['objective'],
            'activities' => $_POST['activities'],
            'assessment' => $_POST['assessment'],
            'status' => $_POST['status']
        ]);

        header('Location: /teacher/lesson-plan');
    }
}