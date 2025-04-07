<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<div class="container mt-5">
    <h1 class="mb-4">Thông tin thanh toán</h1>
    <div class="row">
        <!-- Cột bên trái: Thông tin người nhận và Phương thức thanh toán -->
        <div class="col-md-7">
            <form action="" method="post">
                <!-- Thông tin người nhận -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5>Thông tin người nhận</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($user['fullname']) ?>" id="fullName" name="fullname" placeholder="Nhập họ tên" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>" name="phone" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" name="email" placeholder="Nhập email" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ giao hàng</label>
                            <textarea class="form-control" name="address" rows="3" placeholder="Nhập địa chỉ giao hàng" required><?= htmlspecialchars($user['address']) ?></textarea>
                        </div>
                    </div>
                </div>
                <!-- Phương thức thanh toán -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5>Phương thức thanh toán</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input type="radio" class="form-check-input" id="cod" name="payment_method" value="cod" checked>
                            <label for="cod" class="form-check-label">
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input type="radio" class="form-check-input" id="vnpay" name="payment_method" value="vnpay">
                            <label for="vnpay" class="form-check-label">
                                Thanh toán bằng VNPay
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Nút xác nhận thanh toán -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-check-circle"></i> Xác nhận thanh toán
                    </button>
                </div>
            </form>
        </div>
        <!-- Cột bên phải: Thông tin giỏ hàng -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5>Thông tin giỏ hàng</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <!-- Hiển thị các sản phẩm trong giỏ hàng -->
                        <?php foreach($carts as $cart) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0"><?= htmlspecialchars($cart['name']) ?></h6>
                                    <small class="text-muted">Số lượng: <?= htmlspecialchars($cart['quantity']) ?></small>
                                </div>
                                <span><?= number_format($cart['price'] * $cart['quantity']) ?> VNĐ</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- Tổng tiền -->
                <div class="card-footer text-end fw-bold">
                    Tổng tiền: <span class="text-danger"><?= number_format($sumPrice) ?> VNĐ</span>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once ROOT_DIR . "views/clients/footer.php" ?>
