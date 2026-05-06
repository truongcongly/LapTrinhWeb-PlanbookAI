<?php

use App\Core\Auth;

$title = 'Cài đặt hệ thống - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Cài đặt hệ thống';
$pageDesc = 'Cấu hình các tùy chọn chung của hệ thống';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Cài đặt hệ thống</h3>
        <p>Quản lý tên hệ thống, chữ trên logo, AI, OCR và chế độ quy trình làm việc.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Biểu mẫu cài đặt</h5>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/settings/update">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tên hệ thống</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="system_name" value="<?= htmlspecialchars($settings['system_name'] ?? ''); ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Chữ trên logo</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="system_logo_text" value="<?= htmlspecialchars($settings['system_logo_text'] ?? ''); ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Bật AI</label>
                        <select class="form-select form-select-lg rounded-4" name="ai_enabled">
                            <option value="1" <?= (($settings['ai_enabled'] ?? '') === '1') ? 'selected' : ''; ?>>Đang bật</option>
                            <option value="0" <?= (($settings['ai_enabled'] ?? '') === '0') ? 'selected' : ''; ?>>Đang tắt</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Bật OCR</label>
                        <select class="form-select form-select-lg rounded-4" name="ocr_enabled">
                            <option value="1" <?= (($settings['ocr_enabled'] ?? '') === '1') ? 'selected' : ''; ?>>Đang bật</option>
                            <option value="0" <?= (($settings['ocr_enabled'] ?? '') === '0') ? 'selected' : ''; ?>>Đang tắt</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Chế độ quy trình</label>
                        <select class="form-select form-select-lg rounded-4" name="workflow_mode">
                            <option value="standard" <?= (($settings['workflow_mode'] ?? '') === 'standard') ? 'selected' : ''; ?>>Tiêu chuẩn</option>
                            <option value="strict" <?= (($settings['workflow_mode'] ?? '') === 'strict') ? 'selected' : ''; ?>>Nghiêm ngặt</option>
                            <option value="flexible" <?= (($settings['workflow_mode'] ?? '') === 'flexible') ? 'selected' : ''; ?>>Linh hoạt</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Lưu cài đặt
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
