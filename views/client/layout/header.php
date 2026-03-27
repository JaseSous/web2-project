<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOGUE SHOP</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <header>
        <div class="container nav-wrapper">
            <a href="index.php" class="logo">VOGUE</a>
            
            <nav class="nav-links">
                <a href="index.php">Trang chủ</a>
                <a href="index.php?area=client&controller=sanpham&action=danhsach">Sản phẩm</a>
                <a href="index.php?area=client&controller=giohang&action=index" class="cart-btn">Giỏ hàng</a>
                
                <?php if (isset($_SESSION['user_client'])): ?>
                    
                    <?php 
                        $ho_ten_day_du = trim($_SESSION['user_client']['ho_ten']);
                        $mang_ten = explode(' ', $ho_ten_day_du);
                        $ten_ngan = end($mang_ten); 
                    ?>
                    
                    <span style="border-left: 1px solid var(--border-color); height: 20px; margin: 0 10px;"></span>
                    
                    <span style="font-weight: 600; text-transform: uppercase; font-size: 0.9rem;">
                        CHÀO, <?= htmlspecialchars($ten_ngan) ?>
                    </span>
                    
                    <a href="index.php?area=client&controller=donhang&action=lichsu">Đơn hàng</a>
                    
                    <a href="index.php?area=client&controller=nguoidung&action=dangxuat" style="color: #ef4444; font-weight: 600;">
                        Đăng xuất
                    </a>
                    
                <?php else: ?>
                    
                    <span style="border-left: 1px solid var(--border-color); height: 20px; margin: 0 10px;"></span>
                    
                    <a href="index.php?area=client&controller=nguoidung&action=dangnhap">Đăng nhập</a>
                    
                <?php endif; ?>
                </nav>
        </div>
    </header>
    
    <main>