<?php
$title = $method['name'] . ' | Thanh toán PlanbookAI';
$currentPage = 'pricing';
$baseUrl = '/LapTrinhWeb-PlanbookAI/public';
$paymentQrImages = [
    'vnpay' => $baseUrl . '/images/payment-vnpay-qr.svg',
    'momo' => $baseUrl . '/images/payment-momo-qr.svg',
    'bank' => $baseUrl . '/images/payment-bank-qr.svg',
];
$paymentQr = $paymentQrImages[$methodKey] ?? $paymentQrImages['vnpay'];
$amount = number_format($plan['price'], 0, ',', '.');
$gatewayClass = 'payment-real--' . $methodKey;
$extraStylesheets = ['/LapTrinhWeb-PlanbookAI/public/css/home-modern.css?v=20260422-scanpay-form'];
include __DIR__ . '/../layouts/head.php';
?>

<main class="payment-real-page <?= htmlspecialchars($gatewayClass, ENT_QUOTES, 'UTF-8'); ?>">
    <?php if ($methodKey === 'momo'): ?>
        <header class="momo-real-header">
            <div class="momo-real-logo">mo<br>mo</div>
            <span>Cổng thanh toán MoMo</span>
        </header>

        <section class="momo-real-wrap">
            <aside class="momo-order-card">
                <h1>Thông tin đơn hàng</h1>
                <div class="momo-provider">
                    <span class="momo-sale">Plan</span><strong>BookAI</strong>
                </div>
                <dl>
                    <div>
                        <dt>Mã đơn hàng</dt>
                        <dd><?= htmlspecialchars($orderCode, ENT_QUOTES, 'UTF-8'); ?></dd>
                    </div>
                    <div>
                        <dt>Mô tả</dt>
                        <dd>Thanh toán: Gói Chuyên nghiệp</dd>
                    </div>
                    <div>
                        <dt>Số tiền</dt>
                        <dd class="momo-price"><?= $amount; ?>đ</dd>
                    </div>
                </dl>
                <div class="momo-countdown">
                    <span>Đơn hàng sẽ hết hạn sau:</span>
                    <strong>09</strong>
                    <strong>57</strong>
                </div>
                <a href="<?= $baseUrl; ?>/thanh-toan?plan=professional&method=momo">Quay về</a>
            </aside>

            <section class="momo-qr-panel">
                <h2>Quét mã QR để thanh toán</h2>
                <div class="momo-qr-code">
                    <img src="<?= $paymentQr; ?>" alt="Mã QR thanh toán MoMo">
                </div>
                <p><i class="bi bi-qr-code-scan"></i> Sử dụng <strong>App MoMo</strong> hoặc ứng dụng camera hỗ trợ QR code để quét mã</p>
                <form method="POST" action="<?= $baseUrl; ?>/thanh-toan/hoan-tat" class="momo-confirm-form">
                    <input type="hidden" name="method" value="momo">
                    <input type="hidden" name="plan" value="<?= htmlspecialchars($plan['key'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="text" name="momo_phone" placeholder="Nhập SĐT MoMo bất kỳ" required>
                    <button type="submit">Xác nhận đã thanh toán</button>
                </form>
                <small>Gặp khó khăn khi thanh toán? <b>Xem Hướng dẫn</b></small>
            </section>
        </section>
    <?php elseif ($methodKey === 'vnpay'): ?>
        <section class="scanpay-form-page scanpay-form-page--vnpay">
            <aside class="scanpay-qr-card">
                <h1>Ứng dụng mobile<br>quét mã</h1>
                <strong>VNPAY<small>QR</small></strong>
                <img src="<?= $paymentQr; ?>" alt="Mã QR thanh toán VNPAY">
                <em>Scan to Pay</em>
            </aside>

            <form method="POST" action="<?= $baseUrl; ?>/thanh-toan/hoan-tat" class="scanpay-form-card">
                <input type="hidden" name="method" value="vnpay">
                <input type="hidden" name="plan" value="<?= htmlspecialchars($plan['key'], ENT_QUOTES, 'UTF-8'); ?>">
                <h2>Thông tin thanh toán</h2>
                <p>Mã đơn: <b><?= htmlspecialchars($orderCode, ENT_QUOTES, 'UTF-8'); ?></b> - Số tiền: <b><?= $amount; ?>đ</b></p>
                <div class="scanpay-form-row">
                    <input type="text" name="bank_name" placeholder="Tên ngân hàng bất kỳ" required>
                    <input type="text" name="customer_name" placeholder="Tên chủ thẻ/tài khoản" required>
                </div>
                <input type="text" name="transaction_code" placeholder="Mã giao dịch/OTP bất kỳ" required>
                <button type="submit">Thanh toán qua VNPAY</button>
            </form>
        </section>
    <?php else: ?>
        <section class="scanpay-form-page scanpay-form-page--bank">
            <aside class="scanpay-qr-card scanpay-qr-card--bank">
                <h1>Ứng dụng ngân hàng<br>quét mã</h1>
                <strong>Vietcombank</strong>
                <img src="<?= $paymentQr; ?>" alt="Mã QR chuyển khoản ngân hàng">
            </aside>

            <form method="POST" action="<?= $baseUrl; ?>/thanh-toan/hoan-tat" class="scanpay-form-card scanpay-form-card--bank">
                <input type="hidden" name="method" value="bank">
                <input type="hidden" name="plan" value="<?= htmlspecialchars($plan['key'], ENT_QUOTES, 'UTF-8'); ?>">
                <h2>Thông tin thanh toán</h2>
                <p>Mã đơn: <b><?= htmlspecialchars($orderCode, ENT_QUOTES, 'UTF-8'); ?></b> - Số tiền: <b><?= $amount; ?>đ</b></p>
                <div class="scanpay-form-row">
                    <input type="text" name="card_holder" placeholder="Tên chủ thẻ" required>
                    <input type="text" name="account_number" placeholder="Số tài khoản" required>
                </div>
                <input type="text" name="bank_transaction" placeholder="Mã giao dịch/OTP bất kỳ" required>
                <button type="submit">Xác nhận thanh toán</button>
            </form>
        </section>
    <?php endif; ?>
</main>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
