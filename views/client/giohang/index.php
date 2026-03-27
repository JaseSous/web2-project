<?php require_once './views/client/layout/header.php'; ?>

<div class="container" style="margin-top: 50px; margin-bottom: 100px;">
    
    <h1 style="font-family: var(--font-heading); font-size: 2.5rem; text-transform: uppercase; letter-spacing: 3px; border-bottom: 2px solid var(--text-black); padding-bottom: 15px; margin-bottom: 40px;">
        Giỏ Hàng Của Bạn
    </h1>

    <?php if (empty($cart)): ?>
        <div style="text-align: center; padding: 80px 20px; border: 1px dashed var(--border-color); background: var(--bg-light-gray);">
            <p style="font-size: 1.2rem; color: var(--text-muted); margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1px;">
                Chưa có sản phẩm nào trong giỏ hàng.
            </p>
            <a href="index.php?area=client&controller=sanpham&action=danhsach" 
               style="display: inline-block; padding: 15px 40px; background: var(--text-black); color: var(--bg-white); border: 1px solid var(--text-black); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; text-decoration: none; transition: 0.3s;"
               onmouseover="this.style.background='transparent'; this.style.color='var(--text-black)';"
               onmouseout="this.style.background='var(--text-black)'; this.style.color='var(--bg-white)';">
                Tiếp tục mua sắm
            </a>
        </div>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 50px; align-items: start;">
            
            <div>
                <div style="display: grid; grid-template-columns: 100px 1fr 120px 120px 40px; gap: 20px; border-bottom: 1px solid var(--text-black); padding-bottom: 15px; margin-bottom: 25px; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">
                    <div>Sản Phẩm</div>
                    <div>Thông tin</div>
                    <div style="text-align: center;">Đơn giá</div>
                    <div style="text-align: center;">Số lượng</div>
                    <div></div>
                </div>

                <?php foreach ($cart as $item): ?>
                    <div style="display: grid; grid-template-columns: 100px 1fr 120px 120px 40px; gap: 20px; align-items: center; border-bottom: 1px solid var(--border-color); padding-bottom: 25px; margin-bottom: 25px;">
                        
                        <div>
                            <img src="<?= !empty($item['hinh_anh']) ? $item['hinh_anh'] : 'https://via.placeholder.com/100x120' ?>" alt="<?= $item['ten_sp'] ?>" style="width: 100%; height: 120px; object-fit: cover; border: 1px solid var(--border-color);">
                        </div>
                        
                        <div>
                            <a href="index.php?area=client&controller=sanpham&action=chitiet&id=<?= $item['id'] ?>" style="font-family: var(--font-heading); font-size: 1.1rem; color: var(--text-black); text-decoration: none; font-weight: bold; text-transform: uppercase;">
                                <?= $item['ten_sp'] ?>
                            </a>
                        </div>
                        
                        <div style="text-align: center; font-weight: 600;">
                            <?= number_format($item['gia'], 0, ',', '.') ?>đ
                        </div>
                        
                        <div style="text-align: center;">
                            <input type="number" class="qty-input" data-id="<?= $item['id'] ?>" value="<?= $item['so_luong'] ?>" min="1" 
                                   style="width: 60px; padding: 8px; text-align: center; border: 1px solid var(--text-black); outline: none; font-size: 1rem; color: var(--text-black); background: transparent;">
                        </div>
                        
                        <div style="text-align: center;">
                            <a href="index.php?area=client&controller=giohang&action=xoa&id=<?= $item['id'] ?>" 
                               style="color: var(--text-muted); font-size: 1.2rem; text-decoration: none; transition: 0.3s;"
                               onmouseover="this.style.color='#ef4444';"
                               onmouseout="this.style.color='var(--text-muted)';"
                               title="Xóa khỏi giỏ">
                                ✖
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div style="background: #fafafa; border: 1px solid var(--border-color); padding: 30px;">
                <h3 style="font-family: var(--font-heading); font-size: 1.2rem; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; margin-bottom: 25px;">
                    Tóm Tắt Đơn Hàng
                </h3>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 0.95rem;">
                    <span style="color: var(--text-muted);">Tạm tính:</span>
                    <span id="tam-tinh" style="font-weight: 600;"><?= number_format($tongTien, 0, ',', '.') ?>đ</span>
                </div>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 25px; font-size: 0.95rem;">
                    <span style="color: var(--text-muted);">Phí vận chuyển:</span>
                    <span style="font-weight: 600;">Tính ở bước thanh toán</span>
                </div>
                
                <div style="display: flex; justify-content: space-between; border-top: 1px solid var(--text-black); padding-top: 20px; margin-bottom: 30px;">
                    <span style="font-weight: bold; text-transform: uppercase;">Tổng cộng:</span>
                    <span id="tong-cong" style="font-size: 1.5rem; font-weight: 700; color: var(--text-black);"><?= number_format($tongTien, 0, ',', '.') ?> VNĐ</span>
                </div>

                <a href="index.php?area=client&controller=thanhtoan&action=index" 
                   style="display: block; text-align: center; width: 100%; padding: 18px; background: var(--text-black); color: var(--bg-white); border: 1px solid var(--text-black); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; text-decoration: none; transition: 0.3s;"
                   onmouseover="this.style.background='transparent'; this.style.color='var(--text-black)';"
                   onmouseout="this.style.background='var(--text-black)'; this.style.color='var(--bg-white)';">
                    Tiến Hành Thanh Toán
                </a>
            </div>

        </div>
    <?php endif; ?>
</div>

<script>
    // Lấy tất cả các ô nhập số lượng
    const qtyInputs = document.querySelectorAll('.qty-input');

    qtyInputs.forEach(input => {
        // Lắng nghe sự kiện 'change' (khi bạn gõ số mới hoặc bấm mũi tên tăng/giảm)
        input.addEventListener('change', function() {
            let id = this.getAttribute('data-id');
            let so_luong = this.value;

            // Nếu nhập bậy số nhỏ hơn 1, ép về 1
            if (so_luong < 1) {
                this.value = 1;
                so_luong = 1;
            }

            // Đóng gói dữ liệu gửi ngầm về Server
            let formData = new FormData();
            formData.append('id', id);
            formData.append('so_luong', so_luong);

            // Gửi AJAX bằng Fetch API (Công nghệ JS hiện đại nhất)
            fetch('index.php?area=client&controller=giohang&action=capnhatAjax', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    // Thay đổi ngay lập tức con số trên màn hình cực mượt
                    document.getElementById('tam-tinh').innerText = data.tongTienFormat + 'đ';
                    document.getElementById('tong-cong').innerText = data.tongTienFormat + ' VNĐ';
                }
            })
            .catch(error => console.error('Lỗi cập nhật giỏ hàng:', error));
        });
    });
</script>

<?php require_once './views/client/layout/footer.php'; ?>