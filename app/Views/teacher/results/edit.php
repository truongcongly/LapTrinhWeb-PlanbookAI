<?php

use App\Core\Auth;

$title = 'Edit Result - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit Result';
$pageDesc = 'Thêm feedback và chỉnh sửa kết quả';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chỉnh sửa kết quả</h3>
        <p>Thêm phản hồi cho học sinh và điều chỉnh điểm nếu cần.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Result Feedback Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/results/update?id=<?= $result['id']; ?>">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tên học sinh</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="student_name" value="<?= htmlspecialchars($result['student_name']); ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Điểm</label>
                        <input type="number" step="0.01" class="form-control form-control-lg rounded-4" name="score" value="<?= htmlspecialchars($result['score']); ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="auto_graded" <?= ($result['status'] === 'auto_graded') ? 'selected' : ''; ?>>Auto Graded</option>
                            <option value="reviewed" <?= ($result['status'] === 'reviewed') ? 'selected' : ''; ?>>Reviewed</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Feedback</label>
                        <textarea class="form-control rounded-4" name="feedback" rows="6" placeholder="Nhập nhận xét cho học sinh..."><?= htmlspecialchars($result['feedback'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle-fill me-2"></i>Cập nhật kết quả
                    </button>

                    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results" class="btn btn-light border rounded-pill px-4">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_results_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';