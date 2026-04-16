<?php

use App\Core\Auth;

$title = 'Take Exam - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Take Exam';
$pageDesc = 'Làm bài kiểm tra mô phỏng';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Làm bài kiểm tra</h3>
        <p>Mô phỏng quy trình học sinh làm bài và hệ thống tự chấm điểm.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Take Exam">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($exam['title']); ?></h5>
            <small class="text-secondary"><?= htmlspecialchars($exam['subject']); ?> • <?= htmlspecialchars($exam['grade_level']); ?></small>
        </div>

        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/show?id=<?= $exam['id']; ?>" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
    </div>

    <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/exams/submit?id=<?= $exam['id']; ?>">
        <div class="mb-4">
            <label class="form-label fw-semibold">Tên học sinh</label>
            <input type="text" class="form-control form-control-lg rounded-4" name="student_name" placeholder="Nhập tên học sinh" required>
        </div>

        <div class="small-panel mb-4">
            <h6>Instructions</h6>
            <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($exam['instructions'] ?? ''); ?></p>
        </div>

        <?php if (!empty($questions)): ?>
            <div class="row g-4">
                <?php foreach ($questions as $index => $q): ?>
                    <div class="col-12">
                        <div class="small-panel">
                            <h6>Câu <?= $index + 1; ?></h6>
                            <p style="white-space: pre-line;"><?= htmlspecialchars($q['question_text']); ?></p>

                            <div class="mt-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="answers[<?= $q['id']; ?>]" value="A" id="q<?= $q['id']; ?>a">
                                    <label class="form-check-label" for="q<?= $q['id']; ?>a">
                                        <strong>A.</strong> <?= htmlspecialchars($q['option_a']); ?>
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="answers[<?= $q['id']; ?>]" value="B" id="q<?= $q['id']; ?>b">
                                    <label class="form-check-label" for="q<?= $q['id']; ?>b">
                                        <strong>B.</strong> <?= htmlspecialchars($q['option_b']); ?>
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="answers[<?= $q['id']; ?>]" value="C" id="q<?= $q['id']; ?>c">
                                    <label class="form-check-label" for="q<?= $q['id']; ?>c">
                                        <strong>C.</strong> <?= htmlspecialchars($q['option_c']); ?>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[<?= $q['id']; ?>]" value="D" id="q<?= $q['id']; ?>d">
                                    <label class="form-check-label" for="q<?= $q['id']; ?>d">
                                        <strong>D.</strong> <?= htmlspecialchars($q['option_d']); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Nộp bài</button>
            </div>
        <?php else: ?>
            <div class="text-secondary">Đề thi chưa có câu hỏi.</div>
        <?php endif; ?>
    </form>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_exams_take.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';