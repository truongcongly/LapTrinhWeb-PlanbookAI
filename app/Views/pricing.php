<?php
$title = 'Bảng giá | PlanbookAI';
$currentPage = 'pricing';
include __DIR__ . '/layouts/marketing_header.php';
?>

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
            <article class="home-pricing-card">
                <h3 class="home-headline fw-bold mb-2">Miễn phí</h3>
                <p class="home-muted mb-3">Trải nghiệm những tính năng cơ bản nhất.</p>
                <div class="home-price mb-3">0đ<span class="fs-6 fw-semibold home-muted">/tháng</span></div>
                <ul class="home-check-list mb-4">
                    <li><span class="material-symbols-outlined">check_circle</span>Tối đa 3 giáo án mỗi tháng</li>
                    <li><span class="material-symbols-outlined">check_circle</span>Kho học liệu cộng đồng</li>
                    <li><span class="material-symbols-outlined">check_circle</span>Xuất PDF cơ bản</li>
                </ul>
                <a href="/LapTrinhWeb-PlanbookAI/public/login" class="btn home-btn-secondary w-100 py-3">Bắt đầu ngay</a>
            </article>

            <article class="home-pricing-card is-featured">
                <span class="home-pill home-pill--secondary mb-3">Phổ biến nhất</span>
                <h3 class="home-headline fw-bold mb-2">Chuyên nghiệp</h3>
                <p class="home-muted mb-3">Dành cho giáo viên muốn bứt phá hiệu suất.</p>
                <div class="home-price mb-2">199.000đ<span class="fs-6 fw-semibold home-muted">/tháng</span></div>
                <p class="small fw-bold" style="color: var(--home-secondary);">Thanh toán theo năm để tiết kiệm 20%</p>
                <ul class="home-check-list mb-4">
                    <li><span class="material-symbols-outlined">check_circle</span>Giáo án AI không giới hạn</li>
                    <li><span class="material-symbols-outlined">check_circle</span>Trợ lý soạn bài AI thế hệ mới</li>
                    <li><span class="material-symbols-outlined">check_circle</span>Tích hợp Google Classroom</li>
                    <li><span class="material-symbols-outlined">check_circle</span>Xuất Word và PowerPoint nâng cao</li>
                </ul>
                <a href="/LapTrinhWeb-PlanbookAI/public/thanh-toan?plan=professional" class="btn home-btn-primary w-100 py-3">Nâng cấp ngay</a>
            </article>

            <article class="home-pricing-card">
                <h3 class="home-headline fw-bold mb-2">Doanh nghiệp</h3>
                <p class="home-muted mb-3">Giải pháp toàn diện cho trường học.</p>
                <div class="home-price mb-3">Liên hệ</div>
                <ul class="home-check-list mb-4">
                    <li><span class="material-symbols-outlined">check_circle</span>Quản lý tập trung giáo viên</li>
                    <li><span class="material-symbols-outlined">check_circle</span>Thư viện giáo án dùng chung</li>
                    <li><span class="material-symbols-outlined">check_circle</span>Phân tích và báo cáo chuyên sâu</li>
                    <li><span class="material-symbols-outlined">check_circle</span>Hỗ trợ 24/7 và training trực tiếp</li>
                </ul>
                <a href="/LapTrinhWeb-PlanbookAI/public/lien-he" class="btn home-btn-secondary w-100 py-3">Đặt lịch tư vấn</a>
            </article>
        </div>
    </div>
</section>

<section class="home-section">
    <div class="container">
        <div class="home-section-header text-center">
            <h2 class="home-section-title">So sánh chi tiết tính năng</h2>
        </div>
        <div class="home-card p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead style="background: #eef1f3;">
                        <tr>
                            <th class="p-4">Tính năng</th>
                            <th class="p-4">Miễn phí</th>
                            <th class="p-4">Chuyên nghiệp</th>
                            <th class="p-4">Doanh nghiệp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-4">Số lượng giáo án / tháng</td>
                            <td class="p-4">03</td>
                            <td class="p-4 fw-bold" style="color: var(--home-secondary);">Không giới hạn</td>
                            <td class="p-4">Không giới hạn</td>
                        </tr>
                        <tr>
                            <td class="p-4">Soạn giáo án bằng AI</td>
                            <td class="p-4">Cơ bản</td>
                            <td class="p-4">Nâng cao</td>
                            <td class="p-4">Nâng cao</td>
                        </tr>
                        <tr>
                            <td class="p-4">Xuất PDF, Word, PPT</td>
                            <td class="p-4">Chỉ PDF</td>
                            <td class="p-4">Có</td>
                            <td class="p-4">Có</td>
                        </tr>
                        <tr>
                            <td class="p-4">Lưu trữ đám mây</td>
                            <td class="p-4">500MB</td>
                            <td class="p-4">10GB</td>
                            <td class="p-4">Không giới hạn</td>
                        </tr>
                        <tr>
                            <td class="p-4">Tích hợp LMS</td>
                            <td class="p-4">-</td>
                            <td class="p-4">-</td>
                            <td class="p-4">Có</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/layouts/marketing_footer.php'; ?>
