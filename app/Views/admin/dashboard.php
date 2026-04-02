<?php
use App\Core\Auth;

$title = 'Admin Dashboard';
$currentUser = Auth::user();
$pageTitle = 'Admin Dashboard';
$pageDesc = 'Quản trị tài khoản và giám sát hệ thống';

include __DIR__ . '/../layouts/head.php';
$role = 'admin';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-panel">
    <?php include __DIR__ . '/../layouts/topbar.php'; ?>

    <div class="page-body">
        <div class="row g-4">
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card bg-soft-primary">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Tổng người dùng</div>
                            <h3 class="mt-2 mb-1">03</h3>
                            <div class="small text-success">+2 trong tháng này</div>
                        </div>
                        <div class="icon-box icon-primary">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card stat-card bg-soft-success">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Teacher accounts</div>
                            <h3 class="mt-2 mb-1">01</h3>
                            <div class="small text-success">Đang hoạt động</div>
                        </div>
                        <div class="icon-box icon-success">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card stat-card bg-soft-warning">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Staff accounts</div>
                            <h3 class="mt-2 mb-1">01</h3>
                            <div class="small text-warning">Nội dung mẫu</div>
                        </div>
                        <div class="icon-box icon-warning">
                            <i class="bi bi-person-workspace"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card stat-card bg-soft-info">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">System status</div>
                            <h3 class="mt-2 mb-1">Online</h3>
                            <div class="small text-info">Kết nối DB ổn định</div>
                        </div>
                        <div class="icon-box icon-info">
                            <i class="bi bi-server"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-7">
                <div class="card panel-card">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Thao tác nhanh</h5>
                        <a class="quick-link" href="/LapTrinhWeb-PlanbookAI/public/admin/users">
                            <i class="bi bi-people"></i> Danh sách người dùng
                        </a>
                        <a class="quick-link" href="/LapTrinhWeb-PlanbookAI/public/admin/users/create">
                            <i class="bi bi-person-plus"></i> Thêm người dùng
                        </a>
                        <a class="quick-link" href="#">
                            <i class="bi bi-shield-check"></i> Phân quyền hệ thống
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card panel-card">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Vai trò hiện tại</h5>
                        <span class="role-badge role-admin">Admin</span>
                        <p class="text-secondary mt-3 mb-0">
                            Bạn có quyền quản lý tài khoản, kiểm soát điều hướng và cấu hình hệ thống nền.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>