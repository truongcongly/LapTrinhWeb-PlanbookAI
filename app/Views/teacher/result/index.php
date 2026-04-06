<?php

$title = 'Kết quả';
$role = 'teacher';

ob_start();
?>

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
    <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams" class="btn btn-secondary">← Quay lại</a>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_result_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';