<?php
$title = 'PlanbookAI - Teaching Support Platform';
include __DIR__ . '/layouts/head.php';
?>

<style>
.nav-dropdown { position: relative; }
.nav-dropdown .dropdown-menu {
    position: absolute; top: 110%; left: 0;
    background: #fff; border: 1px solid #e2e8f0;
    border-radius: 14px; padding: 8px; min-width: 220px;
    box-shadow: 0 8px 24px rgba(15,23,42,.1);
    display: none; z-index: 200;
}
.nav-dropdown:hover .dropdown-menu { display: block; }
.dropdown-menu a {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 12px; border-radius: 8px; color: #0f172a; font-size: 14px;
}
.dropdown-menu a:hover { background: #f8fafc; }
.drop-icon {
    width: 34px; height: 34px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;
}
.hero-new {
    padding: 90px 0 70px;
    background: linear-gradient(160deg, #eff6ff 0%, #f0fdf4 50%, #fff 100%);
}
.hero-inner { display: flex; gap: 48px; align-items: center; }
.hero-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: #dbeafe; color: #1d4ed8;
    padding: 7px 16px; border-radius: 999px; font-size: 13px; font-weight: 700; margin-bottom: 20px;
}
.hero-title-new {
    font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 900;
    line-height: 1.15; margin-bottom: 20px;
}
.hero-title-new span { color: #2563eb; }
.hero-card-new {
    background: #fff; border: 1px solid #e2e8f0;
    border-radius: 22px; padding: 26px;
    box-shadow: 0 20px 48px rgba(15,23,42,.08);
}
.feature-item-new {
    display: flex; align-items: center; gap: 10px;
    padding: 11px 14px; border-radius: 10px;
    background: #f8fafc; font-size: 14px; font-weight: 500; margin-bottom: 10px;
}
.check-badge {
    width: 24px; height: 24px; border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; flex-shrink: 0; font-weight: 700;
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="/LapTrinhWeb-PlanbookAI/public/">
            <div style="width:36px;height:36px;background:#2563eb;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            PlanbookAI
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#homeNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="homeNav">
            <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-1">
                <li class="nav-item nav-dropdown">
                    <a class="nav-link fw-semibold" href="#">Tính năng <i class="bi bi-chevron-down" style="font-size:11px;"></i></a>
                    <div class="dropdown-menu">
                        <a href="#">
                            <div class="drop-icon" style="background:#dbeafe;">📝</div>
                            <div>
                                <div style="font-weight:700;font-size:14px;">Lesson Plan</div>
                                <div style="color:#64748b;font-size:12px;">Tạo & quản lý giáo án</div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="drop-icon" style="background:#dcfce7;">❓</div>
                            <div>
                                <div style="font-weight:700;font-size:14px;">Question Bank</div>
                                <div style="color:#64748b;font-size:12px;">Ngân hàng câu hỏi</div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="drop-icon" style="background:#fef3c7;">📋</div>
                            <div>
                                <div style="font-weight:700;font-size:14px;">Exam & Grading</div>
                                <div style="color:#64748b;font-size:12px;">Tạo đề & chấm điểm</div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="drop-icon" style="background:#ede9fe;">📊</div>
                            <div>
                                <div style="font-weight:700;font-size:14px;">Results</div>
                                <div style="color:#64748b;font-size:12px;">Thống kê kết quả</div>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#roles">Vai trò</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#workflow">Quy trình</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#about">Giới thiệu</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-outline-primary rounded-pill px-4">Đăng nhập</a>
                <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-primary rounded-pill px-4">Đăng ký</a>
            </div>
        </div>
    </div>
</nav>

<section class="hero-new">
    <div class="container">
        <div class="hero-inner">
            <div class="col-lg-6">
                <div class="hero-badge"><i class="bi bi-mortarboard-fill"></i> Educational Management Platform</div>
                <h1 class="hero-title-new">
                    Nền tảng hỗ trợ <span>giáo viên</span><br>dạy học thông minh hơn
                </h1>
                <p class="landing-text mt-3">
                    PlanbookAI giúp giáo viên tạo giáo án, quản lý câu hỏi, sinh bài tập và tổ chức kiểm tra — tất cả trong một nền tảng thống nhất.
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="bi bi-rocket-takeoff me-2"></i>Bắt đầu miễn phí
                    </a>
                    <a href="#features" class="btn btn-light border btn-lg rounded-pill px-4">
                        Xem tính năng <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="landing-stats mt-5">
                    <div class="stat-pill">
                        <strong>3</strong>
                        <span>Vai trò chính</span>
                    </div>
                    <div class="stat-pill">
                        <strong>5+</strong>
                        <span>Module</span>
                    </div>
                    <div class="stat-pill">
                        <strong>MVC</strong>
                        <span>Kiến trúc</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="hero-card-new">
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                        <div style="width:44px;height:44px;background:#eff6ff;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#2563eb;font-size:20px;">
                            <i class="bi bi-file-earmark-text-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:800;font-size:16px;">Exam Generation</div>
                            <div style="color:#64748b;font-size:13px;">Tạo đề kiểm tra nhanh chóng</div>
                        </div>
                    </div>
                    <div class="feature-item-new">
                        <div class="check-badge" style="background:#dbeafe;color:#1d4ed8;">✓</div>
                        Tạo đề trắc nghiệm tự động
                    </div>
                    <div class="feature-item-new">
                        <div class="check-badge" style="background:#dcfce7;color:#166534;">✓</div>
                        Chấm điểm tự động
                    </div>
                    <div class="feature-item-new">
                        <div class="check-badge" style="background:#fef3c7;color:#92400e;">✓</div>
                        Thống kê kết quả học sinh
                    </div>
                    <div class="feature-item-new">
                        <div class="check-badge" style="background:#ede9fe;color:#6d28d9;">✓</div>
                        Quản lý ngân hàng câu hỏi
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="section-gap bg-white">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">Core Features</span>
            <h2 class="section-title">Các tính năng chính của hệ thống</h2>
            <p class="section-desc">Thiết kế theo mô hình module độc lập, dễ mở rộng và phù hợp với phát triển nhóm.</p>
        </div>
        <div class="row g-4 mt-4">
            <div class="col-md-6 col-xl-3">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-primary-subtle text-primary"><i class="bi bi-shield-lock-fill"></i></div>
                    <h5>Authentication</h5>
                    <p>Đăng ký, đăng nhập, phân quyền và điều hướng dashboard theo tác nhân.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-success-subtle text-success"><i class="bi bi-journal-richtext"></i></div>
                    <h5>Lesson Plan</h5>
                    <p>Xây dựng giáo án, framework giảng dạy và quản lý nội dung học tập.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-warning-subtle text-warning"><i class="bi bi-collection-fill"></i></div>
                    <h5>Question Bank</h5>
                    <p>Tổ chức hệ thống câu hỏi theo chủ đề, độ khó và mục đích sử dụng.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-info-subtle text-info"><i class="bi bi-ui-checks-grid"></i></div>
                    <h5>Exam & Result</h5>
                    <p>Tạo đề kiểm tra, chấm điểm tự động và theo dõi kết quả học tập.</p>
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
                        <p>Quản trị hệ thống, tài khoản, quyền truy cập và theo dõi vận hành.</p>
                        <span class="role-tag role-tag-admin">System Control</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="role-card-home h-100">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Staff" class="role-card-image">
                    <div class="role-card-body">
                        <h4>Staff</h4>
                        <p>Hỗ trợ nội dung mẫu, chuẩn hóa tài nguyên và xây dựng kho câu hỏi.</p>
                        <span class="role-tag role-tag-staff">Content Support</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="role-card-home h-100">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Teacher" class="role-card-image">
                    <div class="role-card-body">
                        <h4>Teacher</h4>
                        <p>Người dùng chính, sử dụng giáo án, câu hỏi, bài tập và đề kiểm tra.</p>
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
                    <p>Tạo giáo án, câu hỏi, bài tập và đề kiểm tra từ các nguồn dữ liệu có sẵn.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="workflow-box h-100">
                    <div class="workflow-step">04</div>
                    <h5>Track & Expand</h5>
                    <p>Quản trị và mở rộng hệ thống theo nhu cầu phát triển tiếp theo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="section-gap section-soft-bg">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="section-badge">Về PlanbookAI</span>
                <h2 class="section-title mt-3">Xây dựng bởi sinh viên, dành cho giáo viên</h2>
                <p class="section-desc mt-3">PlanbookAI là dự án Capstone được phát triển bởi nhóm sinh viên, tập trung hỗ trợ giáo viên Hóa học THPT trong việc chuẩn hóa quy trình giảng dạy.</p>
                <div class="d-flex flex-column gap-3 mt-4">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:44px;height:44px;background:#dbeafe;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#1d4ed8;font-size:18px;flex-shrink:0;"><i class="bi bi-people-fill"></i></div>
                        <div><strong>Nhóm 5 thành viên</strong><br><span style="color:#64748b;font-size:14px;">Mỗi người phụ trách một module độc lập</span></div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:44px;height:44px;background:#dcfce7;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#166534;font-size:18px;flex-shrink:0;"><i class="bi bi-code-slash"></i></div>
                        <div><strong>PHP MVC thuần</strong><br><span style="color:#64748b;font-size:14px;">Không dùng framework, tự xây dựng từ đầu</span></div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:44px;height:44px;background:#fef3c7;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#92400e;font-size:18px;flex-shrink:0;"><i class="bi bi-github"></i></div>
                        <div><strong>Quản lý bằng Git</strong><br><span style="color:#64748b;font-size:14px;">Mỗi thành viên có nhánh riêng trên GitHub</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="landing-image-card">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/hero-education.svg" alt="PlanbookAI" class="img-fluid rounded-4">
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