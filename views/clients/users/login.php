<?php 
// Đảm bảo đường dẫn này đúng với cấu trúc của bạn
include_once ROOT_DIR . 'views/clients/header.php'; 
?>

<div class="container" style="min-height: 550px;">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Đăng Nhập Tài Khoản</h3>

                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= ROOT_URL . '?ctl=login' ?>" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Đăng nhập</button>
                        </div>
                    </form>

                    <!-- **ĐÃ THÊM PHẦN ĐĂNG KÝ VÀO ĐÂY** -->
                    <div class="text-center mt-4">
                        <p class="mb-0">Bạn chưa có tài khoản?</p>
                        <a href="<?= ROOT_URL . '?ctl=register' ?>">Đăng ký ngay tại đây</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
// Đảm bảo đường dẫn này đúng với cấu trúc của bạn
include_once ROOT_DIR . 'views/clients/footer.php'; 
?>