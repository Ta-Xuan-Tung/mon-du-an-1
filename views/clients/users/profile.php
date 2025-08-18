<?php 
// Đảm bảo người dùng đã đăng nhập
if (!isset($_SESSION['user'])) {
    header('Location: ' . ROOT_URL . '?ctl=login');
    die;
}
include_once ROOT_DIR . 'views/clients/header.php'; 
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <?php if (!empty($_SESSION['message_success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['message_success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message_success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['message_error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['message_error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message_error']); ?>
            <?php endif; ?>


            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Thông tin cá nhân</h3>
                </div>
                <div class="card-body p-4">
                    <form action="<?= ROOT_URL . '?ctl=edit-profile' ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" 
                                   value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" readonly disabled>
                            <small class="text-muted">Email không thể thay đổi.</small>
                        </div>

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" 
                                   value="<?= htmlspecialchars($_SESSION['user']['fullname']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="address" name="address" rows="3"><?= htmlspecialchars($_SESSION['user']['address'] ?? '') ?></textarea>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h3 class="mb-0">Đổi mật khẩu</h3>
                </div>
                <div class="card-body p-4">
                    <form action="<?= ROOT_URL . '?ctl=change-password' ?>" method="POST">
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Mật khẩu cũ</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-shield-lock"></i> Đổi mật khẩu
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php 
include_once ROOT_DIR . 'views/clients/footer.php'; 
?>