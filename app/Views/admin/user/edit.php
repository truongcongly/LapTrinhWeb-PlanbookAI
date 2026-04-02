<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa người dùng - PlanbookAI</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <div class="auth-page">
        <div class="auth-box">
            <div class="auth-logo">PlanbookAI</div>
            <div class="auth-subtitle">Cập nhật thông tin tài khoản</div>

            <h2>Sửa người dùng</h2>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/update?id=<?= $user['id']; ?>">
                <div class="form-group">
                    <label>Họ tên</label>
                    <input class="form-control" type="text" name="name" value="<?= $user['name']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" value="<?= $user['email']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Vai trò</label>
                    <select class="form-control" name="role">
                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : ''; ?>>Staff</option>
                        <option value="teacher" <?= $user['role'] === 'teacher' ? 'selected' : ''; ?>>Teacher</option>
                    </select>
                </div>

                <button class="btn" type="submit">Cập nhật</button>
            </form>

            <div class="auth-footer">
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users">Quay lại danh sách</a>
            </div>
        </div>
    </div>

    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>