<?php
require_once 'BaseModel.php';

class SanPhamModel extends BaseModel {
    // Hàm lấy danh sách quần áo đang được phép bán
    public function layDanhSachSanPhamDangBan() {
        $sql = "SELECT * FROM SanPham WHERE hien_trang = 1 ORDER BY id DESC";
        // Chỉ cần gọi hàm getAll() từ BaseModel là xong!
        return $this->getAll($sql);
    }

    // Hàm lấy chi tiết 1 sản phẩm dựa vào ID
    public function layChiTietSanPham($id_san_pham) {
        $sql = "SELECT * FROM SanPham WHERE id = :id";
        // Truyền tham số an toàn (Named Parameter) vào mảng
        return $this->getOne($sql, ['id' => $id_san_pham]);
    }
}
?>