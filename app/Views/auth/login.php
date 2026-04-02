<?php
use App\Core\Session;

Session::start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - PlanbookAI</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <div class="auth-page">
        <div class="auth-box">
            <div class="auth-logo">PlanbookAI</div>
            <div class="auth-subtitle">Nền tảng hỗ trợ giáo viên quản lý học liệu và giảng dạy</div>

            <h2>Đăng nhập</h2>

            <?php if (Session::has('error')): ?>
                <div class="alert alert-error">
                    <?= Session::get('error'); Session::remove('error'); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/login">
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Nhập email" required>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>

                <button class="btn" type="submit">Đăng nhập</button>
            </form>

            <div class="auth-footer">
                Chưa có tài khoản?
                <a href="/LapTrinhWeb-PlanbookAI/public/register">Đăng ký ngay</a>
            </div>
        </div>
    </div>

    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>