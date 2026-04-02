<?php
use App\Core\Auth;

$title = 'Teacher Dashboard';
$currentUser = Auth::user();
$pageTitle = 'Teacher Dashboard';
$pageDesc = 'Khu vực làm việc của giáo viên';

include __DIR__ . '/../layouts/head.php';
$role = 'teacher';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-panel">
    <?php include __DIR__ . '/../layouts/topbar.php'; ?>

    <div class="page-body">
        <div class="row g-4">
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card bg-soft-primary">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Lesson plans</div>
                            <h3 class="mt-2 mb-1">08</h3>
                            <div class="small text-primary">Bản nháp và hoàn chỉnh</div>
                        </div>
                        <div class="icon-box icon-primary">
                            <i class="bi bi-journal-bookmark"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card stat-card bg-soft-success">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Question bank</div>
                            <h3 class="mt-2 mb-1">120</h3>
                            <div class="small text-success">Theo chủ đề, độ khó</div>
                        </div>
                        <div class="icon-box icon-success">
                            <i class="bi bi-collection"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card stat-card bg-soft-warning">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Exercises</div>
                            <h3 class="mt-2 mb-1">18</h3>
                            <div class="small text-warning">Bài tập đã tạo</div>
                        </div>
                        <div class="icon-box icon-warning">
                            <i class="bi bi-ui-checks-grid"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card stat-card bg-soft-info">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Exams</div>
                            <h3 class="mt-2 mb-1">06</h3>
                            <div class="small text-info">Đề kiểm tra đã lưu</div>
                        </div>
                        <div class="icon-box icon-info">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card panel-card mt-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Thao tác nhanh</h5>
                <a class="quick-link" href="#"><i class="bi bi-plus-circle"></i> Tạo giáo án mới</a>
                <a class="quick-link" href="#"><i class="bi bi-patch-plus"></i> Thêm câu hỏi</a>
                <a class="quick-link" href="#"><i class="bi bi-file-plus"></i> Tạo đề kiểm tra</a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>