<?php

use App\Core\Auth;

$title = 'Exercise Detail - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Exercise Detail';
$pageDesc = 'Xem chi tiết bài tập';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết bài tập</h3>
        <p>Xem đầy đủ thông tin, mô tả và câu hỏi của bài tập đã tạo.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($exercise['title']); ?></h5>
            <small class="text-secondary">
                <?= htmlspecialchars($exercise['subject']); ?> • <?= htmlspecialchars($exercise['topic']); ?>
            </small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises/edit?id=<?= $exercise['id']; ?>" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square me-2"></i>Sửa
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Quay lại
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Môn học</h6>
                <p class="mb-0"><?= htmlspecialchars($exercise['subject']); ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Chủ đề</h6>
                <p class="mb-0"><?= htmlspecialchars($exercise['topic']); ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Trạng thái</h6>
                <p class="mb-0">
                    <?php if (($exercise['status'] ?? '') === 'published'): ?>
                        <span class="badge bg-success-subtle text-success">Published</span>
                    <?php else: ?>
                        <span class="badge bg-warning-subtle text-warning">Draft</span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>

    <div class="small-panel mb-4">
        <h6>Mô tả</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($exercise['description'] ?? ''); ?></p>
    </div>

</div>

<div class="dashboard-card mt-4">
    <div class="card-header-custom">
        <h5>Câu hỏi từ Question Bank</h5>
    </div>

    <?php if (!empty($questions)): ?>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Câu hỏi</th>
                        <th>Chủ đề</th>
                        <th>Độ khó</th>
                        <th>Đáp án</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($questions as $index => $q): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td style="white-space: pre-line;"><?= htmlspecialchars($q['question_text']); ?></td>
                            <td><?= htmlspecialchars($q['topic']); ?></td>
                            <td><?= htmlspecialchars(strtoupper($q['difficulty'])); ?></td>
                            <td><span class="badge bg-primary-subtle text-primary"><?= htmlspecialchars(strtoupper($q['correct_answer'])); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="mb-0 text-secondary">Bài tập này chưa gắn câu hỏi nào từ Question Bank.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_exercises_show.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
