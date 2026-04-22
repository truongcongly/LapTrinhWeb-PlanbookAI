<?php

use App\Core\Auth;

$title = 'Lesson Plans - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Lesson Plans';
$pageDesc = 'Quản lý giáo án cá nhân của giáo viên';
$role = 'teacher';

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Lesson Plans</h3>
        <p>Tạo, chỉnh sửa và theo dõi giáo án theo từng môn học, khối lớp và trạng thái hoàn thiện.</p>
    </div>
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sách giáo án</h5>
            <small class="text-secondary">Tất cả lesson plans của bạn</small>
        </div>

        <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/create" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle-fill me-2"></i>Tạo giáo án mới
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Tổng giáo án</h6>
                <p class="mb-0">
                    <strong><?= count($lessonPlans ?? []); ?></strong> lesson plan đã tạo.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Bản nháp</h6>
                <p class="mb-0">
                    <strong>
                        <?= count(array_filter($lessonPlans ?? [], fn($item) => ($item['status'] ?? '') === 'draft')); ?>
                    </strong> lesson plan ở trạng thái draft.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-panel">
                <h6>Hoàn chỉnh</h6>
                <p class="mb-0">
                    <strong>
                        <?= count(array_filter($lessonPlans ?? [], fn($item) => ($item['status'] ?? '') === 'completed')); ?>
                    </strong> lesson plan đã hoàn thiện.
                </p>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Môn học</th>
                    <th>Khối lớp</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lessonPlans)): ?>
                    <?php foreach ($lessonPlans as $lessonPlan): ?>
                        <tr>
                            <td>#<?= $lessonPlan['id']; ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars($lessonPlan['title']); ?></td>
                            <td><?= htmlspecialchars($lessonPlan['subject']); ?></td>
                            <td><?= htmlspecialchars($lessonPlan['grade_level']); ?></td>
                            <td>
                                <?php if (($lessonPlan['status'] ?? '') === 'completed'): ?>
                                    <span class="badge bg-success-subtle text-success">Completed</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $lessonPlan['created_at'] ?? '-'; ?></td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/show?id=<?= $lessonPlan['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/edit?id=<?= $lessonPlan['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/delete?id=<?= $lessonPlan['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">
                                    <i class="bi bi-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No lesson plans" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary mb-2">Bạn chưa có lesson plan nào.</div>
                            <a href="/LapTrinhWeb-PlanbookAI/public/teacher/lesson-plans/create" class="btn btn-primary rounded-pill px-4">
                                Tạo lesson plan đầu tiên
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/teacher_lesson_plans_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';