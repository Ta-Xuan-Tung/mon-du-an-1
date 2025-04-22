<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Thông tin người dùng</h2>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Thông tin cá nhân</h5>
        </div>
        <div class="card-body">
            <p><strong>Họ và tên:</strong> <?= htmlspecialchars($_SESSION['user']['fullname'] ?? 'Chưa cập nhật') ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user']['email'] ?? 'Chưa cập nhật') ?></p>
            <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($_SESSION['user']['phone'] ?? 'Chưa cập nhật') ?></p>
            <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($_SESSION['user']['address'] ?? 'Chưa cập nhật') ?></p>
        </div>
        <div class="card-footer text-end">
            <a href="<?= ROOT_URL . '?ctl=logout' ?>" class="btn btn-danger">Đăng xuất</a>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php" ?>