DROP DATABASE IF EXISTS planbookai;
CREATE DATABASE IF NOT EXISTS planbookai;
USE planbookai;
SET NAMES utf8mb4;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff', 'teacher') NOT NULL DEFAULT 'teacher',
    service_plan ENUM('free', 'professional') NOT NULL DEFAULT 'free',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password, role, service_plan) VALUES
('Admin', 'admin@planbookai.com', MD5('123456'), 'admin', 'professional'),
('Staff', 'staff@planbookai.com', MD5('123456'), 'staff', 'professional'),
('Teacher', 'teacher@planbookai.com', MD5('123456'), 'teacher', 'free');

CREATE TABLE lesson_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    grade_level VARCHAR(50) NOT NULL,
    topic VARCHAR(255) NULL,
    objectives TEXT,
    activities TEXT,
    assessment TEXT,
    status ENUM('draft', 'completed') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT NOT NULL,
    question_text TEXT NOT NULL,
    subject VARCHAR(100) NOT NULL,
    topic VARCHAR(100) NOT NULL,
    difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
    option_a VARCHAR(255) DEFAULT NULL,
    option_b VARCHAR(255) DEFAULT NULL,
    option_c VARCHAR(255) DEFAULT NULL,
    option_d VARCHAR(255) DEFAULT NULL,
    correct_answer ENUM('A', 'B', 'C', 'D') DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    grade_level VARCHAR(50) NOT NULL,
    total_questions INT NOT NULL DEFAULT 0,
    duration_minutes INT NOT NULL DEFAULT 45,
    status ENUM('draft', 'published') DEFAULT 'draft',
    instructions TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE exam_answer_keys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT NOT NULL,
    answer_key TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    topic VARCHAR(100) NOT NULL,
    description TEXT,
    content TEXT,
    status ENUM('draft', 'published') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE exam_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT NOT NULL,
    teacher_id INT NOT NULL,
    student_name VARCHAR(255) NOT NULL,
    scan_file VARCHAR(255) DEFAULT NULL,
    scanned_answers TEXT NOT NULL,
    submitted_answers TEXT NULL,
    total_questions INT NOT NULL DEFAULT 0,
    correct_count INT NOT NULL DEFAULT 0,
    score DECIMAL(5,2) NOT NULL DEFAULT 0,
    feedback TEXT,
    status ENUM('auto_graded', 'needs_review', 'reviewed', 'failed') DEFAULT 'auto_graded',
    ocr_status ENUM('manual', 'uploaded', 'processing', 'needs_review', 'completed', 'failed') DEFAULT 'manual',
    ocr_confidence DECIMAL(5,2) DEFAULT NULL,
    ocr_error TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE exam_result_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    result_id INT NOT NULL,
    question_number INT NOT NULL,
    student_answer VARCHAR(10) DEFAULT NULL,
    correct_answer VARCHAR(10) DEFAULT NULL,
    is_correct TINYINT(1) DEFAULT 0,
    confidence DECIMAL(5,2) DEFAULT NULL,
    note TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE lesson_plan_samples (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    grade_level VARCHAR(50) NOT NULL,
    topic VARCHAR(255) NULL,
    objectives TEXT,
    activities TEXT,
    assessment TEXT,
    status ENUM('draft', 'approved') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE question_samples (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT NOT NULL,
    question_text TEXT NOT NULL,
    subject VARCHAR(100) NOT NULL,
    topic VARCHAR(100) NOT NULL,
    difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
    option_a VARCHAR(255) DEFAULT NULL,
    option_b VARCHAR(255) DEFAULT NULL,
    option_c VARCHAR(255) DEFAULT NULL,
    option_d VARCHAR(255) DEFAULT NULL,
    correct_answer ENUM('A', 'B', 'C', 'D') DEFAULT NULL,
    status ENUM('draft', 'approved') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE curriculum_frameworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    grade_level VARCHAR(50) NOT NULL,
    objectives TEXT,
    activities TEXT,
    assessment TEXT,
    status ENUM('draft', 'published') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE system_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO system_settings (setting_key, setting_value) VALUES
('system_name', 'PlanbookAI'),
('system_logo_text', 'PlanbookAI'),
('ai_enabled', '1'),
('ocr_enabled', '1'),
('workflow_mode', 'standard');

CREATE TABLE exam_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT NOT NULL,
    question_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE exercise_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exercise_id INT NOT NULL,
    question_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE prompt_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) DEFAULT NULL,
    prompt_content TEXT NOT NULL,
    description TEXT DEFAULT NULL,
    status ENUM('draft', 'active', 'archived') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Sample IT learning resources for staff to import into teacher modules.
-- Default staff_id = 2 and default teacher_id used by import controllers = 3.

INSERT INTO lesson_plan_samples
(staff_id, title, subject, grade_level, topic, objectives, activities, assessment, status)
VALUES
(2, 'IT Sample Lesson - HTML va CSS co ban', 'Cong nghe thong tin', 'Grade 10', 'Web co ban',
'Sau bai hoc, hoc sinh co the mo ta cau truc tai lieu HTML, su dung cac the thong dung va ap dung CSS de dinh dang trang web don gian.',
'1. Khoi dong: quan sat mot trang web va xac dinh cac thanh phan tieu de, doan van, hinh anh.
2. Hinh thanh kien thuc: gioi thieu HTML document, heading, paragraph, link, image, list va CSS selector.
3. Luyen tap: hoc sinh tao trang gioi thieu ban than gom tieu de, anh, danh sach so thich va lien ket.
4. Van dung: them CSS cho mau chu, khoang cach, bo cuc va nut lien ket.
5. Chia se: hoc sinh trinh bay san pham va nhan gop y.',
'Danh gia qua san pham trang web: dung cau truc HTML, CSS tach bach, giao dien de doc, co it nhat 5 thanh phan noi dung va khong loi hien thi co ban.', 'approved'),
(2, 'IT Sample Lesson - Thuat toan tim kiem tuyen tinh va nhi phan', 'Cong nghe thong tin', 'Grade 10', 'Thuat toan',
'Hoc sinh hieu bai toan tim kiem, mo phong duoc tim kiem tuyen tinh va tim kiem nhi phan, so sanh so buoc thuc hien trong tung truong hop.',
'1. Khoi dong: dat van de tim ten trong danh sach hoc sinh.
2. Kham pha: mo phong linear search tren danh sach chua sap xep.
3. Kham pha: mo phong binary search tren danh sach da sap xep.
4. Luyen tap nhom: tinh so lan so sanh voi danh sach 8, 16, 32 phan tu.
5. Van dung: viet ma gia hoac code Python don gian cho hai thuat toan.',
'Hoc sinh nop bang so sanh, tra loi cau hoi tinh huong va hoan thanh bai tap viet ma gia cho binary search.', 'approved'),
(2, 'IT Sample Lesson - Co so du lieu quan he va cau lenh SELECT', 'Cong nghe thong tin', 'Grade 11', 'Co so du lieu',
'Hoc sinh nhan biet bang, ban ghi, truong, khoa chinh; viet duoc cau lenh SELECT co dieu kien WHERE va sap xep ORDER BY.',
'1. Khoi dong: phan tich bang diem hoc sinh.
2. Hinh thanh kien thuc: table, row, column, primary key, foreign key.
3. Huong dan: SELECT cot, SELECT *, WHERE, ORDER BY.
4. Luyen tap: truy van bang Students va Scores theo yeu cau.
5. Van dung: de xuat cau truc bang cho he thong quan ly thu vien nho.',
'Danh gia bang 5 truy van SQL dung yeu cau, giai thich duoc y nghia khoa chinh va dieu kien loc.', 'approved'),
(2, 'IT Sample Lesson - An toan thong tin ca nhan tren Internet', 'Cong nghe thong tin', 'Grade 12', 'An toan thong tin',
'Hoc sinh nhan dien rui ro phishing, mat khau yeu, chia se du lieu qua muc; biet ap dung cac bien phap bao ve tai khoan va du lieu ca nhan.',
'1. Khoi dong: phan biet email that va email lua dao.
2. Thao luan: cac dau hieu phishing va social engineering.
3. Thuc hanh: tao mat khau manh va bat xac thuc hai lop.
4. Tinh huong: xu ly khi bi lo mat khau hoac nhan link dang nghi.
5. Cam ket hanh dong: lap checklist an toan ca nhan.',
'Danh gia qua phieu tinh huong, checklist bao mat va bai mini quiz ve phishing, password, 2FA, quyen rieng tu.', 'approved');

INSERT INTO question_samples
(staff_id, question_text, subject, topic, difficulty, option_a, option_b, option_c, option_d, correct_answer, status)
VALUES
(2, 'Trong HTML, the nao thuong duoc dung de tao lien ket den mot trang web khac?', 'Cong nghe thong tin', 'Web co ban', 'easy', '<a>', '<p>', '<img>', '<div>', 'A', 'approved'),
(2, 'Thuoc tinh CSS nao dung de thay doi mau chu cua mot phan tu?', 'Cong nghe thong tin', 'Web co ban', 'easy', 'font-size', 'background', 'color', 'margin', 'C', 'approved'),
(2, 'Phat bieu nao dung ve file CSS ngoai?', 'Cong nghe thong tin', 'Web co ban', 'medium', 'Khong the tai su dung cho nhieu trang', 'Giup tach noi dung HTML va dinh dang', 'Chi chay duoc khi co JavaScript', 'Bat buoc dat trong the body', 'B', 'approved'),
(2, 'Dieu kien quan trong de ap dung tim kiem nhi phan la gi?', 'Cong nghe thong tin', 'Thuat toan', 'easy', 'Danh sach phai da sap xep', 'Danh sach phai co dung 10 phan tu', 'Tat ca phan tu phai la chuoi', 'Khong duoc co phan tu trung nhau', 'A', 'approved'),
(2, 'Voi danh sach 16 phan tu da sap xep, tim kiem nhi phan can toi da khoang bao nhieu lan so sanh?', 'Cong nghe thong tin', 'Thuat toan', 'medium', '2', '4', '8', '16', 'B', 'approved'),
(2, 'Do phuc tap thoi gian trung binh cua tim kiem tuyen tinh theo kich thuoc n la gi?', 'Cong nghe thong tin', 'Thuat toan', 'medium', 'O(1)', 'O(log n)', 'O(n)', 'O(n log n)', 'C', 'approved'),
(2, 'Trong co so du lieu quan he, khoa chinh dung de lam gi?', 'Cong nghe thong tin', 'Co so du lieu', 'easy', 'Dinh dang mau cua bang', 'Xac dinh duy nhat moi ban ghi', 'Ma hoa toan bo du lieu', 'Xoa cac ban ghi trung lap tu dong', 'B', 'approved'),
(2, 'Cau lenh SQL nao dung de lay tat ca cot tu bang students?', 'Cong nghe thong tin', 'Co so du lieu', 'easy', 'GET students ALL', 'SELECT * FROM students', 'OPEN students', 'FIND * IN students', 'B', 'approved'),
(2, 'Menh de WHERE trong SQL co vai tro gi?', 'Cong nghe thong tin', 'Co so du lieu', 'medium', 'Sap xep ket qua', 'Nhom ket qua', 'Loc ban ghi theo dieu kien', 'Doi ten bang', 'C', 'approved'),
(2, 'Dau hieu nao thuong gap trong email phishing?', 'Cong nghe thong tin', 'An toan thong tin', 'easy', 'Noi dung yeu cau cap nhat mat khau qua link la', 'Nguoi gui la giao vien quen biet va khong co link', 'Email chi chua lich hoc da thong bao', 'File dinh kem la tai lieu da duoc xac minh', 'A', 'approved'),
(2, 'Bien phap nao tang an toan tai khoan ro ret nhat?', 'Cong nghe thong tin', 'An toan thong tin', 'medium', 'Dung cung mot mat khau cho moi dich vu', 'Bat xac thuc hai lop', 'Chia se mat khau voi ban than', 'Tat cap nhat bao mat', 'B', 'approved'),
(2, 'Vi sao khong nen cong khai thong tin ca nhan nhay cam tren mang xa hoi?', 'Cong nghe thong tin', 'An toan thong tin', 'hard', 'Vi thong tin co the bi loi dung de lua dao hoac danh cap danh tinh', 'Vi mang xa hoi khong cho dang anh', 'Vi trinh duyet se tu dong xoa tai khoan', 'Vi thong tin ca nhan khong bao gio thay doi', 'A', 'approved');

INSERT INTO prompt_templates
(staff_id, title, category, prompt_content, description, status)
VALUES
(2, 'IT Prompt - Tao giao an theo chu de CNTT', 'lesson_plan',
'Ban la tro ly giao vien mon Cong nghe thong tin. Hay tao giao an chi tiet cho chu de: {topic}. Dau vao gom khoi lop: {grade_level}, thoi luong: {duration}, muc tieu can dat: {objectives}. Ket qua can co: muc tieu, chuan bi, tien trinh day hoc theo tung hoat dong, cau hoi goi mo, bai tap thuc hanh va tieu chi danh gia.',
'Prompt ho tro teacher tao lesson plan CNTT co muc tieu, hoat dong va danh gia ro rang.', 'active'),
(2, 'IT Prompt - Tao cau hoi cho Question Bank CNTT', 'question_bank',
'Hay tao cau hoi trac nghiem mon Cong nghe thong tin ve chu de: {topic}, khoi lop: {grade_level}, do kho: {difficulty}. Ket qua can co: noi dung cau hoi ro rang, 4 lua chon A/B/C/D, chi mot dap an dung, giai thich ngan vi sao dap an dung.',
'Prompt ho tro teacher tao cau hoi chat luong de dua vao question bank.', 'active');
