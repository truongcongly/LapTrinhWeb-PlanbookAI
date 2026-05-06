<?php

use App\Core\Auth;

$title = 'Xác thực - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Xác thực';
$pageDesc = 'Tổng quan xác thực và quyền truy cập theo vai trò';
$role = 'admin';

$totalAccounts = array_sum($roleCounts ?? []);
$adminCount = (int)($roleCounts['admin'] ?? 0);
$staffCount = (int)($roleCounts['staff'] ?? 0);
$teacherCount = (int)($roleCounts['teacher'] ?? 0);
$contentCount = (int)(($counts['lesson_plans'] ?? 0) + ($counts['questions'] ?? 0) + ($counts['exercises'] ?? 0) + ($counts['exams'] ?? 0));

$accessRows = [
    ['role' => 'Quản trị', 'class' => 'auth-pill-admin', 'area' => 'Khu vực quản trị', 'access' => 'Người dùng, báo cáo, biểu đồ, xác thực, lỗi hệ thống và cài đặt hệ thống.'],
    ['role' => 'Nhân viên', 'class' => 'auth-pill-staff', 'area' => 'Vận hành nội dung', 'access' => 'Mẫu giáo án, mẫu câu hỏi, mẫu prompt và kiểm duyệt nội dung.'],
    ['role' => 'Giáo viên', 'class' => 'auth-pill-teacher', 'area' => 'Không gian giảng dạy', 'access' => 'Giáo án, câu hỏi, bài tập, đề thi, chấm OCR và kết quả.'],
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
            <h3>Xác thực</h3>
            <p>Theo dõi vai trò tài khoản, phiên quản trị hiện tại và phạm vi truy cập.</p>
        </div>
    </div>

    <div class="auth-kpi-grid">
        <div class="auth-card auth-kpi">
            <div class="auth-icon bg-primary"><i class="bi bi-shield-lock-fill"></i></div>
            <div>
                <div class="auth-label">Đang đăng nhập với vai trò</div>
                <div class="auth-value"><?= htmlspecialchars(ucfirst($currentUser['role'] ?? '-')); ?></div>
            </div>
        </div>
        <div class="auth-card auth-kpi">
            <div class="auth-icon bg-success"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="auth-label">Tài khoản</div>
                <div class="auth-value"><?= (int)$totalAccounts; ?></div>
            </div>
        </div>
        <div class="auth-card auth-kpi">
            <div class="auth-icon bg-warning"><i class="bi bi-person-badge-fill"></i></div>
            <div>
                <div class="auth-label">Quản trị viên</div>
                <div class="auth-value"><?= $adminCount; ?></div>
            </div>
        </div>
        <div class="auth-card auth-kpi">
            <div class="auth-icon bg-info"><i class="bi bi-collection-fill"></i></div>
            <div>
                <div class="auth-label">Mục được bảo vệ</div>
                <div class="auth-value"><?= $contentCount; ?></div>
            </div>
        </div>
    </div>

    <div class="auth-main-grid">
        <div class="auth-card">
            <h5 class="mb-4">Phiên hiện tại</h5>
            <div class="auth-profile">
                <div class="auth-avatar"><i class="bi bi-person-fill fs-3"></i></div>
                <div class="min-w-0">
                    <h5 class="mb-1"><?= htmlspecialchars($currentUser['name'] ?? '-'); ?></h5>
                    <p class="text-secondary mb-0"><?= htmlspecialchars($currentUser['email'] ?? '-'); ?></p>
                </div>
            </div>
            <div class="auth-info-list">
                <div class="auth-info-item">
                    <h6>Vai trò</h6>
                    <span class="auth-pill auth-pill-admin"><?= htmlspecialchars(ucfirst($currentUser['role'] ?? '-')); ?></span>
                </div>
                <div class="auth-info-item">
                    <h6>Phạm vi phiên</h6>
                    <p class="mb-0">Tài khoản này có thể quản lý người dùng, báo cáo, cài đặt, phân tích và vận hành nền tảng.</p>
                </div>
            </div>
        </div>

        <div class="auth-card">
            <h5 class="mb-4">Phân bố vai trò</h5>
            <div class="auth-role-grid mb-4">
                <div class="auth-info-item">
                    <h6>Quản trị</h6>
                    <div class="auth-role-count mb-2"><?= $adminCount; ?></div>
                    <span class="auth-pill auth-pill-admin">Toàn quyền</span>
                </div>
                <div class="auth-info-item">
                    <h6>Nhân viên</h6>
                    <div class="auth-role-count mb-2"><?= $staffCount; ?></div>
                    <span class="auth-pill auth-pill-staff">Vận hành nội dung</span>
                </div>
                <div class="auth-info-item">
                    <h6>Giáo viên</h6>
                    <div class="auth-role-count mb-2"><?= $teacherCount; ?></div>
                    <span class="auth-pill auth-pill-teacher">Không gian làm việc</span>
                </div>
            </div>

            <h5 class="mb-3">Phạm vi truy cập</h5>
            <div class="auth-boundary-list">
                <div class="auth-boundary-row">
                    <strong>Khu vực quản trị</strong>
                    <span>Tổng quan, người dùng, báo cáo, biểu đồ, xác thực, lỗi hệ thống và cài đặt.</span>
                </div>
                <div class="auth-boundary-row">
                    <strong>Khu vực nhân viên</strong>
                    <span>Mẫu giáo án, mẫu câu hỏi và mẫu prompt.</span>
                </div>
                <div class="auth-boundary-row">
                    <strong>Khu vực giáo viên</strong>
                    <span>Giáo án, câu hỏi, bài tập, đề thi, chấm OCR và kết quả.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="auth-card">
        <h5 class="mb-4">Ma trận truy cập</h5>
        <div class="table-responsive">
            <table class="auth-table">
                <thead>
                    <tr>
                        <th style="width: 170px;">Vai trò</th>
                        <th style="width: 240px;">Khu vực chính</th>
                        <th>Quyền truy cập</th>
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
