<?php
$host = 'localhost';
$dbname = 'web2';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Thiết lập chế độ báo lỗi để dễ dàng debug
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    // Nếu kết nối thất bại, in ra lỗi
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}
?>