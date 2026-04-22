<?php

use App\Core\Auth;

$title = 'Curriculum Frameworks - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Curriculum Frameworks';
$pageDesc = 'Quản lý lesson plan templates và khung chương trình';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Curriculum Frameworks</h3>
        <p>Tạo và quản lý template giáo án với objectives, activities và assessment.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sách framework</h5>
            <small class="text-secondary">Tất cả curriculum frameworks của hệ thống</small>
        </div>

        <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks/create" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle-fill me-2"></i>Tạo framework mới
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Môn học</th>
                    <th>Khối lớp</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($frameworks)): ?>
                    <?php foreach ($frameworks as $framework): ?>
                        <tr>
                            <td>#<?= $framework['id']; ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($framework['title']); ?></td>
                            <td><?= htmlspecialchars($framework['subject']); ?></td>
                            <td><?= htmlspecialchars($framework['grade_level']); ?></td>
                            <td>
                                <?php if (($framework['status'] ?? '') === 'active'): ?>
                                    <span class="badge bg-success-subtle text-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks/show?id=<?= $framework['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Xem</a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks/edit?id=<?= $framework['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">Sửa</a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks/delete?id=<?= $framework['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">Chưa có framework nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_frameworks_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';