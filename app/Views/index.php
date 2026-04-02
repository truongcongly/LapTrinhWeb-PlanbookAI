<?php
$title = 'PlanbookAI - Nền tảng hỗ trợ giáo viên';
include __DIR__ . '/layouts/head.php';
?>

<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand app-brand fw-bold text-primary" href="/LapTrinhWeb-PlanbookAI/public/">
            <i class="bi bi-mortarboard-fill me-2"></i>PlanbookAI
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHome">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarHome">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link" href="#features">Tính năng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#roles">Vai trò</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#workflow">Quy trình</a>
                </li>
                <li class="nav-item">
                    <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-outline-primary rounded-pill px-4">Đăng nhập</a>
                </li>
                <li class="nav-item">
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-primary rounded-pill px-4">Đăng ký</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="hero-badge">
                    <i class="bi bi-stars me-2"></i>PHP MVC School Platform
                </span>

                <h1 class="hero-title mt-4">
                    Xây dựng giáo án, quản lý câu hỏi và tổ chức đánh giá
                    <span class="text-primary">trong một nền tảng thống nhất</span>
                </h1>

                <p class="hero-text mt-4">
                    PlanbookAI hỗ trợ nhà trường và giáo viên quản lý tài khoản, nội dung mẫu, giáo án, ngân hàng câu hỏi và đề kiểm tra với giao diện hiện đại, dễ sử dụng và thuận tiện mở rộng.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-primary btn-lg rounded-pill px-4">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập ngay
                    </a>
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-light btn-lg rounded-pill px-4 border">
                        <i class="bi bi-person-plus me-2"></i>Tạo tài khoản
                    </a>
                </div>

                <div class="hero-stats mt-5">
                    <div class="hero-stat-box">
                        <h4>3</h4>
                        <p>Vai trò chính</p>
                    </div>
                    <div class="hero-stat-box">
                        <h4>5</h4>
                        <p>Module nhóm</p>
                    </div>
                    <div class="hero-stat-box">
                        <h4>MVC</h4>
                        <p>Kiến trúc rõ ràng</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-dashboard-card">
                    <div class="hero-dashboard-top">
                        <div class="dot bg-danger"></div>
                        <div class="dot bg-warning"></div>
                        <div class="dot bg-success"></div>
                    </div>

                    <div class="row g-3">
                        <div class="col-6">
                            <div class="mini-card soft-blue">
                                <div class="mini-icon bg-primary">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <h5>Users</h5>
                                <p>Admin / Staff / Teacher</p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mini-card soft-green">
                                <div class="mini-icon bg-success">
                                    <i class="bi bi-journal-bookmark-fill"></i>
                                </div>
                                <h5>Lesson Plans</h5>
                                <p>Quản lý giáo án</p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mini-card soft-yellow">
                                <div class="mini-icon bg-warning">
                                    <i class="bi bi-patch-question-fill"></i>
                                </div>
                                <h5>Question Bank</h5>
                                <p>Ngân hàng câu hỏi</p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mini-card soft-cyan">
                                <div class="mini-icon bg-info">
                                    <i class="bi bi-file-earmark-check-fill"></i>
                                </div>
                                <h5>Exams</h5>
                                <p>Tạo đề và đánh giá</p>
                            </div>
                        </div>
                    </div>

                    <div class="hero-panel mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 fw-bold">Tổng quan hệ thống</h6>
                            <span class="badge text-bg-primary">Online</span>
                        </div>

                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar bg-primary" style="width: 78%"></div>
                        </div>

                        <div class="d-flex justify-content-between small text-secondary">
                            <span>Core module ready</span>
                            <span>78%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="section-block bg-white">
    <div class="container">
        <div class="section-heading text-center">
            <span class="section-label">Tính năng chính</span>
            <h2 class="section-title">Hệ thống được xây dựng theo hướng quản lý học liệu và giảng dạy toàn diện</h2>
            <p class="section-text">
                Cấu trúc nền tảng rõ ràng giúp nhóm có thể phát triển song song theo module và mở rộng dễ dàng trong các giai đoạn tiếp theo.
            </p>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-6 col-xl-3">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-primary-subtle text-primary">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h5>Authentication</h5>
                    <p>Đăng nhập, đăng ký, phân quyền theo vai trò và dashboard riêng cho từng tác nhân.</p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-success-subtle text-success">
                        <i class="bi bi-journal-richtext"></i>
                    </div>
                    <h5>Lesson Plan</h5>
                    <p>Tạo, lưu và quản lý giáo án, framework và nội dung giảng dạy theo cấu trúc rõ ràng.</p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-warning-subtle text-warning">
                        <i class="bi bi-collection-fill"></i>
                    </div>
                    <h5>Question Bank</h5>
                    <p>Xây dựng ngân hàng câu hỏi theo môn học, chủ đề và độ khó để tái sử dụng thuận tiện.</p>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="feature-card h-100">
                    <div class="feature-icon bg-info-subtle text-info">
                        <i class="bi bi-ui-checks-grid"></i>
                    </div>
                    <h5>Exam & Result</h5>
                    <p>Tạo đề kiểm tra, lưu đáp án, chấm điểm và quản lý kết quả theo hướng mở rộng OCR.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="roles" class="section-block section-soft">
    <div class="container">
        <div class="section-heading text-center">
            <span class="section-label">Tác nhân hệ thống</span>
            <h2 class="section-title">Ba vai trò chính trong PlanbookAI</h2>
            <p class="section-text">
                Mỗi vai trò được thiết kế giao diện và quyền truy cập riêng, phù hợp với nhiệm vụ trong hệ thống.
            </p>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="role-card h-100">
                    <div class="role-top admin-top">
                        <i class="bi bi-person-gear"></i>
                    </div>
                    <div class="role-body">
                        <h4>Admin</h4>
                        <p>Quản trị người dùng, phân quyền, giám sát hệ thống và quản lý nền tảng vận hành.</p>
                        <span class="role-badge-home role-admin-home">System Control</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="role-card h-100">
                    <div class="role-top staff-top">
                        <i class="bi bi-person-workspace"></i>
                    </div>
                    <div class="role-body">
                        <h4>Staff</h4>
                        <p>Chuẩn hóa nội dung mẫu, xây dựng dữ liệu hỗ trợ và phối hợp với giáo viên trong hệ thống.</p>
                        <span class="role-badge-home role-staff-home">Content Support</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="role-card h-100">
                    <div class="role-top teacher-top">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="role-body">
                        <h4>Teacher</h4>
                        <p>Sử dụng chính hệ thống để xây dựng giáo án, quản lý câu hỏi, bài tập và đề kiểm tra.</p>
                        <span class="role-badge-home role-teacher-home">Main User</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="workflow" class="section-block bg-white">
    <div class="container">
        <div class="section-heading text-center">
            <span class="section-label">Quy trình hoạt động</span>
            <h2 class="section-title">Luồng làm việc điển hình của hệ thống</h2>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-number">01</div>
                    <h5>Đăng nhập hệ thống</h5>
                    <p>Người dùng xác thực tài khoản để truy cập dashboard theo vai trò.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-number">02</div>
                    <h5>Quản lý nội dung</h5>
                    <p>Staff hoặc Teacher tạo giáo án, câu hỏi hoặc nội dung mẫu theo chức năng được cấp.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-number">03</div>
                    <h5>Tạo bài tập / đề</h5>
                    <p>Teacher sử dụng dữ liệu sẵn có để tạo bài tập và đề kiểm tra nhanh chóng.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="step-card">
                    <div class="step-number">04</div>
                    <h5>Theo dõi và mở rộng</h5>
                    <p>Admin giám sát toàn hệ thống và mở rộng thêm module khi cần.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <h2 class="mb-3">Sẵn sàng bắt đầu với PlanbookAI?</h2>
                    <p class="mb-0 text-white-50">
                        Đăng nhập hoặc tạo tài khoản để trải nghiệm hệ thống quản lý học liệu và giảng dạy theo kiến trúc MVC hiện đại.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end">
                    <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-light btn-lg rounded-pill px-4 me-2">
                        Đăng nhập
                    </a>
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-outline-light btn-lg rounded-pill px-4">
                        Đăng ký
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="home-footer">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <div>© 2026 PlanbookAI. School Management & Teaching Support Platform.</div>
        <div class="text-secondary">Built with PHP, Bootstrap, MySQL and MVC structure.</div>
    </div>
</footer>

<?php include __DIR__ . '/layouts/footer.php'; ?>