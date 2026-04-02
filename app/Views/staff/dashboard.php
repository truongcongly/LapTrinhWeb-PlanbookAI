<?php
use App\Core\Auth;

$title = 'Staff Dashboard';
$currentUser = Auth::user();
$pageTitle = 'Staff Dashboard';
$pageDesc = 'Quản lý nội dung mẫu và hỗ trợ dữ liệu học liệu';

include __DIR__ . '/../layouts/head.php';
$role = 'staff';
include __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-panel">
    <?php include __DIR__ . '/../layouts/topbar.php'; ?>

    <div class="page-body">
        <div class="row g-4">
            <div class="col-md-6 col-xl-4">
                <div class="card stat-card bg-soft-warning">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Lesson samples</div>
                            <h3 class="mt-2 mb-1">12</h3>
                            <div class="small text-warning">Mẫu nội dung đang có</div>
                        </div>
                        <div class="icon-box icon-warning">
                            <i class="bi bi-journal-text"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card stat-card bg-soft-info">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Question samples</div>
                            <h3 class="mt-2 mb-1">45</h3>
                            <div class="small text-info">Câu hỏi mẫu sẵn dùng</div>
                        </div>
                        <div class="icon-box icon-info">
                            <i class="bi bi-patch-question"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card stat-card bg-soft-success">
                    <div class="card-body d-flex justify-content-between align-items-start">
                        <div>
                            <div class="text-secondary small">Support status</div>
                            <h3 class="mt-2 mb-1">Ready</h3>
                            <div class="small text-success">Sẵn sàng hỗ trợ giáo viên</div>
                        </div>
                        <div class="icon-box icon-success">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card panel-card mt-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Thao tác nhanh</h5>
                <a class="quick-link" href="#"><i class="bi bi-plus-circle"></i> Tạo giáo án mẫu</a>
                <a class="quick-link" href="#"><i class="bi bi-plus-square"></i> Tạo câu hỏi mẫu</a>
                <a class="quick-link" href="#"><i class="bi bi-collection"></i> Xem thư viện mẫu</a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>