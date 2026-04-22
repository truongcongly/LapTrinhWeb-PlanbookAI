<?php

use App\Core\Auth;

$title = 'Edit Framework - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit Framework';
$pageDesc = 'Chỉnh sửa curriculum framework';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chỉnh sửa framework</h3>
        <p>Cập nhật template objectives, activities và assessment.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Edit Framework Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/frameworks/update?id=<?= $framework['id']; ?>">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" value="<?= htmlspecialchars($framework['title']); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft" <?= ($framework['status']==='draft')?'selected':''; ?>>Draft</option>
                            <option value="active" <?= ($framework['status']==='active')?'selected':''; ?>>Active</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" value="<?= htmlspecialchars($framework['subject']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Khối lớp</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="grade_level" value="<?= htmlspecialchars($framework['grade_level']); ?>" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Objectives Template</label>
                        <textarea class="form-control rounded-4" name="objectives_template" rows="4"><?= htmlspecialchars($framework['objectives_template']); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Activities Template</label>
                        <textarea class="form-control rounded-4" name="activities_template" rows="5"><?= htmlspecialchars($framework['activities_template']); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Assessment Template</label>
                        <textarea class="form-control rounded-4" name="assessment_template" rows="4"><?= htmlspecialchars($framework['assessment_template']); ?></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Cập nhật</button>
                    <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks" class="btn btn-light border rounded-pill px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_frameworks_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';