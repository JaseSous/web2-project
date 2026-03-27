<?php
require_once './models/DonHangModel.php';

class ThanhToanController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
        
        // CHỐT CHẶN: Ép đăng nhập và phải có hàng trong giỏ
        if (!isset($_SESSION['user_client'])) {
            header("Location: index.php?area=client&controller=nguoidung&action=dangnhap");
            exit();
        }
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            header("Location: index.php?area=client&controller=giohang&action=index");
            exit();
        }
    }

    // Giao diện Thanh toán
    public function index() {
        $user = $_SESSION['user_client'];
        $cart = $_SESSION['cart'];
        
        $tongTien = 0;
        foreach ($cart as $item) {
            $tongTien += ($item['gia'] * $item['so_luong']);
        }

        require_once './views/client/thanhtoan/index.php';
    }

    // Xử lý khi bấm nút Xác nhận đặt hàng
    public function xuly() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_SESSION['user_client'];
            $cart = $_SESSION['cart'];

            $ten_nguoi_nhan = trim($_POST['ten_nguoi_nhan']);
            $so_dien_thoai = trim($_POST['so_dien_thoai']);
            $dia_chi = trim($_POST['dia_chi']);
            $ghi_chu = trim($_POST['ghi_chu']);
            
            // Xử lý phương thức thanh toán (1: COD, 2: CK, 3: VNPAY)
            $pt_text = $_POST['phuong_thuc_thanh_toan'];
            $pt_thanh_toan_id = 1; 
            if ($pt_text == 'Chuyển khoản') $pt_thanh_toan_id = 2;
            if ($pt_text == 'VNPAY') $pt_thanh_toan_id = 3;

            // Tính tổng tiền
            $tongTien = 0;
            foreach ($cart as $item) {
                $tongTien += ($item['gia'] * $item['so_luong']);
            }

            $donHangModel = new DonHangModel($this->conn);

            // 1. Tạo đơn hàng tổng
            $don_hang_id = $donHangModel->taoDonHang($user['id'], $ten_nguoi_nhan, $so_dien_thoai, $dia_chi, $ghi_chu, $tongTien, $pt_thanh_toan_id);

            if ($don_hang_id > 0) {
                // 2. Lặp giỏ hàng đưa vào chi tiết
                foreach ($cart as $item) {
                    $donHangModel->themChiTietDonHang($don_hang_id, $item['id'], $item['so_luong'], $item['gia']);
                }

                // 3. Dọn dẹp giỏ hàng
                unset($_SESSION['cart']);

                // 4. Thông báo và chuyển hướng
                echo "<script>alert('VOGUE đã nhận được đơn đặt hàng của bạn!'); window.location.href='index.php';</script>";
                exit();
            } else {
                echo "<script>alert('Có lỗi xảy ra, vui lòng thử lại!'); history.back();</script>";
            }
        }
    }
}
?>