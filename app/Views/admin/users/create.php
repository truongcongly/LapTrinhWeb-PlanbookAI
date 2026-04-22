<?php
use App\Core\Auth;

$title = 'Create User - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create User';
$pageDesc = 'Tao tai khoan moi trong he thong';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Them nguoi dung moi</h3>
        <p>Tao tai khoan Admin, Staff hoac Teacher voi thong tin day du va ro rang.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>User Information Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lai
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/store">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ho ten</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="name" placeholder="Nhap ho ten" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control form-control-lg rounded-4" name="email" placeholder="Nhap email" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Mat khau</label>
                        <input type="password" class="form-control form-control-lg rounded-4" name="password" placeholder="Nhap mat khau" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Vai tro</label>
                        <select class="form-select form-select-lg rounded-4" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Dich vu</label>
                        <select class="form-select form-select-lg rounded-4" name="service_plan" required>
                            <option value="free">Goi mien phi</option>
                            <option value="professional">Goi chuyen nghiep</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Luu nguoi dung
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
$tempFile = sys_get_temp_dir() . '/admin_users_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
