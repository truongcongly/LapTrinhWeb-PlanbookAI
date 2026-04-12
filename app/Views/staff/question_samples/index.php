<?php

use App\Core\Auth;

$title = 'Question Bank Sample - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Question Bank Sample';
$pageDesc = 'Quản lý ngân hàng câu hỏi mẫu theo môn học, chủ đề và độ khó';
$role = 'staff';

$filters = $filters ?? ['subject' => '', 'topic' => '', 'difficulty' => ''];

ob_start();
?>

<div class="hero-mini-banner mb-4">
    <div>
        <h3>Question Bank Sample</h3>
        <p>Danh sách câu hỏi mẫu (thêm, sửa, xóa) và lọc theo môn/chủ đề/độ khó.</p>
    </div>
    <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Question Samples">
</div>

<div class="dashboard-card">
    <div class="card-header-custom">
        <div>
            <h5>Danh sách câu hỏi mẫu</h5>
        </div>

        <a href="/LapTrinhWeb-PlanbookAI/public/staff/question-samples/create" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle-fill me-2"></i>Thêm câu hỏi mẫu
        </a>
    </div>

    <form class="row g-3 align-items-end mb-4" method="GET" action="/LapTrinhWeb-PlanbookAI/public/staff/question-samples">
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

        <div class="col-lg-4">
            <label class="form-label fw-semibold">Chủ đề</label>
            <select class="form-select rounded-4" name="topic" id="filterTopic">
                <option value="">Tất cả chủ đề</option>
                <?php foreach (($topics ?? []) as $topic): ?>
                    <option value="<?= htmlspecialchars($topic); ?>" <?= (($filters['topic'] ?? '') === $topic) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($topic); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-lg-3">
            <label class="form-label fw-semibold">Độ khó</label>
            <select class="form-select rounded-4" name="difficulty">
                <option value="" <?= (trim($filters['difficulty'] ?? '') === '') ? 'selected' : ''; ?>>Tất cả</option>
                <option value="easy" <?= (($filters['difficulty'] ?? '') === 'easy') ? 'selected' : ''; ?>>Easy</option>
                <option value="medium" <?= (($filters['difficulty'] ?? '') === 'medium') ? 'selected' : ''; ?>>Medium</option>
                <option value="hard" <?= (($filters['difficulty'] ?? '') === 'hard') ? 'selected' : ''; ?>>Hard</option>
            </select>
        </div>

        <div class="col-lg-1 d-grid">
            <button type="submit" class="btn btn-outline-primary rounded-pill">Lọc</button>
        </div>
    </form>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="small-panel">
                <h6>Tổng câu hỏi</h6>
                <p class="mb-0"><strong><?= count($questions ?? []); ?></strong> câu hỏi.</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="small-panel">
                <h6>Easy</h6>
                <p class="mb-0"><strong><?= count(array_filter($questions ?? [], fn($item) => ($item['difficulty'] ?? '') === 'easy')); ?></strong> câu hỏi dễ.</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="small-panel">
                <h6>Medium</h6>
                <p class="mb-0"><strong><?= count(array_filter($questions ?? [], fn($item) => ($item['difficulty'] ?? '') === 'medium')); ?></strong> câu hỏi trung bình.</p>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="small-panel">
                <h6>Hard</h6>
                <p class="mb-0"><strong><?= count(array_filter($questions ?? [], fn($item) => ($item['difficulty'] ?? '') === 'hard')); ?></strong> câu hỏi khó.</p>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nội dung câu hỏi</th>
                    <th>Môn học</th>
                    <th>Chủ đề</th>
                    <th>Độ khó</th>
                    <th>Đáp án</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($questions)): ?>
                    <?php foreach ($questions as $question): ?>
                        <tr>
                            <td>#<?= $question['id']; ?></td>
                            <td class="fw-semibold"><?= htmlspecialchars(mb_strimwidth($question['question_text'], 0, 60, '...')); ?></td>
                            <td><?= htmlspecialchars($question['subject']); ?></td>
                            <td><?= htmlspecialchars($question['topic']); ?></td>
                            <td>
                                <?php
                                    $difficulty = $question['difficulty'] ?? 'medium';
                                    if ($difficulty === 'easy') {
                                        echo '<span class="badge bg-success-subtle text-success">Easy</span>';
                                    } elseif ($difficulty === 'hard') {
                                        echo '<span class="badge bg-danger-subtle text-danger">Hard</span>';
                                    } else {
                                        echo '<span class="badge bg-warning-subtle text-warning">Medium</span>';
                                    }
                                ?>
                            </td>
                            <td><?= htmlspecialchars($question['correct_answer'] ?? '-'); ?></td>
                            <td class="text-center">
                                <a href="/LapTrinhWeb-PlanbookAI/public/staff/question-samples/edit?id=<?= $question['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <a href="/LapTrinhWeb-PlanbookAI/public/staff/question-samples/delete?id=<?= $question['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">
                                    <i class="bi bi-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <img src="/LapTrinhWeb-PlanbookAI/public/images/empty-state.svg" alt="No questions" style="max-width: 160px;" class="mb-3">
                            <div class="text-secondary mb-2">Chưa có câu hỏi mẫu nào.</div>
                            <a href="/LapTrinhWeb-PlanbookAI/public/staff/question-samples/create" class="btn btn-primary rounded-pill px-4">
                                Tạo câu hỏi mẫu đầu tiên
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
    const topicEl = document.getElementById('filterTopic');
    const selectedTopic = "<?= htmlspecialchars($filters['topic'] ?? '', ENT_QUOTES); ?>";

    async function refreshTopics() {
        const subject = subjectEl.value || '';
        const url = new URL('/LapTrinhWeb-PlanbookAI/public/staff/question-samples/topics', window.location.origin);
        if (subject) url.searchParams.set('subject', subject);

        try {
            const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' }});
            const data = await res.json();
            const topics = Array.isArray(data.topics) ? data.topics : [];

            topicEl.innerHTML = '<option value="">Tất cả chủ đề</option>';
            topics.forEach(t => {
                const opt = document.createElement('option');
                opt.value = t;
                opt.textContent = t;
                if (selectedTopic && selectedTopic === t) opt.selected = true;
                topicEl.appendChild(opt);
            });
        } catch (e) {
            // Nếu lỗi, giữ nguyên options server-rendered
        }
    }

    subjectEl.addEventListener('change', function () {
        topicEl.value = '';
        refreshTopics();
    });

    // Nếu đang chọn môn, đảm bảo topic list đúng theo môn
    if (subjectEl.value) {
        refreshTopics();
    }
});
</script>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_question_samples_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
