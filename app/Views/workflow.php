<?php
$title = 'Quy trình - PlanbookAI';
include __DIR__ . '/layouts/head.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="/LapTrinhWeb-PlanbookAI/public/">
            <div style="width:36px;height:36px;background:#2563eb;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            PlanbookAI
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link fw-semibold" href="/LapTrinhWeb-PlanbookAI/public/">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/LapTrinhWeb-PlanbookAI/public/roles">Vai trò</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold active" href="/LapTrinhWeb-PlanbookAI/public/workflow">Quy trình</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/LapTrinhWeb-PlanbookAI/public/about">Giới thiệu</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-outline-primary rounded-pill px-4">Đăng nhập</a>
                <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-primary rounded-pill px-4">Đăng ký</a>
            </div>
        </div>
    </div>
</nav>

<section style="padding:70px 0;background:linear-gradient(160deg,#f0fdf4,#fff);">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Workflow</span>
            <h2 class="section-title mt-3">Luồng hoạt động tổng quát</h2>
            <p class="section-desc mx-auto">Quy trình sử dụng PlanbookAI từ đăng nhập đến quản lý kết quả học tập.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="workflow-box h-100">
                    <div class="workflow-step">01</div>
                    <h5>Đăng nhập</h5>
                    <p>Người dùng đăng nhập và được điều hướng đến dashboard đúng vai trò của mình.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="workflow-box h-100">
                    <div class="workflow-step">02</div>
                    <h5>Quản lý nội dung</h5>
                    <p>Admin, Staff và Teacher thao tác trên module phù hợp với quyền hạn được cấp.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="workflow-box h-100">
                    <div class="workflow-step">03</div>
                    <h5>Tạo tài nguyên</h5>
                    <p>Tạo giáo án, câu hỏi, bài tập và đề kiểm tra từ các nguồn dữ liệu có sẵn.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="workflow-box h-100">
                    <div class="workflow-step">04</div>
                    <h5>Theo dõi & Mở rộng</h5>
                    <p>Quản trị và mở rộng hệ thống theo nhu cầu phát triển tiếp theo của dự án.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-6">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-primary-subtle text-primary"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <h5>Tạo đề kiểm tra</h5>
                    <p>Giáo viên tạo đề trắc nghiệm → in ra cho học sinh làm → nhập đáp án vào hệ thống → chấm điểm tự động.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="feature-box h-100">
                    <div class="feature-icon bg-success-subtle text-success"><i class="bi bi-graph-up-arrow"></i></div>
                    <h5>Theo dõi kết quả</h5>
                    <p>Hệ thống lưu kết quả từng học sinh → giáo viên xem thống kê → điều chỉnh phương pháp giảng dạy.</p>
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