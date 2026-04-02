<div class="topbar">
    <div>
        <h4 class="mb-1"><?= $pageTitle ?? 'Dashboard'; ?></h4>
        <div class="text-secondary small"><?= $pageDesc ?? 'Trang quản trị hệ thống'; ?></div>
    </div>

    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light rounded-circle">
            <i class="bi bi-bell"></i>
        </button>

        <div class="text-end">
            <div class="fw-semibold"><?= $currentUser['name'] ?? 'User'; ?></div>
            <div class="small text-secondary"><?= $currentUser['email'] ?? ''; ?></div>
        </div>
    </div>
</div>