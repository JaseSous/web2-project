<?php require_once './views/client/layout/header.php'; ?>

<div class="container" style="margin-top: 50px; margin-bottom: 100px;">
    
    <h1 style="font-family: var(--font-heading); font-size: 2.2rem; text-transform: uppercase; letter-spacing: 3px; border-bottom: 2px solid var(--text-black); padding-bottom: 15px; margin-bottom: 40px;">
        Lịch Sử Mua Hàng
    </h1>

    <?php if (empty($danhSachDonHang)): ?>
        <div style="text-align: center; padding: 60px 20px; border: 1px dashed var(--border-color); background: var(--bg-light-gray);">
            <p style="font-size: 1.1rem; color: var(--text-muted); margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px;">
                Bạn chưa có đơn hàng nào tại VOGUE.
            </p>
            <a href="index.php?area=client&controller=sanpham&action=danhsach" 
               style="display: inline-block; padding: 12px 30px; background: var(--text-black); color: var(--bg-white); border: 1px solid var(--text-black); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; text-decoration: none; transition: 0.3s;"
               onmouseover="this.style.background='transparent'; this.style.color='var(--text-black)';"
               onmouseout="this.style.background='var(--text-black)'; this.style.color='var(--bg-white)';">
                Bắt đầu mua sắm
            </a>
        </div>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--text-black); text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">
                        <th style="padding: 15px 10px;">Mã ĐH</th>
                        <th style="padding: 15px 10px;">Ngày Đặt</th>
                        <th style="padding: 15px 10px;">Người Nhận</th>
                        <th style="padding: 15px 10px;">Tổng Tiền</th>
                        <th style="padding: 15px 10px;">Phương Thức</th>
                        <th style="padding: 15px 10px;">Trạng Thái</th>
                        <th style="padding: 15px 10px; text-align: right;">Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($danhSachDonHang as $don): ?>
                        <tr style="border-bottom: 1px solid var(--border-color); transition: background 0.3s;" onmouseover="this.style.background='#fafafa';" onmouseout="this.style.background='transparent';">
                            <td style="padding: 20px 10px; font-weight: bold;">#VOGUE-<?= $don['id'] ?></td>
                            
                            <td style="padding: 20px 10px; color: var(--text-muted);">
                                <?= date('d/m/Y H:i', strtotime($don['thoi_gian_dat'])) ?>
                            </td>
                            
                            <td style="padding: 20px 10px;">
                                <div style="font-weight: 600; margin-bottom: 5px;"><?= htmlspecialchars($don['ten_nguoi_nhan']) ?></div>
                                <div style="font-size: 0.85rem; color: var(--text-muted);"><?= htmlspecialchars($don['so_dien_thoai_nguoi_nhan']) ?></div>
                            </td>
                            
                            <td style="padding: 20px 10px; font-weight: bold; color: var(--text-black);">
                                <?= number_format($don['tong_tien'], 0, ',', '.') ?>đ
                            </td>
                            
                            <td style="padding: 20px 10px; font-size: 0.9rem;">
                                <?php 
                                    if ($don['phuong_thuc_thanh_toan'] == 1) echo "COD (Tiền mặt)";
                                    elseif ($don['phuong_thuc_thanh_toan'] == 2) echo "Chuyển khoản";
                                    elseif ($don['phuong_thuc_thanh_toan'] == 3) echo "VNPAY/MOMO";
                                    else echo "Khác";
                                ?>
                            </td>
                            
                            <td style="padding: 20px 10px;">
                                <?php 
                                    $trang_thai = $don['trang_thai'];
                                    if ($trang_thai == 1) {
                                        echo '<span style="padding: 6px 12px; background: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">Chờ xác nhận</span>';
                                    } elseif ($trang_thai == 2) {
                                        echo '<span style="padding: 6px 12px; background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">Đang giao</span>';
                                    } elseif ($trang_thai == 3) {
                                        echo '<span style="padding: 6px 12px; background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">Hoàn thành</span>';
                                    } else {
                                        echo '<span style="padding: 6px 12px; background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">Đã hủy</span>';
                                    }
                                ?>
                            </td>

                            <td style="padding: 20px 10px; text-align: right;">
                                <a href="index.php?area=client&controller=donhang&action=chitiet&id=<?= $don['id'] ?>" 
                                   style="display: inline-block; padding: 8px 15px; background: transparent; border: 1px solid var(--text-black); color: var(--text-black); text-decoration: none; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; transition: 0.3s;"
                                   onmouseover="this.style.background='var(--text-black)'; this.style.color='var(--bg-white)';"
                                   onmouseout="this.style.background='transparent'; this.style.color='var(--text-black)';">
                                    Xem
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>

<?php require_once './views/client/layout/footer.php'; ?>