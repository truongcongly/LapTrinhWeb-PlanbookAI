<?php include __DIR__ . '/../../layouts/app.php'; ?>

<div class="container mt-4">
    <h2><?= htmlspecialchars($exam['title']) ?></h2>
    <p><strong>Môn:</strong> <?= $exam['subject'] ?> | <strong>Thời gian:</strong> <?= $exam['duration_minutes'] ?> phút</p>
    <hr>
    <h5>Danh sách câu hỏi</h5>
    <?php foreach ($questions as $i => $q): ?>
    <div class="card mb-2">
        <div class="card-body">
            <p><strong>Câu <?= $i+1 ?>:</strong> <?= htmlspecialchars($q['question_text']) ?></p>
            <p>A. <?= $q['option_a'] ?> &nbsp; B. <?= $q['option_b'] ?> &nbsp; C. <?= $q['option_c'] ?> &nbsp; D. <?= $q['option_d'] ?></p>
            <p class="text-success"><strong>Đáp án đúng: <?= $q['correct_answer'] ?></strong></p>
        </div>
    </div>
    <?php endforeach; ?>
    <a href="/LAPTRINHWEB-PLANBOOKAI/public/teacher/exams" class="btn btn-secondary mt-2">← Quay lại</a>
</div>