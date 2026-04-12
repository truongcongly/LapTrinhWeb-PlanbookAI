<?php
$title = 'Giới thiệu - PlanbookAI';
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
                <li class="nav-item"><a class="nav-link fw-semibold" href="/LapTrinhWeb-PlanbookAI/public/workflow">Quy trình</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold active" href="/LapTrinhWeb-PlanbookAI/public/about">Giới thiệu</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-outline-primary rounded-pill px-4">Đăng nhập</a>
                <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-primary rounded-pill px-4">Đăng ký</a>
            </div>
        </div>
    </div>
</nav>

<section style="padding:70px 0;background:linear-gradient(160deg,#fef3c7,#fff);">
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
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:44px;height:44px;background:#ede9fe;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#6d28d9;font-size:18px;flex-shrink:0;"><i class="bi bi-mortarboard-fill"></i></div>
                        <div><strong>Dành cho giáo viên Hóa học</strong><br><span style="color:#64748b;font-size:14px;">Tập trung hỗ trợ giáo viên THPT</span></div>
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

<footer class="home-footer">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <div>© 2026 PlanbookAI. Educational Management Platform.</div>
        <div class="text-secondary">Built with PHP MVC, Bootstrap, MySQL.</div>
    </div>
</footer>

<?php include __DIR__ . '/layouts/footer.php'; ?>