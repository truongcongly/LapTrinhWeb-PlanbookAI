<?php

use App\Core\Auth;

$title = 'Nop bai thanh cong - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Nop bai thanh cong';
$pageDesc = 'Bai lam da duoc luu va tao file PDF de cham OCR';
$role = 'teacher';

$scanFile = (string)($result['scan_file'] ?? '');
$downloadUrl = ($scanFile !== '' && !empty($result['id'])) ? '/LapTrinhWeb-PlanbookAI/public/teacher/exams/download-submission-pdf?result_id=' . (int)$result['id'] : '';

ob_start();
?>

<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="dashboard-card text-center">
            <div class="home-feature-icon mx-auto mb-4" style="background: rgba(22, 163, 74, 0.12); color: #16a34a;">
                <i class="bi bi-check2-circle"></i>
            </div>

            <h3 class="fw-bold mb-3">Nop bai thanh cong</h3>
            <p class="text-secondary mb-4">
                Bai lam cua <?= htmlspecialchars($result['student_name'] ?? 'hoc sinh'); ?> da duoc luu va tao file PDF.
                Bai nay chua duoc cham diem. Hay tai PDF va cham bai trong OCR Grading.
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <?php if ($downloadUrl !== ''): ?>
                    <a href="<?= htmlspecialchars($downloadUrl); ?>" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-file-earmark-pdf-fill me-2"></i>Tai PDF bai lam
                    </a>
                <?php endif; ?>

                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading/create" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-camera me-2"></i>Cham bang OCR
                </a>

                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="btn btn-light border rounded-pill px-4">
                    Quay lai danh sach de thi
                </a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_exams_submission_success.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
