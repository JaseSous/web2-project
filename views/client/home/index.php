<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Shop Thời Trang</title>
    <style>
        /* CSS cơ bản chống "quá xấu" */
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f4f4f4; }
        .container { max-width: 1200px; margin: auto; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .product-card { background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .product-card img { max-width: 100%; height: auto; border-radius: 5px; }
        .price { color: #e74c3c; font-weight: bold; font-size: 1.2em; }
        .btn { display: inline-block; padding: 10px 15px; background: #3498db; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sản Phẩm Mới Nhất</h1>
        
        <div class="product-grid">
            <?php if (!empty($danhSachSanPham)): ?>
                <?php foreach ($danhSachSanPham as $sp): ?>
                    <div class="product-card">
                        <img src="<?= !empty($sp['hinh_anh']) ? $sp['hinh_anh'] : 'https://via.placeholder.com/250x300?text=No+Image' ?>" alt="<?= $sp['ten_sp'] ?>">
                        
                        <h3><?= $sp['ten_sp'] ?></h3>
                        
                        <p class="price"><?= number_format($sp['gia_ban_de_xuat'], 0, ',', '.') ?> VNĐ</p>
                        
                        <a href="index.php?area=client&controller=sanpham&action=chitiet&id=<?= $sp['id'] ?>" class="btn">Xem chi tiết</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Hiện chưa có sản phẩm nào để hiển thị.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>