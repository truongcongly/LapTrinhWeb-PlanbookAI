<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý người dùng</title>
</head>
<body>
    <h1>Danh sách người dùng</h1>

    <a href="/planbookai/public/admin/users/create">Thêm user</a>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Role</th>
            <th>Hành động</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= $user['name']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><?= $user['role']; ?></td>
                <td>
                    <a href="/planbookai/public/admin/users/edit?id=<?= $user['id']; ?>">Sửa</a>
                    <a href="/planbookai/public/admin/users/delete?id=<?= $user['id']; ?>" onclick="return confirm('Xóa user này?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="/planbookai/public/admin/dashboard">Về dashboard</a>
</body>
</html>