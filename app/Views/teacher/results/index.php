<?php

use App\Core\Auth;

$title = 'Results - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Results';
$pageDesc = 'Quản lý kết quả chấm bài và phản hồi';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Results</h3>
        <p>Theo dõi kết quả auto grading, xem điểm và cập nhật feedback cho từng học sinh.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sách kết quả</h5>
            <small class="text-secondary">Kết quả chấm bài của giáo viên</small>
        </div>

        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading/create" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle-fill me-2"></i>Tạo kết quả mới
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Học sinh</th>
                    <th>Đề thi</th>
                    <th>Số đúng</th>
                    <th>Điểm</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $result): ?>
                        <tr>
                            <td>#<?= $result['id']; ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($result['student_name']); ?></td>
                            <td><?= htmlspecialchars($result['exam_title'] ?? ''); ?></td>
                            <td><?= (int)$result['correct_count']; ?>/<?= (int)$result['total_questions']; ?></td>
                            <td><strong><?= htmlspecialchars($result['score']); ?></strong></td>
                            <td>
                                <?php if (($result['status'] ?? '') === 'reviewed'): ?>
                                    <span class="badge bg-success-subtle text-success">Reviewed</span>
                                <?php else: ?>
                                    <span class="badge bg-info-subtle text-info">Auto Graded</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/show?id=<?= $result['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/edit?id=<?= $result['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Feedback
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/delete?id=<?= $result['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">
                                    <i class="bi bi-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No results" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary mb-2">Chưa có kết quả nào.</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_results_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';