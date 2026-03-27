<?php require_once './views/client/layout/header.php'; ?>

<div class="container" style="margin-top: 60px; margin-bottom: 100px; display: flex; justify-content: center;">
    
    <div style="display: flex; width: 100%; max-width: 900px; background: var(--bg-white); border: 1px solid var(--border-color); box-shadow: 0 20px 40px rgba(0,0,0,0.05);">
        
        <div style="flex: 1; padding: 60px 50px; display: flex; flex-direction: column; justify-content: center;">
            <h1 style="font-family: var(--font-heading); font-size: 2rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; color: var(--text-black);">
                Đăng Nhập
            </h1>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 30px;">
                Chào mừng bạn quay trở lại với THE HOUSE.
            </p>

            <?php if (!empty($error)): ?>
                <div style="background: #fdf2f2; border-left: 4px solid #f87171; color: #ef4444; padding: 12px 15px; margin-bottom: 25px; font-size: 0.9rem;">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="index.php?area=client&controller=nguoidung&action=dangnhap" method="POST">
                
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; font-weight: 600;">Email</label>
                    <input type="email" name="email" required placeholder="Nhập địa chỉ email..." 
                           style="width: 100%; padding: 15px; border: 1px solid var(--border-color); outline: none; font-size: 1rem; background: transparent; transition: border 0.3s;"
                           onfocus="this.style.borderColor='var(--text-black)';" onblur="this.style.borderColor='var(--border-color)';">
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; font-weight: 600;">Mật khẩu</label>
                    <input type="password" name="mat_khau" required placeholder="Nhập mật khẩu..." 
                           style="width: 100%; padding: 15px; border: 1px solid var(--border-color); outline: none; font-size: 1rem; background: transparent; transition: border 0.3s;"
                           onfocus="this.style.borderColor='var(--text-black)';" onblur="this.style.borderColor='var(--border-color)';">
                </div>

                <button type="submit" 
                        style="width: 100%; padding: 16px; background: var(--text-black); color: var(--bg-white); border: 1px solid var(--text-black); text-transform: uppercase; letter-spacing: 2px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.background='transparent'; this.style.color='var(--text-black)';"
                        onmouseout="this.style.background='var(--text-black)'; this.style.color='var(--bg-white)';">
                    Đăng Nhập
                </button>
            </form>

            <div style="margin-top: 30px; text-align: center; font-size: 0.9rem; color: var(--text-muted);">
                Chưa có tài khoản? 
                <a href="index.php?area=client&controller=nguoidung&action=dangky" style="color: var(--text-black); font-weight: 600; text-decoration: underline;">Đăng ký ngay</a>
            </div>
        </div>

        <div style="flex: 1; background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=800'); background-size: cover; background-position: center; position: relative;">
            <div style="position: absolute; bottom: 40px; left: 40px; color: white;">
                <h2 style="font-family: var(--font-heading); font-size: 2rem; letter-spacing: 2px; text-transform: uppercase;">THE HOUSE</h2>
                <p style="font-size: 0.9rem; letter-spacing: 1px; opacity: 0.8;">Định hình phong cách của bạn</p>
            </div>
        </div>

    </div>
</div>

<?php require_once './views/client/layout/footer.php'; ?>