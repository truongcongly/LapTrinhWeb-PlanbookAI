<?php
$title = 'Liên hệ | PlanbookAI';
$currentPage = 'contact';
include __DIR__ . '/layouts/marketing_header.php';
?>

<section class="home-page-hero">
    <div class="container text-center">
        <span class="home-pill home-pill--secondary mb-4">Liên hệ</span>
        <h1 class="home-hero-title mb-4">Kết nối với PlanbookAI</h1>
        <p class="home-hero-desc fs-5 mx-auto" style="max-width: 760px;">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ trong hành trình đổi mới giáo dục của bạn.</p>
    </div>
</section>

<section class="home-section pt-0">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="d-grid gap-4">
                    <div class="home-contact-card">
                        <div class="d-flex gap-3">
                            <div class="home-feature-icon"><i class="bi bi-geo-alt-fill"></i></div>
                            <div>
                                <h3 class="home-headline fw-bold fs-4 mb-2">Văn phòng chính</h3>
                                <p class="home-card-copy mb-0">Tầng 12, Tòa nhà Innovation, Công viên phần mềm Quang Trung, Quận 12, TP. Hồ Chí Minh.</p>
                            </div>
                        </div>
                    </div>
                    <div class="home-contact-card">
                        <div class="d-flex gap-3">
                            <div class="home-feature-icon"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <h3 class="home-headline fw-bold fs-4 mb-2">Email hỗ trợ</h3>
                                <p class="home-card-copy mb-0">hotro@planbookai.com<br>kinhdoanh@planbookai.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="home-contact-card">
                        <div class="d-flex gap-3">
                            <div class="home-feature-icon" style="background: rgba(219,234,254,.9); color: #1d4ed8;"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <h3 class="home-headline fw-bold fs-4 mb-2">Điện thoại</h3>
                                <p class="home-card-copy mb-0">+84 1900 8888<br>Thứ 2 - Thứ 7 (8:00 - 18:00)</p>
                            </div>
                        </div>
                    </div>
                    <div class="home-card">
                        <h3 class="home-headline fw-bold fs-4 mb-3">Giờ làm việc</h3>
                        <div class="d-grid gap-2 home-muted">
                            <div class="d-flex justify-content-between"><span>Thứ 2 - Thứ 6</span><strong>08:00 - 17:30</strong></div>
                            <div class="d-flex justify-content-between"><span>Thứ 7</span><strong>08:30 - 12:00</strong></div>
                            <div class="d-flex justify-content-between"><span>Chủ nhật & Ngày lễ</span><strong>Nghỉ</strong></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="home-contact-card h-100">
                    <h3 class="home-headline fw-bold mb-4">Gửi tin nhắn cho chúng tôi</h3>
                    <form class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Họ và tên</label>
                            <input type="text" class="form-control rounded-4 border-0 py-3 px-4" placeholder="Nguyễn Văn A" style="background: rgba(217,221,224,.35);">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control rounded-4 border-0 py-3 px-4" placeholder="email@vi-du.com" style="background: rgba(217,221,224,.35);">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Chủ đề</label>
                            <select class="form-select rounded-4 border-0 py-3 px-4" style="background: rgba(217,221,224,.35);">
                                <option>Hỗ trợ kỹ thuật</option>
                                <option>Hợp tác trường học</option>
                                <option>Báo giá và gói dịch vụ</option>
                                <option>Khác</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Lời nhắn</label>
                            <textarea class="form-control rounded-4 border-0 py-3 px-4" rows="6" placeholder="Hãy cho chúng tôi biết bạn cần hỗ trợ gì..." style="background: rgba(217,221,224,.35);"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn home-btn-primary w-100 py-3">Gửi tin nhắn ngay</button>
                        </div>
                    </form>
                    <p class="small home-muted text-center mt-4 mb-0">Cam kết phản hồi trong vòng 24 giờ làm việc.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/layouts/marketing_footer.php'; ?>
