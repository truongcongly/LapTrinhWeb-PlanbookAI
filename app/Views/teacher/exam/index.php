<?php

$title = 'Danh sách đề thi';
$role = 'teacher';

ob_start();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách đề thi</h2>
        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/create" class="btn btn-primary">+ Tạo đề thi</a>
    </div>

    <?php if (empty($exams)): ?>
        <div class="alert alert-info">Chưa có đề thi nào.</div>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Môn học</th>
                    <th>Thời gian</th>
                    <th>Số câu</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exams as $i => $exam): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($exam['title']) ?></td>
                    <td><?= htmlspecialchars($exam['subject']) ?></td>
                    <td><?= $exam['duration_minutes'] ?> phút</td>
                    <td><?= $exam['total_questions'] ?> câu</td>
                    <td><?= $exam['created_at'] ?></td>
                    <td>
                        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/<?= $exam['id'] ?>" class="btn btn-sm btn-info">Xem</a>
                        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/grading/<?= $exam['id'] ?>" class="btn btn-sm btn-success">Chấm điểm</a>
                        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/results/<?= $exam['id'] ?>" class="btn btn-sm btn-warning">Kết quả</a>
                        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/exams/delete/<?= $exam['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa đề thi này?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_exam_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';