<?php

namespace App\Controllers\Staff;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\LessonPlanSample;
use App\Models\LessonPlan;

class LessonPlanSampleController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('staff');
    }

    private function normalizeStatus($status, $default = 'draft')
    {
        $status = strtolower(trim((string) $status));
        $allowed = ['draft', 'approved'];

        return in_array($status, $allowed, true) ? $status : $default;
    }

    public function index()
    {
        $this->authorize();

        $staff = Auth::user();
        $model = new LessonPlanSample();
        $lessonSamples = $model->getAllByStaff($staff['id']);

        $this->view('staff/lesson_samples/index', compact('lessonSamples'));
    }

    public function create()
    {
        $this->authorize();
        $this->view('staff/lesson_samples/create');
    }

    public function store()
    {
        $this->authorize();

        $staff = Auth::user();
        $model = new LessonPlanSample();

        $created = $model->create([
            'staff_id'    => $staff['id'],
            'title'       => trim($_POST['title'] ?? ''),
            'subject'     => trim($_POST['subject'] ?? ''),
            'grade_level' => trim($_POST['grade_level'] ?? ''),
            'topic'       => trim($_POST['topic'] ?? ''),
            'objectives'  => trim($_POST['objectives'] ?? ''),
            'activities'  => trim($_POST['activities'] ?? ''),
            'assessment'  => trim($_POST['assessment'] ?? ''),
            'status'      => 'draft',
        ]);

        if ($created) {
            Session::flash('success', 'Tạo lesson plan sample thành công.');
        } else {
            Session::flash('error', 'Tạo lesson plan sample thất bại.');
        }

        return $this->redirect('/staff/lesson-samples');
    }

    public function show()
    {
        $this->authorize();

        $id = (int) ($_GET['id'] ?? 0);
        $model = new LessonPlanSample();
        $sample = $model->findById($id);

        if (!$sample) {
            Session::flash('error', 'Không tìm thấy lesson plan sample.');
            return $this->redirect('/staff/lesson-samples');
        }

        $this->view('staff/lesson_samples/show', compact('sample'));
    }

    public function edit()
    {
        $this->authorize();

        $id = (int) ($_GET['id'] ?? 0);
        $model = new LessonPlanSample();
        $sample = $model->findById($id);

        if (!$sample) {
            Session::flash('error', 'Không tìm thấy lesson plan sample.');
            return $this->redirect('/staff/lesson-samples');
        }

        $this->view('staff/lesson_samples/edit', compact('sample'));
    }

    public function update()
    {
        $this->authorize();

        $id = (int) ($_GET['id'] ?? 0);
        $model = new LessonPlanSample();
        $sample = $model->findById($id);

        if (!$sample) {
            Session::flash('error', 'Không tìm thấy lesson plan sample.');
            return $this->redirect('/staff/lesson-samples');
        }

        $updated = $model->update($id, [
            'title'       => trim($_POST['title'] ?? ''),
            'subject'     => trim($_POST['subject'] ?? ''),
            'grade_level' => trim($_POST['grade_level'] ?? ''),
            'topic'       => trim($_POST['topic'] ?? ''),
            'objectives'  => trim($_POST['objectives'] ?? ''),
            'activities'  => trim($_POST['activities'] ?? ''),
            'assessment'  => trim($_POST['assessment'] ?? ''),
            'status'      => $this->normalizeStatus($_POST['status'] ?? 'draft'),
        ]);

        if ($updated) {
            Session::flash('success', 'Cập nhật lesson plan sample thành công.');
        } else {
            Session::flash('error', 'Cập nhật lesson plan sample thất bại.');
        }

        return $this->redirect('/staff/lesson-samples');
    }

    public function delete()
    {
        $this->authorize();

        $id = (int) ($_GET['id'] ?? 0);
        $model = new LessonPlanSample();
        $sample = $model->findById($id);

        if (!$sample) {
            Session::flash('error', 'Không tìm thấy lesson plan sample.');
            return $this->redirect('/staff/lesson-samples');
        }

        $deleted = $model->delete($id);

        if ($deleted) {
            Session::flash('success', 'Xóa lesson plan sample thành công.');
        } else {
            Session::flash('error', 'Xóa lesson plan sample thất bại.');
        }

        return $this->redirect('/staff/lesson-samples');
    }

    public function import()
    {
        $this->authorize();

        $id = (int) ($_GET['id'] ?? 0);

        $sampleModel = new LessonPlanSample();
        $lessonPlanModel = new LessonPlan();

        $sample = $sampleModel->findById($id);

        if (!$sample) {
            Session::flash('error', 'Không tìm thấy lesson plan sample.');
            return $this->redirect('/staff/lesson-samples');
        }

        // Tạm gán cứng teacher_id
        $teacherId = 3;

        $created = $lessonPlanModel->create([
            'teacher_id'  => $teacherId,
            'title'       => $sample['title'] ?? '',
            'subject'     => $sample['subject'] ?? '',
            'grade_level' => $sample['grade_level'] ?? '',
            'topic'       => $sample['topic'] ?? '',
            'objectives'  => $sample['objectives'] ?? '',
            'activities'  => $sample['activities'] ?? '',
            'assessment'  => $sample['assessment'] ?? '',
            'status'      => 'draft',
        ]);

        if ($created) {
            Session::flash('success', 'Import thành công sang Lesson Plans.');
        } else {
            Session::flash('error', 'Import lesson plan thất bại.');
        }

        return $this->redirect('/staff/lesson-samples');
    }
}