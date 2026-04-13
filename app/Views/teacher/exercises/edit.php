<?php

use App\Core\Auth;

$title = 'Edit Exercise - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit Exercise';
$pageDesc = 'Chỉnh sửa bài tập';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chỉnh sửa bài tập</h3>
        <p>Cập nhật thông tin, mô tả và nội dung bài tập theo nhu cầu giảng dạy.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Edit Exercise">
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Edit Exercise Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/exercises/update?id=<?= $exercise['id']; ?>">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề bài tập</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" value="<?= htmlspecialchars($exercise['title']); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft" <?= ($exercise['status'] === 'draft') ? 'selected' : ''; ?>>Draft</option>
                            <option value="published" <?= ($exercise['status'] === 'published') ? 'selected' : ''; ?>>Published</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" value="<?= htmlspecialchars($exercise['subject']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Chủ đề</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="topic" value="<?= htmlspecialchars($exercise['topic']); ?>" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Mô tả</label>
                        <textarea class="form-control rounded-4" name="description" rows="3"><?= htmlspecialchars($exercise['description'] ?? ''); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Nội dung bài tập</label>
                        <textarea class="form-control rounded-4" name="content" rows="8" required><?= htmlspecialchars($exercise['content']); ?></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle-fill me-2"></i>Cập nhật
                    </button>

                    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises" class="btn btn-light border rounded-pill px-4">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_exercises_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';