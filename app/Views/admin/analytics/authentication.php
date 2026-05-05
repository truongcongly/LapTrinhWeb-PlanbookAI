<?php

use App\Core\Auth;

$title = 'Authentication - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Authentication';
$pageDesc = 'Authentication and role access overview';
$role = 'admin';

$totalAccounts = array_sum($roleCounts ?? []);
$adminCount = (int)($roleCounts['admin'] ?? 0);
$staffCount = (int)($roleCounts['staff'] ?? 0);
$teacherCount = (int)($roleCounts['teacher'] ?? 0);
$contentCount = (int)(($counts['lesson_plans'] ?? 0) + ($counts['questions'] ?? 0) + ($counts['exercises'] ?? 0) + ($counts['exams'] ?? 0));

$accessRows = [
    ['role' => 'Admin', 'class' => 'auth-pill-admin', 'area' => 'Administration', 'access' => 'Users, reports, charts, authentication, errors, and system settings.'],
    ['role' => 'Staff', 'class' => 'auth-pill-staff', 'area' => 'Content Operations', 'access' => 'Lesson samples, question samples, prompt templates, and content review.'],
    ['role' => 'Teacher', 'class' => 'auth-pill-teacher', 'area' => 'Teaching Workspace', 'access' => 'Lessons, questions, exercises, exams, OCR grading, and results.'],
];

ob_start();
?>

<style>
.auth-page {
    display: grid;
    gap: 24px;
}

.auth-kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
}

.auth-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 12px 30px rgba(15, 23, 42, .05);
    min-width: 0;
}

.auth-card h5,
.auth-card h6 {
    font-weight: 800;
    color: #0f172a;
}

.auth-kpi {
    display: flex;
    align-items: center;
    gap: 14px;
    min-height: 96px;
}

.auth-icon {
    width: 48px;
    height: 48px;
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    flex: 0 0 auto;
}

.auth-label {
    color: #64748b;
    font-size: .9rem;
    margin-bottom: 4px;
}

.auth-value {
    color: #0f172a;
    font-size: 1.55rem;
    font-weight: 800;
    line-height: 1.15;
    overflow-wrap: anywhere;
}

.auth-main-grid {
    display: grid;
    grid-template-columns: minmax(280px, .9fr) minmax(0, 1.4fr);
    gap: 24px;
    align-items: start;
}

.auth-profile {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 22px;
    min-width: 0;
}

.auth-avatar {
    width: 62px;
    height: 62px;
    border-radius: 50%;
    background: #dbeafe;
    color: #2563eb;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
}

.auth-profile h5,
.auth-profile p {
    overflow-wrap: anywhere;
}

.auth-profile .min-w-0 {
    min-width: 0;
}

.auth-info-list {
    display: grid;
    gap: 14px;
}

.auth-info-item {
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    background: #f8fafc;
    padding: 16px;
}

.auth-info-item p {
    color: #64748b;
    line-height: 1.6;
}

.auth-role-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
}

.auth-role-count {
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
    color: #0f172a;
}

.auth-pill {
    display: inline-flex;
    align-items: center;
    width: fit-content;
    max-width: 100%;
    padding: 7px 13px;
    border-radius: 999px;
    font-size: .84rem;
    font-weight: 800;
    line-height: 1.2;
    white-space: nowrap;
}

.auth-pill-admin {
    background: #dbeafe;
    color: #1d4ed8;
}

.auth-pill-staff {
    background: #fef3c7;
    color: #b45309;
}

.auth-pill-teacher {
    background: #dcfce7;
    color: #15803d;
}

.auth-boundary-list {
    display: grid;
    gap: 12px;
}

.auth-boundary-row {
    display: grid;
    grid-template-columns: 150px minmax(0, 1fr);
    gap: 14px;
    padding: 14px 0;
    border-bottom: 1px solid #e2e8f0;
}

.auth-boundary-row:last-child {
    border-bottom: 0;
    padding-bottom: 0;
}

.auth-boundary-row strong {
    color: #0f172a;
}

.auth-boundary-row span {
    color: #475569;
    overflow-wrap: anywhere;
}

.auth-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

.auth-table th,
.auth-table td {
    padding: 15px 14px;
    border-bottom: 1px solid #e2e8f0;
    vertical-align: top;
    color: #0f172a;
    overflow-wrap: anywhere;
}

.auth-table th {
    color: #334155;
    background: #f8fafc;
    font-weight: 800;
}

.auth-table tr:last-child td {
    border-bottom: 0;
}

