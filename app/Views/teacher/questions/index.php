<?php

use App\Core\Auth;

$title = 'Question Bank - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Question Bank';
$pageDesc = 'Quản lý câu hỏi phục vụ bài tập và đề kiểm tra';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Question Bank</h3>
        <p>Tạo, chỉnh sửa và quản lý ngân hàng câu hỏi theo môn học, chủ đề và độ khó.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Question Bank">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sách câu hỏi</h5>
            <small class="text-secondary">Tất cả câu hỏi của bạn</small>
        </div>

        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions/create" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle-fill me-2"></i>Thêm câu hỏi mới
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Tổng câu hỏi</h6>
                <p class="mb-0"><strong><?= count($questions ?? []); ?></strong> câu hỏi đã tạo.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Easy</h6>
                <p class="mb-0"><strong><?= count(array_filter($questions ?? [], fn($item) => ($item['difficulty'] ?? '') === 'easy')); ?></strong> câu hỏi dễ.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Hard</h6>
                <p class="mb-0"><strong><?= count(array_filter($questions ?? [], fn($item) => ($item['difficulty'] ?? '') === 'hard')); ?></strong> câu hỏi khó.</p>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nội dung câu hỏi</th>
                    <th>Môn học</th>
                    <th>Chủ đề</th>
                    <th>Độ khó</th>
                    <th>Đáp án</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($questions)): ?>
                    <?php foreach ($questions as $question): ?>
                        <tr>
                            <td>#<?= $question['id']; ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars(mb_strimwidth($question['question_text'], 0, 60, '...')); ?></td>
                            <td><?= htmlspecialchars($question['subject']); ?></td>
                            <td><?= htmlspecialchars($question['topic']); ?></td>
                            <td>
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
                            </td>
                            <td><?= htmlspecialchars($question['correct_answer'] ?? '-'); ?></td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions/show?id=<?= $question['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions/edit?id=<?= $question['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions/delete?id=<?= $question['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">
                                    <i class="bi bi-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No questions" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary mb-2">Bạn chưa có câu hỏi nào.</div>
                            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions/create" class="btn btn-primary rounded-pill px-4">
                                Tạo câu hỏi đầu tiên
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_questions_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';