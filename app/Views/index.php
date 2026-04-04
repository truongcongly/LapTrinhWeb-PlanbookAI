<?php
$title = 'PlanbookAI - Teaching Support Platform';
include __DIR__ . '/layouts/head.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="/LapTrinhWeb-PlanbookAI/public/">
            <i class="bi bi-mortarboard-fill me-2"></i>PlanbookAI
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#homeNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="homeNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#roles">Roles</a></li>
                <li class="nav-item"><a class="nav-link" href="#workflow">Workflow</a></li>
                <li class="nav-item">
                    <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-outline-primary rounded-pill px-4">Login</a>
                </li>
                <li class="nav-item">
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-primary rounded-pill px-4">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="landing-hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="landing-tag">Educational Management Platform</span>
                <h1 class="landing-title mt-4">
                    Hệ thống hỗ trợ giáo viên xây dựng giáo án, quản lý câu hỏi và tổ chức đánh giá
                </h1>
                <p class="landing-text mt-4">
                    PlanbookAI là nền tảng quản lý học liệu và giảng dạy dành cho nhà trường, staff và giáo viên. Hệ thống giúp chuẩn hóa quy trình tạo giáo án, lưu trữ ngân hàng câu hỏi, sinh bài tập và hỗ trợ quản lý đề kiểm tra.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                    </a>
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-light border btn-lg rounded-pill px-4">
                        <i class="bi bi-person-plus me-2"></i>Đăng ký
                    </a>
                </div>

                <div class="landing-stats mt-5">
                    <div class="stat-pill">
                        <strong>3</strong>
                        <span>Vai trò chính</span>
                    </div>
                    <div class="stat-pill">
                        <strong>5</strong>
                        <span>Module nhóm</span>
                    </div>
                    <div class="stat-pill">
                        <strong>MVC</strong>
                        <span>Kiến trúc rõ ràng</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="landing-image-card">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/hero-education.svg" alt="PlanbookAI Hero" class="img-fluid rounded-4">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="section-gap bg-white">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">Core Features</span>
            <h2 class="section-title">Các nhóm chức năng chính của hệ thống</h2>
            <p class="section-desc">Thiết kế theo mô hình module độc lập, dễ mở rộng và phù hợp với phát triển nhóm.</p>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-6 col-xl-3">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-primary-subtle text-primary">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h5>Authentication</h5>
                    <p>Đăng ký, đăng nhập, phân quyền và điều hướng dashboard theo tác nhân.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-success-subtle text-success">
                        <i class="bi bi-journal-richtext"></i>
                    </div>
                    <h5>Lesson Plan</h5>
                    <p>Xây dựng giáo án, framework giảng dạy và quản lý nội dung học tập.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-warning-subtle text-warning">
                        <i class="bi bi-collection-fill"></i>
                    </div>
                    <h5>Question Bank</h5>
                    <p>Tổ chức hệ thống câu hỏi theo chủ đề, độ khó và mục đích sử dụng.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-info-subtle text-info">
                        <i class="bi bi-ui-checks-grid"></i>
                    </div>
                    <h5>Exam & Result</h5>
                    <p>Tạo đề kiểm tra, theo dõi kết quả và mở rộng sang chấm điểm thông minh.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="roles" class="section-gap section-soft-bg">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">Roles</span>
            <h2 class="section-title">Ba tác nhân chính trong hệ thống</h2>
            <p class="section-desc">Mỗi tác nhân có dashboard và nhóm chức năng phù hợp với nhiệm vụ.</p>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="role-card-home h-100">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/admin-panel.svg" alt="Admin" class="role-card-image">
                    <div class="role-card-body">
                        <h4>Admin</h4>
                        <p>Quản trị hệ thống, tài khoản, quyền truy cập, theo dõi vận hành và quản lý dữ liệu nền.</p>
                        <span class="role-tag role-tag-admin">System Control</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="role-card-home h-100">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Staff" class="role-card-image">
                    <div class="role-card-body">
                        <h4>Staff</h4>
                        <p>Hỗ trợ nội dung mẫu, chuẩn hóa tài nguyên, xây dựng kho lesson/question mẫu cho giáo viên.</p>
                        <span class="role-tag role-tag-staff">Content Support</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="role-card-home h-100">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Teacher" class="role-card-image">
                    <div class="role-card-body">
                        <h4>Teacher</h4>
                        <p>Người dùng chính của hệ thống, sử dụng giáo án, câu hỏi, bài tập và đề kiểm tra trong giảng dạy.</p>
                        <span class="role-tag role-tag-teacher">Main User</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="workflow" class="section-gap bg-white">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">Workflow</span>
            <h2 class="section-title">Luồng hoạt động tổng quát</h2>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-3">
                <div class="workflow-box h-100">
                    <div class="workflow-step">01</div>
                    <h5>Login</h5>
                    <p>Người dùng đăng nhập và được điều hướng đến dashboard đúng vai trò.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="workflow-box h-100">
                    <div class="workflow-step">02</div>
                    <h5>Manage Content</h5>
                    <p>Admin, Staff và Teacher thao tác trên module phù hợp với quyền hạn.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="workflow-box h-100">
                    <div class="workflow-step">03</div>
                    <h5>Create Resources</h5>
                    <p>Tạo giáo án, câu hỏi, bài tập và đề kiểm tra từ các nguồn dữ liệu được tổ chức sẵn.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="workflow-box h-100">
                    <div class="workflow-step">04</div>
                    <h5>Track & Expand</h5>
                    <p>Quản trị và mở rộng hệ thống theo nhu cầu phát triển tiếp theo của dự án.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-banner-section">
    <div class="container">
        <div class="cta-banner">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h2>Bắt đầu trải nghiệm PlanbookAI ngay hôm nay</h2>
                    <p class="mb-0">Đăng nhập để truy cập dashboard hoặc tạo tài khoản mới để khám phá nền tảng.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-light btn-lg rounded-pill px-4 me-2">Đăng nhập</a>
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-outline-light btn-lg rounded-pill px-4">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="home-footer">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <div>© 2026 PlanbookAI. Educational Management Platform.</div>
        <div class="text-secondary">Built with PHP MVC, Bootstrap, MySQL.</div>
    </div>
</footer>

<?php include __DIR__ . '/layouts/footer.php'; ?>