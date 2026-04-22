<?php

use App\Core\Auth;

$title = 'Question Detail - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Question Detail';
$pageDesc = 'Xem chi tiết câu hỏi';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết câu hỏi</h3>
        <p>Xem đầy đủ nội dung câu hỏi, các lựa chọn và đáp án đúng.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Question #<?= $question['id']; ?></h5>
            <small class="text-secondary">
                <?= htmlspecialchars($question['subject']); ?> • <?= htmlspecialchars($question['topic']); ?>
            </small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions/edit?id=<?= $question['id']; ?>" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square me-2"></i>Sửa
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Quay lại
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Môn học</h6>
                <p class="mb-0"><?= htmlspecialchars($question['subject']); ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Chủ đề</h6>
                <p class="mb-0"><?= htmlspecialchars($question['topic']); ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Độ khó</h6>
                <p class="mb-0">
                    <?php
                        $difficulty = $question['difficulty'] ?? 'medium';
                        if ($difficulty === 'easy') {
                            echo '<span class="badge bg-success-subtle text-success">Easy</span>';
                        } elseif ($difficulty === 'hard') {
                            echo '<span class="badge bg-danger-subtle text-danger">Hard</span>';
                        } else {
                            echo '<span class="badge bg-warning-subtle text-warning">Medium</span>';
                        }
                    ?>
                </p>
            </div>
        </div>
    </div>

    <div class="small-panel mb-4">
        <h6>Nội dung câu hỏi</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($question['question_text']); ?></p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="small-panel">
                <h6>Option A</h6>
                <p class="mb-0"><?= htmlspecialchars($question['option_a']); ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="small-panel">
                <h6>Option B</h6>
                <p class="mb-0"><?= htmlspecialchars($question['option_b']); ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="small-panel">
                <h6>Option C</h6>
                <p class="mb-0"><?= htmlspecialchars($question['option_c']); ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="small-panel">
                <h6>Option D</h6>
                <p class="mb-0"><?= htmlspecialchars($question['option_d']); ?></p>
            </div>
        </div>
    </div>

    <div class="small-panel mt-4">
        <h6>Đáp án đúng</h6>
        <p class="mb-0">
            <span class="badge bg-primary-subtle text-primary fs-6"><?= htmlspecialchars($question['correct_answer']); ?></span>
        </p>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_questions_show.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';