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

    // --- HIỂN THỊ VÀ XỬ LÝ FORM ĐĂNG KÝ ---
    public function dangky() {
        // Nếu đã đăng nhập rồi thì đá về trang chủ
        if (isset($_SESSION['user_client'])) {
            header("Location: index.php");
            exit();
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form và loại bỏ khoảng trắng thừa
            $ho_ten = trim($_POST['ho_ten']);
            $email = trim($_POST['email']);
            $so_dien_thoai = trim($_POST['so_dien_thoai']);
            $dia_chi = trim($_POST['dia_chi']);
            $mat_khau = $_POST['mat_khau'];
            $xac_nhan_mat_khau = $_POST['xac_nhan_mat_khau'];

            // 1. Kiểm tra rỗng (Validation cơ bản)
            if (empty($ho_ten) || empty($email) || empty($so_dien_thoai) || empty($dia_chi) || empty($mat_khau)) {
                $error = "Vui lòng điền đầy đủ tất cả thông tin!";
            } 
            // 2. Kiểm tra mật khẩu khớp nhau
            elseif ($mat_khau !== $xac_nhan_mat_khau) {
                $error = "Mật khẩu xác nhận không khớp!";
            } 
            // 3. Kiểm tra độ dài mật khẩu (bảo mật)
            elseif (strlen($mat_khau) < 6) {
                $error = "Mật khẩu phải có ít nhất 6 ký tự!";
            } 
            else {
                $userModel = new NguoiDungModel($this->conn);
                
                // 4. Kiểm tra Email đã có người dùng chưa
                if ($userModel->kiemTraEmailTonTai($email)) {
                    $error = "Email này đã được đăng ký. Vui lòng sử dụng email khác hoặc Đăng nhập!";
                } else {
                    // 5. Tiến hành lưu vào database
                    $ket_qua = $userModel->dangKy($ho_ten, $email, $mat_khau, $so_dien_thoai, $dia_chi);
                    
                    if ($ket_qua) {
                        $success = "Đăng ký tài khoản thành công! Bạn có thể đăng nhập ngay bây giờ.";
                        // Xóa trống các biến để form không hiển thị lại dữ liệu cũ
                        $ho_ten = $email = $so_dien_thoai = $dia_chi = ''; 
                    } else {
                        $error = "Có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại sau!";
                    }
                }
            }
        }

        // Gọi View hiển thị
        require_once './views/client/nguoidung/dangky.php';
    }
}
?>