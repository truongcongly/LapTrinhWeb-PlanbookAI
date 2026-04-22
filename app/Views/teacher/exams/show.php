<?php

use App\Core\Auth;

$title = 'Exam Detail - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Exam Detail';
$pageDesc = 'Xem chi tiết đề thi và các câu hỏi';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết đề kiểm tra</h3>
        <p>Xem thông tin đề thi, answer key và danh sách câu hỏi đã chọn.</p>
    </div>
</div>

<div class="dashboard-card mb-4">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($exam['title']); ?></h5>
            <small class="text-secondary"><?= htmlspecialchars($exam['subject']); ?> • <?= htmlspecialchars($exam['grade_level']); ?></small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/take?id=<?= $exam['id']; ?>" class="btn btn-primary rounded-pill px-4">Take Exam</a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/edit?id=<?= $exam['id']; ?>" class="btn btn-outline-primary rounded-pill px-4">Sửa</a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Số câu</h6>
                <p class="mb-0"><?= (int)$exam['total_questions']; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Thời lượng</h6>
                <p class="mb-0"><?= (int)$exam['duration_minutes']; ?> phút</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Trạng thái</h6>
                <p class="mb-0"><?= htmlspecialchars($exam['status']); ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Answer Key</h6>
                <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($exam['answer_key'] ?? ''); ?></p>
            </div>
        </div>
    </div>

    <div class="small-panel">
        <h6>Instructions</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($exam['instructions'] ?? ''); ?></p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <h5>Danh sách câu hỏi trong đề</h5>
    </div>

    <?php if (!empty($questions)): ?>
        <div class="row g-4">
            <?php foreach ($questions as $index => $q): ?>
                <div class="col-12">
                    <div class="small-panel">
                        <h6>Câu <?= $index + 1; ?></h6>
                        <p style="white-space: pre-line;"><?= htmlspecialchars($q['question_text']); ?></p>
                        <div class="row g-2">
                            <div class="col-md-6"><strong>A.</strong> <?= htmlspecialchars($q['option_a']); ?></div>
                            <div class="col-md-6"><strong>B.</strong> <?= htmlspecialchars($q['option_b']); ?></div>
                            <div class="col-md-6"><strong>C.</strong> <?= htmlspecialchars($q['option_c']); ?></div>
                            <div class="col-md-6"><strong>D.</strong> <?= htmlspecialchars($q['option_d']); ?></div>
                        </div>
                        <div class="mt-2 text-secondary small">Đáp án đúng: <?= htmlspecialchars($q['correct_answer']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-secondary">Đề thi chưa có câu hỏi nào.</div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_exams_show_full.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';