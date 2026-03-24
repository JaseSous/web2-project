<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vogue Shop</title>
    <style>
        /* CSS dùng chung cho toàn bộ trang Client */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; color: #333; }
        .container { max-width: 1200px; margin: auto; padding: 20px; }
        header { background: #2c3e50; color: #fff; padding: 15px 0; }
        header .container { display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        header a { color: #fff; text-decoration: none; margin-left: 20px; font-weight: bold; }
        header a:hover { color: #3498db; }
        .btn { display: inline-block; padding: 10px 15px; background: #3498db; color: #fff; text-decoration: none; border-radius: 5px; cursor: pointer; border: none; }
        .btn:hover { background: #2980b9; }
        .price { color: #e74c3c; font-weight: bold; font-size: 1.2em; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="index.php" style="margin-left: 0; font-size: 1.5em;">VOGUE SHOP</a>
            </div>
            <nav>
                <a href="index.php">Trang chủ</a>
                <a href="index.php?area=client&controller=sanpham&action=danhsach">Sản phẩm</a>
                <a href="index.php?area=client&controller=giohang&action=index">🛒 Giỏ hàng</a>
                <a href="index.php?area=client&controller=nguoidung&action=dangnhap">Đăng nhập</a>
            </nav>
        </div>
    </header>
    <main class="container">