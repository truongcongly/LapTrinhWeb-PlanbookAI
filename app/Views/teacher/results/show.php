<?php

use App\Core\Auth;

$title = 'Result Detail - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Result Detail';
$pageDesc = 'Xem chi tiết kết quả chấm bài';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chi tiết kết quả</h3>
        <p>Xem thông tin bài làm, điểm số, đáp án nhận diện và trạng thái xử lý.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5><?= htmlspecialchars($result['student_name']); ?></h5>
            <small class="text-secondary"><?= htmlspecialchars($result['exam_title'] ?? ''); ?></small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/edit?id=<?= $result['id']; ?>" class="btn btn-outline-primary rounded-pill px-4">
                <i class="bi bi-pencil-square me-2"></i>Feedback
            </a>
            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Quay lại
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="small-panel">
                <h6>Môn học</h6>
                <p class="mb-0"><?= htmlspecialchars($result['subject'] ?? ''); ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-panel">
                <h6>Khối lớp</h6>
                <p class="mb-0"><?= htmlspecialchars($result['grade_level'] ?? ''); ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-panel">
                <h6>Số câu đúng</h6>
                <p class="mb-0"><?= (int)$result['correct_count']; ?>/<?= (int)$result['total_questions']; ?></p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-panel">
                <h6>Điểm</h6>
                <p class="mb-0"><strong><?= htmlspecialchars($result['score']); ?></strong></p>
            </div>
        </div>
    </div>

    <div class="small-panel mb-4">
        <h6>Đáp án nhận diện</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($result['scanned_answers']); ?></p>
    </div>

    <?php if (!empty($result['scan_file'])): ?>
        <div class="small-panel mb-4">
            <h6>File scan bài làm</h6>
            <?php
                $scanFile = (string) $result['scan_file'];
                $scanUrl = '/LapTrinhWeb-PlanbookAI/public/' . ltrim($scanFile, '/');
                $extension = strtolower(pathinfo($scanFile, PATHINFO_EXTENSION));
            ?>
            <?php if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'], true)): ?>
                <img src="<?= htmlspecialchars($scanUrl); ?>" alt="Scan file" class="img-fluid rounded-4 border mb-3" style="max-height: 420px; object-fit: contain;">
            <?php endif; ?>
            <div>
                <a href="<?= htmlspecialchars($scanUrl); ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                    <i class="bi bi-box-arrow-up-right me-1"></i>Mở file scan
                </a>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($details)): ?>
        <div class="small-panel mb-4">
            <h6>Chi tiết chấm từng câu</h6>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Câu</th>
                            <th>Đáp án HS</th>
                            <th>Đáp án đúng</th>
                            <th>Kết quả</th>
                            <th>Confidence</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($details as $detail): ?>
                            <tr>
                                <td>#<?= (int)$detail['question_number']; ?></td>
                                <td><?= htmlspecialchars($detail['student_answer'] ?: '-'); ?></td>
                                <td><?= htmlspecialchars($detail['correct_answer'] ?: '-'); ?></td>
                                <td>
                                    <?php if ((int)$detail['is_correct'] === 1): ?>
                                        <span class="badge bg-success-subtle text-success">Đúng</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger">Sai</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($detail['confidence'] ?? '-'); ?>%</td>
                                <td><?= htmlspecialchars($detail['note'] ?? ''); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <div class="small-panel mb-4">
        <h6>Bài nộp của học sinh</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($result['submitted_answers'] ?? ''); ?></p>
    </div>
    
    <div class="small-panel mb-4">
        <h6>Feedback</h6>
        <p class="mb-0" style="white-space: pre-line;"><?= htmlspecialchars($result['feedback'] ?? ''); ?></p>
    </div>

    <div class="small-panel">
        <h6>Trạng thái</h6>
        <p class="mb-0">
            <?php if (($result['status'] ?? '') === 'reviewed'): ?>
                <span class="badge bg-success-subtle text-success">Reviewed</span>
            <?php elseif (($result['status'] ?? '') === 'needs_review'): ?>
                <span class="badge bg-warning-subtle text-warning">Needs Review</span>
            <?php elseif (($result['status'] ?? '') === 'failed'): ?>
                <span class="badge bg-danger-subtle text-danger">Failed</span>
            <?php else: ?>
                <span class="badge bg-info-subtle text-info">Auto Graded</span>
            <?php endif; ?>
        </p>
    </div>

    <div class="small-panel mt-4">
        <h6>OCR</h6>
        <p class="mb-1">Status: <?= htmlspecialchars($result['ocr_status'] ?? 'manual'); ?></p>
        <p class="mb-1">Confidence: <?= htmlspecialchars($result['ocr_confidence'] ?? '-'); ?>%</p>
        <?php if (!empty($result['ocr_error'])): ?>
            <p class="mb-0 text-danger"><?= htmlspecialchars($result['ocr_error']); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_results_show.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
