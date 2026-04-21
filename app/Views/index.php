<?php
$title = 'PlanbookAI - Kiến tạo tương lai giáo dục cùng AI';
$currentPage = 'home';
include __DIR__ . '/layouts/marketing_header.php';
?>

<section class="home-page-hero home-mesh-gradient">
    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-xl-10">
                <span class="home-pill home-pill--soft mb-4">
                    <i class="bi bi-stars"></i>
                    Kỷ nguyên giáo dục 4.0 đã bắt đầu
                </span>
                <h1 class="home-hero-title mb-4">
                    Trao quyền cho
                    <span class="home-gradient-text">người khai sáng hiện đại</span>
                </h1>
                <p class="home-hero-desc fs-4 mx-auto mb-5" style="max-width: 920px;">
                    PlanbookAI không chỉ là một công cụ. Đây là hệ sinh thái giúp giáo viên, nhà trường và học sinh cùng làm việc thông minh hơn bằng AI.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
                    <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn home-btn-primary px-5 py-3">Khởi tạo miễn phí ngay</a>
                    <a href="/LapTrinhWeb-PlanbookAI/public/giao-vien" class="btn home-btn-secondary px-5 py-3">Xem giải pháp cho giáo viên</a>
                </div>
            </div>
        </div>

        <div class="home-glass-card p-3 p-lg-4 mx-auto" style="max-width: 1120px;">
            <img class="home-dashboard-image" src="/LapTrinhWeb-PlanbookAI/public/images/home-classroom.jpg" alt="Giáo viên và học sinh trong lớp học">
        </div>
    </div>
</section>

<section class="home-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="position-relative">
                    <img class="img-fluid rounded-5 shadow-lg" src="/LapTrinhWeb-PlanbookAI/public/images/home-teacher-desk.jpg" alt="Bàn làm việc giáo viên với sách vở">
                    <div class="home-float-card home-glass-card d-none d-md-block">
                        <span class="home-price d-block">15h</span>
                        <p class="fw-bold mb-1">Thời gian lấy lại mỗi tuần</p>
                        <p class="small home-muted mb-0">AI xử lý phần lặp lại để giáo viên dành thời gian cho sáng tạo và kết nối với học sinh.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="home-pill home-pill--secondary mb-3">Món quà của thời gian</span>
                <h2 class="home-section-title">Khi máy móc làm việc, con người có thể sáng tạo</h2>
                <p class="home-section-desc mb-4">
                    PlanbookAI giúp giảm áp lực soạn bài, lên kế hoạch, chấm bài và báo cáo. Khi phần nặng tính thủ tục được tự động hóa, giáo viên có thể quay lại điều cốt lõi của nghề dạy học.
                </p>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="home-card h-100">
                            <div class="home-feature-icon mb-3">
                                <i class="bi bi-magic"></i>
                            </div>
                            <h3 class="home-headline fw-bold fs-4 mb-2">Tự động hóa hoàn toàn</h3>
                            <p class="home-card-copy mb-0">Soạn giáo án chuẩn và tạo học liệu chỉ với vài câu lệnh ngắn.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="home-card h-100">
                            <div class="home-feature-icon mb-3" style="background: rgba(0, 191, 165, 0.12); color: #00bfa5;">
                                <i class="bi bi-circle-half"></i>
                            </div>
                            <h3 class="home-headline fw-bold fs-4 mb-2">Cân bằng cuộc sống</h3>
                            <p class="home-card-copy mb-0">Giảm tải giấy tờ để mỗi ngày đến trường là một trải nghiệm nhẹ nhàng hơn.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-section" style="background: #f8fafc;">
    <div class="container">
        <div class="home-section-header text-center">
            <span class="home-pill home-pill--secondary mb-3">Hệ sinh thái thông minh</span>
            <h2 class="home-section-title">Chọn đúng hành trình cho từng nhóm người dùng</h2>
            <p class="home-section-desc mx-auto" style="max-width: 760px;">
                Sáu file HTML mẫu giờ đã được tách thành sáu trang public riêng. Từ đây người dùng có thể đi thẳng đến đúng nội dung họ cần.
            </p>
        </div>

        <div class="home-bento">
            <article class="home-card home-card--feature home-card--span-4">
                <div class="home-feature-icon mb-4">
                    <i class="bi bi-person-video3"></i>
                </div>
                <h3 class="home-headline fw-bold mb-3">Giáo viên</h3>
                <p class="home-card-copy mb-4">Soạn giáo án AI, tạo đề, chấm OCR và xem báo cáo lớp học.</p>
                <a href="/LapTrinhWeb-PlanbookAI/public/giao-vien" class="btn home-btn-secondary">Xem trang giáo viên</a>
            </article>

            <article class="home-card home-card--gradient home-card--span-4">
                <div class="home-round-icon mb-4">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <h3 class="home-headline fw-bold mb-3">Trường học</h3>
                <p class="text-white-50 mb-4">Quản trị tiến độ, kiểm duyệt giáo án, thống kê theo tổ và điều hành toàn trường.</p>
                <a href="/LapTrinhWeb-PlanbookAI/public/truong-hoc" class="btn home-btn-secondary">Xem trang trường học</a>
            </article>

            <article class="home-card home-card--feature home-card--span-4">
                <div class="home-feature-icon mb-4" style="background: rgba(219, 234, 254, 0.9); color: #1d4ed8;">
                    <i class="bi bi-phone-fill"></i>
                </div>
                <h3 class="home-headline fw-bold mb-3">Ứng dụng di động</h3>
                <p class="home-card-copy mb-4">Dạy học, chấm bài và theo dõi lịch trình ở bất cứ đâu trên điện thoại.</p>
                <a href="/LapTrinhWeb-PlanbookAI/public/ung-dung-di-dong" class="btn home-btn-secondary">Xem mobile app</a>
            </article>
        </div>
    </div>
