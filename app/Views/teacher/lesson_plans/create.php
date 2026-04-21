<?php

use App\Core\Auth;

$title = 'Create Lesson Plan - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Lesson Plan';
$pageDesc = 'Tạo giáo án mới cho hoạt động giảng dạy';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tạo lesson plan mới</h3>
        <p>Xây dựng giáo án theo môn học, khối lớp, mục tiêu, hoạt động và hình thức đánh giá.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Create Lesson Plan">
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Lesson Plan Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/store">
                <?php
                $promptTemplateCategoryKey = 'lesson_plan';
                $promptTemplateCategoryLabel = 'Lesson Plan';
                $promptPanelId = 'lesson-plan-prompt-panel';
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
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" placeholder="Ví dụ: Lesson Plan - Unit 1" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft">Draft</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" placeholder="Ví dụ: English" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Khối lớp</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="grade_level" placeholder="Ví dụ: Grade 6" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Objectives</label>
                        <textarea class="form-control rounded-4" name="objectives" rows="4" placeholder="Nhập mục tiêu bài học..."></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Activities</label>
                        <textarea class="form-control rounded-4" name="activities" rows="5" placeholder="Nhập hoạt động dạy học..."></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Assessment</label>
                        <textarea class="form-control rounded-4" name="assessment" rows="4" placeholder="Nhập hình thức đánh giá..."></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Lưu lesson plan
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
$tempFile = sys_get_temp_dir() . '/teacher_lesson_plans_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
