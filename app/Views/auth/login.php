<?php
use App\Core\Session;

Session::start();
$title = 'Đăng nhập - PlanbookAI';
include __DIR__ . '/../layouts/head.php';
?>

<div class="container-fluid auth-wrapper d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <div class="card auth-card">
                <div class="row g-0">
                    <div class="col-lg-5">
                        <div class="auth-left d-flex flex-column justify-content-center h-100">
                            <div class="app-brand fs-2 text-white">PlanbookAI</div>
                            <h1 class="mt-3">Đăng nhập hệ thống</h1>
                            <p>
                                Quản lý người dùng, nội dung mẫu, giáo án và hoạt động đánh giá trong một giao diện thống nhất.
                            </p>
                            <div class="mt-4">
                                <span class="badge text-bg-light text-primary">Admin</span>
                                <span class="badge text-bg-light text-warning">Staff</span>
                                <span class="badge text-bg-light text-success">Teacher</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="auth-right">
                            <h3 class="fw-bold mb-2">Welcome back</h3>
                            <p class="text-secondary mb-4">Nhập thông tin để truy cập hệ thống.</p>

                            <?php if (Session::has('error')): ?>
                                <div class="alert alert-danger rounded-4">
                                    <?= Session::get('error'); Session::remove('error'); ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/login">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                                </div>

                                <button type="submit" class="btn btn-brand w-100">Đăng nhập</button>
                            </form>

                            <div class="mt-4 text-secondary">
                                Chưa có tài khoản?
                                <a href="/LapTrinhWeb-PlanbookAI/public/register" class="fw-semibold">Đăng ký ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>