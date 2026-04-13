<?php

use App\Core\Auth;

$title = 'Result Detail - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Result Detail';
$pageDesc = 'Xem chi tiết kết quả chấm bài';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết kết quả</h3>
        <p>Xem thông tin bài làm, điểm số, đáp án nhận diện và trạng thái xử lý.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Result Detail">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($result['student_name']); ?></h5>
            <small class="text-secondary"><?= htmlspecialchars($result['exam_title'] ?? ''); ?></small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/edit?id=<?= $result['id']; ?>" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square me-2"></i>Feedback
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Quay lại
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Môn học</h6>
                <p class="mb-0"><?= htmlspecialchars($result['subject'] ?? ''); ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-panel">
                <h6>Khối lớp</h6>
                <p class="mb-0"><?= htmlspecialchars($result['grade_level'] ?? ''); ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-panel">
                <h6>Số câu đúng</h6>
                <p class="mb-0"><?= (int)$result['correct_count']; ?>/<?= (int)$result['total_questions']; ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-panel">
                <h6>Điểm</h6>
                <p class="mb-0"><strong><?= htmlspecialchars($result['score']); ?></strong></p>
            </div>
        </div>
    </div>

    <div class="small-panel mb-4">
        <h6>Đáp án nhận diện</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($result['scanned_answers']); ?></p>
    </div>

    <div class="small-panel mb-4">
        <h6>Feedback</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($result['feedback'] ?? ''); ?></p>
    </div>

    <div class="small-panel">
        <h6>Trạng thái</h6>
        <p class="mb-0">
            <?php if (($result['status'] ?? '') === 'reviewed'): ?>
                <span class="badge bg-success-subtle text-success">Reviewed</span>
            <?php else: ?>
                <span class="badge bg-info-subtle text-info">Auto Graded</span>
            <?php endif; ?>
        </p>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_results_show.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';