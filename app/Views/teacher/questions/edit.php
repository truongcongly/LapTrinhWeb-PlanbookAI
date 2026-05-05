<?php

use App\Core\Auth;

$title = 'Edit Question - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit Question';
$pageDesc = 'Chỉnh sửa nội dung câu hỏi';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chỉnh sửa câu hỏi</h3>
        <p>Cập nhật môn học, chủ đề, độ khó, đáp án và nội dung các lựa chọn.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Edit Question Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/questions/update?id=<?= $question['id']; ?>">
                <?php
                $promptTemplateCategoryLabel = 'Question Bank';
                $promptPanelId = 'question-bank-prompt-panel';
                $promptImportTargets = [
                    ['selector' => 'textarea[name="question_text"]', 'label' => 'Chen vao cau hoi'],
                    ['selector' => 'input[name="option_a"]', 'label' => 'Chen vao A'],
                    ['selector' => 'input[name="option_b"]', 'label' => 'Chen vao B'],
                    ['selector' => 'input[name="option_c"]', 'label' => 'Chen vao C'],
                    ['selector' => 'input[name="option_d"]', 'label' => 'Chen vao D'],
                ];
                include __DIR__ . '/../partials/prompt_template_panel.php';
                ?>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" value="<?= htmlspecialchars($question['subject']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Chủ đề</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="topic" value="<?= htmlspecialchars($question['topic']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Độ khó</label>
                        <select class="form-select form-select-lg rounded-4" name="difficulty" required>
                            <option value="easy" <?= ($question['difficulty'] === 'easy') ? 'selected' : ''; ?>>Easy</option>
                            <option value="medium" <?= ($question['difficulty'] === 'medium') ? 'selected' : ''; ?>>Medium</option>
                            <option value="hard" <?= ($question['difficulty'] === 'hard') ? 'selected' : ''; ?>>Hard</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Đáp án đúng</label>
                        <select class="form-select form-select-lg rounded-4" name="correct_answer" required>
                            <option value="A" <?= ($question['correct_answer'] === 'A') ? 'selected' : ''; ?>>A</option>
                            <option value="B" <?= ($question['correct_answer'] === 'B') ? 'selected' : ''; ?>>B</option>
                            <option value="C" <?= ($question['correct_answer'] === 'C') ? 'selected' : ''; ?>>C</option>
                            <option value="D" <?= ($question['correct_answer'] === 'D') ? 'selected' : ''; ?>>D</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Nội dung câu hỏi</label>
                        <textarea class="form-control rounded-4" name="question_text" rows="4" required><?= htmlspecialchars($question['question_text']); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option A</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_a" value="<?= htmlspecialchars($question['option_a']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option B</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_b" value="<?= htmlspecialchars($question['option_b']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option C</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_c" value="<?= htmlspecialchars($question['option_c']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option D</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_d" value="<?= htmlspecialchars($question['option_d']); ?>" required>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle-fill me-2"></i>Cập nhật
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
$tempFile = sys_get_temp_dir() . '/teacher_questions_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
