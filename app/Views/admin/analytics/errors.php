<?php

use App\Core\Auth;

$title = 'Lỗi hệ thống - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Lỗi hệ thống';
$pageDesc = 'Kiểm tra tình trạng hệ thống và các lỗi cần xử lý';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Lỗi hệ thống</h3>
        <p>Kiểm tra các phụ thuộc quan trọng của hệ thống và trạng thái chấm điểm bị lỗi.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <h5>Kiểm tra hệ thống</h5>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Hạng mục</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($checks ?? []) as $check): ?>
                    <tr>
                        <td class="fw-semibold"><?= htmlspecialchars($check['name']); ?></td>
                        <td>
                            <?php if (!empty($check['status'])): ?>
                                <span class="badge bg-success-subtle text-success">Ổn định</span>
                            <?php else: ?>
                                <span class="badge bg-danger-subtle text-danger">Có lỗi</span>
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
