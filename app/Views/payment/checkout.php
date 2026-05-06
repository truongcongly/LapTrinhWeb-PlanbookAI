<?php
$title = 'Thanh toán | PlanbookAI';
$currentPage = 'pricing';
$baseUrl = '/LapTrinhWeb-PlanbookAI/public';
$selectedPayment = $paymentMethods[$selectedMethod];
include __DIR__ . '/../layouts/marketing_header.php';
?>

<section class="home-page-hero payment-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="home-pill home-pill--secondary mb-4">Thanh toán gói dịch vụ.</span>
                <h1 class="home-hero-title mb-4">Hoàn tất gói <?= htmlspecialchars($plan['name'], ENT_QUOTES, 'UTF-8'); ?>.</h1>
                <p class="home-hero-desc fs-5 mb-0" style="max-width: 720px;">
                    Chọn VNPay, MoMo hoặc chuyển khoản ngân hàng. Sau khi thanh toán thành công, hệ thống sẽ tự chuyển bạn về trang đăng nhập.
                </p>
            </div>
            <div class="col-lg-5">
                <div class="payment-summary-card">
                    <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                        <div>
                            <p class="home-muted fw-bold mb-1">Mã đơn hàng.</p>
                            <h2 class="home-headline fs-4 fw-bold mb-0"><?= htmlspecialchars($orderCode, ENT_QUOTES, 'UTF-8'); ?></h2>
                        </div>
                        <span class="payment-status-badge">Đang chờ.</span>
                    </div>
                    <div class="payment-total">
                        <?= number_format($plan['price'], 0, ',', '.'); ?>đ
                        <span>/<?= htmlspecialchars($plan['cycle'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                    <p class="home-muted mb-0">Gói Chuyên nghiệp mở khóa giáo án AI không giới hạn, trợ lý soạn bài nâng cao và xuất Word/PowerPoint.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-section pt-0">
    <div class="container">
        <div class="payment-layout">
            <div class="payment-method-panel">
                <h2 class="home-headline fw-bold fs-3 mb-4">Chọn phương thức.</h2>

                <div class="payment-method-grid">
                    <?php foreach ($paymentMethods as $key => $method): ?>
                        <a class="payment-method-option <?= $selectedMethod === $key ? 'is-selected' : ''; ?>" href="<?= $baseUrl; ?>/thanh-toan?plan=professional&method=<?= urlencode($key); ?>">
                            <span class="payment-method-icon"><i class="bi <?= htmlspecialchars($method['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                            <span>
                                <strong><?= htmlspecialchars($method['name'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                <small><?= htmlspecialchars($method['description'], ENT_QUOTES, 'UTF-8'); ?></small>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="payment-detail-card">
                <div class="payment-detail-header">
                    <span class="payment-method-icon is-large"><i class="bi <?= htmlspecialchars($selectedPayment['icon'], ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                    <div>
                        <h2 class="home-headline fw-bold fs-3 mb-1"><?= htmlspecialchars($selectedPayment['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p class="home-muted mb-0"><?= htmlspecialchars($selectedPayment['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>

                <?php if ($selectedMethod === 'bank'): ?>
                    <div class="payment-bank-box">
                        <div>
                            <span>Ngân hàng.</span>
                            <strong>Vietcombank</strong>
                        </div>
                        <div>
                            <span>Số tài khoản.</span>
                            <strong>0123 456 789</strong>
                        </div>
                        <div>
                            <span>Chủ tài khoản.</span>
                            <strong>PLANBOOKAI JSC</strong>
                        </div>
                        <div>
                            <span>Nội dung.</span>
                            <strong><?= htmlspecialchars($orderCode, ENT_QUOTES, 'UTF-8'); ?> PROFESSIONAL</strong>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="payment-qr-box">
                        <div class="payment-qr">
                            <i class="bi bi-qr-code"></i>
                        </div>
                        <div>
                            <h3 class="home-headline fw-bold fs-5 mb-2">Quét mã hoặc xác nhận thanh toán.</h3>
                            <p class="home-muted mb-0">Đây là giao diện demo. Khi có tài khoản merchant thật, phần này sẽ chuyển hướng sang cổng <?= htmlspecialchars($selectedPayment['name'], ENT_QUOTES, 'UTF-8'); ?>.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="payment-note">
                    <i class="bi bi-shield-check"></i>
                    <span><?= htmlspecialchars($selectedPayment['note'], ENT_QUOTES, 'UTF-8'); ?></span>
                </div>

                <div class="payment-actions">
                    <a href="<?= $baseUrl; ?>/thanh-toan/<?= urlencode($selectedMethod); ?>?order=<?= urlencode($orderCode); ?>" class="btn home-btn-primary px-5 py-3">
                        <i class="bi bi-box-arrow-up-right me-2"></i>Tiếp tục thanh toán.
                    </a>
                    <a href="<?= $baseUrl; ?>/bang-gia" class="btn home-btn-secondary px-4 py-3">Quay lại bảng giá.</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../layouts/marketing_footer.php'; ?>
