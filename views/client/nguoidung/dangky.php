<?php require_once './views/client/layout/header.php'; ?>

<div class="container" style="margin-top: 60px; margin-bottom: 100px; display: flex; justify-content: center;">
    
    <div style="display: flex; width: 100%; max-width: 1000px; background: var(--bg-white); border: 1px solid var(--border-color); box-shadow: 0 20px 40px rgba(0,0,0,0.05);">
        
        <div style="flex: 1.2; padding: 50px; display: flex; flex-direction: column; justify-content: center;">
            <h1 style="font-family: var(--font-heading); font-size: 2rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; color: var(--text-black);">
                Tạo Tài Khoản
            </h1>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px;">
                Trở thành thành viên của THE HOUSE để trải nghiệm mua sắm đẳng cấp.
            </p>

            <?php if (!empty($error)): ?>
                <div style="background: #fdf2f2; border-left: 4px solid #f87171; color: #ef4444; padding: 12px 15px; margin-bottom: 20px; font-size: 0.9rem;">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div style="background: #f0fdf4; border-left: 4px solid #4ade80; color: #166534; padding: 12px 15px; margin-bottom: 20px; font-size: 0.9rem;">
                    <?= $success ?> <br>
                    <a href="index.php?area=client&controller=nguoidung&action=dangnhap" style="color: var(--text-black); font-weight: bold; text-decoration: underline; margin-top: 10px; display: inline-block;">Nhấn vào đây để Đăng nhập</a>
                </div>
            <?php endif; ?>

            <form action="index.php?area=client&controller=nguoidung&action=dangky" method="POST">
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Họ và tên</label>
                        <input type="text" name="ho_ten" required value="<?= isset($ho_ten) ? htmlspecialchars($ho_ten) : '' ?>" placeholder="VD: Nguyễn Văn A" 
                               style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Số điện thoại</label>
                        <input type="text" name="so_dien_thoai" required value="<?= isset($so_dien_thoai) ? htmlspecialchars($so_dien_thoai) : '' ?>" placeholder="VD: 0912345678" 
                               style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Email</label>
                    <input type="email" name="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" placeholder="Nhập địa chỉ email..." 
                           style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Địa chỉ giao hàng</label>
                    <input type="text" name="dia_chi" required value="<?= isset($dia_chi) ? htmlspecialchars($dia_chi) : '' ?>" placeholder="Số nhà, Đường, Phường, Quận..." 
                           style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Mật khẩu</label>
                        <input type="password" name="mat_khau" required placeholder="Tối thiểu 6 ký tự" 
                               style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; font-weight: 600;">Xác nhận Mật khẩu</label>
                        <input type="password" name="xac_nhan_mat_khau" required placeholder="Nhập lại mật khẩu" 
                               style="width: 100%; padding: 12px; border: 1px solid var(--border-color); outline: none; background: transparent;">
                    </div>
                </div>

                <button type="submit" 
                        style="width: 100%; padding: 15px; background: var(--text-black); color: var(--bg-white); border: 1px solid var(--text-black); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.background='transparent'; this.style.color='var(--text-black)';"
                        onmouseout="this.style.background='var(--text-black)'; this.style.color='var(--bg-white)';">
                    Đăng Ký Tài Khoản
                </button>
            </form>

            <div style="margin-top: 25px; text-align: center; font-size: 0.9rem; color: var(--text-muted);">
                Đã có tài khoản? 
                <a href="index.php?area=client&controller=nguoidung&action=dangnhap" style="color: var(--text-black); font-weight: 600; text-decoration: underline;">Đăng nhập ngay</a>
            </div>
        </div>

        <div style="flex: 0.8; background-image: url('https://images.unsplash.com/photo-1445205170230-053b83016050?w=800'); background-size: cover; background-position: center;">
        </div>

    </div>
</div>

<?php require_once './views/client/layout/footer.php'; ?>