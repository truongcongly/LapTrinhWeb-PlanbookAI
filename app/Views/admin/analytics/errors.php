<?php

use App\Core\Auth;

$title = 'Errors - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Errors';
$pageDesc = 'System health and error checks';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Errors</h3>
        <p>Check important system dependencies and failed grading status.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <h5>System Checks</h5>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Check</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($checks ?? []) as $check): ?>
                    <tr>
                        <td class="fw-semibold"><?= htmlspecialchars($check['name']); ?></td>
                        <td>
                            <?php if (!empty($check['status'])): ?>
                                <span class="badge bg-success-subtle text-success">OK</span>
                            <?php else: ?>
                                <span class="badge bg-danger-subtle text-danger">Error</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($check['detail']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_analytics_errors.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
