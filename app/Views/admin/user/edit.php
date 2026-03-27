<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa user</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <h1>Sửa user</h1>

    <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/update?id=<?= $user['id']; ?>">
        <input type="text" name="name" value="<?= $user['name']; ?>" required>
        <input type="email" name="email" value="<?= $user['email']; ?>" required>
        <select name="role">
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="teacher" <?= $user['role'] === 'teacher' ? 'selected' : ''; ?>>Teacher</option>
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
        </select>
        <button type="submit">Cập nhật</button>
    </form>

    <a href="/LapTrinhWeb-PlanbookAI/public/admin/users">Quay lại</a>
    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>