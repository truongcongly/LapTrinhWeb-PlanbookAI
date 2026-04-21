<?php
use App\Core\Auth;

$title = 'User Management - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'User Management';
$pageDesc = 'Quan ly tai khoan Admin, Staff va Teacher';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Quan ly nguoi dung</h3>
        <p>Theo doi danh sach tai khoan, chinh sua thong tin va phan quyen trong toan he thong.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/admin-panel.svg" alt="User Management">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sach nguoi dung</h5>
            <small class="text-secondary">Quan ly role, goi dich vu va thong tin tai khoan he thong</small>
        </div>

        <div class="d-flex gap-2">
            <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/create" class="btn btn-primary rounded-pill px-4">
                <i class="bi bi-person-plus-fill me-2"></i>Them nguoi dung
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ho ten</th>
                    <th>Email</th>
                    <th>Vai tro</th>
                    <th>Dich vu</th>
                    <th>Ngay tao</th>
                    <th class="text-center">Hanh dong</th>
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
                            <td>
                                <?php if (($user['service_plan'] ?? 'free') === 'professional'): ?>
                                    <span class="role-badge service-badge service-professional">Chuyen nghiep</span>
                                <?php else: ?>
                                    <span class="role-badge service-badge service-free">Mien phi</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $user['created_at'] ?? '-'; ?></td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/edit?id=<?= $user['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Sua
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/delete?id=<?= $user['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">
                                    <i class="bi bi-trash"></i> Xoa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No data" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary">Chua co du lieu nguoi dung.</div>
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