</section>

<section class="home-dark-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="home-section-title text-white">Sức mạnh của sự chuyển đổi thực thụ</h2>
                <p class="fs-5 text-white-50 mb-0">Những con số này phản ánh lợi ích trực tiếp mà giáo viên và nhà trường nhận được khi đưa AI vào quy trình giảng dạy.</p>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="home-dark-stat">
                            <div class="home-price" style="color: #00bfa5;">50.000+</div>
                            <p class="mb-0 text-white-50">Giáo viên sử dụng</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="home-dark-stat">
                            <div class="home-price" style="color: #2563eb;">2 triệu</div>
                            <p class="mb-0 text-white-50">Giáo án được AI hỗ trợ</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="home-dark-stat">
                            <div class="home-price" style="color: #8ab4ff;">500+</div>
                            <p class="mb-0 text-white-50">Trường học đồng hành</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="home-dark-stat">
                            <div class="home-price" style="color: #ffffff;">98%</div>
                            <p class="mb-0 text-white-50">Mức độ hài lòng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-section">
    <div class="container text-center">
        <h2 class="home-section-title mb-4">Tương lai giáo dục bắt đầu từ bạn</h2>
        <p class="home-section-desc fs-5 mx-auto mb-4" style="max-width: 760px;">
            Hãy bắt đầu bằng việc chọn đúng trang phù hợp với nhu cầu: giáo viên, trường học, bảng giá, ứng dụng di động hoặc liên hệ tư vấn.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="/LapTrinhWeb-PlanbookAI/public/register" class="btn home-btn-primary px-5 py-3">Bắt đầu trải nghiệm</a>
            <a href="/LapTrinhWeb-PlanbookAI/public/lien-he" class="btn home-btn-secondary px-5 py-3">Liên hệ giải pháp trường học</a>
        </div>
    </div>
</section>

