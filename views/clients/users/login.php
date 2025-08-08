<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Hiển thị thông báo thành công -->
            <?php if (isset($message) && is_array($message) && !empty($message['text'])): ?>
                <div class="alert alert-<?= htmlspecialchars($message['type'] ?? 'success') ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($message['text']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>

            <!-- Hiển thị thông báo lỗi -->
            <?php if (isset($error) && is_array($error) && !empty($error['text'])): ?>
                <div class="alert alert-<?= htmlspecialchars($error['type'] ?? 'danger') ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($error['text']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>

            <div class="container">
                <h3>Đăng nhập</h3>
                <form action="<?= ROOT_URL . '?ctl=login' ?>" method="POST">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="loginEmail" placeholder="Nhập email">
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Nhập mật khẩu">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php" ?>