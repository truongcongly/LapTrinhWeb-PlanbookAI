<?php
use App\Core\Session;

Session::start();
$title = 'Đăng ký - PlanbookAI';
include __DIR__ . '/../layouts/head.php';
?>

<a href="/LapTrinhWeb-PlanbookAI/public/" class="btn btn-success auth-page-back-home-btn">
    <i class="bi bi-arrow-left"></i>
    <span>Quay lại trang chủ</span>
</a>

<section class="auth-modern-section auth-register-bg">
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
                                    <h2>Đăng ký</h2>
                                    <p>Tạo tài khoản mới để bắt đầu sử dụng hệ thống.</p>
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

                                    <input type="hidden" name="role" value="teacher">

                                    <button type="submit" class="btn btn-auth-submit w-100">
                                        <i class="bi bi-person-plus-fill me-2"></i>Đăng ký tài khoản
                                    </button>

                                    <div class="auth-social-list mt-4">
                                        <a href="#" class="auth-social-btn">
                                            <span class="auth-social-icon is-facebook">f</span>
                                            <span>Facebook</span>
                                        </a>
                                        <a href="#" class="auth-social-btn">
                                            <span class="auth-social-icon is-zalo">Z</span>
                                            <span>Zalo</span>
                                        </a>
                                        <a href="#" class="auth-social-btn">
                                            <span class="auth-social-icon is-google">G</span>
                                            <span>Google</span>
                                        </a>
                                        <a href="#" class="auth-social-btn">
                                            <span class="auth-social-icon is-telegram"><i class="bi bi-telegram"></i></span>
                                            <span>Telegram</span>
                                        </a>
                                        <a href="#" class="auth-social-btn">
                                            <span class="auth-social-icon is-twitter"><i class="bi bi-twitter-x"></i></span>
                                            <span>Twitter</span>
                                        </a>
                                        <a href="#" class="auth-social-btn">
                                            <span class="auth-social-icon is-gmail"><i class="bi bi-envelope-fill"></i></span>
                                            <span>Gmail</span>
                                        </a>
                                    </div>
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
