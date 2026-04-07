<?php
use App\Core\Session;

Session::start();
$title = 'Đăng ký - PlanbookAI';
include __DIR__ . '/../layouts/head.php';
?>

<section class="auth-modern-section auth-register-bg">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-xl-10 col-lg-11">
                <div class="auth-modern-card">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="auth-modern-left">
                                <span class="auth-chip">Create New Account</span>
                                <h1>Tạo tài khoản mới trên PlanbookAI</h1>
                                <p>
                                    Bắt đầu sử dụng hệ thống với vai trò Staff hoặc Teacher để quản lý học liệu, câu hỏi, bài tập và hoạt động giảng dạy một cách hiệu quả.
                                </p>

                                <div class="auth-modern-features">
                                    <div class="auth-feature-item">
                                        <i class="bi bi-person-workspace"></i>
                                        <span>Workspace riêng theo vai trò</span>
                                    </div>
                                    <div class="auth-feature-item">
                                        <i class="bi bi-folder-check"></i>
                                        <span>Quản lý nội dung khoa học</span>
                                    </div>
                                    <div class="auth-feature-item">
                                        <i class="bi bi-stars"></i>
                                        <span>UI hiện đại, dễ mở rộng module</span>
                                    </div>
                                </div>

                                <div class="auth-illustration-wrap">
                                    <img src="/LapTrinhWeb-PlanbookAI/public/images/auth-register.svg" alt="Register Illustration" class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="auth-modern-right">
                                <div class="auth-form-header">
                                    <a href="/LapTrinhWeb-PlanbookAI/public/" class="auth-brand">
                                        <i class="bi bi-mortarboard-fill me-2"></i>PlanbookAI
                                    </a>
                                    <h2>Đăng ký</h2>
                                    <p>Tạo tài khoản để bắt đầu sử dụng hệ thống.</p>
                                </div>

                                <?php if (Session::hasFlash('error')): ?>
                                    <div class="alert alert-danger rounded-4 border-0 shadow-sm">
                                        <?= Session::getFlash('error'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (Session::hasFlash('success')): ?>
                                    <div class="alert alert-success rounded-4 border-0 shadow-sm">
                                        <?= Session::getFlash('success'); ?>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/register" class="auth-form-modern">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Họ và tên</label>
                                        <div class="input-group input-modern">
                                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                            <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Email</label>
                                        <div class="input-group input-modern">
                                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                            <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Mật khẩu</label>
                                        <div class="input-group input-modern">
                                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Vai trò</label>
                                        <div class="input-group input-modern">
                                            <span class="input-group-text"><i class="bi bi-person-badge-fill"></i></span>
                                            <select class="form-select" name="role" required>
                                                <option value="teacher">Teacher</option>
                                                <option value="staff">Staff</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-auth-submit w-100">
                                        <i class="bi bi-person-plus-fill me-2"></i>Đăng ký tài khoản
                                    </button>
                                </form>

                                <div class="auth-divider"><span>hoặc</span></div>

                                <div class="auth-bottom-text">
                                    Đã có tài khoản?
                                    <a href="/LapTrinhWeb-PlanbookAI/public/login">Đăng nhập ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>