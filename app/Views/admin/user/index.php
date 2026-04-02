<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng - PlanbookAI</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <div class="dashboard-page">
        <aside class="sidebar">
            <div class="sidebar-brand">PlanbookAI</div>
            <div class="sidebar-role">Administrator Panel</div>

            <div class="sidebar-menu">
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/dashboard">Dashboard</a>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/users" class="active">Quản lý người dùng</a>
                <a href="/LapTrinhWeb-PlanbookAI/public/logout">Đăng xuất</a>
            </div>
        </aside>

        <main class="main-content">
            <div class="topbar">
                <div>
                    <h1>Quản lý người dùng</h1>
                    <p>Danh sách tài khoản trong hệ thống</p>
                </div>
            </div>

            <div class="panel">
                <div class="page-actions">
                    <a class="btn-link" href="/LapTrinhWeb-PlanbookAI/public/admin/users/create">+ Thêm người dùng</a>
                    <a class="btn-outline" href="/LapTrinhWeb-PlanbookAI/public/admin/dashboard">Về Dashboard</a>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['name']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td>
                                        <?php if ($user['role'] === 'admin'): ?>
                                            <span class="badge badge-admin">Admin</span>
                                        <?php elseif ($user['role'] === 'staff'): ?>
                                            <span class="badge badge-staff">Staff</span>
                                        <?php else: ?>
                                            <span class="badge badge-teacher">Teacher</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/edit?id=<?= $user['id']; ?>">Sửa</a>
                                        |
                                        <a href="/LapTrinhWeb-PlanbookAI/public/admin/users/delete?id=<?= $user['id']; ?>" onclick="return confirmDelete()">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>