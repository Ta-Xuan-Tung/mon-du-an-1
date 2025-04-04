<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="container">
                <h2>Đăng ký</h2>
                <form action="<?= ROOT_URL . '?ctl=register'?>" method="POST">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ Tên</label>
                        <input type="text" class="form-control" name="fullname" placeholde="Nhập họ tên">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholde="Nhập email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" placeholde="Nhập mật khẩu">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" placeholde="Nhập số điện thoại">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" placeholde="Nhập địa chỉ">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php" ?>
