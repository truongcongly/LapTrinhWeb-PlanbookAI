<?php include __DIR__ . '/../../layouts/app.php'; ?>

<div class="container mt-4">
    <h2>Kết quả: <?= htmlspecialchars($exam['title']) ?></h2>
    <?php if (empty($results)): ?>
        <div class="alert alert-info">Chưa có kết quả nào.</div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tên học sinh</th>
                    <th>Điểm</th>
                    <th>Thời gian nộp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $i => $r): ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= htmlspecialchars($r['student_name']) ?></td>
                    <td><strong><?= $r['score'] ?>/10</strong></td>
                    <td><?= $r['submitted_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <a href="/LAPTRINHWEB-PLANBOOKAI/public/teacher/exams" class="btn btn-secondary">← Quay lại</a>
</div>