<div class="home-ai-chatbot is-collapsed" data-planbook-chatbot>
    <section class="home-ai-chat-window" aria-label="Trợ lý tư vấn PlanbookAI" data-chat-window>
        <div class="home-ai-chat-header">
            <div class="home-ai-chat-avatar" aria-hidden="true">
                <i class="bi bi-stars"></i>
            </div>
            <div>
                <h2>Trợ lý PlanbookAI</h2>
                <p>Đang sẵn sàng tư vấn</p>
            </div>
            <button class="home-ai-icon-btn" type="button" aria-label="Thu nhỏ chat" data-chat-close>
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="home-ai-chat-messages" data-chat-messages>
            <div class="home-ai-message home-ai-message--bot">
                <p>Xin chào! Mình có thể tư vấn nhanh về PlanbookAI: soạn giáo án, tạo đề, quản lý trường học, bảng giá hoặc cách bắt đầu dùng thử.</p>
            </div>
        </div>

        <div class="home-ai-chat-suggestions" aria-label="Câu hỏi gợi ý">
            <button type="button" data-chat-suggestion="PlanbookAI giúp giáo viên như thế nào?">Cho giáo viên</button>
            <button type="button" data-chat-suggestion="Nhà trường dùng PlanbookAI để làm gì?">Cho nhà trường</button>
            <button type="button" data-chat-suggestion="Tôi muốn biết bảng giá">Bảng giá</button>
        </div>

        <form class="home-ai-chat-form" data-chat-form>
            <label class="visually-hidden" for="homeAiChatInput">Nhập câu hỏi cho PlanbookAI</label>
            <input id="homeAiChatInput" type="text" placeholder="Hỏi về PlanbookAI..." autocomplete="off" data-chat-input>
            <button type="submit" aria-label="Gửi câu hỏi">
                <i class="bi bi-send-fill"></i>
            </button>
        </form>
    </section>

    <button class="home-ai-chat-toggle" type="button" aria-label="Mở chat tư vấn PlanbookAI" aria-expanded="false" data-chat-toggle>
        <i class="bi bi-chat-dots-fill"></i>
        <span class="home-ai-chat-pulse" aria-hidden="true"></span>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const chatbot = document.querySelector('[data-planbook-chatbot]');

    if (!chatbot) {
        return;
    }

    const toggleBtn = chatbot.querySelector('[data-chat-toggle]');
    const closeBtn = chatbot.querySelector('[data-chat-close]');
    const form = chatbot.querySelector('[data-chat-form]');
    const input = chatbot.querySelector('[data-chat-input]');
    const messages = chatbot.querySelector('[data-chat-messages]');
    const suggestions = chatbot.querySelectorAll('[data-chat-suggestion]');

    const answers = [
        {
            keywords: ['giao vien', 'giáo viên', 'soan', 'soạn', 'giao an', 'giáo án', 'tao de', 'tạo đề', 'cham bai', 'chấm bài'],
            text: 'Với giáo viên, PlanbookAI hỗ trợ soạn giáo án theo khung chương trình, tạo câu hỏi/bài tập, gợi ý hoạt động dạy học và giảm thời gian xử lý công việc lặp lại.'
        },
        {
            keywords: ['truong', 'trường', 'nha truong', 'nhà trường', 'quan ly', 'quản lý', 'to chuyen mon', 'tổ chuyên môn'],
            text: 'Với nhà trường, PlanbookAI giúp quản lý giáo án, theo dõi tiến độ, hỗ trợ kiểm duyệt nội dung và tổng hợp báo cáo cho tổ chuyên môn hoặc ban giám hiệu.'
        },
        {
            keywords: ['gia', 'giá', 'bang gia', 'bảng giá', 'chi phi', 'chi phí', 'goi', 'gói'],
            text: 'Bạn có thể xem các gói dịch vụ tại mục Bảng giá. Nếu cần triển khai cho trường học, PlanbookAI có thể tư vấn theo số lượng giáo viên và nhu cầu quản trị.'
        },
        {
            keywords: ['dang ky', 'đăng ký', 'dung thu', 'dùng thử', 'bat dau', 'bắt đầu', 'tai khoan', 'tài khoản'],
            text: 'Để bắt đầu, bạn nhấn Đăng ký trên thanh menu hoặc nút Khởi tạo miễn phí ngay. Sau khi có tài khoản, giáo viên có thể vào workspace để tạo giáo án và học liệu.'
        },
        {
            keywords: ['lien he', 'liên hệ', 'tu van', 'tư vấn', 'hotline', 'email'],
            text: 'Bạn có thể vào trang Liên hệ để gửi yêu cầu tư vấn. Đội ngũ PlanbookAI sẽ hỗ trợ chọn giải pháp phù hợp cho giáo viên cá nhân hoặc nhà trường.'
        },
        {
            keywords: ['mobile', 'di dong', 'di động', 'ung dung', 'ứng dụng', 'dien thoai', 'điện thoại'],
            text: 'Ứng dụng di động giúp giáo viên theo dõi lịch trình, xử lý công việc và xem nội dung học tập thuận tiện hơn trên điện thoại.'
        }
    ];

    function normalizeText(text) {
        return text.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    }

    function addMessage(text, type) {
        const bubble = document.createElement('div');
        const paragraph = document.createElement('p');

        bubble.className = 'home-ai-message home-ai-message--' + type;
        paragraph.textContent = text;
        bubble.appendChild(paragraph);
        messages.appendChild(bubble);
        messages.scrollTop = messages.scrollHeight;
    }

    function getAnswer(question) {
        const normalizedQuestion = normalizeText(question);
        const matchedAnswer = answers.find(function (answer) {
            return answer.keywords.some(function (keyword) {
                return normalizedQuestion.includes(normalizeText(keyword));
            });
        });

        return matchedAnswer
            ? matchedAnswer.text
            : 'PlanbookAI là nền tảng AI hỗ trợ giáo viên và nhà trường xây dựng giáo án, học liệu, câu hỏi, bài tập và báo cáo. Bạn có thể hỏi mình về giáo viên, nhà trường, bảng giá, đăng ký hoặc liên hệ tư vấn.';
    }

    function submitQuestion(question) {
        const trimmedQuestion = question.trim();

        if (!trimmedQuestion) {
            return;
        }

        addMessage(trimmedQuestion, 'user');
        input.value = '';

        setTimeout(function () {
            addMessage(getAnswer(trimmedQuestion), 'bot');
        }, 350);
    }

    function setOpenState(isOpen) {
        chatbot.classList.toggle('is-collapsed', !isOpen);
        toggleBtn.setAttribute('aria-expanded', String(isOpen));

        if (isOpen) {
            window.setTimeout(function () {
                input.focus();
            }, 120);
        }
    }

    toggleBtn.addEventListener('click', function () {
        setOpenState(chatbot.classList.contains('is-collapsed'));
    });

    closeBtn.addEventListener('click', function () {
        setOpenState(false);
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        submitQuestion(input.value);
    });

    suggestions.forEach(function (button) {
        button.addEventListener('click', function () {
            submitQuestion(button.dataset.chatSuggestion || button.textContent);
        });
    });
});
</script>

<?php include __DIR__ . '/layouts/marketing_footer.php'; ?>
