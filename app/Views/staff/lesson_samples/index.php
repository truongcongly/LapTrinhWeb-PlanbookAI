<?php

use App\Core\Auth;

$title       = 'Lesson Samples - PlanbookAI';
$currentUser = Auth::user();
$pageTitle   = 'Lesson Samples';
$pageDesc    = 'Quản lý giáo án mẫu theo môn học, khối lớp và trạng thái';
$role        = 'staff';

$filters = $filters ?? ['subject' => '', 'grade_level' => '', 'status' => ''];

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Lesson Samples</h3>
        <p>Danh sách giáo án mẫu (thêm, sửa, xóa) và lọc theo môn học / khối lớp / trạng thái.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Lesson Samples">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sách giáo án mẫu</h5>
        </div>
        <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/create" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle-fill me-2"></i>Thêm giáo án mẫu
        </a>
    </div>

    <!-- Filter form -->
    <form class="row g-3 align-items-end mb-4" method="GET" action="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples">
        <div class="col-lg-4">
            <label class="form-label fw-semibold">Môn học</label>
            <select class="form-select rounded-4" name="subject" id="filterSubject">
                <option value="">Tất cả môn</option>
                <?php foreach (($subjects ?? []) as $subject): ?>
                    <option value="<?= htmlspecialchars($subject); ?>" <?= (($filters['subject'] ?? '') === $subject) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($subject); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-lg-3">
            <label class="form-label fw-semibold">Khối lớp</label>
            <select class="form-select rounded-4" name="grade_level" id="filterGrade">
                <option value="">Tất cả khối</option>
                <?php foreach (($gradeLevels ?? []) as $grade): ?>
                    <option value="<?= htmlspecialchars($grade); ?>" <?= (($filters['grade_level'] ?? '') === $grade) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($grade); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-lg-3">
            <label class="form-label fw-semibold">Trạng thái</label>
            <select class="form-select rounded-4" name="status">
                <option value="" <?= (trim($filters['status'] ?? '') === '') ? 'selected' : ''; ?>>Tất cả</option>
                <option value="draft"     <?= (($filters['status'] ?? '') === 'draft')     ? 'selected' : ''; ?>>Draft</option>
                <option value="completed" <?= (($filters['status'] ?? '') === 'completed') ? 'selected' : ''; ?>>Completed</option>
            </select>
        </div>

        <div class="col-lg-2 d-grid">
            <button type="submit" class="btn btn-outline-primary rounded-pill">
                <i class="bi bi-funnel-fill me-1"></i>Lọc
            </button>
        </div>
    </form>

    <!-- Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Tổng giáo án</h6>
                <p class="mb-0"><strong><?= count($lessonSamples ?? []); ?></strong> giáo án mẫu.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Bản nháp</h6>
                <p class="mb-0">
                    <strong><?= count(array_filter($lessonSamples ?? [], fn($item) => ($item['status'] ?? '') === 'draft')); ?></strong>
                    giáo án ở trạng thái nháp.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="small-panel">
                <h6>Hoàn chỉnh</h6>
                <p class="mb-0">
                    <strong><?= count(array_filter($lessonSamples ?? [], fn($item) => ($item['status'] ?? '') === 'completed')); ?></strong>
                    giáo án đã hoàn thiện.
                </p>
            </div>
        </div>
    </div>

    <!-- Table -->
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
                <?php if (!empty($lessonSamples)): ?>
                    <?php foreach ($lessonSamples as $sample): ?>
                        <tr>
                            <td>#<?= $sample['id']; ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars(mb_strimwidth($sample['title'], 0, 60, '...')); ?></td>
                            <td><?= htmlspecialchars($sample['subject']); ?></td>
                            <td><?= htmlspecialchars($sample['grade_level']); ?></td>
                            <td>
                                <?php if (($sample['status'] ?? '') === 'completed'): ?>
                                    <span class="badge bg-success-subtle text-success">Completed</span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $sample['created_at'] ?? '-'; ?></td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/show?id=<?= $sample['id']; ?>"
                                   class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/edit?id=<?= $sample['id']; ?>"
                                   class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/delete?id=<?= $sample['id']; ?>"
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                   onclick="return confirmDelete()">
                                    <i class="bi bi-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No lesson samples" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary mb-2">Chưa có lesson sample nào.</div>
                            <a href="/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/create" class="btn btn-primary rounded-pill px-4">
                                Tạo lesson sample đầu tiên
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const subjectEl = document.getElementById('filterSubject');
    const gradeEl   = document.getElementById('filterGrade');
    const selectedGrade = "<?= htmlspecialchars($filters['grade_level'] ?? '', ENT_QUOTES); ?>";

    async function refreshGrades() {
        const subject = subjectEl.value || '';
        const url = new URL('/LapTrinhWeb-PlanbookAI/public/staff/lesson-samples/grade-levels', window.location.origin);
        if (subject) url.searchParams.set('subject', subject);

        try {
            const res  = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
            const data = await res.json();
            const levels = Array.isArray(data.grade_levels) ? data.grade_levels : [];

            gradeEl.innerHTML = '<option value="">Tất cả khối</option>';
            levels.forEach(g => {
                const opt = document.createElement('option');
                opt.value = g;
                opt.textContent = g;
                if (selectedGrade && selectedGrade === g) opt.selected = true;
                gradeEl.appendChild(opt);
            });
        } catch (e) {
            
        }
    }

    subjectEl.addEventListener('change', function () {
        gradeEl.value = '';
        refreshGrades();
    });

    if (subjectEl.value) {
        refreshGrades();
    }
});
</script>

<?php
$content  = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_lesson_samples_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';