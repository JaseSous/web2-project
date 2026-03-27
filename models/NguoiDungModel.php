<?php
require_once 'BaseModel.php';

class NguoiDungModel extends BaseModel {
    
    // 1. Kiểm tra đăng nhập
    public function kiemTraDangNhap($email, $mat_khau) {
        $sql = "SELECT * FROM NguoiDung WHERE email = :email AND trang_thai = 1 LIMIT 1";
        $user = $this->getOne($sql, ['email' => $email]);

        // Kiểm tra mật khẩu (Sử dụng password_verify vì mật khẩu nên được băm mã hóa)
        if ($user && password_verify($mat_khau, $user['mat_khau'])) {
            return $user;
        }
        return false;
    }

    // 2. Kiểm tra Email đã tồn tại chưa (Dùng cho Đăng ký)
    public function kiemTraEmailTonTai($email) {
        $sql = "SELECT id FROM NguoiDung WHERE email = :email LIMIT 1";
        $user = $this->getOne($sql, ['email' => $email]);
        return $user ? true : false;
    }

    // 3. Đăng ký tài khoản mới (vai_tro = 0 là Khách hàng)
    public function dangKy($ho_ten, $email, $mat_khau, $so_dien_thoai, $dia_chi) {
        $sql = "INSERT INTO NguoiDung (ho_ten, email, mat_khau, so_dien_thoai, dia_chi, vai_tro, trang_thai) 
                VALUES (:ho_ten, :email, :mat_khau, :so_dien_thoai, :dia_chi, 0, 1)";
        
        $params = [
            'ho_ten' => $ho_ten,
            'email' => $email,
            // Mã hóa mật khẩu trước khi lưu vào DB để bảo mật
            'mat_khau' => password_hash($mat_khau, PASSWORD_DEFAULT),
            'so_dien_thoai' => $so_dien_thoai,
            'dia_chi' => $dia_chi
        ];

        return $this->execute($sql, $params);
    }
}
?>