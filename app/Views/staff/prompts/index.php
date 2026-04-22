<?php

use App\Core\Auth;

$title = 'Prompt Templates - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Prompt Templates';
$pageDesc = 'Quan ly prompt mau cho AI workflow';
$role = 'staff';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
    <h3>Prompt Templates</h3>
    <p>Tao va quan ly prompt mau cho lesson plan, bai tap, de thi va phan hoi AI.</p>
</div>
</div>

<div class="dashboard-card">
<div class="card-header-custom">
    <div>
        <h5>Danh sach prompt templates</h5>
        <small class="text-secondary">Tat ca prompt templates cua ban</small>
    </div>

    <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/create" class="btn btn-primary rounded-pill px-4">
        <i class="bi bi-plus-circle-fill me-2"></i>Tao prompt moi
    </a>
</div>

<div class="table-responsive">
    <table class="table align-middle mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tieu de</th>
                <th>Category</th>
                <th>Trang thai</th>
                <th class="text-center">Hanh dong</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($prompts)): ?>
                <?php foreach ($prompts as $prompt): ?>
                    <tr>
                        <td>#<?= $prompt['id']; ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($prompt['title']); ?></td>
                        <td><?= htmlspecialchars($prompt['category']); ?></td>
                        <td>
                            <?php
                            $status = $prompt['status'] ?? 'draft';
                            if ($status === 'active') {
                                echo '<span class="badge bg-success-subtle text-success">Active</span>';
                            } elseif ($status === 'archived') {
                                echo '<span class="badge bg-secondary-subtle text-secondary">Archived</span>';
                            } else {
                                echo '<span class="badge bg-warning-subtle text-warning">Draft</span>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/show?id=<?= $prompt['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Xem</a>
                            <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/edit?id=<?= $prompt['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">Sua</a>
                            <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/delete?id=<?= $prompt['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">Xoa</a>
                            <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/import?id=<?= $prompt['id']; ?>" class="btn btn-sm btn-outline-success rounded-pill px-3">Import</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center py-5">Chua co prompt template nao.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_prompts_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
