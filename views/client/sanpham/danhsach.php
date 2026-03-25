<?php require_once './views/client/layout/header.php'; ?>

<div class="container" style="margin-top: 40px; margin-bottom: 80px;">
    
    <h1 style="font-family: var(--font-heading); font-size: 2.5rem; text-transform: uppercase; letter-spacing: 3px; border-bottom: 2px solid var(--text-black); padding-bottom: 15px; margin-bottom: 40px;">
        Bộ Sưu Tập
    </h1>

    <div style="display: grid; grid-template-columns: 250px 1fr; gap: 50px; align-items: start;">
        
        <aside style="border: 1px solid var(--border-color); padding: 25px; background: #fafafa;">
            <h3 style="font-family: var(--font-heading); text-transform: uppercase; letter-spacing: 2px; font-size: 1.1rem; margin-bottom: 25px;">Bộ Lọc Tìm Kiếm</h3>
            
            <form action="index.php" method="GET">
                <input type="hidden" name="area" value="client">
                <input type="hidden" name="controller" value="sanpham">
                <input type="hidden" name="action" value="danhsach">

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Tên sản phẩm</label>
                    <input type="text" name="tu_khoa" value="<?= htmlspecialchars($tu_khoa) ?>" placeholder="Nhập từ khóa..." 
                           style="width: 100%; padding: 10px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Danh mục</label>
                    <select name="loai_id" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); outline: none; background: transparent; cursor: pointer;">
                        <option value="0">--- Tất cả ---</option>
                        <?php foreach ($danhSachLoai as $loai): ?>
                            <option value="<?= $loai['id'] ?>" <?= ($loai_id == $loai['id']) ? 'selected' : '' ?>>
                                <?= $loai['ten_loai'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Khoảng giá (VNĐ)</label>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="number" name="gia_tu" min="0" step="1000" value="<?= ($gia_tu > 0) ? $gia_tu : '' ?>" placeholder="Từ" 
                               style="width: 100%; padding: 10px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                        <span>-</span>
                        <input type="number" name="gia_den" min="0" step="1000" value="<?= ($gia_den > 0) ? $gia_den : '' ?>" placeholder="Đến" 
                               style="width: 100%; padding: 10px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                    </div>
                </div>

                <button type="submit" style="width: 100%; padding: 12px; background: var(--text-black); color: var(--bg-white); border: 1px solid var(--text-black); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; cursor: pointer; transition: 0.3s;"
                        onmouseover="this.style.background='transparent'; this.style.color='var(--text-black)';"
                        onmouseout="this.style.background='var(--text-black)'; this.style.color='var(--bg-white)';">
                    Áp Dụng
                </button>
                
                <a href="index.php?area=client&controller=sanpham&action=danhsach" style="display: block; text-align: center; margin-top: 15px; font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; text-decoration: underline;">
                    Xóa bộ lọc
                </a>
            </form>
        </aside>

        <div>
            <div class="product-grid" style="grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 30px; margin-bottom: 50px;">
                <?php if (!empty($danhSachSanPham)): ?>
                    <?php foreach ($danhSachSanPham as $sp): ?>
                        <article class="product-card">
                            <div class="product-img-wrapper">
                                <img src="<?= !empty($sp['hinh_anh']) ? $sp['hinh_anh'] : 'https://via.placeholder.com/400x520' ?>" alt="<?= $sp['ten_sp'] ?>">
                            </div>
                            <div class="product-info" style="padding: 15px; text-align: left;">
                                <h3 class="product-title" style="font-size: 1.1rem; margin-bottom: 8px;"><?= $sp['ten_sp'] ?></h3>
                                <div class="product-price" style="font-size: 1.1rem; margin-bottom: 15px;"><?= number_format($sp['gia_ban_de_xuat'], 0, ',', '.') ?>đ</div>
                                <a href="index.php?area=client&controller=sanpham&action=chitiet&id=<?= $sp['id'] ?>" class="btn-outline" style="padding: 10px; font-size: 0.8rem;">
                                    Xem chi tiết
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="grid-column: 1 / -1; text-align: center; padding: 50px; color: var(--text-muted); border: 1px dashed var(--border-color);">
                        Không tìm thấy sản phẩm nào phù hợp với điều kiện lọc của bạn.
                    </p>
                <?php endif; ?>
            </div>

            <?php if ($tongSoTrang > 1): ?>
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <?php 
                    // Tạo URL base để giữ nguyên các tham số tìm kiếm khi bấm sang trang khác
                    $queryString = $_GET;
                    // Lặp qua tổng số trang để in ra các nút bấm
                    for ($i = 1; $i <= $tongSoTrang; $i++): 
                        $queryString['page'] = $i;
                        $pageUrl = "index.php?" . http_build_query($queryString);
                        
                        // Xử lý CSS cho trang hiện tại (nền đen chữ trắng) và trang khác (nền trắng chữ đen)
                        $btnStyle = ($i == $page) 
                            ? "background: var(--text-black); color: var(--bg-white); border: 1px solid var(--text-black);" 
                            : "background: transparent; color: var(--text-black); border: 1px solid var(--border-color);";
                    ?>
                        <a href="<?= $pageUrl ?>" 
                           style="display: flex; justify-content: center; align-items: center; width: 40px; height: 40px; text-decoration: none; font-weight: 600; transition: 0.3s; <?= $btnStyle ?>"
                           onmouseover="this.style.borderColor='var(--text-black)';"
                           onmouseout="this.style.borderColor='<?= ($i == $page) ? 'var(--text-black)' : 'var(--border-color)' ?>';">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php require_once './views/client/layout/footer.php'; ?>