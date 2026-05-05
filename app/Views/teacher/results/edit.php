<?php

use App\Core\Auth;

$title = 'Edit Result - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit Result';
$pageDesc = 'Them feedback va chinh sua ket qua';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chinh sua ket qua</h3>
        <p>Chen prompt feedback/rubric, tao nhan xet tu dong va dieu chinh diem neu can.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Result Feedback Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lai
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/results/update?id=<?= $result['id']; ?>">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ten hoc sinh</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="student_name" value="<?= htmlspecialchars($result['student_name']); ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Diem</label>
                        <input type="number" step="0.01" min="0" max="10" class="form-control form-control-lg rounded-4" name="score" value="<?= htmlspecialchars($result['score']); ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Trang thai</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="auto_graded" <?= ($result['status'] === 'auto_graded') ? 'selected' : ''; ?>>Auto Graded</option>
                            <option value="needs_review" <?= ($result['status'] === 'needs_review') ? 'selected' : ''; ?>>Needs Review</option>
                            <option value="reviewed" <?= ($result['status'] === 'reviewed') ? 'selected' : ''; ?>>Reviewed</option>
                            <option value="failed" <?= ($result['status'] === 'failed') ? 'selected' : ''; ?>>Failed</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Feedback</label>
                        <textarea class="form-control rounded-4" name="feedback" rows="8" placeholder="Nhap nhan xet cho hoc sinh..."><?= htmlspecialchars($result['feedback'] ?? ''); ?></textarea>
                        <?php if (!empty($generatedFeedback)): ?>
                            <textarea class="d-none" id="generated-feedback"><?= htmlspecialchars($generatedFeedback); ?></textarea>
                            <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 mt-2" id="insert-generated-feedback">
                                <i class="bi bi-magic me-1"></i>Chen feedback tu dong
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check-circle-fill me-2"></i>Cap nhat ket qua
                    </button>

                    <button type="submit" formaction="/LapTrinhWeb-PlanbookAI/public/teacher/results/generate-feedback?id=<?= $result['id']; ?>" class="btn btn-outline-success rounded-pill px-4">
                        <i class="bi bi-stars me-2"></i>Tao feedback va luu
                    </button>

                    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results" class="btn btn-light border rounded-pill px-4">
                        Huy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(() => {
    const button = document.getElementById('insert-generated-feedback');
    const generated = document.getElementById('generated-feedback');
    const feedback = document.querySelector('textarea[name="feedback"]');

    if (!button || !generated || !feedback) return;

    button.addEventListener('click', () => {
        feedback.value = feedback.value.trim()
            ? feedback.value.replace(/\s*$/, '\n\n') + generated.value.trim()
            : generated.value.trim();
        feedback.focus();
    });
})();
</script>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_results_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
