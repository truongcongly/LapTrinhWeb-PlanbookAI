<?php

use App\Core\Auth;

$title = 'System Settings - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'System Settings';
$pageDesc = 'Configure global system options';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>System Settings</h3>
        <p>Manage the system name, logo text, AI, OCR, and workflow mode.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Settings Form</h5>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/settings/update">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">System Name</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="system_name" value="<?= htmlspecialchars($settings['system_name'] ?? ''); ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Logo Text</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="system_logo_text" value="<?= htmlspecialchars($settings['system_logo_text'] ?? ''); ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">AI Enabled</label>
                        <select class="form-select form-select-lg rounded-4" name="ai_enabled">
                            <option value="1" <?= (($settings['ai_enabled'] ?? '') === '1') ? 'selected' : ''; ?>>Enabled</option>
                            <option value="0" <?= (($settings['ai_enabled'] ?? '') === '0') ? 'selected' : ''; ?>>Disabled</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">OCR Enabled</label>
                        <select class="form-select form-select-lg rounded-4" name="ocr_enabled">
                            <option value="1" <?= (($settings['ocr_enabled'] ?? '') === '1') ? 'selected' : ''; ?>>Enabled</option>
                            <option value="0" <?= (($settings['ocr_enabled'] ?? '') === '0') ? 'selected' : ''; ?>>Disabled</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Workflow Mode</label>
                        <select class="form-select form-select-lg rounded-4" name="workflow_mode">
                            <option value="standard" <?= (($settings['workflow_mode'] ?? '') === 'standard') ? 'selected' : ''; ?>>Standard</option>
                            <option value="strict" <?= (($settings['workflow_mode'] ?? '') === 'strict') ? 'selected' : ''; ?>>Strict</option>
                            <option value="flexible" <?= (($settings['workflow_mode'] ?? '') === 'flexible') ? 'selected' : ''; ?>>Flexible</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_settings_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
