<?php
$title = 'Bảng giá | PlanbookAI';
$currentPage = 'pricing';

$defaultPlans = [
    'free' => [
        'name' => 'Miễn phí',
        'price' => '0',
        'cycle' => 'tháng',
        'description' => 'Trải nghiệm những tính năng cơ bản nhất.',
        'features' => "Tối đa 3 giáo án mỗi tháng\nKho học liệu cộng đồng\nXuất PDF cơ bản",
        'status' => 'active',
    ],
    'professional' => [
        'name' => 'Chuyên nghiệp',
        'price' => '199000',
        'cycle' => 'tháng',
        'description' => 'Dành cho giáo viên muốn tăng tốc quy trình giảng dạy.',
        'features' => "Giáo án AI không giới hạn\nTrợ lý soạn bài AI\nXuất Word và PowerPoint nâng cao\nOCR grading workflow",
        'status' => 'active',
    ],
    'enterprise' => [
        'name' => 'Doanh nghiệp',
        'price' => 'Liên hệ',
        'cycle' => 'custom',
        'description' => 'Giải pháp toàn diện cho trường học và tổ chức giáo dục.',
        'features' => "Quản lý tập trung giáo viên\nThư viện giáo án dùng chung\nPhân tích và báo cáo chuyên sâu\nHỗ trợ ưu tiên",
        'status' => 'active',
    ],
];

$plans = $defaultPlans;
$planFeatures = fn(array $plan): array => array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string)($plan['features'] ?? '')))));
$formatPrice = function ($price): string {
    if (is_numeric($price)) {
        return number_format((float)$price, 0, ',', '.') . 'đ';
    }

    return (string)$price;
};
$cycleText = fn(array $plan): string => !empty($plan['cycle']) && $plan['cycle'] !== 'custom' ? '/' . $plan['cycle'] : '';

$featureComparisonRows = [
    ['feature' => 'Số lượng giáo án / tháng', 'free' => '03', 'professional' => 'Không giới hạn', 'enterprise' => 'Không giới hạn'],
    ['feature' => 'Soạn giáo án bằng AI', 'free' => 'Cơ bản', 'professional' => 'Nâng cao (GPT-4)', 'enterprise' => 'Nâng cao (GPT-4)'],
    ['feature' => 'Xuất file PDF, Word, PPT', 'free' => 'Chỉ PDF', 'professional' => true, 'enterprise' => true],
    ['feature' => 'Lưu trữ đám mây', 'free' => '500MB', 'professional' => '10GB', 'enterprise' => 'Không giới hạn'],
    ['feature' => 'Hỗ trợ giáo dục hòa nhập', 'free' => false, 'professional' => true, 'enterprise' => true],
    ['feature' => 'Tích hợp LMS (Moodle, Canvas)', 'free' => false, 'professional' => false, 'enterprise' => true],
];

$renderComparisonValue = function ($value, bool $featured = false): string {
    if ($value === true) {
        return '<span class="feature-check"><i class="bi bi-check-lg"></i></span>';
    }

    if ($value === false) {
        return '<span class="feature-dash">-</span>';
    }

    $class = $featured ? 'feature-value is-featured' : 'feature-value';
    return '<span class="' . $class . '">' . htmlspecialchars((string)$value) . '</span>';
};

include __DIR__ . '/layouts/marketing_header.php';
?>

<style>
.feature-compare-section {
    background: #f3f6fb;
}

.feature-compare-wrap {
    max-width: 1180px;
    margin: 0 auto;
}

.feature-compare-title {
    color: #000;
    font-size: clamp(2rem, 3vw, 3.25rem);
    font-weight: 800;
    letter-spacing: 0;
    margin-bottom: 42px;
    text-align: center;
}

.feature-compare-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    box-shadow: 0 18px 36px rgba(15, 23, 42, .1);
    overflow: hidden;
}

.feature-compare-table {
    min-width: 860px;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
    table-layout: fixed;
    color: #000;
}

.feature-compare-table thead th {
    background: #eef2f5;
    color: #000;
    font-weight: 800;
    padding: 24px 28px;
    border: 0;
    text-align: center;
    vertical-align: middle;
}

.feature-compare-table thead th:first-child {
    width: 38%;
}

.feature-compare-table thead th:nth-child(2),
.feature-compare-table thead th:nth-child(3),
.feature-compare-table thead th:nth-child(4) {
    width: 20.666%;
}

.feature-compare-table tbody th,
.feature-compare-table tbody td {
    padding: 24px 28px;
    border-top: 1px solid #f1f5f9;
    color: #000;
    font-weight: 700;
    vertical-align: middle;
    height: 92px;
}

