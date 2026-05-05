<?php

use App\Core\Auth;

$title = 'Create Question - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Question';
$pageDesc = 'Thêm câu hỏi mới vào question bank';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tạo câu hỏi mới</h3>
        <p>Xây dựng câu hỏi theo môn học, chủ đề, độ khó và đáp án chính xác.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Question Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/questions/store">
                <?php
                $promptTemplateCategoryLabel = 'Question Bank';
                $promptPanelId = 'question-bank-prompt-panel';
                $promptImportTargets = [
                    ['selector' => 'textarea[name="question_text"]', 'label' => 'Chen vao cau hoi'],
                    ['selector' => 'input[name="option_a"]', 'label' => 'Chen vao A'],
                    ['selector' => 'input[name="option_b"]', 'label' => 'Chen vao B'],
                    ['selector' => 'input[name="option_c"]', 'label' => 'Chen vao C'],
                    ['selector' => 'input[name="option_d"]', 'label' => 'Chen vao D'],
                    ['selector' => 'select[name="correct_answer"]', 'label' => 'Chen dap an dung'],
                ];
                include __DIR__ . '/../partials/prompt_template_panel.php';
                ?>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" placeholder="Ví dụ: Math" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Chủ đề</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="topic" placeholder="Ví dụ: Algebra" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Độ khó</label>
                        <select class="form-select form-select-lg rounded-4" name="difficulty" required>
                            <option value="easy">Easy</option>
                            <option value="medium" selected>Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Đáp án đúng</label>
                        <select class="form-select form-select-lg rounded-4" name="correct_answer" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Nội dung câu hỏi</label>
                        <textarea class="form-control rounded-4" name="question_text" rows="4" placeholder="Nhập nội dung câu hỏi..." required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option A</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_a" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option B</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_b" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option C</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_c" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option D</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_d" required>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Lưu câu hỏi
                    </button>

                    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions" class="btn btn-light border rounded-pill px-4">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_questions_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
