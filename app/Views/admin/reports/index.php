<?php

use App\Core\Auth;

$title = 'Reports - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Reports';
$pageDesc = 'Báo cáo tổng quan toàn hệ thống';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Reports</h3>
        <p>Theo dõi số liệu tổng quan về users, frameworks, lesson plans, questions, exams và results.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-primary"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value"><?= $stats['total_users']; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-success"><i class="bi bi-journal-richtext"></i></div>
            <div>
                <div class="stat-label">Frameworks</div>
                <div class="stat-value"><?= $stats['framework_count']; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-warning"><i class="bi bi-journal-bookmark-fill"></i></div>
            <div>
                <div class="stat-label">Lesson Plans</div>
                <div class="stat-value"><?= $stats['lesson_plan_count']; ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-info"><i class="bi bi-file-earmark-text-fill"></i></div>
            <div>
                <div class="stat-label">Exams</div>
                <div class="stat-value"><?= $stats['exam_count']; ?></div>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-card mt-4">
    <div class="card-header-custom">
        <h5>System Summary</h5>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <tbody>
                <tr><th>Admin</th><td><?= $stats['admin_count']; ?></td></tr>
                <tr><th>Staff</th><td><?= $stats['staff_count']; ?></td></tr>
                <tr><th>Teacher</th><td><?= $stats['teacher_count']; ?></td></tr>
                <tr><th>Teacher Questions</th><td><?= $stats['question_count']; ?></td></tr>
                <tr><th>Exercises</th><td><?= $stats['exercise_count']; ?></td></tr>
                <tr><th>Results</th><td><?= $stats['result_count']; ?></td></tr>
                <tr><th>Sample Lessons</th><td><?= $stats['sample_lesson_count']; ?></td></tr>
                <tr><th>Sample Questions</th><td><?= $stats['sample_question_count']; ?></td></tr>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_reports_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';