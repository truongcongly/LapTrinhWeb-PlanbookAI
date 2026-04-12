<?php $role = $role ?? 'admin'; ?>

<aside class="sidebar">
    <div class="brand-box">
        <div class="brand-logo">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
        <div>
            <div class="brand-title">PlanbookAI</div>
            <div class="brand-subtitle">
                <?php if ($role === 'admin'): ?>
                    Administrator Panel
                <?php elseif ($role === 'staff'): ?>
                    Staff Workspace
                <?php else: ?>
                    Teacher Workspace
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="menu-label">Main</div>

    <?php if ($role === 'admin'): ?>
        <a class="nav-item-link" href="/LapTrinhWeb-PlanbookAI/public/admin/dashboard">
            <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
        </a>
        <a class="nav-item-link" href="/LapTrinhWeb-PlanbookAI/public/admin/users">
            <i class="bi bi-people-fill"></i><span>User Management</span>
        </a>
        <a class="nav-item-link" href="#">
            <i class="bi bi-shield-check"></i><span>Permissions</span>
        </a>
        <a class="nav-item-link" href="#">
            <i class="bi bi-bar-chart-fill"></i><span>Reports</span>
        </a>
        <a class="nav-item-link" href="#">
            <i class="bi bi-gear-fill"></i><span>System Settings</span>
        </a>
    <?php elseif ($role === 'staff'): ?>
        <a class="nav-item-link" href="/LapTrinhWeb-PlanbookAI/public/staff/dashboard">
            <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
        </a>
        <a class="nav-item-link" href="#">
            <i class="bi bi-journal-richtext"></i><span>Lesson Samples</span>
        </a>
        <a class="nav-item-link" href="/LapTrinhWeb-PlanbookAI/public/staff/question-samples">
            <i class="bi bi-patch-question-fill"></i><span>Question Samples</span>
        </a>
        <a class="nav-item-link" href="#">
            <i class="bi bi-check2-square"></i><span>Content Review</span>
        </a>
        <a class="nav-item-link" href="#">
            <i class="bi bi-folder-fill"></i><span>Shared Resources</span>
        </a>
    <?php else: ?>
        <a class="nav-item-link" href="/LapTrinhWeb-PlanbookAI/public/teacher/dashboard">
            <i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span>
        </a>
        <a class="nav-item-link" href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans">
            <i class="bi bi-journal-bookmark-fill"></i><span>Lesson Plans</span>
        </a>
        <a class="nav-item-link" href="/LapTrinhWeb-PlanbookAI/public/teacher/questions">
            <i class="bi bi-collection-fill"></i><span>Question Bank</span>
        </a>
        <a class="nav-item-link" href="#">
            <i class="bi bi-ui-checks-grid"></i><span>Exercises</span>
        </a>
        <a class="nav-item-link" href="/LapTrinhWeb-PlanbookAI/public/teacher/exams">
            <i class="bi bi-file-earmark-text-fill"></i><span>Exams</span>
        </a>
        <a class="nav-item-link" href="#">
            <i class="bi bi-graph-up-arrow"></i><span>Results</span>
        </a>
    <?php endif; ?>

    <div class="menu-label mt-4">Account</div>
    <a class="nav-item-link" href="/LapTrinhWeb-PlanbookAI/public/logout">
        <i class="bi bi-box-arrow-right"></i><span>Logout</span>
    </a>
</aside>