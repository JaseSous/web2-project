<?php
// Nhúng file Model để lấy dữ liệu sản phẩm
require_once './models/SanPhamModel.php';

class HomeController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function index() {
        // 1. Khởi tạo Model
        $sanPhamModel = new SanPhamModel($this->conn);

        // 2. Lấy danh sách sản phẩm đang bán (hien_trang = 1)
        $danhSachSanPham = $sanPhamModel->layDanhSachSanPhamDangBan();

        // 3. Gọi file View ra để hiển thị (Truyền biến $danhSachSanPham sang cho View dùng)
        require_once './views/client/home/index.php';
    }
}
?>