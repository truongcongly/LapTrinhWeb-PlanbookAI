<?php
use App\Core\Session;
Session::start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <div class="auth-box">
        <h2>Đăng nhập</h2>

        <?php if (Session::has('error')): ?>
            <p class="error"><?= Session::get('error'); Session::remove('error'); ?></p>
        <?php endif; ?>

        <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/login">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>

        <p><a href="/LapTrinhWeb-PlanbookAI/public/register">Đăng ký</a></p>
    </div>
    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>