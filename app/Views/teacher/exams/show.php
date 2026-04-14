<?php

use App\Core\Auth;

$title = 'Exam Detail - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Exam Detail';
$pageDesc = 'Xem chi tiết đề kiểm tra và answer key';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết đề kiểm tra</h3>
        <p>Xem thông tin đầy đủ của bài kiểm tra và đáp án chuẩn phục vụ chấm bài.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Exam Detail">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($exam['title']); ?></h5>
            <small class="text-secondary">
                <?= htmlspecialchars($exam['subject']); ?> • <?= htmlspecialchars($exam['grade_level']); ?>
            </small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/edit?id=<?= $exam['id']; ?>" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square me-2"></i>Sửa
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Quay lại
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Môn học</h6>
                <p class="mb-0"><?= htmlspecialchars($exam['subject']); ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-panel">
                <h6>Khối lớp</h6>
                <p class="mb-0"><?= htmlspecialchars($exam['grade_level']); ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-panel">
                <h6>Số câu</h6>
                <p class="mb-0"><?= (int)$exam['total_questions']; ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-panel">
                <h6>Thời lượng</h6>
                <p class="mb-0"><?= (int)$exam['duration_minutes']; ?> phút</p>
            </div>
        </div>
    </div>

    <div class="small-panel mb-4">
        <h6>Trạng thái</h6>
        <p class="mb-0">
            <?php if (($exam['status'] ?? '') === 'published'): ?>
                <span class="badge bg-success-subtle text-success">Published</span>
            <?php else: ?>
                <span class="badge bg-warning-subtle text-warning">Draft</span>
            <?php endif; ?>
        </p>
    </div>

    <div class="small-panel mb-4">
        <h6>Instructions</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($exam['instructions'] ?? ''); ?></p>
    </div>

    <div class="small-panel">
        <h6>Answer Key</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($exam['answer_key'] ?? ''); ?></p>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_exams_show.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';