@media (max-width: 1199.98px) {
    .auth-kpi-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .auth-main-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 767.98px) {
    .auth-kpi-grid,
    .auth-role-grid {
        grid-template-columns: 1fr;
    }

    .auth-boundary-row {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="auth-page">
    <div class="hero-mini-banner">
        <div>
            <h3>Authentication</h3>
            <p>Monitor account roles, current admin session, and access boundaries.</p>
        </div>
    </div>

    <div class="auth-kpi-grid">
        <div class="auth-card auth-kpi">
            <div class="auth-icon bg-primary"><i class="bi bi-shield-lock-fill"></i></div>
            <div>
                <div class="auth-label">Signed In As</div>
                <div class="auth-value"><?= htmlspecialchars(ucfirst($currentUser['role'] ?? '-')); ?></div>
            </div>
        </div>
        <div class="auth-card auth-kpi">
            <div class="auth-icon bg-success"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="auth-label">Accounts</div>
                <div class="auth-value"><?= (int)$totalAccounts; ?></div>
            </div>
        </div>
        <div class="auth-card auth-kpi">
            <div class="auth-icon bg-warning"><i class="bi bi-person-badge-fill"></i></div>
            <div>
                <div class="auth-label">Admins</div>
                <div class="auth-value"><?= $adminCount; ?></div>
            </div>
        </div>
        <div class="auth-card auth-kpi">
            <div class="auth-icon bg-info"><i class="bi bi-collection-fill"></i></div>
            <div>
                <div class="auth-label">Protected Items</div>
                <div class="auth-value"><?= $contentCount; ?></div>
            </div>
        </div>
    </div>

    <div class="auth-main-grid">
        <div class="auth-card">
            <h5 class="mb-4">Current Session</h5>
            <div class="auth-profile">
                <div class="auth-avatar"><i class="bi bi-person-fill fs-3"></i></div>
                <div class="min-w-0">
                    <h5 class="mb-1"><?= htmlspecialchars($currentUser['name'] ?? '-'); ?></h5>
                    <p class="text-secondary mb-0"><?= htmlspecialchars($currentUser['email'] ?? '-'); ?></p>
                </div>
            </div>
            <div class="auth-info-list">
                <div class="auth-info-item">
                    <h6>Role</h6>
                    <span class="auth-pill auth-pill-admin"><?= htmlspecialchars(ucfirst($currentUser['role'] ?? '-')); ?></span>
                </div>
                <div class="auth-info-item">
                    <h6>Session Scope</h6>
                    <p class="mb-0">This account can manage users, reports, settings, analytics, and platform operations.</p>
                </div>
            </div>
        </div>

        <div class="auth-card">
            <h5 class="mb-4">Role Distribution</h5>
            <div class="auth-role-grid mb-4">
                <div class="auth-info-item">
                    <h6>Admin</h6>
                    <div class="auth-role-count mb-2"><?= $adminCount; ?></div>
                    <span class="auth-pill auth-pill-admin">Full access</span>
                </div>
                <div class="auth-info-item">
                    <h6>Staff</h6>
                    <div class="auth-role-count mb-2"><?= $staffCount; ?></div>
                    <span class="auth-pill auth-pill-staff">Content ops</span>
                </div>
                <div class="auth-info-item">
                    <h6>Teacher</h6>
                    <div class="auth-role-count mb-2"><?= $teacherCount; ?></div>
                    <span class="auth-pill auth-pill-teacher">Workspace</span>
                </div>
            </div>

            <h5 class="mb-3">Access Boundaries</h5>
            <div class="auth-boundary-list">
                <div class="auth-boundary-row">
                    <strong>Admin area</strong>
                    <span>Dashboard, users, reports, charts, authentication, errors, settings.</span>
                </div>
                <div class="auth-boundary-row">
                    <strong>Staff area</strong>
                    <span>Lesson samples, question samples, prompt templates.</span>
                </div>
                <div class="auth-boundary-row">
                    <strong>Teacher area</strong>
                    <span>Lessons, questions, exercises, exams, OCR grading, results.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="auth-card">
        <h5 class="mb-4">Access Matrix</h5>
        <div class="table-responsive">
            <table class="auth-table">
                <thead>
                    <tr>
                        <th style="width: 170px;">Role</th>
                        <th style="width: 240px;">Primary Area</th>
                        <th>Access</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accessRows as $row): ?>
                        <tr>
                            <td><span class="auth-pill <?= htmlspecialchars($row['class']); ?>"><?= htmlspecialchars($row['role']); ?></span></td>
                            <td><?= htmlspecialchars($row['area']); ?></td>
                            <td><?= htmlspecialchars($row['access']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_analytics_authentication.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
