<?php use App\Core\Auth; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Xin chào, <?= Auth::user()['name']; ?></p>
    <a href="/planbookai/public/admin/users">Quản lý user</a><br>
    <a href="/planbookai/public/logout">Đăng xuất</a>
</body>
</html>