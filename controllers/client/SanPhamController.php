<?php
// Nhúng Model
require_once './models/SanPhamModel.php';

class SanPhamController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function chitiet() {
        // Lấy ID sản phẩm từ URL, ép kiểu về số nguyên để bảo mật
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id > 0) {
            $sanPhamModel = new SanPhamModel($this->conn);
            $sp = $sanPhamModel->layChiTietSanPham($id);

            if ($sp) {
                // Gọi View chi tiết để hiển thị
                require_once './views/client/sanpham/chitiet.php';
            } else {
                echo "<h2 style='text-align:center; margin-top: 50px;'>Sản phẩm không tồn tại hoặc đã bị xóa!</h2>";
            }
        } else {
            echo "<h2 style='text-align:center; margin-top: 50px;'>ID sản phẩm không hợp lệ!</h2>";
        }
    }
}
?>