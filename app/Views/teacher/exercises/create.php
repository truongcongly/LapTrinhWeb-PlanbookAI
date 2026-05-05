<?php

use App\Core\Auth;

$title = 'Create Exercise - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Exercise';
$pageDesc = 'Tạo bài tập mới';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tạo bài tập mới</h3>
        <p>Thiết lập thông tin bài tập, mô tả và nội dung cho hoạt động luyện tập của học sinh.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Exercise Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/exercises/store">
                <?php
                $promptTemplateCategoryKey = 'exercise';
                $promptTemplateCategoryLabel = 'Exercise';
                $promptPanelId = 'exercise-prompt-panel';
                $promptImportTargets = [
                    ['selector' => 'textarea[name="description"]', 'label' => 'Chèn vào Mô tả'],
                    ['selector' => 'textarea[name="content"]', 'label' => 'Chèn vào Nội dung'],
                ];
                include __DIR__ . '/../partials/prompt_template_panel.php';
                ?>

                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề bài tập</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" placeholder="Ví dụ: Practice Exercise - Unit 2" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" placeholder="Ví dụ: English" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Chủ đề</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="topic" placeholder="Ví dụ: Vocabulary" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Mô tả</label>
                        <textarea class="form-control rounded-4" name="description" rows="3" placeholder="Nhập mô tả ngắn về bài tập..."></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Nội dung bài tập</label>
                        <textarea class="form-control rounded-4" name="content" rows="8" placeholder="Nhập nội dung bài tập, danh sách câu hỏi hoặc hướng dẫn..."></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Chọn câu hỏi từ Question Bank</label>
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
                                                    <?= htmlspecialchars($q['subject']); ?> • <?= htmlspecialchars($q['topic']); ?> • <?= strtoupper($q['difficulty']); ?> • Đáp án: <?= strtoupper($q['correct_answer']); ?>
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
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Lưu bài tập
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
$tempFile = sys_get_temp_dir() . '/teacher_exercises_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
