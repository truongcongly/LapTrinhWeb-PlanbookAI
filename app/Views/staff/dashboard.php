<?php

use App\Core\Auth;

$title = 'Staff Dashboard - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Staff Dashboard';
$pageDesc = 'Quản lý lesson samples, question samples và prompt templates';
$role = 'staff';

// Ensure stats have default values
$stats = $stats ?? [
    'lesson_samples' => 0,
    'question_samples' => 0,
    'prompt_templates' => 0,
    'approved_content' => 0,
];

ob_start();
?>

<link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/staff-dashboard.css">

<div class="staff-dashboard">
    <!-- Header Section -->
    <div class="dashboard-title-section d-flex justify-content-between align-items-start">
        <div>
            <h1>Bảng Điều Khiển Nhân Viên</h1>
            <p>Trung tâm quản lý nội dung mẫu và học liệu</p>
        </div>
        <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Tạo Nội Dung
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="stat-cards-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Mẫu Bài Học</div>
                    <div class="stat-number"><?= number_format($stats['lesson_samples'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +5 tháng này
                    </div>
                </div>
                <div class="stat-icon stat-icon-blue">
                    <i class="bi bi-journal-text"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Mẫu Câu Hỏi</div>
                    <div class="stat-number"><?= number_format($stats['question_samples'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +12 được thêm
                    </div>
                </div>
                <div class="stat-icon stat-icon-cyan">
                    <i class="bi bi-patch-question"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Mẫu Lời Nhắc</div>
                    <div class="stat-number"><?= number_format($stats['prompt_templates'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +3 được cập nhật
                    </div>
                </div>
                <div class="stat-icon stat-icon-purple">
                    <i class="bi bi-stars"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Nội Dung Được Duyệt</div>
                    <div class="stat-number"><?= number_format($stats['approved_content'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-check-circle"></i> Sẵn sàng sử dụng
                    </div>
                </div>
                <div class="stat-icon stat-icon-green">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="dashboard-grid-2">
        <div class="card-section">
            <div class="card-header">
                <h5>Xu Hướng Sản Xuất Nội Dung</h5>
            </div>
            <div class="chart-container">
                <canvas id="staffLineChart"></canvas>
            </div>
        </div>

        <div class="card-section">
            <div class="card-header">
                <h5>Phân Phối Loại Nội Dung</h5>
            </div>
            <div class="chart-container chart-center">
                <canvas id="staffDoughnutChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bar Chart Section -->
    <div class="dashboard-grid-2">
        <div class="card-section">
            <div class="card-header">
                <h5>Trạng Thái Nội Dung</h5>
            </div>
            <div class="chart-container">
                <canvas id="staffBarChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Items & Templates -->
    <div class="dashboard-grid-2">
        <!-- Recent Lesson Samples -->
        <div class="card-section">
            <div class="card-header">
                <h5>Mẫu Bài Học Gần Đây</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples" class="view-all-link">Xem Tất Cả</a>
            </div>
            <div style="max-height: 400px;">
                <div class="activity-item">
                    <div class="activity-dot success"></div>
                    <div style="flex: 1;">
                        <h6>Khái Niệm Lập Trình Nâng Cao</h6>
                        <p>Khoa Học Máy Tính • Tạo 2 ngày trước</p>
                        <div class="activity-time">Cập nhật: 2 giờ trước</div>
                    </div>
                    <span class="badge bg-success">Được Duyệt</span>
                </div>

                <div class="activity-item">
                    <div class="activity-dot info"></div>
                    <div style="flex: 1;">
                        <h6>Cơ Bản Phát Triển Web</h6>
                        <p>Công Nghệ Web • Tạo 5 ngày trước</p>
                        <div class="activity-time">Cập nhật: 1 ngày trước</div>
                    </div>
                    <span class="badge bg-info">Đang Xem Xét</span>
                </div>

                <div class="activity-item">
                    <div class="activity-dot warning"></div>
                    <div style="flex: 1;">
                        <h6>Kiến Thức Cơ Bản Cơ Sở Dữ Liệu</h6>
                        <p>Cơ Sở Dữ Liệu • Tạo 1 tuần trước</p>
                        <div class="activity-time">Cập nhật: 3 ngày trước</div>
                    </div>
                    <span class="badge bg-warning">Nháp</span>
                </div>
            </div>
        </div>

        <!-- Prompt Templates -->
        <div class="card-section">
            <div class="card-header">
                <h5>Mẫu Lời Nhắc Đang Hoạt Động</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts" class="view-all-link">Xem Tất Cả</a>
            </div>
            <div style="max-height: 400px;">
                <div class="activity-item">
                    <img src="https://ui-avatars.com/api/?name=Generate+Lesson&background=3b82f6&color=fff" class="rounded-circle" width="40" height="40" alt="Template">
                    <div style="flex: 1;">
                        <h6>Tạo Kế Hoạch Bài Học</h6>
                        <p>Để tạo cấu trúc bài học & nội dung</p>
                        <div class="activity-time">Được sử dụng: 142 lần • Lần cuối: 2 giờ trước</div>
                    </div>
                    <span class="badge bg-success">Đang Hoạt Động</span>
                </div>

                <div class="activity-item">
                    <img src="https://ui-avatars.com/api/?name=Create+Questions&background=06b6d4&color=fff" class="rounded-circle" width="40" height="40" alt="Template">
                    <div style="flex: 1;">
                        <h6>Tạo Ngân Hàng Câu Hỏi</h6>
                        <p>Để tạo các bộ câu hỏi đa dạng</p>
                        <div class="activity-time">Được sử dụng: 98 lần • Lần cuối: 4 giờ trước</div>
                    </div>
                    <span class="badge bg-success">Đang Hoạt Động</span>
                </div>

                <div class="activity-item">
                    <img src="https://ui-avatars.com/api/?name=Exercise+Gen&background=8b5cf6&color=fff" class="rounded-circle" width="40" height="40" alt="Template">
                    <div style="flex: 1;">
                        <h6>Trình Tạo Bài Tập</h6>
                        <p>Để tạo bài tập luyện tập</p>
                        <div class="activity-time">Được sử dụng: 76 lần • Lần cuối: 1 ngày trước</div>
                    </div>
                    <span class="badge bg-success">Đang Hoạt Động</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h5 class="quick-actions-title">Hành Động Nhanh</h5>
        <div class="quick-actions-grid">
            <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/create" class="action-btn">
                <i class="bi bi-plus-circle"></i>
                Bài Học Mới
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/staff/question-samples/create" class="action-btn">
                <i class="bi bi-patch-question"></i>
                Câu Hỏi Mới
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/create" class="action-btn">
                <i class="bi bi-stars"></i>
                Mẫu Mới
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples" class="action-btn">
                <i class="bi bi-list-check"></i>
                Xem Xét Nội Dung
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
                <div class="activity-content" style="flex: 1;">
                    <h6>Mẫu bài học được duyệt</h6>
                    <p>"Khái Niệm Lập Trình Nâng Cao" đã được duyệt và thêm vào thư viện cho giáo viên.</p>
                    <div class="activity-time">1 giờ trước</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-dot info"></div>
                <div class="activity-content" style="flex: 1;">
                    <h6>Các mẫu câu hỏi mới được tạo</h6>
                    <p>12 mẫu câu hỏi mới cho "Khái Niệm OOP" đã được thêm vào và đang chờ xem xét.</p>
                    <div class="activity-time">3 giờ trước</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-dot warning"></div>
                <div class="activity-content" style="flex: 1;">
                    <h6>Mẫu lời nhắc được cập nhật</h6>
                    <p>Mẫu "Tạo Kế Hoạch Bài Học" đã được tối ưu hóa để có chất lượng đầu ra tốt hơn.</p>
                    <div class="activity-time">5 giờ trước</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Content Production Trend
const lineCtx = document.getElementById('staffLineChart');
if (lineCtx) {
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6'],
            datasets: [
                {
                    label: 'Mẫu Bài Học',
                    data: [12, 15, 18, 20, 23, 24],
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37,99,235,0.08)',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 2.5,
                    pointRadius: 4
                },
                {
                    label: 'Mẫu Câu Hỏi',
                    data: [20, 28, 34, 39, 46, 56],
                    borderColor: '#16a34a',
                    backgroundColor: 'rgba(22,163,74,0.06)',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 2.5,
                    pointRadius: 4
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

// Content Mix Distribution
const doughnutCtx = document.getElementById('staffDoughnutChart');
if (doughnutCtx) {
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Bài Học', 'Câu Hỏi', 'Lời Nhắc', 'Khác'],
            datasets: [{
                data: [24, 56, 18, 8],
                backgroundColor: ['#3b82f6', '#f59e0b', '#8b5cf6', '#ef4444'],
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

// Content Status Bar Chart
const barCtx = document.getElementById('staffBarChart');
if (barCtx) {
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Bài Học', 'Câu Hỏi', 'Lời Nhắc', 'Khác'],
            datasets: [
                {
                    label: 'Được Duyệt',
                    data: [24, 36, 12, 5],
                    backgroundColor: '#10b981',
                    borderRadius: 6
                },
                {
                    label: 'Nháp',
                    data: [8, 14, 4, 2],
                    backgroundColor: '#f59e0b',
                    borderRadius: 6
                },
                {
                    label: 'Đang Xem Xét',
                    data: [5, 6, 2, 1],
                    backgroundColor: '#ef4444',
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
$tempFile = sys_get_temp_dir() . '/staff_dashboard_clean.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;
include __DIR__ . '/../layouts/dashboard_layout.php';