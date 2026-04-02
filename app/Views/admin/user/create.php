<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng - PlanbookAI</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <div class="auth-page">
        <div class="auth-box">
            <div class="auth-logo">PlanbookAI</div>
            <div class="auth-subtitle">Thêm tài khoản mới vào hệ thống</div>

            <h2>Thêm người dùng</h2>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/users/store">
                <div class="form-group">
                    <label>Họ tên</label>
                    <input class="form-control" type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input class="form-control" type="password" name="password" required>
                </div>

                <div class="form-group">
                    <label>Vai trò</label>
                    <select class="form-control" name="role">
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>

                <button class="btn" type="submit">Thêm người dùng</button>
            </form>

            <div class="auth-footer">
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users">Quay lại danh sách</a>
            </div>
        </div>
    </div>

    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>