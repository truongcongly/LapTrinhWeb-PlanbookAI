<?php
use App\Core\Session;

Session::start();
$title = 'Đăng nhập - PlanbookAI';
include __DIR__ . '/../layouts/head.php';
?>

<section class="auth-modern-section">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-xl-10 col-lg-11">
                <div class="auth-modern-card">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="auth-modern-left auth-left-planbook">
                                <div class="auth-left-overlay-icons">
                                    <span class="icon i1"><i class="bi bi-pencil"></i></span>
                                    <span class="icon i2"><i class="bi bi-book"></i></span>
                                    <span class="icon i3"><i class="bi bi-calculator"></i></span>
                                    <span class="icon i4"><i class="bi bi-music-note-beamed"></i></span>
                                    <span class="icon i5"><i class="bi bi-star"></i></span>
                                    <span class="icon i6"><i class="bi bi-triangle"></i></span>
                                </div>

                                <div class="auth-left-top">
                                    <h1>Welcome to PlanbookAI!</h1>
                                    <p>The leader in lesson planning</p>
                                </div>

                                <div class="auth-left-image-board">
                                    <img src="/LapTrinhWeb-PlanbookAI/public/images/auth-classroom.png" alt="Classroom Illustration" class="img-fluid">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="auth-modern-right">
                                <div class="auth-form-header">
                                    <a href="/LapTrinhWeb-PlanbookAI/public/" class="auth-brand">
                                        <i class="bi bi-mortarboard-fill me-2"></i>PlanbookAI
                                    </a>
                                    <h2>Đăng nhập</h2>
                                    <p>Nhập thông tin tài khoản để tiếp tục vào hệ thống.</p>
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

                                <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/login" class="auth-form-modern">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Email</label>
                                        <div class="input-group input-modern">
                                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                            <input type="email" class="form-control" name="email" placeholder="Nhập email của bạn" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Mật khẩu</label>
                                        <div class="input-group input-modern">
                                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label text-secondary" for="rememberMe">
                                                Ghi nhớ đăng nhập
                                            </label>
                                        </div>
                                        <span class="small text-secondary">Quên mật khẩu</span>
                                    </div>

                                    <button type="submit" class="btn btn-auth-submit w-100">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
                                    </button>
                                </form>

                                <div class="auth-divider"><span>hoặc</span></div>

                                <div class="auth-bottom-text">
                                    Chưa có tài khoản?
                                    <a href="/LapTrinhWeb-PlanbookAI/public/register">Đăng ký ngay</a>
                                </div>

                                <div class="auth-role-preview mt-4">
                                    <span class="preview-badge admin-badge">Admin</span>
                                    <span class="preview-badge staff-badge">Staff</span>
                                    <span class="preview-badge teacher-badge">Teacher</span>
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