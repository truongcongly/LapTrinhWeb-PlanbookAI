<?php
use App\Core\Session;

Session::start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - PlanbookAI</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <div class="auth-page">
        <div class="auth-box">
            <div class="auth-logo">PlanbookAI</div>
            <div class="auth-subtitle">Tạo tài khoản để bắt đầu sử dụng hệ thống</div>

            <h2>Đăng ký</h2>

            <?php if (Session::has('error')): ?>
                <div class="alert alert-error">
                    <?= Session::get('error'); Session::remove('error'); ?>
                </div>
            <?php endif; ?>

            <?php if (Session::has('success')): ?>
                <div class="alert alert-success">
                    <?= Session::get('success'); Session::remove('success'); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/register">
                <div class="form-group">
                    <label>Họ và tên</label>
                    <input class="form-control" type="text" name="name" placeholder="Nhập họ và tên" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Nhập email" required>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>

                <div class="form-group">
                    <label>Vai trò</label>
                    <select class="form-control" name="role" required>
                        <option value="teacher">Teacher</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>

                <button class="btn" type="submit">Đăng ký</button>
            </form>

            <div class="auth-footer">
                Đã có tài khoản?
                <a href="/LapTrinhWeb-PlanbookAI/public/login">Đăng nhập</a>
            </div>
        </div>
    </div>

    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>