<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\ExamResult;
use App\Models\ExamResultDetail;
use App\Services\PromptTemplateRenderer;

class ResultController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $model = new ExamResult();
        $results = $model->getAllByTeacher($teacher['id']);

        $this->view('teacher/results/index', compact('results'));
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $model = new ExamResult();
        $result = $model->findByIdForTeacher($id, $teacher['id']);

        if (!$result) {
            Session::flash('error', 'Không tìm thấy kết quả.');
            $this->redirect('/teacher/results');
        }

        $detailModel = new ExamResultDetail();
        $details = $detailModel->getByResult($id);

        $this->view('teacher/results/show', compact('result', 'details'));
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $model = new ExamResult();
        $result = $model->findByIdForTeacher($id, $teacher['id']);

        if (!$result) {
            Session::flash('error', 'Không tìm thấy kết quả.');
            $this->redirect('/teacher/results');
        }

        $detailModel = new ExamResultDetail();
        $details = $detailModel->getByResult($id);
        $generatedFeedback = PromptTemplateRenderer::generateFeedback($result, $details);

        $this->view('teacher/results/edit', compact('result', 'details', 'generatedFeedback'));
    }

    public function review()
    {
        $this->authorize();

        $this->redirect('/teacher/results');
    }

    public function reviewUpdate()
    {
        $this->authorize();

        $this->redirect('/teacher/results');
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $model = new ExamResult();
        $result = $model->findByIdForTeacher($id, $teacher['id']);

        if (!$result) {
            Session::flash('error', 'Không tìm thấy kết quả.');
            $this->redirect('/teacher/results');
        }

        $model->update($id, [
            'student_name' => $_POST['student_name'] ?? '',
            'feedback' => $_POST['feedback'] ?? '',
            'score' => $_POST['score'] ?? 0,
            'status' => $_POST['status'] ?? 'reviewed',
        ]);

        Session::flash('success', 'Cập nhật kết quả thành công.');
        $this->redirect('/teacher/results');
    }

    public function generateFeedback()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $model = new ExamResult();
        $detailModel = new ExamResultDetail();
        $result = $model->findByIdForTeacher($id, $teacher['id']);

        if (!$result) {
            Session::flash('error', 'Khong tim thay ket qua.');
            $this->redirect('/teacher/results');
        }

        $details = $detailModel->getByResult($id);
        $feedback = PromptTemplateRenderer::generateFeedback($result, $details);

        $model->update($id, [
            'student_name' => $result['student_name'] ?? '',
            'feedback' => $feedback,
            'score' => $result['score'] ?? 0,
            'status' => $result['status'] ?? 'reviewed',
        ]);

        Session::flash('success', 'Da tao feedback tu dong cho bai lam.');
        $this->redirect('/teacher/results/edit?id=' . $id);
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $teacher = Auth::user();
        $model = new ExamResult();
        $result = $model->findByIdForTeacher($id, $teacher['id']);

        if (!$result) {
            Session::flash('error', 'Không tìm thấy kết quả.');
            $this->redirect('/teacher/results');
        }

        if (!empty($result['scan_file'])) {
            $basePath = dirname(__DIR__, 3);
            $scanPath = realpath($basePath . '/public/' . ltrim($result['scan_file'], '/'));
            $uploadRoot = realpath($basePath . '/public/uploads/answer-scans');

            if ($scanPath && $uploadRoot && str_starts_with($scanPath, $uploadRoot) && is_file($scanPath)) {
                unlink($scanPath);
            }
        }

        $model->delete($id);
        Session::flash('success', 'Xóa kết quả thành công.');
        $this->redirect('/teacher/results');
    }
}
