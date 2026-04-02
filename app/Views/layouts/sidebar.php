<?php
$role = $role ?? 'admin';
?>

<aside class="sidebar">
    <div class="brand-box">
        <div class="app-brand fs-4 text-white">PlanbookAI</div>
        <div class="brand-sub">
            <?php if ($role === 'admin'): ?>
                Admin Panel
            <?php elseif ($role === 'staff'): ?>
                Staff Workspace
            <?php else: ?>
                Teacher Workspace
            <?php endif; ?>
        </div>
    </div>

    <div class="menu-title">Main</div>

    <?php if ($role === 'admin'): ?>
        <a class="nav-link" href="/LapTrinhWeb-PlanbookAI/public/admin/dashboard">
            <i class="bi bi-grid"></i> Dashboard
        </a>
        <a class="nav-link" href="/LapTrinhWeb-PlanbookAI/public/admin/users">
            <i class="bi bi-people"></i> Quản lý người dùng
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-gear"></i> Cấu hình hệ thống
        </a>
    <?php elseif ($role === 'staff'): ?>
        <a class="nav-link" href="/LapTrinhWeb-PlanbookAI/public/staff/dashboard">
            <i class="bi bi-grid"></i> Dashboard
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-journal-text"></i> Lesson Samples
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-patch-question"></i> Question Samples
        </a>
    <?php else: ?>
        <a class="nav-link" href="/LapTrinhWeb-PlanbookAI/public/teacher/dashboard">
            <i class="bi bi-grid"></i> Dashboard
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-journal-bookmark"></i> Lesson Plans
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-collection"></i> Question Bank
        </a>
        <a class="nav-link" href="#">
            <i class="bi bi-ui-checks-grid"></i> Exams
        </a>
    <?php endif; ?>

    <div class="menu-title">Account</div>
    <a class="nav-link" href="/LapTrinhWeb-PlanbookAI/public/logout">
        <i class="bi bi-box-arrow-right"></i> Đăng xuất
    </a>
</aside>