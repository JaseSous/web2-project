<?php
// Nhúng file Model để lấy dữ liệu sản phẩm
require_once './models/SanPhamModel.php';

class HomeController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function index() {
        $sanPhamModel = new SanPhamModel($this->conn);

        // Thay đổi: Chỉ gọi 4 sản phẩm mới nhất ra trang chủ
        $danhSachSanPham = $sanPhamModel->laySanPhamMoiNhat(4);

        require_once './views/client/home/index.php';
    }
}
?>