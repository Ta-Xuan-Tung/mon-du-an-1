<?php 
// Đảm bảo có biến $title và $categories để header không bị lỗi
$title = $title ?? 'Chi tiết đơn hàng';
$categories = $categories ?? (new Category)->all();
include_once ROOT_DIR . "views/clients/header.php"; 
?>

<div class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Chi tiết đơn hàng #<?= htmlspecialchars($order['id']) ?></h4>
            <a href="<?= ROOT_URL . '?ctl=order-history' ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Quay lại lịch sử
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Thông tin người nhận</h5>
                    <p class="mb-1"><strong>Họ và tên:</strong> <?= htmlspecialchars($order['fullname']) ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
                    <p class="mb-1"><strong>Số điện thoại:</strong> <?= htmlspecialchars($order['phone']) ?></p>
                    <p class="mb-1"><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($order['address']) ?></p>
                </div>
                <div class="col-md-6">
                    <h5>Thông tin đơn hàng</h5>
                    <p class="mb-1"><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></p>
                    <p class="mb-1"><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                    <p class="mb-1">
                        <strong>Trạng thái:</strong> 
                        <?php 
                            $status_id = $order['status'];
                            $status_name = (new Order)->status_details[$status_id] ?? 'Không xác định';
                            $status_class = [1 => 'secondary', 2 => 'primary', 3 => 'success', 4 => 'danger'][$status_id] ?? 'dark';
                        ?>
                        <span class="badge bg-<?= $status_class ?>"><?= $status_name ?></span>
                    </p>
                </div>
            </div>

            <h5 class="mt-4">Các sản phẩm đã đặt</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col" class="text-end">Đơn giá</th>
                            <th scope="col" class="text-center">Số lượng</th>
                            <th scope="col" class="text-center">Size</th>
                            <th scope="col" class="text-end">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($order_details as $item): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= ROOT_URL . $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
                                        <span><?= htmlspecialchars($item['name']) ?></span>
                                    </div>
                                </td>
                                <td class="text-end"><?= number_format($item['price']) ?> VNĐ</td>
                                <td class="text-center"><?= htmlspecialchars($item['quantity']) ?></td>
                                <td class="text-center"><span class="badge bg-secondary"><?= htmlspecialchars($item['size']) ?></span></td>
                                <td class="text-end fw-bold"><?= number_format($item['price'] * $item['quantity']) ?> VNĐ</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td colspan="4" class="text-end fw-bold h5">Tổng cộng</td>
                            <td class="text-end fw-bold h5 text-danger"><?= number_format($order['total_price']) ?> VNĐ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>