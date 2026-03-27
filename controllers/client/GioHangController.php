<?php
require_once './models/SanPhamModel.php';

class GioHangController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
        
        // CHỐT CHẶN BẮT BUỘC ĐĂNG NHẬP
        // Nếu chưa đăng nhập, ép chuyển hướng về trang Đăng nhập
        if (!isset($_SESSION['user_client'])) {
            header("Location: index.php?area=client&controller=nguoidung&action=dangnhap");
            exit();
        }

        // Khởi tạo mảng giỏ hàng trong Session nếu nó chưa tồn tại
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // 1. Hiển thị trang Giỏ hàng
    public function index() {
        $cart = $_SESSION['cart'];
        $tongTien = 0;
        
        // Tính tổng tiền các sản phẩm trong giỏ
        foreach ($cart as $item) {
            $tongTien += ($item['gia'] * $item['so_luong']);
        }

        require_once './views/client/giohang/index.php';
    }

    // 2. Thêm sản phẩm vào giỏ (Nhận dữ liệu từ form ở trang Chi tiết)
    public function them() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_san_pham = isset($_POST['id_san_pham']) ? (int)$_POST['id_san_pham'] : 0;
            $so_luong = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 1;

            if ($id_san_pham > 0 && $so_luong > 0) {
                $sanPhamModel = new SanPhamModel($this->conn);
                $sp = $sanPhamModel->layChiTietSanPham($id_san_pham);

                if ($sp) {
                    // Nếu sản phẩm ĐÃ CÓ trong giỏ, ta cộng dồn số lượng
                    if (isset($_SESSION['cart'][$id_san_pham])) {
                        $_SESSION['cart'][$id_san_pham]['so_luong'] += $so_luong;
                    } 
                    // Nếu CHƯA CÓ, ta thêm mới một mảng con chứa thông tin SP vào giỏ
                    else {
                        $_SESSION['cart'][$id_san_pham] = [
                            'id' => $sp['id'],
                            'ten_sp' => $sp['ten_sp'],
                            'hinh_anh' => $sp['hinh_anh'],
                            'gia' => $sp['gia_ban_de_xuat'],
                            'so_luong' => $so_luong
                        ];
                    }
                }
            }
        }
        // Thêm xong, lập tức chuyển hướng sang trang xem giỏ hàng
        header("Location: index.php?area=client&controller=giohang&action=index");
        exit();
    }

    // 3. Xóa một sản phẩm khỏi giỏ
    public function xoa() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        // Xóa phần tử mảng dựa vào ID sản phẩm (key)
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        
        // Quay lại trang giỏ hàng
        header("Location: index.php?area=client&controller=giohang&action=index");
        exit();
    }

    // 4. Cập nhật số lượng sản phẩm trong giỏ
    public function capnhat() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            $so_luong = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 1;

            if ($id > 0) {
                if ($so_luong > 0) {
                    // Cập nhật lại số lượng mới
                    if (isset($_SESSION['cart'][$id])) {
                        $_SESSION['cart'][$id]['so_luong'] = $so_luong;
                    }
                } else {
                    // Nếu khách cố tình nhập số lượng <= 0, ta xóa luôn sản phẩm đó khỏi giỏ
                    if (isset($_SESSION['cart'][$id])) {
                        unset($_SESSION['cart'][$id]);
                    }
                }
            }
        }
        
        // Cập nhật xong thì quay lại trang giỏ hàng để thấy kết quả và tổng tiền mới
        header("Location: index.php?area=client&controller=giohang&action=index");
        exit();
    }

    // 5. Hàm cập nhật số lượng ngầm bằng AJAX (Không tải lại trang)
    public function capnhatAjax() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            $so_luong = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 1;

            if ($id > 0 && isset($_SESSION['cart'][$id])) {
                if ($so_luong > 0) {
                    $_SESSION['cart'][$id]['so_luong'] = $so_luong;
                } else {
                    // Tránh trường hợp nhập số âm hoặc 0 bằng cách ép về 1
                    $_SESSION['cart'][$id]['so_luong'] = 1;
                }
            }

            // Tính lại tổng tiền sau khi cập nhật
            $tongTien = 0;
            foreach ($_SESSION['cart'] as $item) {
                $tongTien += ($item['gia'] * $item['so_luong']);
            }

            // Trả dữ liệu về dưới dạng JSON cho Javascript đọc
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'tongTienFormat' => number_format($tongTien, 0, ',', '.')
            ]);
            exit(); // Bắt buộc phải có exit() để ngắt luồng HTML
        }
    }
}
?>