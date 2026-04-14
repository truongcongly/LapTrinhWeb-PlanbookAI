<?php

use App\Core\Auth;

$title = 'OCR Mock Grading - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'OCR Mock Grading';
$pageDesc = 'Mô phỏng chấm bài tự động dựa trên đáp án nhận diện';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>OCR Mock Grading</h3>
        <p>Mô phỏng quy trình nhận diện đáp án từ bài làm và chấm tự động theo answer key.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="OCR Mock Grading">
</div>

<div class="dashboard-card text-center py-5">
    <h5 class="mb-3">Bắt đầu chấm bài</h5>
    <p class="text-secondary mb-4">Chọn đề thi, nhập tên học sinh và dán chuỗi đáp án nhận diện để hệ thống auto-grade.</p>
    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading/create" class="btn btn-primary rounded-pill px-4">
        <i class="bi bi-camera-fill me-2"></i>Tạo phiên chấm bài
    </a>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_grading_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';