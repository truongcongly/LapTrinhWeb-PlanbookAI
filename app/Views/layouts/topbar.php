<div class="topbar">
    <div>
        <h4 class="topbar-title"><?= $pageTitle ?? 'Dashboard'; ?></h4>
        <div class="topbar-subtitle"><?= $pageDesc ?? 'Welcome to PlanbookAI'; ?></div>
    </div>

    <div class="topbar-right">
        <button class="icon-btn">
            <i class="bi bi-bell"></i>
        </button>

        <div class="user-chip">
            <div class="user-avatar">
                <i class="bi bi-person-fill"></i>
            </div>
            <div>
                <div class="user-name"><?= $currentUser['name'] ?? 'User'; ?></div>
                <div class="user-email"><?= $currentUser['email'] ?? ''; ?></div>
            </div>
        </div>
    </div>
</div>