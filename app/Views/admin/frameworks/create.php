<?php

use App\Core\Auth;

$title = 'Create Framework - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Framework';
$pageDesc = 'Tạo lesson plan template mới';
$role = 'admin';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tạo curriculum framework mới</h3>
        <p>Xây dựng template chuẩn cho giáo án và hoạt động giảng dạy.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Framework Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/admin/frameworks/store">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft">Draft</option>
                            <option value="active">Active</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Khối lớp</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="grade_level" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Objectives Template</label>
                        <textarea class="form-control rounded-4" name="objectives_template" rows="4"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Activities Template</label>
                        <textarea class="form-control rounded-4" name="activities_template" rows="5"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Assessment Template</label>
                        <textarea class="form-control rounded-4" name="assessment_template" rows="4"></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Lưu framework</button>
                    <a href="/LapTrinhWeb-PlanbookAI/public/admin/frameworks" class="btn btn-light border rounded-pill px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_frameworks_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';