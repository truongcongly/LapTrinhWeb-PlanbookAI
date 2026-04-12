<?php
use App\Core\Auth;

$title = 'Create User - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create User';
$pageDesc = 'Tạo tài khoản mới trong hệ thống';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Thêm người dùng mới</h3>
        <p>Tạo tài khoản Admin, Staff hoặc Teacher với thông tin đầy đủ và rõ ràng.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/admin-panel.svg" alt="Create User">
</div>

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>User Information Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/store">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Họ tên</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="name" placeholder="Nhập họ tên" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control form-control-lg rounded-4" name="email" placeholder="Nhập email" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Mật khẩu</label>
                        <input type="password" class="form-control form-control-lg rounded-4" name="password" placeholder="Nhập mật khẩu" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Vai trò</label>
                        <select class="form-select form-select-lg rounded-4" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Lưu người dùng
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
$tempFile = sys_get_temp_dir() . '/admin_users_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';