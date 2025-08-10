<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container mt-5" style="min-height: 500px;">
    <h1 class="mb-4">Giỏ hàng của bạn</h1>

    <?php 
    // Sử dụng session_flash để lấy và xóa thông báo gọn gàng hơn
    $message = session_flash('message');
    if ($message && !empty($message['text'])): 
    ?>
        <div class="alert alert-<?= $message['type'] ?? 'success' ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message['text']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (empty($carts)): ?>
        <div class="alert alert-info text-center">
            <p class="h4">Giỏ hàng của bạn đang trống</p>
            <a href="<?= ROOT_URL ?>" class="btn btn-primary mt-3">Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <form action="<?= ROOT_URL . '?ctl=update-cart' ?>" method="post">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center" colspan="2">Sản phẩm</th>
                            <th scope="col" class="text-center">Size</th>
                            <th scope="col" class="text-end">Giá</th>
                            <th scope="col" class="text-center">Số lượng</th>
                            <th scope="col" class="text-end">Thành tiền</th>
                            <th scope="col" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($carts as $key => $cart) : 
                            $parts = explode('_', $key);
                            $id = $parts[0];
                            $size = $cart['size'];
                        ?>
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <!-- SỬA LỖI ẢNH BỊ MÉO: Dùng class thay vì style inline -->
                                    <img src="<?= ROOT_URL . $cart['image'] ?>" alt="<?= htmlspecialchars($cart['name']) ?>" class="cart-product-img">
                                </td>
                                <td><?= htmlspecialchars($cart['name']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($size) ?></td>
                                <td class="text-end"><?= number_format($cart['price']) ?> VNĐ</td>
                                <td class="text-center">
                                    <input type="number" name="quantity[<?= $key ?>]" value="<?= $cart['quantity'] ?>" min="1" class="form-control" style="width: 80px; margin: auto;">
                                </td>
                                <td class="text-end fw-bold"><?= number_format($cart['price'] * $cart['quantity']) ?> VNĐ</td>
                                <td class="text-center">
                                    <a href="<?= ROOT_URL . '?ctl=delete-cart&id=' . $id . '&size=' . $size ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="5" class="text-end fw-bold">Tổng Tiền:</td>
                            <td colspan="2" class="fw-bold text-danger h5 text-end"><?= number_format($sumPrice) ?> VNĐ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <!-- SỬA LỖI LINK SAI -->
                <a href="<?= ROOT_URL ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                </a>
                <div>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-arrow-clockwise"></i> Cập nhật giỏ hàng
                    </button>
                    <a href="<?= ROOT_URL . '?ctl=view-checkout' ?>" class="btn btn-success">
                        <i class="bi bi-credit-card"></i> Thanh toán
                    </a>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>