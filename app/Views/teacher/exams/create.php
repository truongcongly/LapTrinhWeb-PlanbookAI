<?php

use App\Core\Auth;

$title = 'Create Exam - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Exam';
$pageDesc = 'Tạo đề kiểm tra và chọn câu hỏi';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tạo đề kiểm tra mới</h3>
        <p>Chọn nhiều câu hỏi từ question bank để tạo một bài kiểm tra hoàn chỉnh.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-11 col-lg-12">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Exam Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/exams/store">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề đề thi</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Khối lớp</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="grade_level" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Thời lượng (phút)</label>
                        <input type="number" class="form-control form-control-lg rounded-4" name="duration_minutes" value="45" min="1" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Hướng dẫn</label>
                        <textarea class="form-control rounded-4" name="instructions" rows="4"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Chọn câu hỏi cho đề thi</label>
                        <div class="border rounded-4 p-3 bg-light">
                            <?php if (!empty($questions)): ?>
                                <div class="row g-3">
                                    <?php foreach ($questions as $q): ?>
                                        <div class="col-md-6">
                                            <label class="d-block border rounded-4 p-3 bg-white h-100">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="questions[]" value="<?= $q['id']; ?>">
                                                    <span class="fw-semibold ms-2">Question #<?= $q['id']; ?></span>
                                                </div>
                                                <div class="mt-2 small text-dark" style="white-space: pre-line;">
                                                    <?= htmlspecialchars($q['question_text']); ?>
                                                </div>
                                                <div class="mt-2 text-secondary small">
                                                    <?= htmlspecialchars($q['subject']); ?> • <?= htmlspecialchars($q['topic']); ?> • <?= strtoupper($q['correct_answer']); ?>
                                                </div>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-secondary">Chưa có câu hỏi nào trong question bank.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Lưu đề thi</button>
                    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="btn btn-light border rounded-pill px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_exams_create_full.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
