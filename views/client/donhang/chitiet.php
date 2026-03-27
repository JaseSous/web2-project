<?php require_once './views/client/layout/header.php'; ?>

<div class="container" style="margin-top: 50px; margin-bottom: 100px; max-width: 900px;">
    
    <div style="display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 2px solid var(--text-black); padding-bottom: 15px; margin-bottom: 30px;">
        <h1 style="font-family: var(--font-heading); font-size: 2.2rem; text-transform: uppercase; letter-spacing: 3px; margin: 0;">
            Chi Tiết Đơn Hàng #VOGUE-<?= $donHang['id'] ?>
        </h1>
        <a href="index.php?area=client&controller=donhang&action=lichsu" style="color: var(--text-muted); font-size: 0.9rem; text-decoration: underline; text-transform: uppercase; letter-spacing: 1px;">
            Quay lại Lịch sử
        </a>
    </div>

    <div style="background: #fafafa; border: 1px solid var(--border-color); padding: 30px; margin-bottom: 40px; display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
        
        <div>
            <h3 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">ĐỊA CHỈ NHẬN HÀNG</h3>
            <p style="margin-bottom: 8px; font-weight: 600; font-size: 1.1rem;"><?= htmlspecialchars($donHang['ten_nguoi_nhan']) ?></p>
            <p style="margin-bottom: 8px; color: var(--text-dark-gray);">SĐT: <?= htmlspecialchars($donHang['so_dien_thoai_nguoi_nhan']) ?></p>
            <p style="margin-bottom: 8px; color: var(--text-dark-gray); line-height: 1.5;">Địa chỉ: <?= htmlspecialchars($donHang['dia_chi_giao_hang']) ?></p>
            <?php if (!empty($donHang['ghi_chu'])): ?>
                <p style="margin-top: 15px; font-size: 0.9rem; color: #b45309; background: #fffbeb; padding: 10px; border-left: 3px solid #f59e0b;">
                    <strong>Ghi chú:</strong> <?= htmlspecialchars($donHang['ghi_chu']) ?>
                </p>
            <?php endif; ?>
        </div>

        <div>
            <h3 style="font-size: 1rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">THÔNG TIN THANH TOÁN</h3>
            
            <div style="margin-bottom: 12px; display: flex; justify-content: space-between;">
                <span style="color: var(--text-muted);">Ngày đặt:</span> 
                <span style="font-weight: 600;"><?= date('d/m/Y H:i', strtotime($donHang['thoi_gian_dat'])) ?></span>
            </div>
            
            <div style="margin-bottom: 12px; display: flex; justify-content: space-between;">
                <span style="color: var(--text-muted);">Phương thức:</span> 
                <span style="font-weight: 600;">
                    <?php 
                        if ($donHang['phuong_thuc_thanh_toan'] == 1) echo "COD (Tiền mặt)";
                        elseif ($donHang['phuong_thuc_thanh_toan'] == 2) echo "Chuyển khoản";
                        elseif ($donHang['phuong_thuc_thanh_toan'] == 3) echo "VNPAY/MOMO";
                    ?>
                </span>
            </div>

            <div style="margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                <span style="color: var(--text-muted);">Trạng thái:</span> 
                <?php 
                    $trang_thai = $donHang['trang_thai'];
                    if ($trang_thai == 1) echo '<span style="color: #b45309; font-weight: bold; text-transform: uppercase;">Chờ xác nhận</span>';
                    elseif ($trang_thai == 2) echo '<span style="color: #1d4ed8; font-weight: bold; text-transform: uppercase;">Đang giao hàng</span>';
                    elseif ($trang_thai == 3) echo '<span style="color: #15803d; font-weight: bold; text-transform: uppercase;">Giao thành công</span>';
                    else echo '<span style="color: #b91c1c; font-weight: bold; text-transform: uppercase;">Đã hủy</span>';
                ?>
            </div>
        </div>
    </div>

    <h3 style="font-size: 1.2rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;">SẢN PHẨM ĐÃ MUA</h3>
    
    <div style="border: 1px solid var(--border-color);">
        <?php foreach ($chiTietDon as $item): ?>
            <div style="display: grid; grid-template-columns: 80px 1fr 120px 120px; gap: 20px; align-items: center; padding: 20px; border-bottom: 1px solid var(--border-color);">
                
                <div>
                    <img src="<?= !empty($item['hinh_anh']) ? $item['hinh_anh'] : 'https://via.placeholder.com/80x100' ?>" style="width: 100%; height: 100px; object-fit: cover; border: 1px solid var(--border-color);">
                </div>
                
                <div>
                    <a href="index.php?area=client&controller=sanpham&action=chitiet&id=<?= $item['san_pham_id'] ?>" style="font-family: var(--font-heading); font-size: 1.1rem; color: var(--text-black); text-decoration: none; font-weight: bold; text-transform: uppercase;">
                        <?= $item['ten_sp'] ?>
                    </a>
                    <div style="color: var(--text-muted); font-size: 0.85rem; margin-top: 5px;">Đơn giá: <?= number_format($item['don_gia'], 0, ',', '.') ?>đ</div>
                </div>
                
                <div style="text-align: center; color: var(--text-dark-gray);">
                    Số lượng: <span style="font-weight: bold; color: var(--text-black); font-size: 1.1rem;"><?= $item['so_luong_mua'] ?></span>
                </div>
                
                <div style="text-align: right; font-weight: 700; font-size: 1.1rem; color: var(--text-black);">
                    <?= number_format($item['thanh_tien'], 0, ',', '.') ?>đ
                </div>
            </div>
        <?php endforeach; ?>
        
        <div style="padding: 25px 20px; background: #fafafa; display: flex; justify-content: flex-end; align-items: center; gap: 30px;">
            <span style="text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: var(--text-muted);">Tổng Cộng:</span>
            <span style="font-size: 1.8rem; font-weight: 700; color: var(--text-black);"><?= number_format($donHang['tong_tien'], 0, ',', '.') ?> VNĐ</span>
        </div>
    </div>

</div>

<?php require_once './views/client/layout/footer.php'; ?>