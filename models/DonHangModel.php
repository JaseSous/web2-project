<?php
require_once 'BaseModel.php';

class DonHangModel extends BaseModel {
    
    // 1. Tạo đơn hàng mới
    public function taoDonHang($khach_hang_id, $ten_nguoi_nhan, $so_dien_thoai, $dia_chi, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan) {
        $sql = "INSERT INTO dondathang (khach_hang_id, ten_nguoi_nhan, so_dien_thoai_nguoi_nhan, dia_chi_giao_hang, ghi_chu, tong_tien, phuong_thuc_thanh_toan, trang_thai, thoi_gian_dat) 
                VALUES (:khach_hang_id, :ten_nguoi_nhan, :so_dien_thoai, :dia_chi, :ghi_chu, :tong_tien, :phuong_thuc_thanh_toan, 1, NOW())";
        
        $params = [
            'khach_hang_id' => $khach_hang_id,
            'ten_nguoi_nhan' => $ten_nguoi_nhan,
            'so_dien_thoai' => $so_dien_thoai,
            'dia_chi' => $dia_chi,
            'ghi_chu' => $ghi_chu,
            'tong_tien' => $tong_tien,
            'phuong_thuc_thanh_toan' => $phuong_thuc_thanh_toan
        ];

        $this->execute($sql, $params);
        return $this->conn->lastInsertId(); // Trả về ID của đơn hàng vừa tạo
    }

    // 2. Thêm từng sản phẩm vào chi tiết đơn hàng
    public function themChiTietDonHang($don_hang_id, $san_pham_id, $so_luong, $don_gia) {
        $thanh_tien = $so_luong * $don_gia;
        $sql = "INSERT INTO chitietdonhang (don_hang_id, san_pham_id, so_luong_mua, don_gia, thanh_tien) 
                VALUES (:don_hang_id, :san_pham_id, :so_luong, :don_gia, :thanh_tien)";
        
        $params = [
            'don_hang_id' => $don_hang_id,
            'san_pham_id' => $san_pham_id,
            'so_luong' => $so_luong,
            'don_gia' => $don_gia,
            'thanh_tien' => $thanh_tien
        ];
        return $this->execute($sql, $params);
    }
}
?>