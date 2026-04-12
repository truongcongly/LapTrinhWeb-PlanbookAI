<?php
$title = 'Vai trò - PlanbookAI';
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
                <li class="nav-item"><a class="nav-link fw-semibold active" href="/LapTrinhWeb-PlanbookAI/public/roles">Vai trò</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/LapTrinhWeb-PlanbookAI/public/workflow">Quy trình</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/LapTrinhWeb-PlanbookAI/public/about">Giới thiệu</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn btn-outline-primary rounded-pill px-4">Đăng nhập</a>
                <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn btn-primary rounded-pill px-4">Đăng ký</a>
            </div>
        </div>
    </div>
</nav>

<section style="padding:70px 0;background:linear-gradient(160deg,#eff6ff,#fff);">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-badge">Roles</span>
            <h2 class="section-title mt-3">Ba tác nhân chính trong hệ thống</h2>
            <p class="section-desc mx-auto">Mỗi tác nhân có dashboard và nhóm chức năng phù hợp với nhiệm vụ của mình.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="role-card-home h-100">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/admin-panel.svg" alt="Admin" class="role-card-image">
                    <div class="role-card-body">
                        <h4>Admin</h4>
                        <p>Quản trị hệ thống, tài khoản, quyền truy cập và theo dõi vận hành toàn bộ nền tảng.</p>
                        <span class="role-tag role-tag-admin">System Control</span>
                        <ul class="mt-3" style="color:#64748b;font-size:14px;line-height:2;">
                            <li>Quản lý tài khoản người dùng</li>
                            <li>Cấu hình hệ thống</li>
                            <li>Theo dõi doanh thu</li>
                            <li>Quản lý framework giáo án</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="role-card-home h-100">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Staff" class="role-card-image">
                    <div class="role-card-body">
                        <h4>Staff</h4>
                        <p>Hỗ trợ nội dung mẫu, chuẩn hóa tài nguyên và xây dựng kho câu hỏi cho giáo viên.</p>
                        <span class="role-tag role-tag-staff">Content Support</span>
                        <ul class="mt-3" style="color:#64748b;font-size:14px;line-height:2;">
                            <li>Tạo giáo án mẫu</li>
                            <li>Xây dựng ngân hàng câu hỏi</li>
                            <li>Quản lý prompt AI</li>
                            <li>Duyệt nội dung</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="role-card-home h-100">
                    <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-workspace.svg" alt="Teacher" class="role-card-image">
                    <div class="role-card-body">
                        <h4>Teacher</h4>
                        <p>Người dùng chính, sử dụng giáo án, câu hỏi, bài tập và đề kiểm tra trong giảng dạy.</p>
                        <span class="role-tag role-tag-teacher">Main User</span>
                        <ul class="mt-3" style="color:#64748b;font-size:14px;line-height:2;">
                            <li>Tạo giáo án cá nhân</li>
                            <li>Tạo đề kiểm tra</li>
                            <li>Chấm điểm tự động</li>
                            <li>Xem kết quả học sinh</li>
                        </ul>
                    </div>
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