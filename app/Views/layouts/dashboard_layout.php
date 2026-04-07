<?php include __DIR__ . '/head.php'; ?>
<div class="dashboard-shell">
    <?php include __DIR__ . '/sidebar.php'; ?>

    <main class="main-panel">
        <?php include __DIR__ . '/topbar.php'; ?>

        <div class="page-content">
            <?php if (\App\Core\Session::hasFlash('success')): ?>
                <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
                    <?= \App\Core\Session::getFlash('success'); ?>
                </div>
            <?php endif; ?>

            <?php if (\App\Core\Session::hasFlash('error')): ?>
                <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">
                    <?= \App\Core\Session::getFlash('error'); ?>
                </div>
            <?php endif; ?>

            <?php include $contentView; ?>
        </div>
    </main>
</div>
<?php include __DIR__ . '/footer.php'; ?>