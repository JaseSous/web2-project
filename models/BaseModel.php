<?php
class BaseModel {
    protected $conn;

    public function __construct($dbConnection) {
        // Nhận kết nối CSDL từ Controller truyền vào
        $this->conn = $dbConnection;
    }

    // 1. Hàm thực thi SQL chung (Dùng cho INSERT, UPDATE, DELETE)
    // $sql: Câu lệnh SQL
    // $params: Mảng các tham số truyền vào (để chống SQL Injection)
    public function execute($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            // In ra lỗi chi tiết nếu câu SQL bị sai
            die("Lỗi truy vấn SQL: " . $e->getMessage() . "<br>Câu SQL: " . $sql);
        }
    }

    // 2. Hàm lấy danh sách dữ liệu (SELECT nhiều dòng - VD: Lấy danh sách sản phẩm)
    public function getAll($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        // Trả về mảng kết hợp (Associative Array)
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // 3. Hàm lấy 1 dòng dữ liệu (SELECT 1 dòng - VD: Lấy chi tiết 1 cái áo)
    public function getOne($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Hàm lấy ID của dòng dữ liệu vừa được thêm vào CSDL
    // Rất quan trọng: Khi khách chốt đơn, chúng ta INSERT vào bảng DonDatHang, 
    // sau đó phải lấy ngay ID đơn hàng đó để tiếp tục INSERT vào bảng ChiTietDonHang.
    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }
}
?>