<?php

use App\Core\Auth;

$title = 'Admin Dashboard - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Admin Dashboard';
$pageDesc = 'Quản trị hệ thống, người dùng, framework và báo cáo tổng quan';
$role = 'admin';

// Ensure stats have default values
$stats = $stats ?? [
    'users' => 0,
    'staff' => 0,
    'teachers' => 0,
    'reports' => 0,
];

ob_start();
?>

<link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/admin-dashboard.css">

<div class="admin-dashboard">
    <!-- Header Section -->
    <div class="dashboard-title-section d-flex justify-content-between align-items-start">
        <div>
            <h1>Admin Dashboard</h1>
            <p>Toàn cảnh tổng quát hệ thống PlanbookAI</p>
        </div>
        <a href="/LapTrinhWeb-PlanbookAI/public/admin/reports" class="btn btn-outline-primary">
            <i class="bi bi-download me-2"></i>Export Report
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="stat-cards-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Tổng Người Dùng</div>
                    <div class="stat-number"><?= number_format($stats['users'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +12% tháng này
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Nhân Viên Nội Bộ</div>
                    <div class="stat-number"><?= number_format($stats['staff'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +2 tháng này
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="bi bi-person-badge"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Giáo Viên</div>
                    <div class="stat-number"><?= number_format($stats['teachers'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +8% từ tháng trước
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Sức Khỏe Hệ Thống</div>
                    <div class="stat-number">98.5%</div>
                    <div class="stat-change positive">
                        <i class="bi bi-check-circle"></i> Tất cả hệ thống hoạt động
                    </div>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="bi bi-activity"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="dashboard-grid-2">
        <div class="card-section">
            <div class="card-header">
                <h5>Xu Hướng Tăng Trưởng Hệ Thống</h5>
            </div>
            <div class="chart-container">
                <canvas id="adminLineChart"></canvas>
            </div>
        </div>

        <div class="card-section">
            <div class="card-header">
                <h5>Phân Phối Người Dùng</h5>
            </div>
            <div class="chart-container chart-center">
                <canvas id="userDistributionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bar Chart Section -->
    <div class="dashboard-grid-2">
        <div class="card-section">
            <div class="card-header">
                <h5>Hoạt Động Theo Vai Trò</h5>
            </div>
            <div class="chart-container">
                <canvas id="roleActivityChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Users & Frameworks -->
    <div class="dashboard-grid-2">
        <!-- Recent Users -->
        <div class="card-section">
            <div class="card-header">
                <h5>Người Dùng Gần Đây</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="view-all-link">Xem Tất Cả</a>
            </div>
            <div>
                <div class="activity-item">
                    <img src="https://ui-avatars.com/api/?name=John+Smith&background=0d6efd&color=fff" class="rounded-circle" width="40" height="40" alt="User">
                    <div class="flex-1">
                        <h6>John Smith</h6>
                        <p>Giáo Viên - Đăng ký 2 giờ trước</p>
                        <div class="activity-time">Đăng nhập lần cuối: Vừa mới</div>
                    </div>
                    <span class="badge bg-success">Đang Hoạt Động</span>
                </div>

                <div class="activity-item">
                    <img src="https://ui-avatars.com/api/?name=Emily+Davis&background=198754&color=fff" class="rounded-circle" width="40" height="40" alt="User">
                    <div class="flex-1">
                        <h6>Emily Davis</h6>
                        <p>Nhân Viên - Đăng ký 1 ngày trước</p>
                        <div class="activity-time">Đăng nhập lần cuối: 2 giờ trước</div>
                    </div>
                    <span class="badge bg-success">Đang Hoạt Động</span>
                </div>

                <div class="activity-item">
                    <img src="https://ui-avatars.com/api/?name=Michael+Brown&background=dc3545&color=fff" class="rounded-circle" width="40" height="40" alt="User">
                    <div class="flex-1">
                        <h6>Michael Brown</h6>
                        <p>Giáo Viên - Đăng ký 3 ngày trước</p>
                        <div class="activity-time">Đăng nhập lần cuối: 1 tuần trước</div>
                    </div>
                    <span class="badge bg-secondary">Không Hoạt Động</span>
                </div>
            </div>
        </div>

        <!-- Curriculum Frameworks -->
        <div class="card-section">
            <div class="card-header">
                <h5>Khung Chương Trình</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks" class="view-all-link">Xem Tất Cả</a>
            </div>
            <div>
                <div class="activity-item">
                    <div class="activity-dot success"></div>
                    <div class="flex-1">
                        <h6>Chương Trình Khoa Học Máy Tính</h6>
                        <p>Tạo 2 tuần trước • 45 chủ đề</p>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 100%;"></div>
                        </div>
                    </div>
                    <span class="badge bg-success">Active</span>
                </div>

                <div class="activity-item">
                    <div class="activity-dot info"></div>
                    <div class="flex-1">
                        <h6>Khung Quản Lý Kinh Doanh</h6>
                        <p>Tạo 1 tháng trước • 38 chủ đề</p>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 85%;"></div>
                        </div>
                    </div>
                    <span class="badge bg-success">Active</span>
                </div>

                <div class="activity-item">
                    <div class="activity-dot warning"></div>
                    <div class="flex-1">
                        <h6>Chương Trình Kỹ Thuật</h6>
                        <p>Tạo 3 ngày trước • 52 chủ đề</p>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;"></div>
                        </div>
                    </div>
                    <span class="badge bg-warning">Draft</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h5 class="quick-actions-title">Hành Động Nhanh</h5>
        <div class="quick-actions-grid">
            <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/create" class="action-btn">
                <i class="bi bi-person-plus-fill"></i>
                Thêm Người Dùng
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks/create" class="action-btn">
                <i class="bi bi-journal-plus"></i>
                Tạo Chương Trình
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/admin/reports" class="action-btn">
                <i class="bi bi-file-earmark-pdf"></i>
                Tạo Báo Cáo
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card-section">
        <div class="card-header">
            <h5>Hoạt Động Gần Đây</h5>
        </div>
        <div>
            <div class="activity-item">
                <div class="activity-dot success"></div>
                <div class="activity-content">
                    <h6>Tài khoản giáo viên mới được kích hoạt</h6>
                    <p>John Smith đã đăng ký thành công và kích hoạt tài khoản giáo viên.</p>
                    <div class="activity-time">5 phút trước</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-dot info"></div>
                <div class="activity-content">
                    <h6>Khung Chương Trình được cập nhật</h6>
                    <p>Chương trình Khoa Học Máy Tính đã được cập nhật với các chủ đề và nội dung mới.</p>
                    <div class="activity-time">22 phút trước</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-dot warning"></div>
                <div class="activity-content" style="flex: 1;">
                    <h6>Báo Cáo Hệ Thống được tạo</h6>
                    <p>Báo cáo hiệu suất hệ thống hằng tháng đã được tạo và lưu thành công.</p>
                    <div class="activity-time">47 phút trước</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// System Growth Trend
const lineCtx = document.getElementById('adminLineChart');
if (lineCtx) {
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Th8 2024', 'Th9 2024', 'Th10 2024', 'Th11 2024', 'Th12 2024', 'Th1 2025'],
            datasets: [{
                label: 'Người Dùng',
                data: [380, 420, 450, 480, 390, 520],
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.08)',
                fill: true,
                tension: 0.35,
                borderWidth: 2.5,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: true } }
        }
    });
}

// User Distribution
const doughnutCtx = document.getElementById('userDistributionChart');
if (doughnutCtx) {
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Admin', 'Nhân Viên', 'Giáo Viên'],
            datasets: [{
                data: [2, 18, 62],
                backgroundColor: ['#ef4444', '#f59e0b', '#10b981'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%'
        }
    });
}

// Role Activity Bar Chart
const barCtx = document.getElementById('roleActivityChart');
if (barCtx) {
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4', 'Tuần 5'],
            datasets: [
                {
                    label: 'Admin',
                    data: [12, 19, 8, 15, 10],
                    backgroundColor: '#ef4444',
                    borderRadius: 6
                },
                {
                    label: 'Nhân Viên',
                    data: [35, 42, 38, 45, 40],
                    backgroundColor: '#f59e0b',
                    borderRadius: 6
                },
                {
                    label: 'Giáo Viên',
                    data: [68, 75, 72, 80, 78],
                    backgroundColor: '#10b981',
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: true } }
        }
    });
}
</script>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_dashboard_clean.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;
include __DIR__ . '/../layouts/dashboard_layout.php';
