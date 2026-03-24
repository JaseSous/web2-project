<?php require_once './views/client/layout/header.php'; ?>

<section class="hero-banner">
    <div class="hero-content">
        <h1>VOGUE SHOP</h1>
        <p>Sự tinh tế tối giản. Khám phá bộ sưu tập mới nhất.</p>
    </div>
</section>

<div class="container">
    <h2 class="section-title">Sản Phẩm Nổi Bật</h2>

    <div class="product-grid">
        <?php if (!empty($danhSachSanPham)): ?>
            <?php foreach ($danhSachSanPham as $sp): ?>
                <article class="product-card">
                    <div class="product-img-wrapper">
                        <img src="<?= !empty($sp['hinh_anh']) ? $sp['hinh_anh'] : 'https://via.placeholder.com/400x520?text=House+Fashion' ?>" alt="<?= $sp['ten_sp'] ?>">
                    </div>
                    
                    <div class="product-info">
                        <span class="product-cate">Thời trang</span> 
                        <h3 class="product-title"><?= $sp['ten_sp'] ?></h3>
                        <div class="product-price"><?= number_format($sp['gia_ban_de_xuat'], 0, ',', '.') ?>đ</div>
                        <a href="index.php?area=client&controller=sanpham&action=chitiet&id=<?= $sp['id'] ?>" class="btn-outline">
                            Xem chi tiết
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; width: 100%; color: #666; letter-spacing: 1px;">Admin đang cập nhật bộ sưu tập...</p>
        <?php endif; ?>
    </div>
</div> <?php require_once './views/client/layout/footer.php'; ?>