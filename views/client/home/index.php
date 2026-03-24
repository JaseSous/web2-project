<?php require_once './views/client/layout/header.php'; ?>

<section class="hero-banner">
    <h1>Bộ Sưu Tập Mùa Hè 2026</h1>
    <p>Khám phá những xu hướng thời trang mới nhất với mức giá cực kỳ ưu đãi.</p>
</section>

<h2 class="section-title">Sản Phẩm Nổi Bật</h2>

<div class="product-grid">
    <?php if (!empty($danhSachSanPham)): ?>
        <?php foreach ($danhSachSanPham as $sp): ?>
            <article class="product-card">
                <div class="product-img-wrapper">
                    <img src="<?= !empty($sp['hinh_anh']) ? $sp['hinh_anh'] : 'https://via.placeholder.com/400x500?text=No+Image' ?>" alt="<?= $sp['ten_sp'] ?>">
                </div>
                
                <div class="product-info">
                    <span class="product-cate">Thời trang</span> 
                    
                    <h3 class="product-title"><?= $sp['ten_sp'] ?></h3>
                    
                    <div class="product-price">
                        <?= number_format($sp['gia_ban_de_xuat'], 0, ',', '.') ?>đ
                    </div>
                    
                    <a href="index.php?area=client&controller=sanpham&action=chitiet&id=<?= $sp['id'] ?>" class="btn-primary">
                        Xem chi tiết
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align: center; width: 100%; color: #666;">Hiện chưa có sản phẩm nào. Admin đang cập nhật...</p>
    <?php endif; ?>
</div>

<?php require_once './views/client/layout/footer.php'; ?>