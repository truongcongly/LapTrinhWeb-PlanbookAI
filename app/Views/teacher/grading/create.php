<?php

use App\Core\Auth;

$title = 'Create Grading Session - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Grading Session';
$pageDesc = 'Nhập dữ liệu bài làm để hệ thống chấm tự động';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tạo phiên chấm bài</h3>
        <p>Chọn đề thi và nhập đáp án nhận diện dạng A,B,C,D để mô phỏng OCR grading.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Create Grading Session">
</div>

<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Grading Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/grading/store">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Chọn đề thi</label>
                        <select class="form-select form-select-lg rounded-4" name="exam_id" required>
                            <option value="">-- Chọn đề thi --</option>
                            <?php foreach (($exams ?? []) as $exam): ?>
                                <option value="<?= $exam['id']; ?>">
                                    <?= htmlspecialchars($exam['title']); ?> - <?= htmlspecialchars($exam['subject']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tên học sinh</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="student_name" placeholder="Nhập tên học sinh" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Đáp án nhận diện (OCR Mock)</label>
                        <textarea class="form-control rounded-4" name="scanned_answers" rows="5" placeholder="Ví dụ: A,B,C,D,A,B,C,D,A,B" required></textarea>
                        <small class="text-secondary">Nhập mỗi đáp án cách nhau bằng dấu phẩy.</small>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check2-square me-2"></i>Auto Grade
                    </button>

                    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading" class="btn btn-light border rounded-pill px-4">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_grading_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';