<?php

use App\Core\Auth;

$title = 'Review OCR - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Review OCR';
$pageDesc = 'Kiểm tra và chỉnh sửa đáp án OCR trước khi xác nhận điểm';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Review OCR</h3>
        <p>Chỉnh lại đáp án học sinh theo từng câu, hệ thống sẽ tự tính lại số câu đúng và điểm.</p>
    </div>
</div>

<form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/results/review-update?id=<?= $result['id']; ?>">
    <div class="dashboard-card">
        <div class="card-header-custom">
            <div>
                <h5><?= htmlspecialchars($result['student_name']); ?></h5>
                <small class="text-secondary"><?= htmlspecialchars($result['exam_title'] ?? ''); ?></small>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-save-fill me-2"></i>Lưu review
                </button>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/show?id=<?= $result['id']; ?>" class="btn btn-outline-secondary rounded-pill px-4">
                    Quay lại
                </a>
            </div>
        </div>

        <?php if (!empty($result['scan_file'])): ?>
            <div class="small-panel mb-4">
                <h6>File scan</h6>
                <?php
                    $scanFile = (string)$result['scan_file'];
                    $scanUrl = '/LapTrinhWeb-PlanbookAI/public/' . ltrim($scanFile, '/');
                    $extension = strtolower(pathinfo($scanFile, PATHINFO_EXTENSION));
                ?>
                <?php if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true)): ?>
                    <img src="<?= htmlspecialchars($scanUrl); ?>" alt="Scan file" class="img-fluid rounded-4 border mb-3" style="max-height: 360px; object-fit: contain;">
                <?php endif; ?>
                <div>
                    <a href="<?= htmlspecialchars($scanUrl); ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Mở file scan
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Câu</th>
                        <th>Đáp án học sinh</th>
                        <th>Đáp án đúng</th>
                        <th>Hiện tại</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($details)): ?>
                        <?php foreach ($details as $detail): ?>
                            <?php $questionNumber = (int)$detail['question_number']; ?>
                            <tr>
                                <td>#<?= $questionNumber; ?></td>
                                <td style="max-width: 220px;">
                                    <select class="form-select rounded-4" name="student_answers[<?= $questionNumber; ?>]">
                                        <option value="">-- Trống --</option>
                                        <?php foreach (['A', 'B', 'C', 'D'] as $option): ?>
                                            <option value="<?= $option; ?>" <?= (($detail['student_answer'] ?? '') === $option) ? 'selected' : ''; ?>>
                                                <?= $option; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><span class="badge bg-primary-subtle text-primary"><?= htmlspecialchars($detail['correct_answer'] ?: '-'); ?></span></td>
                                <td>
                                    <?php if ((int)$detail['is_correct'] === 1): ?>
                                        <span class="badge bg-success-subtle text-success">Đúng</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger">Sai</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($detail['note'] ?? ''); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No details" style="max-width: 150px;" class="mb-3">
                                <div class="text-secondary">Chưa có chi tiết từng câu để review.</div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_results_review.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
