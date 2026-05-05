<?php

use App\Core\Auth;

$title = 'OCR Grading - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'OCR Grading';
$pageDesc = 'Chấm bài tự động, review đáp án nhận diện và quản lý phiên chấm';
$role = 'teacher';
$stats = $stats ?? [];
$recentResults = $recentResults ?? [];

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>OCR Grading</h3>
        <p>Upload bài làm, nhập đáp án nhận diện, chấm tự động theo answer key và review lại từng câu khi cần.</p>
    </div>
</div>

<div class="dashboard-card mb-4">
    <div class="card-header-custom">
        <div>
            <h5>Bắt đầu chấm bài</h5>
            <small class="text-secondary">Chọn đề thi, nhập đáp án OCR hoặc đính kèm file scan bài làm.</small>
        </div>
        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading/create" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-camera-fill me-2"></i>Tạo phiên chấm bài
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Tổng phiên chấm</h6>
                <p class="mb-0"><strong><?= (int)($stats['total'] ?? 0); ?></strong> kết quả.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Auto graded</h6>
                <p class="mb-0"><strong><?= (int)($stats['auto_graded'] ?? 0); ?></strong> bài đã chấm.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Cần review</h6>
                <p class="mb-0"><strong><?= (int)($stats['needs_review'] ?? 0); ?></strong> bài cần xem lại.</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Reviewed</h6>
                <p class="mb-0"><strong><?= (int)($stats['reviewed'] ?? 0); ?></strong> bài đã duyệt.</p>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Phiên chấm gần đây</h5>
            <small class="text-secondary">Theo dõi nhanh kết quả OCR grading mới nhất.</small>
        </div>
        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results" class="btn btn-outline-secondary rounded-pill px-4">
            Xem tất cả
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Học sinh</th>
                    <th>Đề thi</th>
                    <th>Số đúng</th>
                    <th>Điểm</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($recentResults)): ?>
                    <?php foreach ($recentResults as $result): ?>
                        <tr>
                            <td class="fw-semibold"><?= htmlspecialchars($result['student_name']); ?></td>
                            <td><?= htmlspecialchars($result['exam_title'] ?? ''); ?></td>
                            <td><?= (int)$result['correct_count']; ?>/<?= (int)$result['total_questions']; ?></td>
                            <td><strong><?= htmlspecialchars($result['score']); ?></strong></td>
                            <td>
                                <?php if (($result['status'] ?? '') === 'reviewed'): ?>
                                    <span class="badge bg-success-subtle text-success">Reviewed</span>
                                <?php elseif (($result['status'] ?? '') === 'needs_review'): ?>
                                    <span class="badge bg-warning-subtle text-warning">Needs Review</span>
                                <?php elseif (($result['status'] ?? '') === 'failed'): ?>
                                    <span class="badge bg-danger-subtle text-danger">Failed</span>
                                <?php else: ?>
                                    <span class="badge bg-info-subtle text-info">Auto Graded</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/show?id=<?= $result['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No grading results" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary mb-2">Chưa có phiên chấm nào.</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_grading_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
