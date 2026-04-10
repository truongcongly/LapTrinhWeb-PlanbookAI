<?php

use App\Core\Auth;

$title = 'Staff Dashboard';
$currentUser = Auth::user();
$pageTitle = 'Staff Dashboard';
$pageDesc = 'Hỗ trợ nội dung mẫu và tài nguyên học liệu';
$role = 'staff';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Xin chào Staff 👋</h3>
        <p>Quản lý lesson samples, question samples và hỗ trợ chuẩn hóa nội dung cho giáo viên.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Staff Banner">
</div>

<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-warning"><i class="bi bi-journal-richtext"></i></div>
            <div>
                <div class="stat-label">Lesson Samples</div>
                <div class="stat-value">24</div>
                <div class="stat-note">Kho giáo án mẫu</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-info"><i class="bi bi-patch-question-fill"></i></div>
            <div>
                <div class="stat-label">Question Samples</div>
                <div class="stat-value">156</div>
                <div class="stat-note">Dữ liệu câu hỏi mẫu</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-success"><i class="bi bi-check2-circle"></i></div>
            <div>
                <div class="stat-label">Approved Content</div>
                <div class="stat-value">87</div>
                <div class="stat-note">Đã duyệt nội dung</div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-primary"><i class="bi bi-folder2-open"></i></div>
            <div>
                <div class="stat-label">Shared Resources</div>
                <div class="stat-value">39</div>
                <div class="stat-note">Tài nguyên dùng chung</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-lg-7">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Content Modules</h5>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="small-panel">
                        <h6>Lesson Sample Management</h6>
                        <p>Tạo, chỉnh sửa và chuẩn hóa giáo án mẫu để giáo viên tái sử dụng nhanh.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-panel">
                        <h6>Question Sample Management</h6>
                        <p>Xây dựng kho câu hỏi mẫu theo chủ đề, độ khó và chuẩn đầu ra.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-panel">
                        <h6>Content Review</h6>
                        <p>Kiểm tra, rà soát và hỗ trợ kiểm soát chất lượng học liệu trước khi dùng.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-panel">
                        <h6>Shared Resources</h6>
                        <p>Tổng hợp tài nguyên dùng chung cho các module lesson, question và exam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Quick Actions</h5>
            </div>
            <div class="quick-action-list">
                <a href="#" class="quick-action-item">
                    <i class="bi bi-plus-square"></i> Tạo lesson sample
                </a>
                <a href="/LapTrinhWeb-PlanbookAI/public/staff/question-samples/create" class="quick-action-item">
                    <i class="bi bi-plus-circle"></i> Tạo question sample
                </a>
                <a href="#" class="quick-action-item">
                    <i class="bi bi-check2-square"></i> Kiểm duyệt nội dung
                </a>
                <a href="#" class="quick-action-item">
                    <i class="bi bi-folder"></i> Quản lý tài nguyên chung
                </a>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-card mt-4">
    <div class="card-header-custom">
        <h5>Recent Sample Activities</h5>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Last Update</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Hóa học 10 - Acids and Bases</td>
                    <td>Lesson Sample</td>
                    <td><span class="badge bg-success-subtle text-success">Ready</span></td>
                    <td>Today</td>
                </tr>
                <tr>
                    <td>Trắc nghiệm chương 1</td>
                    <td>Question Sample</td>
                    <td><span class="badge bg-warning-subtle text-warning">Draft</span></td>
                    <td>Yesterday</td>
                </tr>
                <tr>
                    <td>Tài nguyên thực hành lớp 9</td>
                    <td>Shared Resource</td>
                    <td><span class="badge bg-info-subtle text-info">Updated</span></td>
                    <td>2 days ago</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_dashboard_content.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../layouts/dashboard_layout.php';