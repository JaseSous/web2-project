<?php
require_once './models/DonHangModel.php';

class DonhangController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
        
        // CHỐT CHẶN: Phải đăng nhập mới được xem lịch sử
        if (!isset($_SESSION['user_client'])) {
            header("Location: index.php?area=client&controller=nguoidung&action=dangnhap");
            exit();
        }
    }

    // Hiển thị danh sách đơn hàng đã mua
    public function lichsu() {
        $user = $_SESSION['user_client'];
        $donHangModel = new DonHangModel($this->conn);
        
        // Lấy toàn bộ đơn hàng của user đang đăng nhập
        $danhSachDonHang = $donHangModel->layLichSuDonHang($user['id']);

        // Gọi View hiển thị
        require_once './views/client/donhang/lichsu.php';
    }

    // Hiển thị chi tiết 1 đơn hàng
    public function chitiet() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $user = $_SESSION['user_client'];

        if ($id > 0) {
            $donHangModel = new DonHangModel($this->conn);
            
            // Lấy thông tin đơn hàng
            $donHang = $donHangModel->layDonHangTheoId($id, $user['id']);

            if ($donHang) {
                // Nếu đơn hàng tồn tại và đúng là của khách này -> Lấy tiếp danh sách món đồ
                $chiTietDon = $donHangModel->layChiTietSanPhamTrongDon($id);
                
                // Gọi view hiển thị
                require_once './views/client/donhang/chitiet.php';
                return; // Kết thúc hàm
            }
        }
        
        // Nếu ID bậy bạ hoặc cố tình nhập ID đơn của người khác, đá về trang lịch sử
        header("Location: index.php?area=client&controller=donhang&action=lichsu");
        exit();
    }
}
?>