.feature-compare-table tbody th {
    color: #000;
    text-align: left;
    white-space: normal;
    overflow-wrap: anywhere;
}

.feature-compare-table tbody td {
    text-align: center;
    white-space: normal;
    overflow-wrap: anywhere;
}

.feature-compare-table thead th:first-child {
    text-align: left;
}

.feature-value.is-featured {
    color: #000;
    font-weight: 800;
}

.feature-value {
    color: #000;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 28px;
    text-align: center;
}

.feature-check {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #000;
    font-size: 1.4rem;
    font-weight: 900;
    min-height: 28px;
}

.feature-dash {
    color: #000;
    font-size: 1.2rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 28px;
}

@media (max-width: 767.98px) {
    .feature-compare-title {
        margin-bottom: 26px;
    }

    .feature-compare-card {
        border-radius: 18px;
    }

    .feature-compare-table thead th,
    .feature-compare-table tbody th,
    .feature-compare-table tbody td {
        padding: 18px 20px;
    }
}
</style>

<section class="home-page-hero">
    <div class="container text-center">
        <span class="home-pill home-pill--secondary mb-4">Bảng giá</span>
        <h1 class="home-hero-title mb-4">Gói cước linh hoạt cho mọi nhu cầu giảng dạy</h1>
        <p class="home-hero-desc fs-5 mx-auto" style="max-width: 760px;">Dù là giáo viên cá nhân hay nhà trường, PlanbookAI đều có lộ trình phù hợp để bạn bắt đầu và mở rộng.</p>
    </div>
</section>

<section class="home-section pt-0">
    <div class="container">
        <div class="home-pricing-grid">
            <?php foreach (['free', 'professional', 'enterprise'] as $key): ?>
                <?php $plan = $plans[$key]; ?>
                <?php if (($plan['status'] ?? 'active') !== 'active') continue; ?>
                <article class="home-pricing-card <?= $key === 'professional' ? 'is-featured' : ''; ?>">
                    <?php if ($key === 'professional'): ?>
                        <span class="home-pill home-pill--secondary mb-3">Phổ biến nhất</span>
                    <?php endif; ?>
                    <h3 class="home-headline fw-bold mb-2"><?= htmlspecialchars($plan['name']); ?></h3>
                    <p class="home-muted mb-3"><?= htmlspecialchars($plan['description']); ?></p>
                    <div class="home-price mb-3">
                        <?= htmlspecialchars($formatPrice($plan['price'])); ?><span class="fs-6 fw-semibold home-muted"><?= htmlspecialchars($cycleText($plan)); ?></span>
                    </div>
                    <?php if ($key === 'professional'): ?>
                        <p class="small fw-bold" style="color: var(--home-secondary);">Thanh toán theo năm để tiết kiệm 20%</p>
                    <?php endif; ?>
                    <ul class="home-check-list mb-4">
                        <?php foreach ($planFeatures($plan) as $feature): ?>
                            <li><i class="bi bi-check-circle-fill"></i><?= htmlspecialchars($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <?php if ($key === 'professional'): ?>
                        <a href="/LapTrinhWeb-PlanbookAI/public/thanh-toan?plan=professional" class="btn home-btn-primary w-100 py-3">Nâng cấp ngay</a>
                    <?php elseif ($key === 'enterprise'): ?>
                        <a href="/LapTrinhWeb-PlanbookAI/public/lien-he" class="btn home-btn-secondary w-100 py-3">Đặt lịch tư vấn</a>
                    <?php else: ?>
                        <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn home-btn-secondary w-100 py-3">Bắt đầu ngay</a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="home-section feature-compare-section">
    <div class="container">
        <div class="feature-compare-wrap">
            <h2 class="feature-compare-title">So sánh chi tiết tính năng</h2>
            <div class="feature-compare-card">
                <div class="table-responsive">
                    <table class="table feature-compare-table align-middle">
                        <thead>
                            <tr>
                                <th>Tính năng</th>
                                <th>Miễn phí</th>
                                <th class="is-featured">Chuyên nghiệp</th>
                                <th>Doanh nghiệp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($featureComparisonRows as $row): ?>
                                <tr>
                                    <th scope="row"><?= htmlspecialchars($row['feature']); ?></th>
                                    <td><?= $renderComparisonValue($row['free']); ?></td>
                                    <td class="is-featured"><?= $renderComparisonValue($row['professional'], true); ?></td>
                                    <td><?= $renderComparisonValue($row['enterprise']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/layouts/marketing_footer.php'; ?>
