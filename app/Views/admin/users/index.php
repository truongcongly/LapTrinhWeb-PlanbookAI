<?php
use App\Core\Auth;

$title = 'User Management - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'User Management';
$pageDesc = 'Quản lý tài khoản Admin, Staff và Teacher';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Quản lý người dùng</h3>
        <p>Theo dõi danh sách tài khoản, chỉnh sửa thông tin và phân quyền trong toàn hệ thống.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/admin-panel.svg" alt="User Management">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sách người dùng</h5>
            <small class="text-secondary">Quản lý role và thông tin tài khoản hệ thống</small>
        </div>

        <div class="d-flex gap-2">
            <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/create" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-person-plus-fill me-2"></i>Thêm người dùng
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
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
                        <td colspan="6" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No data" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary">Chưa có dữ liệu người dùng.</div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_users_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';