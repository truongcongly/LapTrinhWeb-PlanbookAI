<?php

use App\Core\Auth;

$title       = 'Thêm Lesson Sample - PlanbookAI';
$currentUser = Auth::user();
$pageTitle   = 'Thêm Lesson Sample';
$pageDesc    = 'Tạo giáo án mẫu mới để chia sẻ trong hệ thống';
$role        = 'staff';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Thêm lesson sample mới</h3>
        <p>Xây dựng giáo án mẫu theo môn học, khối lớp, mục tiêu, hoạt động và hình thức đánh giá.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Create Lesson Sample">
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Lesson Sample Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/store">
                <div class="row g-4">

                    <!-- Tiêu đề -->
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề giáo án mẫu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title"
                               placeholder="Ví dụ: Giáo án mẫu Unit 1 - Grade 6" required>
                    </div>

                    <!-- Trạng thái -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft">Draft</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <!-- Môn học -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject"
                               id="subjectInput" list="subjectList"
                               placeholder="Ví dụ: English, Math, Science..." required>
                        <datalist id="subjectList">
                            <?php foreach (($subjects ?? []) as $s): ?>
                                <option value="<?= htmlspecialchars($s); ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <!-- Khối lớp -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Khối lớp <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="grade_level"
                               id="gradeInput" list="gradeList"
                               placeholder="Ví dụ: Grade 6, Grade 7..." required>
                        <datalist id="gradeList">
                            <?php foreach (($gradeLevels ?? []) as $g): ?>
                                <option value="<?= htmlspecialchars($g); ?>">
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <!-- Objectives -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">Objectives (Mục tiêu bài học)</label>
                        <textarea class="form-control rounded-4" name="objectives" rows="4"
                                  placeholder="Nhập mục tiêu bài học...&#10;Ví dụ:&#10;- Học sinh hiểu được...&#10;- Học sinh có thể..."></textarea>
                    </div>

                    <!-- Activities -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">Activities (Hoạt động dạy học)</label>
                        <textarea class="form-control rounded-4" name="activities" rows="5"
                                  placeholder="Nhập các hoạt động dạy học...&#10;Ví dụ:&#10;1. Warm-up (5 phút)&#10;2. Presentation (15 phút)..."></textarea>
                    </div>

                    <!-- Assessment -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">Assessment (Hình thức đánh giá)</label>
                        <textarea class="form-control rounded-4" name="assessment" rows="4"
                                  placeholder="Nhập hình thức đánh giá...&#10;Ví dụ:&#10;- Kiểm tra miệng&#10;- Bài tập về nhà..."></textarea>
                    </div>

                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Lưu lesson sample
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
$tempFile = sys_get_temp_dir() . '/staff_lesson_samples_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';