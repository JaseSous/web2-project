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

    // Lấy tất cả danh mục (Loại sản phẩm) để đưa vào thanh bộ lọc
    public function layDanhSachLoai() {
        $sql = "SELECT * FROM LoaiSanPham";
        return $this->getAll($sql);
    }

    // Đếm tổng số sản phẩm thỏa mãn điều kiện lọc (để tính ra số trang)
    public function demTongSanPhamCoLoc($tu_khoa = '', $loai_id = 0, $gia_tu = 0, $gia_den = 0) {
        $sql = "SELECT COUNT(*) as total FROM SanPham WHERE hien_trang = 1";
        $params = [];

        if ($tu_khoa != '') {
            $sql .= " AND ten_sp LIKE :tu_khoa";
            $params['tu_khoa'] = "%$tu_khoa%";
        }
        if ($loai_id > 0) {
            $sql .= " AND loai_id = :loai_id";
            $params['loai_id'] = $loai_id;
        }
        if ($gia_tu > 0) {
            $sql .= " AND gia_ban_de_xuat >= :gia_tu";
            $params['gia_tu'] = $gia_tu;
        }
        if ($gia_den > 0) {
            $sql .= " AND gia_ban_de_xuat <= :gia_den";
            $params['gia_den'] = $gia_den;
        }

        $result = $this->getOne($sql, $params);
        return $result['total'];
    }

    // Lấy danh sách sản phẩm có LỌC và PHÂN TRANG
    public function layDanhSachSanPhamCoLoc($tu_khoa = '', $loai_id = 0, $gia_tu = 0, $gia_den = 0, $limit = 8, $offset = 0) {
        $sql = "SELECT * FROM SanPham WHERE hien_trang = 1";
        $params = [];

        if ($tu_khoa != '') {
            $sql .= " AND ten_sp LIKE :tu_khoa";
            $params['tu_khoa'] = "%$tu_khoa%";
        }
        if ($loai_id > 0) {
            $sql .= " AND loai_id = :loai_id";
            $params['loai_id'] = $loai_id;
        }
        if ($gia_tu > 0) {
            $sql .= " AND gia_ban_de_xuat >= :gia_tu";
            $params['gia_tu'] = $gia_tu;
        }
        if ($gia_den > 0) {
            $sql .= " AND gia_ban_de_xuat <= :gia_den";
            $params['gia_den'] = $gia_den;
        }

        // Thêm sắp xếp và phân trang
        $sql .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";
        
        // Lưu ý: PDO với Named Parameters khi dùng chung với LIMIT OFFSET thường hay bị lỗi ép kiểu. 
        // Nên ở đây ta nối chuỗi trực tiếp cho phần LIMIT OFFSET vì $limit và $offset ta đã ép kiểu (int) bên Controller rồi, rất an toàn.
        return $this->getAll($sql, $params);
    }

    // Hàm lấy sản phẩm mới nhất có giới hạn số lượng (cho Trang chủ)
    public function laySanPhamMoiNhat($limit = 4) {
        $sql = "SELECT * FROM SanPham WHERE hien_trang = 1 ORDER BY id DESC LIMIT $limit";
        // Do $limit truyền vào từ code cứng (số 4) nên việc nối chuỗi ở đây hoàn toàn an toàn
        return $this->getAll($sql);
    }
}
?>