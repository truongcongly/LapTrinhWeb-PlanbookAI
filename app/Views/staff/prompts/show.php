<?php

use App\Core\Auth;

$title = 'Prompt Template Detail - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Prompt Template Detail';
$pageDesc = 'Xem chi tiết prompt template';
$role = 'staff';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết prompt template</h3>
        <p>Xem đầy đủ nội dung prompt mẫu và mục đích sử dụng của nó.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Prompt Detail">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($prompt['title']); ?></h5>
            <small class="text-secondary"><?= htmlspecialchars($prompt['category']); ?></small>
        </div>

        <div class="d-flex gap-2">
            <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/edit?id=<?= $prompt['id']; ?>" class="btn btn-outline-primary rounded-pill px-4">Sửa</a>
            <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
        </div>
    </div>

    <div class="small-panel mb-4">
        <h6>Description</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($prompt['description']); ?></p>
    </div>

    <div class="small-panel mb-4">
        <h6>Status</h6>
        <p class="mb-0"><?= htmlspecialchars($prompt['status']); ?></p>
    </div>

    <div class="small-panel">
        <h6>Prompt Content</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($prompt['prompt_content']); ?></p>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_prompts_show.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';