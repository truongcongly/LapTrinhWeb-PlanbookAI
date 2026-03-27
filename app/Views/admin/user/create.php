<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm user</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <h1>Thêm user</h1>

    <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/store">
        <input type="text" name="name" placeholder="Tên" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="teacher">Teacher</option>
            <option value="user">User</option>
        </select>
        <button type="submit">Thêm</button>
    </form>

    <a href="/LapTrinhWeb-PlanbookAI/public/admin/users">Quay lại</a>
    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>