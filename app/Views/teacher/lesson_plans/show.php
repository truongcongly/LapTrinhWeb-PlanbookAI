<?php

use App\Core\Auth;

$title = 'Lesson Plan Detail - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Lesson Plan Detail';
$pageDesc = 'Xem chi tiết giáo án';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết lesson plan</h3>
        <p>Xem đầy đủ nội dung giáo án đã tạo để phục vụ giảng dạy và chỉnh sửa khi cần.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Lesson Plan Detail">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($lessonPlan['title']); ?></h5>
            <small class="text-secondary">
                <?= htmlspecialchars($lessonPlan['subject']); ?> • <?= htmlspecialchars($lessonPlan['grade_level']); ?>
            </small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/edit?id=<?= $lessonPlan['id']; ?>" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square me-2"></i>Sửa
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Quay lại
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Môn học</h6>
                <p class="mb-0"><?= htmlspecialchars($lessonPlan['subject']); ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Khối lớp</h6>
                <p class="mb-0"><?= htmlspecialchars($lessonPlan['grade_level']); ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Trạng thái</h6>
                <p class="mb-0">
                    <?php if (($lessonPlan['status'] ?? '') === 'completed'): ?>
                        <span class="badge bg-success-subtle text-success">Completed</span>
                    <?php else: ?>
                        <span class="badge bg-warning-subtle text-warning">Draft</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12">
            <div class="small-panel">
                <h6>Objectives</h6>
                <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($lessonPlan['objectives'] ?? ''); ?></p>
            </div>
        </div>

        <div class="col-12">
            <div class="small-panel">
                <h6>Activities</h6>
                <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($lessonPlan['activities'] ?? ''); ?></p>
            </div>
        </div>

        <div class="col-12">
            <div class="small-panel">
                <h6>Assessment</h6>
                <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($lessonPlan['assessment'] ?? ''); ?></p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_lesson_plans_show.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';