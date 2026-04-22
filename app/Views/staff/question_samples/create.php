<?php

use App\Core\Auth;

$title = 'Create Question Sample - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Create Question Sample';
$pageDesc = 'Thêm câu hỏi mẫu vào Question Bank Sample';
$role = 'staff';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Tạo câu hỏi mẫu mới</h3>
        <p>Chọn môn học, chủ đề, độ khó và đáp án chính xác.</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-11">
        <div class="dashboard-card">
            <div class="card-header-custom">
                <h5>Question Sample Form</h5>
                <a href="/LapTrinhWeb-PlanbookAI/public/staff/question-samples" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
            </div>

            <form method="POST" action="/LapTrinhWeb-PlanbookAI/public/staff/question-samples/store">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Môn học</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="subject" id="subjectInput" list="subjectList" placeholder="Ví dụ: Math" required>
                        <datalist id="subjectList">
                            <?php foreach (($subjects ?? []) as $subject): ?>
                                <option value="<?= htmlspecialchars($subject); ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Chủ đề</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="topic" id="topicInput" list="topicList" placeholder="Ví dụ: Algebra" required>
                        <datalist id="topicList">
                            <?php foreach (($topics ?? []) as $topic): ?>
                                <option value="<?= htmlspecialchars($topic); ?>"></option>
                            <?php endforeach; ?>
                        </datalist>
                        <small class="text-secondary">Khi chọn môn, danh sách chủ đề sẽ tự cập nhật theo môn đó.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Độ khó</label>
                        <select class="form-select form-select-lg rounded-4" name="difficulty" required>
                            <option value="easy">Easy</option>
                            <option value="medium" selected>Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Đáp án đúng</label>
                        <select class="form-select form-select-lg rounded-4" name="correct_answer" required>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Nội dung câu hỏi</label>
                        <textarea class="form-control rounded-4" name="question_text" rows="4" placeholder="Nhập nội dung câu hỏi..." required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option A</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_a" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option B</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_b" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option C</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_c" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Option D</label>
                        <input type="text" class="form-control form-control-lg rounded-4" name="option_d" required>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save-fill me-2"></i>Lưu câu hỏi mẫu
                    </button>

                    <a href="/LapTrinhWeb-PlanbookAI/public/staff/question-samples" class="btn btn-light border rounded-pill px-4">
                        Hủy
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const subjectInput = document.getElementById('subjectInput');
    const topicList = document.getElementById('topicList');

    async function refreshTopicDatalist() {
        const subject = (subjectInput.value || '').trim();
        const url = new URL('/LapTrinhWeb-PlanbookAI/public/staff/question-samples/topics', window.location.origin);
        if (subject) url.searchParams.set('subject', subject);

        try {
            const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' }});
            const data = await res.json();
            const topics = Array.isArray(data.topics) ? data.topics : [];

            topicList.innerHTML = '';
            topics.forEach(t => {
                const opt = document.createElement('option');
                opt.value = t;
                topicList.appendChild(opt);
            });
        } catch (e) {
            // Nếu lỗi, giữ nguyên server-rendered datalist
        }
    }

    subjectInput.addEventListener('change', refreshTopicDatalist);
    subjectInput.addEventListener('blur', refreshTopicDatalist);
});
</script>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_question_samples_create.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
