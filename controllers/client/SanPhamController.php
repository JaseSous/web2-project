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

    public function danhsach() {
        $sanPhamModel = new SanPhamModel($this->conn);

        // 1. Nhận các tham số tìm kiếm từ URL (nếu có)
        $tu_khoa = isset($_GET['tu_khoa']) ? trim($_GET['tu_khoa']) : '';
        $loai_id = isset($_GET['loai_id']) ? (int)$_GET['loai_id'] : 0;
        $gia_tu = isset($_GET['gia_tu']) ? (float)$_GET['gia_tu'] : 0;
        $gia_den = isset($_GET['gia_den']) ? (float)$_GET['gia_den'] : 0;

        // 2. Thiết lập cấu hình phân trang
        $limit = 6; // Hiển thị 6 sản phẩm 1 trang cho dễ thấy phân trang hoạt động
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page <= 0) $page = 1;
        $offset = ($page - 1) * $limit;

        // 3. Gọi Model để lấy dữ liệu
        $danhSachLoai = $sanPhamModel->layDanhSachLoai(); // Lấy danh mục cho Sidebar
        $tongSanPham = $sanPhamModel->demTongSanPhamCoLoc($tu_khoa, $loai_id, $gia_tu, $gia_den);
        
        // Tính tổng số trang (làm tròn lên)
        $tongSoTrang = ceil($tongSanPham / $limit); 
        
        $danhSachSanPham = $sanPhamModel->layDanhSachSanPhamCoLoc($tu_khoa, $loai_id, $gia_tu, $gia_den, $limit, $offset);

        // 4. Gọi View hiển thị
        require_once './views/client/sanpham/danhsach.php';
    }
}
?>