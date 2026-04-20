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
                    <img class="home-dashboard-image" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIbFd-Zczmc1Jvm_fCoYVP-TeLbpc5EFFIe3mHfQe2_aprkwM9WJwWWovjWOdDq_8O-ec4TlJT8A1hjE__aK6837akozmzctwK_lYofanV0yl9YdjD4fyKsx1GKs_r5ZsFXECDf_Nf6rL9Q3Rp35KlFFFXJJrrXkV2LY7yDkN6rd6stRAfWDGs09AR-Iwv3BJZfW2_Sx5U3W198t3mOcO7RGw3T_CKGkpCpztH1i-Sp7cdy0SYRVxieSVv51bzGwuDpiGeEgoBELo6" alt="Teacher page">
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
                        <div class="home-feature-icon mb-4"><span class="material-symbols-outlined">menu_book</span></div>
                        <h3 class="home-headline fw-bold mb-3">Soạn giáo án thông minh</h3>
                        <p class="home-card-copy mb-4">AI đề xuất mục tiêu, hoạt động, học liệu và tiêu chí đánh giá bám sát chương trình mới.</p>
                        <ul class="home-check-list">
                            <li><span class="material-symbols-outlined">check_circle</span>Tích hợp chương trình GDPT 2018</li>
                            <li><span class="material-symbols-outlined">check_circle</span>Gợi ý hoạt động học tập tích cực</li>
                            <li><span class="material-symbols-outlined">check_circle</span>Cá nhân hóa theo phong cách dạy</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid rounded-4 shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxhLOjxJwOjlPih2k3lfCAxhaMFsZFGm3F7suYiCV6QUFTeldadNbMveCnfAeX_u6yRZ6IuwrNV4fzNU4fxfMF_WppInSi0sssO5wi0jspvQXbQYdDVu6Dp3BDJg8y3TbZQh4nIaD8TEXsbvlKz1pwIOn0umerFn8XYPqfpKSuFldE3MiJr6OHy_MmQfptoNAz1xN78m1ajli0nL9TSVwWfwa-qlRg3CbRWl84zEU6nsYknmHxziybI-K1SjyWhGrQTsn4MqEnT25Q" alt="Lesson plan UI">
                    </div>
                </div>
            </article>

            <article class="home-card home-card--gradient home-card--span-4">
                <div class="home-round-icon mb-4"><span class="material-symbols-outlined">quiz</span></div>
                <h3 class="home-headline fw-bold mb-3">Ma trận đề tự động</h3>
                <p class="text-white-50 mb-4">Tạo đề từ ngân hàng câu hỏi hoặc tài liệu riêng, cân bằng theo mức độ nhận thức.</p>
                <div class="home-panel p-4 bg-white bg-opacity-10 border-0">
                    <div class="home-progress mb-3"><span style="width: 70%;"></span></div>
                    <p class="small text-white-50 mb-0">Đang tạo đề kiểm tra giữa kỳ cho khối 11.</p>
                </div>
            </article>

            <article class="home-card home-card--feature home-card--span-4">
                <div class="home-feature-icon mb-4" style="background: rgba(180,0,93,.12); color: #b4005d;"><span class="material-symbols-outlined">document_scanner</span></div>
                <h3 class="home-headline fw-bold mb-3">Chấm OCR nhanh</h3>
                <p class="home-card-copy mb-4">Quét bài làm bằng camera, thống kê lỗi sai phổ biến và lưu kết quả ngay vào hệ thống.</p>
                <img class="img-fluid rounded-4" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgDC25bCQniamql2jovZDrnZh9Fym12ivtEtd8onyyJU61v6yxweLkMa4Po22D1GxHU0mX1GFxEWx2SS_EG2-2bJdSTsViAUEJciihJo788hjrfsPOdqkcAre522jdPJSiaMQWRC9KyZOnaywkfJc5RIbTw9O6VFdWdMVTCmXWu4JneSjx-kQnh_n7wbjUPD9vCGcKgWtjOC73tVQXeae6Ed1z0gsOJ7YdclUyPUasdor6NCZNX2VJknfbB8i6Nc7hL0jqJw3nMEiv" alt="OCR grading">
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
                                    <div class="home-price fs-3" style="color: #b4005d;">+12%</div>
                                    <div class="small text-uppercase fw-bold home-muted">Tiến bộ trung bình</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <img class="img-fluid rounded-4 shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAI7-s3_2q7Tk96twN1TaaAmw-reHg0Z2uXKZURAgXqtYZhVXDCq-VHjy3yRyaSlAmLYc7LdOPQcZjQmGslqvOzBoCcwIM_pKVOkyynfNiBo9q1SIPVKioFQBs784b9nYW-gq6pZAmJUWirvMiEcSnVc0Eyap7jg9V3-uiYYw4cGx-1-JqwB9BCn8FigGS4v5ytJpe9BGoG8Tdnas7doJ0NZyx0U_NnK_YfN0-Ias23pzQ1XT9PK5NVbS5BPm6STh63QcyM7WA8QNh8" alt="Analytics">
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
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAU5VslDwtmS3jKzzGz5CkupSQRSQE6Tlo5EOTHzOn2-ZXTahPkfF-0n3nh161nzDH_SZKdeBQiDrcdgRN1nV_MSFf62ufUIFBei_dPTAFJH4rGE0kDgKwHBwdj71xGITXYbmm_itFkremNl3NAj3h8DkJnaWM145S88Qic2XVHoaupVsnW4CJCxW7loTeIvFUSuFIK4cjOkJ8V7pz4qJP-E8qezuU8ybh99uZl_3dCpB7CguBm-LMhh1swwQejDsvjFHKhG7Dif7F0" alt="Teacher testimonial" class="rounded-circle" style="width: 72px; height: 72px; object-fit: cover;">
                        <div>
                            <div class="fw-bold">Cô Nguyễn Mai Anh</div>
                            <div class="home-muted">Giáo viên Ngữ văn</div>
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
