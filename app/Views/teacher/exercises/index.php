<?php

use App\Core\Auth;

$title = 'Exercises - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Exercises';
$pageDesc = 'Quản lý bài tập phục vụ giảng dạy';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Exercises</h3>
        <p>Tạo, chỉnh sửa và quản lý bài tập theo môn học, chủ đề và trạng thái sử dụng.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Exercises">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sách bài tập</h5>
            <small class="text-secondary">Tất cả exercises của bạn</small>
        </div>

        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises/create" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle-fill me-2"></i>Tạo bài tập mới
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Tổng bài tập</h6>
                <p class="mb-0"><strong><?= count($exercises ?? []); ?></strong> bài tập đã tạo.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Draft</h6>
                <p class="mb-0"><strong><?= count(array_filter($exercises ?? [], fn($item) => ($item['status'] ?? '') === 'draft')); ?></strong> bài tập nháp.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Published</h6>
                <p class="mb-0"><strong><?= count(array_filter($exercises ?? [], fn($item) => ($item['status'] ?? '') === 'published')); ?></strong> bài tập đã phát hành.</p>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Môn học</th>
                    <th>Chủ đề</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($exercises)): ?>
                    <?php foreach ($exercises as $exercise): ?>
                        <tr>
                            <td>#<?= $exercise['id']; ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($exercise['title']); ?></td>
                            <td><?= htmlspecialchars($exercise['subject']); ?></td>
                            <td><?= htmlspecialchars($exercise['topic']); ?></td>
                            <td>
                                <?php if (($exercise['status'] ?? '') === 'published'): ?>
                                    <span class="badge bg-success-subtle text-success">Published</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $exercise['created_at'] ?? '-'; ?></td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises/show?id=<?= $exercise['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises/edit?id=<?= $exercise['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises/delete?id=<?= $exercise['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">
                                    <i class="bi bi-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No exercises" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary mb-2">Bạn chưa có bài tập nào.</div>
                            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exercises/create" class="btn btn-primary rounded-pill px-4">
                                Tạo bài tập đầu tiên
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
$tempFile = sys_get_temp_dir() . '/teacher_exercises_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';