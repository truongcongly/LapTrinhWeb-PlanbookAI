<?php

use App\Core\Auth;

$title = 'Results - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Results';
$pageDesc = 'Quan ly ket qua cham bai va phan hoi';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Results</h3>
        <p>Theo doi ket qua cham bai, xem diem va cap nhat feedback cho tung hoc sinh.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sach ket qua</h5>
            <small class="text-secondary">Ket qua cham bai cua giao vien</small>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hoc sinh</th>
                    <th>De thi</th>
                    <th>So dung</th>
                    <th>Diem</th>
                    <th class="text-center">Hanh dong</th>
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
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/show?id=<?= $result['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/edit?id=<?= $result['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Feedback
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/delete?id=<?= $result['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">
                                    <i class="bi bi-trash"></i> Xoa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No results" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary mb-2">Chua co ket qua nao.</div>
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
