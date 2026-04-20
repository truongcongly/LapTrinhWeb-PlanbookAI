<?php

use App\Core\Auth;

$title = 'Teacher Dashboard - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Teacher Dashboard';
$pageDesc = 'Quản lý lesson plans, questions, exercises, exams, grading và results';
$role = 'teacher';

// Ensure stats have default values
$stats = $stats ?? [
    'lesson_plans' => 0,
    'questions' => 0,
    'exercises' => 0,
    'exams' => 0,
];

ob_start();
?>

<link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/teacher-dashboard.css">

<div class="teacher-dashboard">
    <!-- Header Section -->
    <div class="dashboard-title-section d-flex justify-content-between align-items-start">
        <div>
            <h1>Bảng Điều Khiển Giáo Viên</h1>
            <p>Không gian làm việc thông minh cho giáo viên</p>
        </div>
        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Kế Hoạch Bài Học Mới
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="stat-cards-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Kế Hoạch Bài Học</div>
                    <div class="stat-number"><?= number_format($stats['lesson_plans'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +3 tháng này
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
                    <div class="stat-label">Ngân Hàng Câu Hỏi</div>
                    <div class="stat-number"><?= number_format($stats['questions'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +15 được thêm
                    </div>
                </div>
                <div class="stat-icon stat-icon-cyan">
                    <i class="bi bi-question-circle"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Bài Tập</div>
                    <div class="stat-number"><?= number_format($stats['exercises'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +8 tháng này
                    </div>
                </div>
                <div class="stat-icon stat-icon-green">
                    <i class="bi bi-clipboard-check"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Kỳ Thi</div>
                    <div class="stat-number"><?= number_format($stats['exams'] ?? 0); ?></div>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i> +2 đang hoạt động
                    </div>
                </div>
                <div class="stat-icon stat-icon-orange">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="dashboard-grid-2">
        <div class="card-section">
            <div class="card-header">
                <h5>Xu Hướng Hoạt Động Giáo Dục</h5>
            </div>
            <div class="chart-container">
                <canvas id="teacherLineChart"></canvas>
            </div>
        </div>

        <div class="card-section">
            <div class="card-header">
                <h5>Phân Phối Tài Nguyên Học Tập</h5>
            </div>
            <div class="chart-container chart-center">
                <canvas id="teacherDoughnutChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bar Chart Section -->
    <div class="dashboard-grid-2">
        <div class="card-section">
            <div class="card-header">
                <h5>Hiệu Suất Theo Môn Học</h5>
            </div>
            <div class="chart-container">
                <canvas id="teacherBarChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Materials & Student Performance -->
    <div class="dashboard-grid-2">
        <!-- Recent Lesson Plans -->
        <div class="card-section">
            <div class="card-header">
                <h5>Kế Hoạch Bài Học Gần Đây</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans" class="view-all-link">Xem Tất Cả</a>
            </div>
            <div style="max-height: 400px;">
                <div class="activity-item">
                    <div class="activity-dot success"></div>
                    <div style="flex: 1;">
                        <h6>Giới Thiệu Lập Trình</h6>
                        <p>C/Java Chương 1 • Tạo 2 ngày trước</p>
                        <div class="activity-time">Cập nhật: 2 giờ trước</div>
                    </div>
                    <span class="badge bg-success">Đã Xuất Bản</span>
                </div>

                <div class="activity-item">
                    <div class="activity-dot info"></div>
                    <div style="flex: 1;">
                        <h6>Khái Niệm OOP Nâng Cao</h6>
                        <p>Lập Trình Nâng Cao • Tạo 5 ngày trước</p>
                        <div class="activity-time">Cập nhật: 1 ngày trước</div>
                    </div>
                    <span class="badge bg-info">Nháp</span>
                </div>

                <div class="activity-item">
                    <div class="activity-dot warning"></div>
                    <div style="flex: 1;">
                        <h6>Cơ Bản Thiết Kế Cơ Sở Dữ Liệu</h6>
                        <p>Cơ Sở Dữ Liệu • Tạo 1 tuần trước</p>
                        <div class="activity-time">Cập nhật: 3 ngày trước</div>
                    </div>
                    <span class="badge bg-warning">Xem Xét</span>
                </div>
            </div>
        </div>

        <!-- Recent Exams -->
        <div class="card-section">
            <div class="card-header">
                <h5>Kỳ Thi & Bài Tập Gần Đây</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="view-all-link">Xem Tất Cả</a>
            </div>
            <div style="max-height: 400px;">
                <div class="activity-item">
                    <img src="https://ui-avatars.com/api/?name=Midterm+Exam&background=f59e0b&color=fff" class="rounded-circle" width="40" height="40" alt="Exam">
                    <div style="flex: 1;">
                        <h6>Kỳ Thi Giữa Kỳ - Lập Trình</h6>
                        <p>30 câu hỏi • Xuất bản 1 tuần trước</p>
                        <div class="activity-time">Điểm Trung Bình: 7.8/10</div>
                    </div>
                    <span class="badge bg-success">Đang Hoạt Động</span>
                </div>

                <div class="activity-item">
                    <img src="https://ui-avatars.com/api/?name=Quiz+001&background=3b82f6&color=fff" class="rounded-circle" width="40" height="40" alt="Exercise">
                    <div style="flex: 1;">
                        <h6>Bài Kiểm Tra Hàng Tuần #4</h6>
                        <p>10 câu hỏi • Xuất bản 2 ngày trước</p>
                        <div class="activity-time">Điểm Trung Bình: 8.2/10</div>
                    </div>
                    <span class="badge bg-success">Đang Hoạt Động</span>
                </div>

                <div class="activity-item">
                    <img src="https://ui-avatars.com/api/?name=Exercise&background=06b6d4&color=fff" class="rounded-circle" width="40" height="40" alt="Exercise">
                    <div style="flex: 1;">
                        <h6>Bộ Bài Tập - Lập Trình Hướng Đối Tượng</h6>
                        <p>25 câu hỏi • Xuất bản 3 ngày trước</p>
                        <div class="activity-time">Hoàn Thành: 92%</div>
                    </div>
                    <span class="badge bg-info">Đang Chấm Điểm</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h5 class="quick-actions-title">Hành Động Nhanh</h5>
        <div class="quick-actions-grid">
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/create" class="action-btn">
                <i class="bi bi-plus-circle"></i>
                Bài Học Mới
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/questions/create" class="action-btn">
                <i class="bi bi-question-circle"></i>
                Câu Hỏi Mới
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/create" class="action-btn">
                <i class="bi bi-file-earmark-plus"></i>
                Kỳ Thi Mới
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading" class="action-btn">
                <i class="bi bi-clipboard-data"></i>
                Chấm Điểm
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
                    <h6>Kế hoạch bài học được xuất bản</h6>
                    <p>"Giới Thiệu Lập Trình" đã được xuất bản và hiện đã có sẵn cho học sinh.</p>
                    <div class="activity-time">2 giờ trước</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-dot info"></div>
                <div class="activity-content" style="flex: 1;">
                    <h6>Học sinh nộp bài thi</h6>
                    <p>15 học sinh đã nộp "Kỳ Thi Giữa Kỳ - Lập Trình". Sẵn sàng để chấm điểm.</p>
                    <div class="activity-time">4 giờ trước</div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-dot warning"></div>
                <div class="activity-content" style="flex: 1;">
                    <h6>Câu hỏi được thêm vào ngân hàng</h6>
                    <p>5 câu hỏi mới đã được thêm vào ngân hàng câu hỏi của bạn bằng cách tạo AI.</p>
                    <div class="activity-time">6 giờ trước</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Teaching Activity Trend
const lineCtx = document.getElementById('teacherLineChart');
if (lineCtx) {
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4', 'Tuần 5'],
            datasets: [
                {
                    label: 'Kế Hoạch Bài Học',
                    data: [2, 4, 5, 7, 10],
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37,99,235,0.08)',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 2.5,
                    pointRadius: 4
                },
                {
                    label: 'Bài Tập',
                    data: [3, 5, 6, 8, 10],
                    borderColor: '#16a34a',
                    backgroundColor: 'rgba(22,163,74,0.05)',
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

// Learning Assets Distribution
const doughnutCtx = document.getElementById('teacherDoughnutChart');
if (doughnutCtx) {
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Bài Học', 'Câu Hỏi', 'Bài Tập', 'Kỳ Thi'],
            datasets: [{
                data: [18, 95, 36, 14],
                backgroundColor: ['#3b82f6', '#f59e0b', '#10b981', '#ef4444'],
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

// Teacher Performance Bar Chart
const barCtx = document.getElementById('teacherBarChart');
if (barCtx) {
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Toán', 'Hóa', 'Lý', 'Tiếng Anh', 'Lịch Sử', 'Sinh'],
            datasets: [
                {
                    label: 'Dễ',
                    data: [14, 10, 9, 12, 8, 11],
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                },
                {
                    label: 'Vừa Phải',
                    data: [18, 12, 10, 14, 9, 13],
                    backgroundColor: '#f59e0b',
                    borderRadius: 6
                },
                {
                    label: 'Khó',
                    data: [5, 8, 7, 4, 6, 5],
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
$tempFile = sys_get_temp_dir() . '/teacher_dashboard_clean.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;
include __DIR__ . '/../layouts/dashboard_layout.php';
