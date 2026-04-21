<?php

use App\Core\Auth;

$title = 'Edit Lesson Plan - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit Lesson Plan';
$pageDesc = 'Chỉnh sửa nội dung giáo án';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chỉnh sửa lesson plan</h3>
        <p>Cập nhật lại tiêu đề, mục tiêu, hoạt động và đánh giá theo nhu cầu giảng dạy.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Edit Lesson Plan">
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Edit Lesson Plan Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/update?id=<?= $lessonPlan['id']; ?>">
                <?php
                $promptTemplateCategoryKey = 'lesson_plan';
                $promptTemplateCategoryLabel = 'Lesson Plan';
                $promptPanelId = 'lesson-plan-edit-prompt-panel';
                $promptImportTargets = [
                    ['selector' => 'textarea[name="objectives"]', 'label' => 'Chèn vào Objectives'],
                    ['selector' => 'textarea[name="activities"]', 'label' => 'Chèn vào Activities'],
                    ['selector' => 'textarea[name="assessment"]', 'label' => 'Chèn vào Assessment'],
                ];
                include __DIR__ . '/../partials/prompt_template_panel.php';
                ?>

                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề giáo án</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" value="<?= htmlspecialchars($lessonPlan['title']); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft" <?= ($lessonPlan['status'] === 'draft') ? 'selected' : ''; ?>>Draft</option>
                            <option value="completed" <?= ($lessonPlan['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" value="<?= htmlspecialchars($lessonPlan['subject']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Khối lớp</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="grade_level" value="<?= htmlspecialchars($lessonPlan['grade_level']); ?>" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Objectives</label>
                        <textarea class="form-control rounded-4" name="objectives" rows="4"><?= htmlspecialchars($lessonPlan['objectives']); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Activities</label>
                        <textarea class="form-control rounded-4" name="activities" rows="5"><?= htmlspecialchars($lessonPlan['activities']); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Assessment</label>
                        <textarea class="form-control rounded-4" name="assessment" rows="4"><?= htmlspecialchars($lessonPlan['assessment']); ?></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle-fill me-2"></i>Cập nhật
                    </button>

                    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans" class="btn btn-light border rounded-pill px-4">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_lesson_plans_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
