<?php use App\Core\Auth; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <h1>Teacher Dashboard</h1>
    <p>Xin chào, <?= Auth::user()['name']; ?></p>
    <a href="/LapTrinhWeb-PlanbookAI/public/logout">Đăng xuất</a>
    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>