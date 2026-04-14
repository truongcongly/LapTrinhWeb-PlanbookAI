<?php

use App\Core\Auth;

$title = 'Edit Exam - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit Exam';
$pageDesc = 'Chỉnh sửa đề kiểm tra và answer key';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chỉnh sửa đề kiểm tra</h3>
        <p>Cập nhật thông tin đề, thời lượng, trạng thái và đáp án chuẩn.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Edit Exam">
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Edit Exam Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/exams/update?id=<?= $exam['id']; ?>">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề đề thi</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" value="<?= htmlspecialchars($exam['title']); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft" <?= ($exam['status'] === 'draft') ? 'selected' : ''; ?>>Draft</option>
                            <option value="published" <?= ($exam['status'] === 'published') ? 'selected' : ''; ?>>Published</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" value="<?= htmlspecialchars($exam['subject']); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Khối lớp</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="grade_level" value="<?= htmlspecialchars($exam['grade_level']); ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Số câu</label>
                        <input type="number" class="form-control form-control-lg rounded-4" name="total_questions" min="1" value="<?= (int)$exam['total_questions']; ?>" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Thời lượng</label>
                        <input type="number" class="form-control form-control-lg rounded-4" name="duration_minutes" min="1" value="<?= (int)$exam['duration_minutes']; ?>" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Instructions</label>
                        <textarea class="form-control rounded-4" name="instructions" rows="4"><?= htmlspecialchars($exam['instructions'] ?? ''); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Answer Key</label>
                        <textarea class="form-control rounded-4" name="answer_key" rows="4" required><?= htmlspecialchars($exam['answer_key'] ?? ''); ?></textarea>
                        <small class="text-secondary">Nhập đáp án cách nhau bằng dấu phẩy.</small>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle-fill me-2"></i>Cập nhật
                    </button>

                    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="btn btn-light border rounded-pill px-4">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_exams_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';