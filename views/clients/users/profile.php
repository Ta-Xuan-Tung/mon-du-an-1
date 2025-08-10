<?php 
// Đảm bảo người dùng đã đăng nhập
if (!isset($_SESSION['user'])) {
    header('Location: ' . ROOT_URL . '?ctl=login');
    die;
}
include_once ROOT_DIR . 'views/clients/header.php'; 
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h3 class="mb-4 text-center">Thông tin cá nhân</h3>

            <?php if (!empty($message)) : ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form action="<?= ROOT_URL . '?ctl=edit-profile' ?>" method="POST" enctype="multipart/form-data">
                        <!-- ID người dùng, bắt buộc phải có -->
                        <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <!-- Hiển thị Avatar -->
                                <img src="<?= ROOT_URL . ($_SESSION['user']['avatar'] ?? 'images/default-avatar.png') ?>" 
                                     alt="Avatar" 
                                     class="img-fluid rounded-circle mb-3" 
                                     style="width: 150px; height: 150px; object-fit: cover;">
                                
                                <!-- Gợi ý: Thêm input để thay đổi avatar nếu muốn -->
                                <!-- <label for="avatar" class="form-label">Thay đổi ảnh đại diện</label> -->
                                <!-- <input type="file" class="form-control form-control-sm" name="avatar" id="avatar"> -->
                            </div>

                            <div class="col-md-8">
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
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Lưu thay đổi
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