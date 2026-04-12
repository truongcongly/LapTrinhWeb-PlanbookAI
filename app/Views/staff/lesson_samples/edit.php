<?php

use App\Core\Auth;

$title       = 'Sửa Lesson Sample - PlanbookAI';
$currentUser = Auth::user();
$pageTitle   = 'Sửa Lesson Sample';
$pageDesc    = 'Chỉnh sửa nội dung giáo án mẫu';
$role        = 'staff';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chỉnh sửa lesson sample</h3>
        <p>Cập nhật lại tiêu đề, mục tiêu, hoạt động và đánh giá của giáo án mẫu.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Edit Lesson Sample">
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Edit Lesson Sample Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/update?id=<?= $sample['id']; ?>">
                <div class="row g-4">

                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề giáo án mẫu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title"
                               value="<?= htmlspecialchars($sample['title']); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft"     <?= ($sample['status'] === 'draft')     ? 'selected' : ''; ?>>Draft</option>
                            <option value="completed" <?= ($sample['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject"
                               list="subjectList"
                               value="<?= htmlspecialchars($sample['subject']); ?>" required>
                        <datalist id="subjectList">
                            <?php foreach (($subjects ?? []) as $s): ?>
                                <option value="<?= htmlspecialchars($s); ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Khối lớp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="grade_level"
                               list="gradeList"
                               value="<?= htmlspecialchars($sample['grade_level']); ?>" required>
                        <datalist id="gradeList">
                            <?php foreach (($gradeLevels ?? []) as $g): ?>
                                <option value="<?= htmlspecialchars($g); ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Objectives (Mục tiêu bài học)</label>
                        <textarea class="form-control rounded-4" name="objectives" rows="4"><?= htmlspecialchars($sample['objectives'] ?? ''); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Activities (Hoạt động dạy học)</label>
                        <textarea class="form-control rounded-4" name="activities" rows="5"><?= htmlspecialchars($sample['activities'] ?? ''); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Assessment (Hình thức đánh giá)</label>
                        <textarea class="form-control rounded-4" name="assessment" rows="4"><?= htmlspecialchars($sample['assessment'] ?? ''); ?></textarea>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle-fill me-2"></i>Cập nhật
                    </button>
                    <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples" class="btn btn-light border rounded-pill px-4">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content  = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_lesson_samples_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';