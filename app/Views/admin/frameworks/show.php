<?php

use App\Core\Auth;

$title = 'Framework Detail - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Framework Detail';
$pageDesc = 'Xem chi tiết curriculum framework';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết framework</h3>
        <p>Xem đầy đủ template chương trình và cấu trúc giáo án.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/admin-panel.svg" alt="Framework Detail">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($framework['title']); ?></h5>
            <small class="text-secondary"><?= htmlspecialchars($framework['subject']); ?> • <?= htmlspecialchars($framework['grade_level']); ?></small>
        </div>
        <div class="d-flex gap-2">
            <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks/edit?id=<?= $framework['id']; ?>" class="btn btn-outline-primary rounded-pill px-4">Sửa</a>
            <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
        </div>
    </div>

    <div class="small-panel mb-4">
        <h6>Objectives Template</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($framework['objectives_template']); ?></p>
    </div>

    <div class="small-panel mb-4">
        <h6>Activities Template</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($framework['activities_template']); ?></p>
    </div>

    <div class="small-panel">
        <h6>Assessment Template</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($framework['assessment_template']); ?></p>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_frameworks_show.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';