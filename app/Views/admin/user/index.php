<?php
$title = 'Quản lý người dùng - PlanbookAI';
$currentUser = \App\Core\Auth::user();
$pageTitle = 'Quản lý người dùng';
$pageDesc = 'Danh sách tài khoản trong hệ thống';

include __DIR__ . '/../../layouts/head.php';
$role = 'admin';
include __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-panel">
    <?php include __DIR__ . '/../../layouts/topbar.php'; ?>

    <div class="page-body">
        <div class="card panel-card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
                    <div>
                        <h5 class="fw-bold mb-1">Danh sách người dùng</h5>
                        <p class="text-secondary mb-0">Quản lý tài khoản Admin, Staff và Teacher</p>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/create" class="btn btn-brand">
                            <i class="bi bi-person-plus"></i> Thêm người dùng
                        </a>
                        <a href="/LapTrinhWeb-PlanbookAI/public/admin/dashboard" class="btn btn-soft">
                            <i class="bi bi-arrow-left"></i> Về Dashboard
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Ngày tạo</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>#<?= $user['id']; ?></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($user['name']); ?></td>
                                        <td><?= htmlspecialchars($user['email']); ?></td>
                                        <td>
                                            <?php if ($user['role'] === 'admin'): ?>
                                                <span class="role-badge role-admin">Admin</span>
                                            <?php elseif ($user['role'] === 'staff'): ?>
                                                <span class="role-badge role-staff">Staff</span>
                                            <?php else: ?>
                                                <span class="role-badge role-teacher">Teacher</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $user['created_at'] ?? '-'; ?></td>
                                        <td class="text-center">
                                            <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/edit?id=<?= $user['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                <i class="bi bi-pencil-square"></i> Sửa
                                            </a>
                                            <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/delete?id=<?= $user['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">
                                                <i class="bi bi-trash"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-secondary py-4">
                                        Chưa có dữ liệu người dùng.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>