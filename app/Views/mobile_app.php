<?php
$title = 'Ứng dụng di động | PlanbookAI';
$currentPage = 'mobile';
include __DIR__ . '/layouts/marketing_header.php';
?>

<section class="home-page-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="home-pill home-pill--secondary mb-4">Mới: AI trên điện thoại</span>
                <h1 class="home-hero-title mb-4">Giáo án thông minh mọi lúc, mọi nơi</h1>
                <p class="home-hero-desc fs-5 mb-4">Lên kế hoạch bài giảng, quản lý điểm số và chấm bài nhanh ngay trên điện thoại với trải nghiệm tối ưu cho giáo viên.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#!" class="home-store-btn text-decoration-none">
                        <i class="bi bi-apple fs-2"></i>
                        <span><small class="d-block text-uppercase opacity-75">Tải trên</small><strong>App Store</strong></span>
                    </a>
                    <a href="#!" class="home-store-btn text-decoration-none">
                        <i class="bi bi-google-play fs-2"></i>
                        <span><small class="d-block text-uppercase opacity-75">Tải trên</small><strong>Google Play</strong></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="home-phone-stage">
                    <div class="home-phone-photo-card">
                        <img src="/LapTrinhWeb-PlanbookAI/public/images/mobile-phone-home-screen.svg" alt="Điện thoại hiển thị màn hình ứng dụng">
                    </div>
                    <div class="home-phone home-phone--light">
                        <div class="home-phone-screen d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="home-phone-line" style="width: 50%;"></div>
                                <i class="bi bi-bell-fill" style="color: var(--home-secondary);"></i>
                            </div>
                            <img class="img-fluid rounded-4" src="/LapTrinhWeb-PlanbookAI/public/images/mobile-learning.jpg" alt="Ứng dụng học tập trên thiết bị cá nhân" style="height: 190px; object-fit: cover; width: 100%;">
                            <div class="rounded-4 text-center py-3 fw-bold text-white" style="background: var(--home-secondary);">Chấm điểm AI</div>
                            <div class="home-phone-line"></div>
                            <div class="home-phone-line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-section">
    <div class="container">
        <div class="home-bento">
            <article class="home-card home-card--feature home-card--span-8">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <div class="home-feature-icon mb-4" style="background: rgba(219,234,254,.9); color: #1d4ed8;"><i class="bi bi-camera-fill"></i></div>
                        <h3 class="home-headline fw-bold mb-3">Chấm bài bằng camera</h3>
                        <p class="home-card-copy mb-4">OCR nhận diện chữ viết tay, chấm bài và đồng bộ về sổ điểm chỉ sau vài thao tác trên điện thoại.</p>
                        <ul class="home-check-list">
                            <li><i class="bi bi-check-circle-fill"></i>Nhận diện chữ viết tay chính xác</li>
                            <li><i class="bi bi-check-circle-fill"></i>Tự động đồng bộ kết quả</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid rounded-4 shadow-sm" src="/LapTrinhWeb-PlanbookAI/public/images/teacher-grading.jpg" alt="Chấm bài bằng camera">
                    </div>
                </div>
            </article>

            <article class="home-card home-card--feature home-card--span-4">
                <div class="home-feature-icon mb-4"><i class="bi bi-cloud-slash-fill"></i></div>
                <h3 class="home-headline fw-bold mb-3">Chế độ ngoại tuyến</h3>
                <p class="home-card-copy mb-0">Tiếp tục làm việc ngay cả khi không có Internet. Dữ liệu sẽ tự động đồng bộ khi kết nối lại.</p>
            </article>

            <article class="home-card home-card--feature home-card--span-4">
                <div class="home-feature-icon mb-4"><i class="bi bi-calendar3"></i></div>
                <h3 class="home-headline fw-bold mb-3">Lịch trình thông minh</h3>
                <p class="home-card-copy mb-0">Nhắc tiết học, deadline nộp bài và các sự kiện trường học quan trọng ngay trên thiết bị cầm tay.</p>
            </article>

            <article class="home-card home-card--soft home-card--span-8">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <div class="home-feature-icon mb-4" style="background: rgba(219,234,254,.9); color: #1d4ed8;"><i class="bi bi-people-fill"></i></div>
                        <h3 class="home-headline fw-bold mb-3">Cổng kết nối học sinh</h3>
                        <p class="home-card-copy mb-4">Học sinh xem bài giảng, làm bài trực tuyến và nhận phản hồi trực tiếp từ giáo viên qua ứng dụng.</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex">
                                <div class="rounded-circle bg-secondary-subtle border border-white" style="width: 40px; height: 40px;"></div>
                                <div class="rounded-circle bg-info-subtle border border-white" style="width: 40px; height: 40px; margin-left: -10px;"></div>
                                <div class="rounded-circle bg-warning-subtle border border-white" style="width: 40px; height: 40px; margin-left: -10px;"></div>
                            </div>
                            <span class="small fw-bold home-muted">+1.2k học sinh đang online</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid rounded-4 shadow-sm" src="/LapTrinhWeb-PlanbookAI/public/images/student-group.jpg" alt="Học sinh học nhóm với thiết bị số">
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<?php include __DIR__ . '/layouts/marketing_footer.php'; ?>
