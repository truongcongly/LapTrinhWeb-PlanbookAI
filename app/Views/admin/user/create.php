<?php
$title = 'Thêm người dùng - PlanbookAI';
$currentUser = \App\Core\Auth::user();
$pageTitle = 'Thêm người dùng';
$pageDesc = 'Tạo tài khoản mới trong hệ thống';

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
                                <h4 class="fw-bold mb-1">Thêm người dùng</h4>
                                <p class="text-secondary mb-0">Tạo tài khoản Admin, Staff hoặc Teacher</p>
                            </div>
                            <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="btn btn-soft">
                                <i class="bi bi-arrow-left"></i> Quay lại
                            </a>
                        </div>

                        <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/store">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Họ tên</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập họ tên" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Mật khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Vai trò</label>
                                <select class="form-select" name="role" required>
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="teacher">Teacher</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-brand">
                                    <i class="bi bi-save"></i> Lưu người dùng
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