<?php

use App\Core\Auth;

$title = 'Edit Prompt Template - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Edit Prompt Template';
$pageDesc = 'Chỉnh sửa prompt template';
$role = 'staff';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Chỉnh sửa prompt template</h3>
        <p>Cập nhật category, nội dung và trạng thái của prompt mẫu.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Edit Prompt Template Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts" class="btn btn-outline-secondary rounded-pill px-4">Quay lại</a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/staff/prompts/update?id=<?= $prompt['id']; ?>">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Tiêu đề</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="title" value="<?= htmlspecialchars($prompt['title']); ?>" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select class="form-select form-select-lg rounded-4" name="status" required>
                            <option value="draft" <?= ($prompt['status']==='draft')?'selected':''; ?>>Draft</option>
                            <option value="active" <?= ($prompt['status']==='active')?'selected':''; ?>>Active</option>
                            <option value="archived" <?= ($prompt['status']==='archived')?'selected':''; ?>>Archived</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Category</label>
                        <select class="form-select form-select-lg rounded-4 prompt-category-select" name="category" required>
                            <option value="lesson_plan" <?= ($prompt['category']==='lesson_plan')?'selected':''; ?>>Lesson Plan</option>
                            <option value="question_bank" <?= ($prompt['category']==='question_bank')?'selected':''; ?>>Question Bank</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <div class="alert alert-light border rounded-4 mb-0 prompt-category-guide" data-category-guide="lesson_plan">
                            <div class="fw-semibold mb-2">Form Lesson Plan sẽ dùng các trường:</div>
                            <div class="text-secondary">Tiêu đề giáo án, Môn học, Khối lớp, Objectives, Activities, Assessment.</div>
                            <div class="small text-secondary mt-2">Prompt nên hướng AI sinh nội dung theo đúng 3 phần: Objectives, Activities và Assessment để teacher chèn vào form giáo án.</div>
                        </div>
                        <div class="alert alert-light border rounded-4 mb-0 prompt-category-guide d-none" data-category-guide="question_bank">
                            <div class="fw-semibold mb-2">Form Question Bank sẽ dùng các trường:</div>
                            <div class="text-secondary">Môn học, Chủ đề, Độ khó, Đáp án đúng, Nội dung câu hỏi, Option A, Option B, Option C, Option D.</div>
                            <div class="small text-secondary mt-2">Prompt nên yêu cầu AI tạo câu hỏi trắc nghiệm có 4 lựa chọn và chỉ rõ đáp án đúng.</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control rounded-4 prompt-description-input" name="description" rows="3"><?= htmlspecialchars($prompt['description']); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Prompt Content</label>
                        <textarea class="form-control rounded-4 prompt-content-input" name="prompt_content" rows="10" required><?= htmlspecialchars($prompt['prompt_content']); ?></textarea>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Cập nhật prompt</button>
                    <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts" class="btn btn-light border rounded-pill px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const categorySelect = document.querySelector('.prompt-category-select');
    const descriptionInput = document.querySelector('.prompt-description-input');
    const promptInput = document.querySelector('.prompt-content-input');
    const guides = document.querySelectorAll('.prompt-category-guide');

    const defaults = {
        lesson_plan: {
            description: 'Prompt hỗ trợ teacher tạo giáo án theo môn học, khối lớp, mục tiêu, hoạt động và đánh giá.',
            prompt: `Bạn là trợ lý giáo dục hỗ trợ soạn giáo án.

Hãy tạo nội dung lesson plan theo đúng cấu trúc dưới đây:

Objectives:
- Nêu mục tiêu kiến thức, kỹ năng và thái độ/năng lực học sinh cần đạt.

Activities:
- Thiết kế hoạt động dạy học theo trình tự rõ ràng.
- Gợi ý thời lượng, cách tổ chức lớp và nhiệm vụ của học sinh.

Assessment:
- Đề xuất hình thức đánh giá phù hợp với mục tiêu bài học.
- Có thể gồm câu hỏi kiểm tra nhanh, bài tập về nhà hoặc tiêu chí quan sát.

Thông tin đầu vào teacher sẽ cung cấp:
- Tiêu đề giáo án
- Môn học
- Khối lớp`
        },
        question_bank: {
            description: 'Prompt hỗ trợ teacher tạo câu hỏi trắc nghiệm theo môn học, chủ đề, độ khó và đáp án đúng.',
            prompt: `Bạn là trợ lý giáo dục hỗ trợ tạo câu hỏi trắc nghiệm.

Hãy tạo một câu hỏi theo đúng cấu trúc dưới đây:

Nội dung câu hỏi:

Option A:

Option B:

Option C:

Option D:

Đáp án đúng:

Yêu cầu:
- Câu hỏi phải phù hợp với môn học, chủ đề và độ khó teacher cung cấp.
- Chỉ có một đáp án đúng.
- Các phương án nhiễu phải hợp lý và không quá dễ loại trừ.`
        }
    };

    function syncCategory(fillEmptyFields = false) {
        const category = categorySelect.value;
        guides.forEach((guide) => {
            guide.classList.toggle('d-none', guide.dataset.categoryGuide !== category);
        });

        if (!fillEmptyFields || !defaults[category]) return;

        if (!descriptionInput.value.trim()) {
            descriptionInput.value = defaults[category].description;
        }

        if (!promptInput.value.trim()) {
            promptInput.value = defaults[category].prompt;
        }
    }

    categorySelect.addEventListener('change', () => syncCategory(true));
    syncCategory(false);
});
</script>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_prompts_edit.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
