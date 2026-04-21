<?php
$title = $title ?? 'PlanbookAI';
$currentPage = $currentPage ?? 'home';
$extraStylesheets = $extraStylesheets ?? [
    '/LapTrinhWeb-PlanbookAI/public/css/home-modern.css?v=20260422-crisp-images',
];
$extraHeadTags = $extraHeadTags ?? <<<HTML
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0..1,0&display=swap" rel="stylesheet">
HTML;
$marketingPages = [
    'home' => ['label' => 'Trang chủ', 'href' => '/LapTrinhWeb-PlanbookAI/public/'],
    'teacher' => ['label' => 'Giáo viên', 'href' => '/LapTrinhWeb-PlanbookAI/public/giao-vien'],
    'school' => ['label' => 'Trường học', 'href' => '/LapTrinhWeb-PlanbookAI/public/truong-hoc'],
    'pricing' => ['label' => 'Bảng giá', 'href' => '/LapTrinhWeb-PlanbookAI/public/bang-gia'],
    'mobile' => ['label' => 'Ứng dụng di động', 'href' => '/LapTrinhWeb-PlanbookAI/public/ung-dung-di-dong'],
    'contact' => ['label' => 'Liên hệ', 'href' => '/LapTrinhWeb-PlanbookAI/public/lien-he'],
];
include __DIR__ . '/head.php';
?>

<div class="home-shell">
    <nav class="navbar navbar-expand-lg fixed-top home-navbar">
        <div class="container py-2">
            <a class="navbar-brand home-brand me-4" href="/LapTrinhWeb-PlanbookAI/public/">
                <i class="bi bi-mortarboard-fill"></i>
                <span>PlanbookAI</span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#marketingNav" aria-controls="marketingNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="marketingNav">
                <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-4">
                    <?php foreach ($marketingPages as $key => $page): ?>
                        <li class="nav-item">
                            <a class="nav-link home-nav-link <?= $currentPage === $key ? 'is-active' : ''; ?>" href="<?= $page['href']; ?>">
                                <?= htmlspecialchars($page['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-2 gap-lg-3 mt-3 mt-lg-0">
                    <a href="/LapTrinhWeb-PlanbookAI/public/login" class="text-decoration-none home-login-link px-2">Đăng nhập</a>
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn home-btn-primary px-4 py-2">Đăng ký</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="home-modern">
