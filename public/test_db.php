<?php

$config = require __DIR__ . '/../config/database.php';

$conn = new mysqli(
    $config['host'],
    $config['username'],
    $config['password'],
    $config['dbname']
);

if ($conn->connect_error) {
    die("❌ Lỗi: " . $conn->connect_error);
}

echo "✅ Kết nối database thành công!";