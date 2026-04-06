<?php include __DIR__ . '/../../layouts/app.php'; ?>

<div class="container mt-4">
    <h2>Chấm điểm: <?= htmlspecialchars($exam['title']) ?></h2>
    <form method="POST" action="/LAPTRINHWEB-PLANBOOKAI/public/teacher/grading/<?= $exam['id'] ?>/grade">
        <div class="mb-3">
            <label>Tên học sinh</label>
            <input type="text" name="student_name" class="form-control" required>
        </div>
        <h5>Nhập đáp án học sinh</h5>
        <?php foreach ($questions as $i => $q): ?>
        <div class="card mb-2">
            <div class="card-body">
                <p><strong>Câu <?= $i+1 ?>:</strong> <?= htmlspecialchars($q['question_text']) ?></p>
                <select name="answers[<?= $i ?>]" class="form-control">
                    <option value="">-- Chọn --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
        </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-success mt-3">Chấm điểm</button>
    </form>
</div>