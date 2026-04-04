<?php

use App\Core\Auth;

$title = 'Teacher Dashboard';
$currentUser = Auth::user();
$pageTitle = 'Teacher Dashboard';
$pageDesc = 'Quản lý giáo án, câu hỏi, bài tập và đề kiểm tra';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Xin chào Teacher 👋</h3>
        <p>Quản lý giáo án, ngân hàng câu hỏi, bài tập và đề kiểm tra trong một không gian làm việc thống nhất.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Teacher Banner">
</div>

<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-primary"><i class="bi bi-journal-bookmark-fill"></i></div>
            <div>
                <div class="stat-label">Lesson Plans</div>
                <div class="stat-value">18</div>
                <div class="stat-note">Bản nháp & hoàn chỉnh</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-success"><i class="bi bi-collection-fill"></i></div>
            <div>
                <div class="stat-label">Question Bank</div>
                <div class="stat-value">235</div>
                <div class="stat-note">Câu hỏi đã lưu</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-warning"><i class="bi bi-ui-checks-grid"></i></div>
            <div>
                <div class="stat-label">Exercises</div>
                <div class="stat-value">42</div>
                <div class="stat-note">Bài tập đã tạo</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-info"><i class="bi bi-file-earmark-text-fill"></i></div>
            <div>
                <div class="stat-label">Exams</div>
                <div class="stat-value">11</div>
                <div class="stat-note">Đề kiểm tra</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-lg-8">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Main Functions</h5>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="small-panel">
                        <h6>Lesson Plan Management</h6>
                        <p>Tạo giáo án, áp dụng framework, chỉnh sửa nội dung giảng dạy theo bài học.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-panel">
                        <h6>Question Bank</h6>
                        <p>Thêm, sửa, phân loại và tái sử dụng câu hỏi theo môn học và độ khó.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-panel">
                        <h6>Exercise Creation</h6>
                        <p>Tạo bài tập nhanh từ ngân hàng câu hỏi hoặc nội dung có sẵn.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-panel">
                        <h6>Exam Generation & Results</h6>
                        <p>Tạo đề kiểm tra, chuẩn bị đáp án và theo dõi kết quả học tập.</p>
                    </div>
                </div>
            </div>

            <div class="chart-placeholder mt-4">
                <div class="chart-bars teacher-bars">
                    <span style="height: 45%"></span>
                    <span style="height: 65%"></span>
                    <span style="height: 78%"></span>
                    <span style="height: 58%"></span>
                    <span style="height: 88%"></span>
                    <span style="height: 72%"></span>
                </div>
                <p class="chart-caption">Mô phỏng mức độ sử dụng các module giảng dạy</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Quick Actions</h5>
            </div>
            <div class="quick-action-list">
                <a href="#" class="quick-action-item">
                    <i class="bi bi-plus-circle"></i> Tạo giáo án mới
                </a>
                <a href="#" class="quick-action-item">
                    <i class="bi bi-patch-plus"></i> Thêm câu hỏi
                </a>
                <a href="#" class="quick-action-item">
                    <i class="bi bi-ui-checks"></i> Tạo bài tập
                </a>
                <a href="#" class="quick-action-item">
                    <i class="bi bi-file-plus"></i> Tạo đề kiểm tra
                </a>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-card mt-4">
    <div class="card-header-custom">
        <h5>Recent Teaching Activities</h5>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Activity</th>
                    <th>Module</th>
                    <th>Status</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tạo giáo án mới cho chương 2</td>
                    <td>Lesson Plans</td>
                    <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                    <td>Today</td>
                </tr>
                <tr>
                    <td>Thêm 10 câu hỏi trắc nghiệm</td>
                    <td>Question Bank</td>
                    <td><span class="badge bg-info-subtle text-info">Saved</span></td>
                    <td>Today</td>
                </tr>
                <tr>
                    <td>Khởi tạo đề kiểm tra giữa kỳ</td>
                    <td>Exams</td>
                    <td><span class="badge bg-warning-subtle text-warning">Draft</span></td>
                    <td>Yesterday</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_dashboard_content.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../layouts/dashboard_layout.php';