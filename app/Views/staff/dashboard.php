<?php use App\Core\Auth; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - PlanbookAI</title>
    <link rel="stylesheet" href="/LapTrinhWeb-PlanbookAI/public/css/style.css">
</head>
<body>
    <div class="dashboard-page">
        <aside class="sidebar">
            <div class="sidebar-brand">PlanbookAI</div>
            <div class="sidebar-role">Staff Panel</div>

            <div class="sidebar-menu">
                <a href="/LapTrinhWeb-PlanbookAI/public/staff/dashboard" class="active">Dashboard</a>
                <a href="#">Lesson Samples</a>
                <a href="#">Question Samples</a>
                <a href="/LapTrinhWeb-PlanbookAI/public/logout">Đăng xuất</a>
            </div>
        </aside>

        <main class="main-content">
            <div class="topbar">
                <div>
                    <h1>Staff Dashboard</h1>
                    <p>Khu vực quản lý nội dung mẫu và hỗ trợ dữ liệu</p>
                </div>
                <div class="user-box">
                    <strong><?= Auth::user()['name']; ?></strong>
                    <span><?= Auth::user()['email']; ?></span>
                </div>
            </div>

            <div class="card-grid">
                <div class="card">
                    <h3>Giáo án mẫu</h3>
                    <div class="big-number">00</div>
                    <p>Số lượng nội dung mẫu hiện có</p>
                </div>

                <div class="card">
                    <h3>Câu hỏi mẫu</h3>
                    <div class="big-number">00</div>
                    <p>Dữ liệu mẫu phục vụ giáo viên</p>
                </div>

                <div class="card">
                    <h3>Vai trò</h3>
                    <div class="big-number">Staff</div>
                    <p>Tác nhân hỗ trợ nội dung hệ thống</p>
                </div>
            </div>

            <div class="panel">
                <h2>Thao tác nhanh</h2>
                <div class="quick-actions">
                    <a href="#">Tạo giáo án mẫu</a>
                    <a href="#">Tạo câu hỏi mẫu</a>
                </div>
            </div>
        </main>
    </div>

    <script src="/LapTrinhWeb-PlanbookAI/public/js/main.js"></script>
</body>
</html>