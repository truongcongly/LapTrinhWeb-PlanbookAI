<?php
$title = 'Giáo viên | PlanbookAI';
$currentPage = 'teacher';
include __DIR__ . '/layouts/marketing_header.php';
?>

<section class="home-page-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="home-pill home-pill--secondary mb-4">Dành riêng cho giáo viên</span>
                <h1 class="home-hero-title mb-4">Giảng dạy sáng tạo, giảm bớt áp lực</h1>
                <p class="home-hero-desc fs-5 mb-4">PlanbookAI là trợ lý AI giúp giáo viên tiết kiệm hàng giờ chuẩn bị mỗi tuần, đồng thời làm bài giảng sinh động và có cấu trúc hơn.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn home-btn-primary px-4 py-3">Bắt đầu miễn phí</a>
                    <a href="/LapTrinhWeb-PlanbookAI/public/bang-gia" class="btn home-btn-secondary px-4 py-3">Xem bảng giá</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="home-glass-card p-3">
                    <img class="home-dashboard-image" src="/LapTrinhWeb-PlanbookAI/public/images/teacher-classroom.jpg" alt="Giáo viên giảng bài trong lớp">
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
                        <div class="home-feature-icon mb-4"><i class="bi bi-journal-bookmark-fill"></i></div>
                        <h3 class="home-headline fw-bold mb-3">Soạn giáo án thông minh</h3>
                        <p class="home-card-copy mb-4">AI đề xuất mục tiêu, hoạt động, học liệu và tiêu chí đánh giá bám sát chương trình mới.</p>
                        <ul class="home-check-list">
                            <li><i class="bi bi-check-circle-fill"></i>Tích hợp chương trình GDPT 2018</li>
                            <li><i class="bi bi-check-circle-fill"></i>Gợi ý hoạt động học tập tích cực</li>
                            <li><i class="bi bi-check-circle-fill"></i>Cá nhân hóa theo phong cách dạy</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid rounded-4 shadow-sm" src="/LapTrinhWeb-PlanbookAI/public/images/teacher-lesson-plan.jpg" alt="Giáo viên chuẩn bị giáo án">
                    </div>
                </div>
            </article>

            <article class="home-card home-card--gradient home-card--span-4">
                <div class="home-round-icon mb-4"><i class="bi bi-ui-checks-grid"></i></div>
                <h3 class="home-headline fw-bold mb-3">Ma trận đề tự động</h3>
                <p class="text-white-50 mb-4">Tạo đề từ ngân hàng câu hỏi hoặc tài liệu riêng, cân bằng theo mức độ nhận thức.</p>
                <div class="home-panel p-4 bg-white bg-opacity-10 border-0">
                    <div class="home-progress mb-3"><span style="width: 70%;"></span></div>
                    <p class="small text-white-50 mb-0">Đang tạo đề kiểm tra giữa kỳ cho khối 11.</p>
                </div>
            </article>

            <article class="home-card home-card--feature home-card--span-4">
                <div class="home-feature-icon mb-4" style="background: rgba(219,234,254,.9); color: #1d4ed8;"><i class="bi bi-file-earmark-text-fill"></i></div>
                <h3 class="home-headline fw-bold mb-3">Chấm OCR nhanh</h3>
                <p class="home-card-copy mb-4">Quét bài làm bằng camera, thống kê lỗi sai phổ biến và lưu kết quả ngay vào hệ thống.</p>
                <img class="img-fluid rounded-4" src="/LapTrinhWeb-PlanbookAI/public/images/teacher-grading.jpg" alt="Chấm bài và học tập trên giấy">
            </article>

            <article class="home-card home-card--soft home-card--span-8">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <h3 class="home-headline fw-bold mb-3">Báo cáo và phân tích</h3>
                        <p class="home-card-copy mb-4">Xem nhanh tiến độ lớp học, mức độ hoàn thành, nhóm học sinh cần hỗ trợ và xu hướng cải thiện theo thời gian.</p>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="home-mini-card">
                                    <div class="home-price fs-3">85%</div>
                                    <div class="small text-uppercase fw-bold home-muted">Học sinh đạt chuẩn</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="home-mini-card">
                                    <div class="home-price fs-3" style="color: #1d4ed8;">+12%</div>
                                    <div class="small text-uppercase fw-bold home-muted">Tiến bộ trung bình</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <img class="img-fluid rounded-4 shadow-sm" src="/LapTrinhWeb-PlanbookAI/public/images/teacher-analytics.jpg" alt="Báo cáo và phân tích dữ liệu">
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="home-section">
    <div class="container">
        <div class="home-glass-card p-4 p-lg-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <p class="fs-4 fst-italic mb-4">"Kể từ khi dùng PlanbookAI, thời gian soạn giáo án của tôi giảm mạnh và bài học sinh động hơn nhiều nhờ các gợi ý sáng tạo từ AI."</p>
                    <div class="d-flex align-items-center gap-3">
                        <img src="/LapTrinhWeb-PlanbookAI/public/images/teacher-testimonial.jpg" alt="Teacher testimonial" class="rounded-circle" style="width: 72px; height: 72px; object-fit: cover;">
                        <div>
                            <div class="fw-bold">Thầy Trương Hoàn Thiện</div>
                            <div class="home-muted">Giáo viên Hóa Học</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn home-btn-primary px-5 py-3">Đăng ký ngay</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/layouts/marketing_footer.php'; ?>
