<?php
use App\Core\Auth;

$title = 'Create Prompt Template - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Prompt Template';
$pageDesc = 'Tạo prompt mẫu mới';
$role = 'staff';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tạo prompt template mới</h3>
        <p>Xây dựng prompt mẫu để phục vụ các tác vụ AI trong hệ thống.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Prompt Template Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/staff/prompts/store">
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
                            <option value="archived">Archived</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Category</label>
                        <select class="form-select form-select-lg rounded-4" name="category" required>
                            <option value="lesson_plan">Lesson Plan</option>
                            <option value="exercise">Exercise</option>
                            <option value="exam">Exam</option>
                            <option value="feedback">Feedback</option>
                            <option value="grading">Grading</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control rounded-4" name="description" rows="3"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Prompt Content</label>
                        <textarea class="form-control rounded-4" name="prompt_content" rows="10" required></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Lưu prompt</button>
                    <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts" class="btn btn-light border rounded-pill px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_prompts_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';