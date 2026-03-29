# LapTrinhWeb-PlanbookAI
PlanbookAI - Xây dựng cổng công cụ AI dành cho giáo viên trung học phổ thông
## 1. Mục tiêu dự án

Dự án được xây dựng nhằm mô phỏng một hệ thống quản lý học liệu và công cụ hỗ trợ giáo viên với các tác nhân chính:

- **Admin**
- **Teacher**
- **User**

---
## 2. Công nghệ sử dụng

### Backend
- PHP thuần
- Mô hình MVC tự tổ chức
- Composer autoload (PSR-4)

### Frontend
- HTML
- CSS
- JavaScript

### Database
- MySQL

### Công cụ phát triển
- VS Code
- XAMPP (dùng Apache)
- MySQL Workbench
- Composer
- Git / GitHub

---
## 3. Kiến trúc hệ thống

- Hệ thống hoạt động theo luồng:

URL → public/index.php → Router → Controller → Model → View

- Giải thích:
- public/index.php: điểm vào chính của ứng dụng
- Router.php: phân tích URL và gọi controller phù hợp
- Controllers/: xử lý logic cho từng module
- Models/: thao tác dữ liệu với database
- Views/: hiển thị giao diện cho người dùng

---
## 4. Cấu hình project
- composer.json

Dự án sử dụng Composer để tự động nạp class theo chuẩn PSR-4.

```json
{
    "name": "planbookai/app",
    "autoload": {
        "psr-4": {
            "App\\": "app/"
        }
    }
}

Sau khi thêm hoặc sửa class/namespace, chạy:

composer dump-autoload

```
## 5. Cấu hình database

### 5.1. File config/database.php

```php
<?php
return [
    'host' => '127.0.0.1',
    'dbname' => 'planbookai',
    'username' => 'root',
    'password' => 'YOUR_PASSWORD'
];
```
Lưu ý: Nếu máy đang dùng MySQL Server riêng thay vì MySQL trong XAMPP, hãy nhập đúng password đang dùng trong MySQL Workbench.

### 5.2. File config/app.php
```php
<?php
return [
    'base_url' => 'http://localhost/LapTrinhWeb-PlanbookAI/public'
];
```
---

## 6. Cơ sở dữ liệu

Tạo database

Có thể chạy trực tiếp file database.sql trong MySQL Workbench hoặc phpMyAdmin.

Nội dung cơ bản:
```sql
CREATE DATABASE IF NOT EXISTS planbookai;
USE planbookai;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'teacher', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password, role) VALUES
('Admin', 'admin@planbookai.com', MD5('123456'), 'admin'),
('Teacher', 'teacher@planbookai.com', MD5('123456'), 'teacher'),
('User', 'user@planbookai.com', MD5('123456'), 'user');
```
---

## 7. Cách chạy dự án

7.1. Đặt project vào thư mục XAMPP  
C:\xampp\htdocs\LapTrinhWeb-PlanbookAI

7.2. Bật Apache  
Mở XAMPP Control Panel và bật Apache  
Không bắt buộc bật MySQL trong XAMPP nếu bạn đang dùng MySQL Server riêng

7.3. Chạy Composer autoload  
cd C:\xampp\htdocs\LapTrinhWeb-PlanbookAI  
composer dump-autoload

---

## 8. Ghi chú về MySQL

Apache từ XAMPP  
MySQL Server riêng (ví dụ MySQL84)  
MySQL Workbench để quản lý database  

Nếu MySQL trong XAMPP không khởi động được, có thể do trùng cổng 3306  
Không bắt buộc phải dùng MySQL của XAMPP nếu đã có MySQL Server riêng

---

## 9. Ghi chú về vendor/

Sau khi chạy composer dump-autoload, project sẽ sinh ra thư mục vendor/  
Đây là thư mục bình thường do Composer tạo ra để autoload class, không phải lỗi

---

## 10. Hướng phát triển tiếp theo

Người 1: hoàn thiện login,register, dashboard admin,user,teacher

Người 2: Lesson Plan, Curriculum Framework  

Người 3: Question Bank, Exercise Creation  

Người 4: Exam Generation, Grading, Result  

Người 5: Workspace, Approval, UI Integration