<?php include __DIR__ . '/head.php'; ?>
<div class="dashboard-shell">
    <?php include __DIR__ . '/sidebar.php'; ?>

    <main class="main-panel">
        <?php include __DIR__ . '/topbar.php'; ?>

        <div class="page-content">
            <?php include $contentView; ?>
        </div>
    </main>
</div>
<?php include __DIR__ . '/footer.php'; ?>