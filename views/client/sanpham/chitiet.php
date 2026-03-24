<?php require_once './views/client/layout/header.php'; ?>

<div class="container" style="margin-top: 60px; margin-bottom: 100px;">
    
    <div style="display: grid; grid-template-columns: 3.5fr 6.5fr; gap: 50px; align-items: start; position: relative;">
        
        <div style="border: 1px solid var(--border-color); background: #fcfcfc; display: flex; justify-content: center; align-items: center; padding: 30px;">
            
            <div id="img-zoom-container" style="position: relative; cursor: crosshair; display: inline-block;">
                
                <img id="featured-img" src="<?= !empty($sp['hinh_anh']) ? $sp['hinh_anh'] : 'https://via.placeholder.com/600x800?text=House+Fashion' ?>" 
                     style="max-height: 60vh; max-width: 100%; width: auto; display: block;" 
                     alt="<?= $sp['ten_sp'] ?>">
                     
                <div id="zoom-result" 
                     style="display: none; position: absolute; width: 220px; height: 220px; border: 2px solid var(--text-black); background-color: var(--bg-white); background-repeat: no-repeat; pointer-events: none; box-shadow: 0 15px 35px rgba(0,0,0,0.2); z-index: 10;">
                </div>
            </div>
            
        </div>
        
        <div>
            <h1 style="font-family: var(--font-heading); font-size: 2.2rem; text-transform: uppercase; margin-bottom: 15px; color: var(--text-black);">
                <?= $sp['ten_sp'] ?>
            </h1>
            
            <p style="color: var(--text-muted); font-size: 0.85rem; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 25px;">
                Mã SP: <?= $sp['ma_sp'] ?> <span style="margin: 0 10px;">|</span> Đơn vị: <?= $sp['don_vi_tinh'] ?>
            </p>
            
            <h2 style="font-size: 1.8rem; font-weight: 700; color: var(--text-black); margin-bottom: 30px;">
                <?= number_format($sp['gia_ban_de_xuat'], 0, ',', '.') ?> VNĐ
            </h2>
            
            <p style="margin-bottom: 30px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">
                Trạng thái: 
                <?php 
                    // Tạm thời lấy số lượng ban đầu, sau này lấy từ logic FIFO
                    if ($sp['so_luong_ban_dau'] > 0) {
                        echo '<span style="color: var(--text-black);">Còn hàng</span>';
                    } else {
                        echo '<span style="color: var(--text-muted);">Đang chờ nhập hàng</span>';
                    }
                ?>
            </p>

            <div style="margin-bottom: 40px; padding-top: 30px; border-top: 1px solid var(--border-color);">
                <h3 style="font-family: var(--font-heading); font-size: 1rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px;">
                    Mô tả chi tiết
                </h3>
                <p style="line-height: 1.8; color: var(--text-dark-gray); font-size: 0.95rem;">
                    <?= nl2br($sp['mo_ta']) ?>
                </p>
            </div>

            <form action="index.php?area=client&controller=giohang&action=them" method="POST" style="display: flex; gap: 20px; height: 45px;">
                <input type="hidden" name="id_san_pham" value="<?= $sp['id'] ?>">
                
                <div style="border: 1px solid var(--text-black); width: 80px; display: flex;">
                    <input type="number" id="so_luong" name="so_luong" value="1" min="1" 
                           style="width: 100%; border: none; text-align: center; font-size: 1rem; outline: none; background: transparent; color: var(--text-black);">
                </div>
                
                <button type="submit" 
                        style="flex-grow: 1; background: var(--text-black); color: var(--bg-white); border: 1px solid var(--text-black); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.background='transparent'; this.style.color='var(--text-black)';"
                        onmouseout="this.style.background='var(--text-black)'; this.style.color='var(--bg-white)';">
                    Thêm vào giỏ
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const container = document.getElementById('img-zoom-container');
    const img = document.getElementById('featured-img');
    const lens = document.getElementById('zoom-result');

    // Mức độ phóng to (2.5 lần)
    const zoomLevel = 2.5;
    
    // Khoảng cách từ mũi tên chuột đến góc trái trên của kính lúp (pixel)
    const cursorOffset = 15; 

    container.addEventListener('mousemove', function(e) {
        lens.style.display = 'block';
        
        const rect = img.getBoundingClientRect();
        const lensWidth = lens.offsetWidth;
        const lensHeight = lens.offsetHeight;
        
        // Tọa độ chuột thực tế trên bức ảnh
        let x = e.clientX - rect.left;
        let y = e.clientY - rect.top;
        
        // Giới hạn để tính toán background không bị lố ra ngoài viền ảnh
        if (x > rect.width) x = rect.width;
        if (x < 0) x = 0;
        if (y > rect.height) y = rect.height;
        if (y < 0) y = 0;
        
        // CẬP NHẬT MỚI: Đặt góc trái trên của kính lúp chéo xuống dưới bên phải con trỏ chuột
        lens.style.left = (x + cursorOffset) + 'px';
        lens.style.top = (y + cursorOffset) + 'px';
        
        // Kích thước ảnh nền phóng to
        lens.style.backgroundImage = `url('${img.src}')`;
        lens.style.backgroundSize = `${rect.width * zoomLevel}px ${rect.height * zoomLevel}px`;
        
        // Dịch chuyển background để tâm của kính lúp hiển thị đúng điểm chuột đang trỏ
        const bgX = (x * zoomLevel) - (lensWidth / 2);
        const bgY = (y * zoomLevel) - (lensHeight / 2);
        
        lens.style.backgroundPosition = `-${bgX}px -${bgY}px`;
    });

    // Ẩn kính lúp khi di chuột ra ngoài
    container.addEventListener('mouseleave', function() {
        lens.style.display = 'none';
    });
</script>

<?php require_once './views/client/layout/footer.php'; ?>