<?php

use App\Core\Auth;

$title = 'Create Grading Session - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Grading Session';
$pageDesc = 'Nhap du lieu bai lam de he thong cham tu dong va review OCR';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tao phien cham bai</h3>
        <p>Chon de thi, nhap dap an nhan dien hoac upload file scan de review va tinh diem.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-10">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Grading Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lai
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/teacher/grading/store" enctype="multipart/form-data">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Chon de thi</label>
                        <select class="form-select form-select-lg rounded-4" name="exam_id" required>
                            <option value="">-- Chon de thi --</option>
                            <?php foreach (($exams ?? []) as $exam): ?>
                                <option value="<?= $exam['id']; ?>">
                                    <?= htmlspecialchars($exam['title']); ?> - <?= htmlspecialchars($exam['subject']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ten hoc sinh</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="student_name" placeholder="Nhap ten hoc sinh" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Dap an nhan dien</label>
                        <textarea class="form-control rounded-4" name="scanned_answers" rows="5" placeholder="Vi du: A,B,C,D,A,B hoac 1.A 2.B 3.C"></textarea>
                        <small class="text-secondary">Co the de trong neu chi upload file scan va muon review thu cong. He thong se tao chi tiet can review theo answer key.</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">File scan bai lam</label>
                        <input type="file" class="form-control form-control-lg rounded-4" name="scan_file" accept=".jpg,.jpeg,.png,.webp,.pdf">
                        <small class="text-secondary">File scan duoc luu de giao vien doi chieu trong man Review OCR.</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Ghi chu rubric / cham bai</label>
                        <textarea class="form-control rounded-4" name="grading_note" rows="4" placeholder="Chen rubric grading tu staff neu can..."></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-check2-square me-2"></i>Auto Grade
                    </button>

                    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading" class="btn btn-light border rounded-pill px-4">
                        Huy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_grading_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
