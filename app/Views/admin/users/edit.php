<?php
use App\Core\Auth;

$title = 'Edit User - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit User';
$pageDesc = 'Cập nhật thông tin tài khoản trong hệ thống';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chỉnh sửa người dùng</h3>
        <p>Cập nhật thông tin và vai trò tài khoản phù hợp với nhiệm vụ trong hệ thống.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/admin-panel.svg" alt="Edit User">
</div>

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Edit User Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/update?id=<?= $user['id']; ?>">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Họ tên</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control form-control-lg rounded-4" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Vai trò</label>
                        <select class="form-select form-select-lg rounded-4" name="role" required>
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                            <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : ''; ?>>Staff</option>
                            <option value="teacher" <?= $user['role'] === 'teacher' ? 'selected' : ''; ?>>Teacher</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle-fill me-2"></i>Cập nhật
                    </button>
                    <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="btn btn-light border rounded-pill px-4">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_users_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';