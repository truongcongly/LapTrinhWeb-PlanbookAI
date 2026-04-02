DROP DATABASE IF EXISTS planbookai;
CREATE DATABASE IF NOT EXISTS planbookai;
USE planbookai;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'staff', 'teacher') NOT NULL DEFAULT 'teacher',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password, role) VALUES
('Admin', 'admin@planbookai.com', MD5('123456'), 'admin'),
('Staff', 'staff@planbookai.com', MD5('123456'), 'staff'),
('Teacher', 'teacher@planbookai.com', MD5('123456'), 'teacher');