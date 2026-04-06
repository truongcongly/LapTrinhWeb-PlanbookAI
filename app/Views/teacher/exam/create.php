<?php include __DIR__ . '/../../layouts/app.php'; ?>

<div class="container mt-4">
    <h2>Tạo đề thi mới</h2>
    <form method="POST" action="/LAPTRINHWEB-PLANBOOKAI/public/teacher/exams/store" id="examForm">
        <div class="card mb-3">
            <div class="card-header">Thông tin đề thi</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Tiêu đề đề thi</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Môn học</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Thời gian làm bài (phút)</label>
                    <input type="number" name="duration_minutes" class="form-control" value="45" required>
                </div>
            </div>
        </div>

        <div id="questions-container"></div>

        <button type="button" class="btn btn-secondary mb-3" onclick="addQuestion()">+ Thêm câu hỏi</button>
        <br>
        <button type="submit" class="btn btn-primary">Lưu đề thi</button>
    </form>
</div>

<script>
let questionCount = 0;

function addQuestion() {
    questionCount++;
    const i = questionCount - 1;
    const html = `
    <div class="card mb-3">
        <div class="card-header">Câu hỏi ${questionCount}</div>
        <div class="card-body">
            <div class="mb-2">
                <label>Nội dung câu hỏi</label>
                <input type="text" name="questions[${i}][question_text]" class="form-control" required>
            </div>
            <div class="mb-2"><label>Đáp án A</label>
                <input type="text" name="questions[${i}][option_a]" class="form-control" required>
            </div>
            <div class="mb-2"><label>Đáp án B</label>
                <input type="text" name="questions[${i}][option_b]" class="form-control" required>
            </div>
            <div class="mb-2"><label>Đáp án C</label>
                <input type="text" name="questions[${i}][option_c]" class="form-control" required>
            </div>
            <div class="mb-2"><label>Đáp án D</label>
                <input type="text" name="questions[${i}][option_d]" class="form-control" required>
            </div>
            <div class="mb-2"><label>Đáp án đúng (A/B/C/D)</label>
                <select name="questions[${i}][correct_answer]" class="form-control">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
        </div>
    </div>`;
    document.getElementById('questions-container').insertAdjacentHTML('beforeend', html);
}

// Tự động thêm 1 câu hỏi khi vào trang
addQuestion();
</script>