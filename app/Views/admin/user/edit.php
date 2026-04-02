<?php
$title = 'Sửa người dùng - PlanbookAI';
$currentUser = \App\Core\Auth::user();
$pageTitle = 'Sửa người dùng';
$pageDesc = 'Cập nhật thông tin tài khoản';

include __DIR__ . '/../../layouts/head.php';
$role = 'admin';
include __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-panel">
    <?php include __DIR__ . '/../../layouts/topbar.php'; ?>

    <div class="page-body">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9">
                <div class="card panel-card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="fw-bold mb-1">Sửa người dùng</h4>
                                <p class="text-secondary mb-0">Chỉnh sửa thông tin và vai trò tài khoản</p>
                            </div>
                            <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="btn btn-soft">
                                <i class="bi bi-arrow-left"></i> Quay lại
                            </a>
                        </div>

                        <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/update?id=<?= $user['id']; ?>">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Họ tên</label>
                                <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Vai trò</label>
                                <select class="form-select" name="role" required>
                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : ''; ?>>Staff</option>
                                    <option value="teacher" <?= $user['role'] === 'teacher' ? 'selected' : ''; ?>>Teacher</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-brand">
                                    <i class="bi bi-check2-circle"></i> Cập nhật
                                </button>
                                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="btn btn-outline-secondary rounded-3">
                                    Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>