<?php
// Bật session
session_start();

// Nhúng file kết nối CSDL
require_once './config/database.php';

// --- HỆ THỐNG ROUTING CƠ BẢN ---
// Lấy các tham số từ URL, nếu không có thì gán giá trị mặc định
$area = isset($_GET['area']) ? $_GET['area'] : 'client';
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// 1. Xác định đường dẫn tới file Controller
// Ví dụ: controllers/client/HomeController.php hoặc controllers/admin/SanPhamController.php
$controllerName = ucfirst($controller) . 'Controller'; // Viết hoa chữ cái đầu (VD: HomeController)
$controllerPath = "./controllers/{$area}/{$controllerName}.php";

// 2. Kiểm tra xem file Controller có tồn tại không
if (file_exists($controllerPath)) {
    require_once $controllerPath;
    
    // 3. Kiểm tra xem Class trong Controller có tồn tại không
    if (class_exists($controllerName)) {
        // Khởi tạo đối tượng Controller và truyền kết nối CSDL ($conn) vào
        $controllerObject = new $controllerName($conn);
        
        // 4. Kiểm tra xem phương thức (Action) có tồn tại trong Class không
        if (method_exists($controllerObject, $action)) {
            // Gọi phương thức đó để thực thi
            $controllerObject->$action();
        } else {
            echo "<h1>Lỗi 404: Không tìm thấy hành động '{$action}' trong {$controllerName}!</h1>";
        }
    } else {
        echo "<h1>Lỗi: Class '{$controllerName}' không được định nghĩa!</h1>";
    }
} else {
    echo "<h1>Lỗi 404: Không tìm thấy trang (Controller '{$controllerName}' không tồn tại)!</h1>";
}
?>