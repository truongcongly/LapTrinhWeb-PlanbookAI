<?php

use App\Core\Auth;

$title = 'Create Exam - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Exam';
$pageDesc = 'Tạo đề kiểm tra mới và nhập answer key';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tạo đề kiểm tra mới</h3>
        <p>Thiết lập thông tin đề, số câu hỏi, thời lượng, trạng thái và đáp án chuẩn.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Create Exam">
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Exam Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/exams/store">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề đề thi</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" placeholder="Ví dụ: Midterm Test 1" required>
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
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" placeholder="Ví dụ: English" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Khối lớp</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="grade_level" placeholder="Ví dụ: Grade 7" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Số câu</label>
                        <input type="number" class="form-control form-control-lg rounded-4" name="total_questions" min="1" value="10" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Thời lượng</label>
                        <input type="number" class="form-control form-control-lg rounded-4" name="duration_minutes" min="1" value="45" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Instructions</label>
                        <textarea class="form-control rounded-4" name="instructions" rows="4" placeholder="Nhập hướng dẫn làm bài..."></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Answer Key</label>
                        <textarea class="form-control rounded-4" name="answer_key" rows="4" placeholder="Ví dụ: A,B,C,D,A,B,C,D,A,B" required></textarea>
                        <small class="text-secondary">Nhập đáp án cách nhau bằng dấu phẩy.</small>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Lưu đề thi
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
$tempFile = sys_get_temp_dir() . '/teacher_exams_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';