<?php

use App\Core\Auth;

$title = 'Exams - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Exams';
$pageDesc = 'Quản lý đề kiểm tra và đáp án chuẩn';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Exams</h3>
        <p>Tạo, chỉnh sửa và quản lý đề kiểm tra cùng answer key phục vụ chấm bài.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Exams">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sách đề kiểm tra</h5>
            <small class="text-secondary">Tất cả exams của bạn</small>
        </div>

        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/create" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle-fill me-2"></i>Tạo đề mới
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Tổng đề thi</h6>
                <p class="mb-0"><strong><?= count($exams ?? []); ?></strong> đề đã tạo.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Draft</h6>
                <p class="mb-0"><strong><?= count(array_filter($exams ?? [], fn($item) => ($item['status'] ?? '') === 'draft')); ?></strong> đề nháp.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Published</h6>
                <p class="mb-0"><strong><?= count(array_filter($exams ?? [], fn($item) => ($item['status'] ?? '') === 'published')); ?></strong> đề đã phát hành.</p>
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
                    <th>Khối lớp</th>
                    <th>Số câu</th>
                    <th>Thời lượng</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($exams)): ?>
                    <?php foreach ($exams as $exam): ?>
                        <tr>
                            <td>#<?= $exam['id']; ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($exam['title']); ?></td>
                            <td><?= htmlspecialchars($exam['subject']); ?></td>
                            <td><?= htmlspecialchars($exam['grade_level']); ?></td>
                            <td><?= (int)$exam['total_questions']; ?></td>
                            <td><?= (int)$exam['duration_minutes']; ?> phút</td>
                            <td>
                                <?php if (($exam['status'] ?? '') === 'published'): ?>
                                    <span class="badge bg-success-subtle text-success">Published</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/show?id=<?= $exam['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/edit?id=<?= $exam['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/delete?id=<?= $exam['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">
                                    <i class="bi bi-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No exams" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary mb-2">Bạn chưa có đề kiểm tra nào.</div>
                            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/create" class="btn btn-primary rounded-pill px-4">
                                Tạo đề đầu tiên
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
$tempFile = sys_get_temp_dir() . '/teacher_exams_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';