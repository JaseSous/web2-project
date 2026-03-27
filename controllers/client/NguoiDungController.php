<?php
require_once './models/NguoiDungModel.php';

class NguoiDungController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // --- HIỂN THỊ FORM ĐĂNG NHẬP ---
    public function dangnhap() {
        // Nếu đã đăng nhập rồi thì đá về trang chủ, không cho vào trang này nữa
        if (isset($_SESSION['user_client'])) {
            header("Location: index.php");
            exit();
        }
        
        $error = '';
        // Xử lý khi người dùng bấm nút Đăng nhập (Gửi form POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $mat_khau = $_POST['mat_khau'];

            if (empty($email) || empty($mat_khau)) {
                $error = "Vui lòng nhập đầy đủ Email và Mật khẩu!";
            } else {
                $userModel = new NguoiDungModel($this->conn);
                $user = $userModel->kiemTraDangNhap($email, $mat_khau);

                if ($user) {
                    // Đăng nhập thành công -> Lưu thông tin vào Session
                    $_SESSION['user_client'] = [
                        'id' => $user['id'],
                        'ho_ten' => $user['ho_ten'],
                        'email' => $user['email'],
                        'so_dien_thoai' => $user['so_dien_thoai'],
                        'dia_chi' => $user['dia_chi']
                    ];
                    // Chuyển hướng về trang chủ
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Email hoặc mật khẩu không chính xác, hoặc tài khoản đã bị khóa!";
                }
            }
        }
        // Gọi View hiển thị
        require_once './views/client/nguoidung/dangnhap.php';
    }

    // --- XỬ LÝ ĐĂNG XUẤT ---
    public function dangxuat() {
        unset($_SESSION['user_client']);
        header("Location: index.php");
        exit();
    }
}
?>