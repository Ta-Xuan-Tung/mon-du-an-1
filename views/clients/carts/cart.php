<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<!-- Hiển thị thông báo từ $_SESSION['message'] -->
<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']['text'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<div class="container mt-5">
    <h1 class="mb-4">Giỏ hàng của bạn</h1>
    <form action="<?= ROOT_URL . '?ctl=update-cart' ?>" method="post">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Size</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($carts as $key => $cart) : 
                        // Tách key để lấy id và size (key là id_size)
                        $parts = explode('_', $key);
                        $id = $parts[0];
                        $size = isset($parts[1]) ? $parts[1] : '';
                    ?>
                        <tr>
                            <th scope="row"><?= $id ?></th>
                            <td>    
                                <img src="<?= ROOT_URL . $cart['image'] ?>" alt="" class="img-thumbnail" style="width: 40px; height: 80px;">
                            </td>
                            <td><?= $cart['name'] ?></td>
                            <td><?= $size ?: 'N/A' ?></td> <!-- Hiển thị size, nếu không có thì là N/A -->
                            <td><?= number_format($cart['price']) ?>VNĐ</td>
                            <td>
                                <input type="number" name="quantity[<?= $key ?>]" class="form-control" value="<?= $cart['quantity'] ?>" min="1" style="width: 80px;">
                            </td>
                            <td><?= number_format($cart['price'] * $cart['quantity']) ?>VNĐ</td>
                            <td>
                                <a href="<?= ROOT_URL . '?ctl=delete-cart&id=' . $id ?>&size=<?= $size ?>" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="6" class="text-end fw-bold">Tổng Tiền:</td>
                        <td colspan="2" class="fw-bold text-danger"><?= number_format($sumPrice) ?>VNĐ</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="<?= ROOT_URL . '?ctl=' ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>Tiếp tục mua sắm
            </a>
            <div>
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-arrow-clockwise"></i>Cập nhật giỏ hàng
                </button>
                <a href="<?= ROOT_URL . '?ctl=view-checkout' ?>" class="btn btn-success">
                    <i class="bi bi-credit-card"></i>Thanh toán
                </a>
            </div>
        </div>
    </form>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php" ?>