<?php

use App\Core\Auth;

$title = 'Admin Dashboard';
$currentUser = Auth::user();
$pageTitle = 'Admin Dashboard';
$pageDesc = 'Quản trị hệ thống và điều phối người dùng';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Xin chào Admin 👋</h3>
        <p>Quản lý tài khoản, quyền truy cập và tổng quan hoạt động toàn hệ thống.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/admin-panel.svg" alt="Admin Banner">
</div>

<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-primary"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value">128</div>
                <div class="stat-note">Mock data preview</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-success"><i class="bi bi-person-check-fill"></i></div>
            <div>
                <div class="stat-label">Active Accounts</div>
                <div class="stat-value">114</div>
                <div class="stat-note">Đang hoạt động</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-warning"><i class="bi bi-mortarboard-fill"></i></div>
            <div>
                <div class="stat-label">Teachers</div>
                <div class="stat-value">62</div>
                <div class="stat-note">Giáo viên hệ thống</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-info"><i class="bi bi-person-workspace"></i></div>
            <div>
                <div class="stat-label">Staff</div>
                <div class="stat-value">18</div>
                <div class="stat-note">Nội dung hỗ trợ</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-lg-8">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>System Overview</h5>
                <span class="pill-status online">Online</span>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="small-panel">
                        <h6>User Management</h6>
                        <p>Tạo, cập nhật và quản lý tài khoản người dùng trong hệ thống.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-panel">
                        <h6>Role Control</h6>
                        <p>Phân quyền theo ba tác nhân: Admin, Staff và Teacher.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-panel">
                        <h6>System Settings</h6>
                        <p>Quản lý cấu hình, navigation và các module lõi.</p>
                    </div>
                </div>
            </div>

            <div class="chart-placeholder mt-4">
                <div class="chart-bars">
                    <span style="height: 50%"></span>
                    <span style="height: 80%"></span>
                    <span style="height: 65%"></span>
                    <span style="height: 90%"></span>
                    <span style="height: 70%"></span>
                    <span style="height: 95%"></span>
                </div>
                <p class="chart-caption">Biểu đồ mô phỏng tăng trưởng hoạt động hệ thống</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Quick Actions</h5>
            </div>
            <div class="quick-action-list">
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="quick-action-item">
                    <i class="bi bi-people"></i> Xem danh sách người dùng
                </a>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/create" class="quick-action-item">
                    <i class="bi bi-person-plus"></i> Thêm người dùng mới
                </a>
                <a href="#" class="quick-action-item">
                    <i class="bi bi-shield-lock"></i> Quản lý quyền truy cập
                </a>
                <a href="#" class="quick-action-item">
                    <i class="bi bi-gear"></i> Cấu hình hệ thống
                </a>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-card mt-4">
    <div class="card-header-custom">
        <h5>Recent Activities</h5>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Activity</th>
                    <th>Actor</th>
                    <th>Module</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tạo tài khoản Teacher mới</td>
                    <td>Admin</td>
                    <td>User Management</td>
                    <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                </tr>
                <tr>
                    <td>Cập nhật quyền Staff</td>
                    <td>Admin</td>
                    <td>Permissions</td>
                    <td><span class="badge bg-warning-subtle text-warning">Pending</span></td>
                </tr>
                <tr>
                    <td>Kiểm tra dashboard hệ thống</td>
                    <td>Admin</td>
                    <td>Monitoring</td>
                    <td><span class="badge bg-info-subtle text-info">Reviewing</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_dashboard_content.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../layouts/dashboard_layout.php';