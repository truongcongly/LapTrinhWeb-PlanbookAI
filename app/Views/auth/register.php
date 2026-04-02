<?php
use App\Core\Session;

Session::start();
$title = 'Đăng ký - PlanbookAI';
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
                            <h1 class="mt-3">Tạo tài khoản mới</h1>
                            <p>
                                Bắt đầu sử dụng hệ thống với vai trò Staff hoặc Teacher để quản lý nội dung học tập hiệu quả hơn.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="auth-right">
                            <h3 class="fw-bold mb-2">Create account</h3>
                            <p class="text-secondary mb-4">Điền thông tin để đăng ký tài khoản mới.</p>

                            <?php if (Session::has('error')): ?>
                                <div class="alert alert-danger rounded-4">
                                    <?= Session::get('error'); Session::remove('error'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (Session::has('success')): ?>
                                <div class="alert alert-success rounded-4">
                                    <?= Session::get('success'); Session::remove('success'); ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/register">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Họ và tên</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Vai trò</label>
                                    <select class="form-select" name="role" required>
                                        <option value="teacher">Teacher</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-brand w-100">Đăng ký</button>
                            </form>

                            <div class="mt-4 text-secondary">
                                Đã có tài khoản?
                                <a href="/LapTrinhWeb-PlanbookAI/public/login" class="fw-semibold">Đăng nhập</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>