<?php
use App\Core\Auth;

$title = 'Edit User - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit User';
$pageDesc = 'Cap nhat thong tin tai khoan trong he thong';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chinh sua nguoi dung</h3>
        <p>Cap nhat thong tin, vai tro va goi dich vu phu hop voi nhiem vu trong he thong.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Edit User Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lai
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/update?id=<?= $user['id']; ?>">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ho ten</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control form-control-lg rounded-4" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Vai tro</label>
                        <select class="form-select form-select-lg rounded-4" name="role" required>
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                            <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : ''; ?>>Staff</option>
                            <option value="teacher" <?= $user['role'] === 'teacher' ? 'selected' : ''; ?>>Teacher</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Dich vu</label>
                        <select class="form-select form-select-lg rounded-4" name="service_plan" required>
                            <option value="free" <?= ($user['service_plan'] ?? 'free') === 'free' ? 'selected' : ''; ?>>Goi mien phi</option>
                            <option value="professional" <?= ($user['service_plan'] ?? 'free') === 'professional' ? 'selected' : ''; ?>>Goi chuyen nghiep</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle-fill me-2"></i>Cap nhat
                    </button>
                    <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="btn btn-light border rounded-pill px-4">
                        Huy
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
