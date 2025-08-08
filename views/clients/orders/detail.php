<?php 
// Đảm bảo đường dẫn này đúng với cấu trúc của bạn
include_once ROOT_DIR . 'views/clients/header.php'; 
?>

<div class="container mt-5 mb-5" style="min-height: 500px;">
    <h3 class="mb-4">Chi tiết đơn hàng: <span class="text-primary">#<?= $order['id'] ?></span></h3>

    <div class="row">
        <div class="col-lg-5 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <strong>Thông tin giao hàng</strong>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Tên người nhận:</strong> <?= htmlspecialchars($order['fullname']) ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></li>
                    <li class="list-group-item"><strong>Số điện thoại:</strong> <?= htmlspecialchars($order['phone']) ?></li>
                    <li class="list-group-item"><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['address']) ?></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card shadow-sm h-100">
                 <div class="card-header">
                    <strong>Các sản phẩm đã đặt</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <?php foreach ($order_details as $item): ?>
                                    <tr>
                                        <td style="width: 70px;">
                                            <img src="<?= ROOT_URL . $item['image'] ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($item['name']) ?>">
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($item['name']) ?><br>
                                            <small class="text-muted">Size: <?= htmlspecialchars($item['size']) ?></small>
                                        </td>
                                        <td>x <?= $item['quantity'] ?></td>
                                        <td class="text-end"><?= number_format($item['price']) ?> VNĐ</td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="fw-bold">
                                    <td colspan="3" class="text-end border-0">Tổng cộng:</td>
                                    <td class="text-end text-danger border-0 h5"><?= number_format($order['total_price']) ?> VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="mt-4">
        <a href="<?= ROOT_URL . '?ctl=order-history' ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại lịch sử đơn hàng
        </a>
    </div>
</div>

<?php 
// Đảm bảo đường dẫn này đúng với cấu trúc của bạn
include_once ROOT_DIR . 'views/clients/footer.php'; 
?>