<?php

use App\Core\Auth;

$title = 'Reports - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Reports';
$pageDesc = 'System-wide reports and statistics';
$role = 'admin';

$summaryRows = [
    'Total Users' => $stats['total_users'] ?? 0,
    'Curriculum Frameworks' => $stats['framework_count'] ?? 0,
    'Lesson Plans' => $stats['lesson_plan_count'] ?? 0,
    'Teacher Questions' => $stats['question_count'] ?? 0,
    'Exercises' => $stats['exercise_count'] ?? 0,
    'Exams' => $stats['exam_count'] ?? 0,
    'Exam Results' => $stats['result_count'] ?? 0,
    'Lesson Samples' => $stats['sample_lesson_count'] ?? 0,
    'Question Samples' => $stats['sample_question_count'] ?? 0,
    'Prompt Templates' => $stats['prompt_count'] ?? 0,
];

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Reports</h3>
        <p>Review system totals, user distribution, learning content, and grading performance.</p>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-primary"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value"><?= (int)($stats['total_users'] ?? 0); ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-success"><i class="bi bi-journal-richtext"></i></div>
            <div>
                <div class="stat-label">Frameworks</div>
                <div class="stat-value"><?= (int)($stats['framework_count'] ?? 0); ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-warning"><i class="bi bi-collection-fill"></i></div>
            <div>
                <div class="stat-label">Learning Items</div>
                <div class="stat-value"><?= (int)(($stats['lesson_plan_count'] ?? 0) + ($stats['question_count'] ?? 0) + ($stats['exercise_count'] ?? 0)); ?></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="stat-box">
            <div class="stat-icon bg-info"><i class="bi bi-clipboard-check-fill"></i></div>
            <div>
                <div class="stat-label">Exam Results</div>
                <div class="stat-value"><?= (int)($stats['result_count'] ?? 0); ?></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-7">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Statistics Summary</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <tbody>
                        <?php foreach ($summaryRows as $label => $value): ?>
                            <tr>
                                <th><?= htmlspecialchars($label); ?></th>
                                <td class="text-end fw-semibold"><?= (int)$value; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="dashboard-card mb-4">
            <div class="card-header-custom">
                <h5>Users By Role</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <tbody>
                        <tr><th>Admin</th><td class="text-end"><?= (int)($stats['admin_count'] ?? 0); ?></td></tr>
                        <tr><th>Staff</th><td class="text-end"><?= (int)($stats['staff_count'] ?? 0); ?></td></tr>
                        <tr><th>Teacher</th><td class="text-end"><?= (int)($stats['teacher_count'] ?? 0); ?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Results By Status</h5>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <tbody>
                        <tr><th>Auto Graded</th><td class="text-end"><?= (int)($stats['auto_graded_count'] ?? 0); ?></td></tr>
                        <tr><th>Needs Review</th><td class="text-end"><?= (int)($stats['needs_review_count'] ?? 0); ?></td></tr>
                        <tr><th>Reviewed</th><td class="text-end"><?= (int)($stats['reviewed_count'] ?? 0); ?></td></tr>
                        <tr><th>Failed</th><td class="text-end"><?= (int)($stats['failed_count'] ?? 0); ?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_reports_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
