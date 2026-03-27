<?php require_once './views/client/layout/header.php'; ?>

<div class="container" style="margin-top: 50px; margin-bottom: 100px;">
    
    <h1 style="font-family: var(--font-heading); font-size: 2.2rem; text-transform: uppercase; letter-spacing: 3px; border-bottom: 2px solid var(--text-black); padding-bottom: 15px; margin-bottom: 40px;">
        Thanh Toán
    </h1>

    <form action="index.php?area=client&controller=thanhtoan&action=xuly" method="POST">
        <div style="display: grid; grid-template-columns: 1.8fr 1fr; gap: 50px; align-items: start;">
            
            <div>
                <h3 style="font-family: var(--font-heading); font-size: 1.2rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 25px;">
                    1. Thông Tin Giao Hàng
                </h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Họ và tên</label>
                        <input type="text" name="ten_nguoi_nhan" required value="<?= htmlspecialchars($user['ho_ten']) ?>" 
                               style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Số điện thoại</label>
                        <input type="text" name="so_dien_thoai" required value="<?= htmlspecialchars($user['so_dien_thoai']) ?>" 
                               style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Địa chỉ chi tiết</label>
                    <input type="text" name="dia_chi" required value="<?= htmlspecialchars($user['dia_chi']) ?>" 
                           style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                </div>

                <div style="margin-bottom: 40px;">
                    <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Ghi chú (Tùy chọn)</label>
                    <textarea name="ghi_chu" rows="3" placeholder="Ví dụ: Giao giờ hành chính..." 
                              style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent; resize: vertical;"></textarea>
                </div>

                <h3 style="font-family: var(--font-heading); font-size: 1.2rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 25px; border-top: 1px solid var(--border-color); padding-top: 30px;">
                    2. Phương Thức Thanh Toán
                </h3>
                
                <div style="border: 1px solid var(--border-color); padding: 20px; margin-bottom: 15px;">
                    <label style="display: flex; align-items: center; cursor: pointer; font-weight: 600;">
                        <input type="radio" name="phuong_thuc_thanh_toan" value="COD" checked style="margin-right: 15px; transform: scale(1.2);">
                        Thanh toán khi nhận hàng (COD)
                    </label>
                </div>
                <div style="border: 1px solid var(--border-color); padding: 20px; margin-bottom: 15px;">
                    <label style="display: flex; align-items: center; cursor: pointer; font-weight: 600;">
                        <input type="radio" name="phuong_thuc_thanh_toan" value="Chuyển khoản" style="margin-right: 15px; transform: scale(1.2);">
                        Chuyển khoản ngân hàng
                    </label>
                </div>
            </div>

            <div style="background: #fafafa; border: 1px solid var(--border-color); padding: 30px; position: sticky; top: 120px;">
                <h3 style="font-family: var(--font-heading); font-size: 1.2rem; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; margin-bottom: 20px;">
                    Đơn Hàng
                </h3>
                
                <div style="margin-bottom: 20px; max-height: 300px; overflow-y: auto; padding-right: 10px;">
                    <?php foreach ($cart as $item): ?>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px dashed var(--border-color); padding-bottom: 15px;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <img src="<?= !empty($item['hinh_anh']) ? $item['hinh_anh'] : 'https://via.placeholder.com/50x60' ?>" style="width: 50px; height: 60px; object-fit: cover; border: 1px solid var(--border-color);">
                                <div>
                                    <div style="font-weight: 600; font-size: 0.95rem; margin-bottom: 5px;"><?= $item['ten_sp'] ?></div>
                                    <div style="font-size: 0.85rem; color: var(--text-muted);">SL: <?= $item['so_luong'] ?></div>
                                </div>
                            </div>
                            <div style="font-weight: 600; font-size: 0.95rem;">
                                <?= number_format($item['gia'] * $item['so_luong'], 0, ',', '.') ?>đ
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div style="display: flex; justify-content: space-between; border-top: 1px solid var(--text-black); padding-top: 20px; margin-bottom: 30px;">
                    <span style="font-weight: bold; text-transform: uppercase;">Tổng cộng:</span>
                    <span style="font-size: 1.5rem; font-weight: 700; color: var(--text-black);"><?= number_format($tongTien, 0, ',', '.') ?> VNĐ</span>
                </div>

                <button type="submit" 
                        style="width: 100%; padding: 18px; background: var(--text-black); color: var(--bg-white); border: 1px solid var(--text-black); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; cursor: pointer; transition: 0.3s;"
                        onmouseover="this.style.background='transparent'; this.style.color='var(--text-black)';"
                        onmouseout="this.style.background='var(--text-black)'; this.style.color='var(--bg-white)';">
                    Xác Nhận Đặt Hàng
                </button>
            </div>
            
        </div>
    </form>
</div>

<?php require_once './views/client/layout/footer.php'; ?>