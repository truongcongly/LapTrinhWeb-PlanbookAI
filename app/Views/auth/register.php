<?php
use App\Core\Session;
Session::start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="/planbookai/public/css/style.css">
</head>
<body>
    <div class="auth-box">
        <h2>Đăng ký</h2>

        <?php if (Session::has('error')): ?>
            <p class="error"><?= Session::get('error'); Session::remove('error'); ?></p>
        <?php endif; ?>

        <?php if (Session::has('success')): ?>
            <p class="success"><?= Session::get('success'); Session::remove('success'); ?></p>
        <?php endif; ?>

        <form method="POST" action="/planbookai/public/register">
            <input type="text" name="name" placeholder="Họ tên" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <select name="role">
                <option value="user">User</option>
                <option value="teacher">Teacher</option>
            </select>
            <button type="submit">Đăng ký</button>
        </form>

        <p><a href="/planbookai/public/login">Đăng nhập</a></p>
    </div>
</body>
</html>