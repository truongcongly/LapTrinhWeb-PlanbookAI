<?php

namespace App\Controllers\Staff;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\LessonPlanSample;

class LessonPlanSampleController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('staff');
    }

    public function index()
    {
        $this->authorize();

        $model = new LessonPlanSample();

        $filters = [
            'subject'     => $_GET['subject']     ?? '',
            'grade_level' => $_GET['grade_level'] ?? '',
            'status'      => $_GET['status']      ?? '',
        ];

        $lessonSamples = $model->getAll($filters);
        $subjects      = $model->getDistinctSubjects();
        $gradeLevels   = $model->getDistinctGradeLevels(
            trim($filters['subject']) !== '' ? $filters['subject'] : null
        );

        $this->view('staff/lesson_samples/index', compact('lessonSamples', 'subjects', 'gradeLevels', 'filters'));
    }

    public function create()
    {
        $this->authorize();

        $model       = new LessonPlanSample();
        $subjects    = $model->getDistinctSubjects();
        $gradeLevels = $model->getDistinctGradeLevels();

        $this->view('staff/lesson_samples/create', compact('subjects', 'gradeLevels'));
    }

    public function store()
    {
        $this->authorize();

        $staff = Auth::user();
        $model = new LessonPlanSample();

        $model->create([
            'staff_id'    => $staff['id'],
            'title'       => $_POST['title']       ?? '',
            'subject'     => $_POST['subject']     ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'objectives'  => $_POST['objectives']  ?? '',
            'activities'  => $_POST['activities']  ?? '',
            'assessment'  => $_POST['assessment']  ?? '',
            'status'      => $_POST['status']      ?? 'draft',
        ]);

        Session::flash('success', 'Tạo lesson sample thành công.');
        $this->redirect('/staff/lesson-samples');
    }

    public function show()
    {
        $this->authorize();

        $id     = $_GET['id'] ?? 0;
        $model  = new LessonPlanSample();
        $sample = $model->findById($id);

        if (!$sample) {
            Session::flash('error', 'Không tìm thấy lesson sample.');
            $this->redirect('/staff/lesson-samples');
        }

        $this->view('staff/lesson_samples/show', compact('sample'));
    }

    public function edit()
    {
        $this->authorize();

        $id     = $_GET['id'] ?? 0;
        $model  = new LessonPlanSample();
        $sample = $model->findById($id);

        if (!$sample) {
            Session::flash('error', 'Không tìm thấy lesson sample.');
            $this->redirect('/staff/lesson-samples');
        }

        $subjects    = $model->getDistinctSubjects();
        $gradeLevels = $model->getDistinctGradeLevels();

        $this->view('staff/lesson_samples/edit', compact('sample', 'subjects', 'gradeLevels'));
    }

    public function update()
    {
        $this->authorize();

        $id    = $_GET['id'] ?? 0;
        $model = new LessonPlanSample();

        $sample = $model->findById($id);
        if (!$sample) {
            Session::flash('error', 'Không tìm thấy lesson sample.');
            $this->redirect('/staff/lesson-samples');
        }

        $model->update($id, [
            'title'       => $_POST['title']       ?? '',
            'subject'     => $_POST['subject']     ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'objectives'  => $_POST['objectives']  ?? '',
            'activities'  => $_POST['activities']  ?? '',
            'assessment'  => $_POST['assessment']  ?? '',
            'status'      => $_POST['status']      ?? 'draft',
        ]);

        Session::flash('success', 'Cập nhật lesson sample thành công.');
        $this->redirect('/staff/lesson-samples');
    }

    public function delete()
    {
        $this->authorize();

        $id    = $_GET['id'] ?? 0;
        $model = new LessonPlanSample();

        $sample = $model->findById($id);
        if (!$sample) {
            Session::flash('error', 'Không tìm thấy lesson sample.');
            $this->redirect('/staff/lesson-samples');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa lesson sample thành công.');
        $this->redirect('/staff/lesson-samples');
    }

    public function gradeLevels()
    {
        $this->authorize();

        $subject = $_GET['subject'] ?? null;
        $model   = new LessonPlanSample();
        $levels  = $model->getDistinctGradeLevels(
            (is_string($subject) && trim($subject) !== '') ? $subject : null
        );

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['grade_levels' => $levels], JSON_UNESCAPED_UNICODE);
        exit();
    }
}