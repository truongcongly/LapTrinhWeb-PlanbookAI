<?php

use App\Core\Auth;

$title       = 'Chi tiết Lesson Sample - PlanbookAI';
$currentUser = Auth::user();
$pageTitle   = 'Chi tiết Lesson Sample';
$pageDesc    = 'Xem đầy đủ nội dung giáo án mẫu';
$role        = 'staff';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết lesson sample</h3>
        <p>Xem đầy đủ nội dung giáo án mẫu đã được tạo trong hệ thống.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($sample['title']); ?></h5>
            <small class="text-secondary">
                <?= htmlspecialchars($sample['subject']); ?> &bull; <?= htmlspecialchars($sample['grade_level']); ?>
            </small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/edit?id=<?= $sample['id']; ?>"
               class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square me-2"></i>Sửa
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples"
               class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Quay lại
            </a>
        </div>
    </div>

    <!-- Info panels -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Môn học</h6>
                <p class="mb-0 fw-semibold"><?= htmlspecialchars($sample['subject']); ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Khối lớp</h6>
                <p class="mb-0 fw-semibold"><?= htmlspecialchars($sample['grade_level']); ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Trạng thái</h6>
                <p class="mb-0">
                    <?php if (($sample['status'] ?? '') === 'completed'): ?>
                        <span class="badge bg-success-subtle text-success fs-6">Completed</span>
                    <?php else: ?>
                        <span class="badge bg-warning-subtle text-warning fs-6">Draft</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Ngày tạo</h6>
                <p class="mb-0"><?= $sample['created_at'] ?? '-'; ?></p>
            </div>
        </div>
    </div>

    <!-- Content sections -->
    <div class="row g-4">
        <div class="col-12">
            <div class="small-panel">
                <h6 class="d-flex align-items-center gap-2">
                    <i class="bi bi-bullseye text-primary"></i>
                    Objectives (Mục tiêu bài học)
                </h6>
                <?php if (!empty($sample['objectives'])): ?>
                    <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($sample['objectives']); ?></p>
                <?php else: ?>
                    <p class="mb-0 text-secondary fst-italic">Chưa có nội dung.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12">
            <div class="small-panel">
                <h6 class="d-flex align-items-center gap-2">
                    <i class="bi bi-activity text-success"></i>
                    Activities (Hoạt động dạy học)
                </h6>
                <?php if (!empty($sample['activities'])): ?>
                    <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($sample['activities']); ?></p>
                <?php else: ?>
                    <p class="mb-0 text-secondary fst-italic">Chưa có nội dung.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12">
            <div class="small-panel">
                <h6 class="d-flex align-items-center gap-2">
                    <i class="bi bi-clipboard-check text-warning"></i>
                    Assessment (Hình thức đánh giá)
                </h6>
                <?php if (!empty($sample['assessment'])): ?>
                    <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($sample['assessment']); ?></p>
                <?php else: ?>
                    <p class="mb-0 text-secondary fst-italic">Chưa có nội dung.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer actions -->
    <div class="mt-4 pt-3 border-top d-flex gap-3 flex-wrap">
        <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/edit?id=<?= $sample['id']; ?>"
           class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-pencil-square me-2"></i>Chỉnh sửa lesson sample
        </a>
        <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/delete?id=<?= $sample['id']; ?>"
           class="btn btn-outline-danger rounded-pill px-4"
           onclick="return confirmDelete()">
            <i class="bi bi-trash me-2"></i>Xóa
        </a>
    </div>
</div>

<?php
$content  = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_lesson_samples_show.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';