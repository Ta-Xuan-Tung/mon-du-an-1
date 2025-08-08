<?php 
// Đảm bảo đường dẫn này đúng với cấu trúc của bạn
include_once ROOT_DIR . 'views/clients/header.php'; 
?>

<div class="container mt-5 mb-5" style="min-height: 500px;">
    <h3 class="mb-4">Lịch sử đơn hàng của bạn</h3>
    
    <?php if (empty($orders)): ?>
        <div class="alert alert-info">
            Bạn chưa có đơn hàng nào. Hãy bắt đầu mua sắm ngay!
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Mã ĐH</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Thanh toán</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <th scope="row">#<?= $order['id'] ?></th>
                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                            <td><strong><?= number_format($order['total_price'], 0, ',', '.') ?> VNĐ</strong></td>
                            <td><?= htmlspecialchars($order['payment_method']) ?></td>
                            <td>
                                <?php
                                    $status_text = (new Order)->status_details[$order['status']] ?? 'Không xác định';
                                    $status_class = 'badge bg-secondary';
                                    if ($order['status'] == 1) $status_class = 'badge bg-warning text-dark';
                                    if ($order['status'] == 2) $status_class = 'badge bg-info text-dark';
                                    if ($order['status'] == 3) $status_class = 'badge bg-success';
                                    if ($order['status'] == 4) $status_class = 'badge bg-danger';
                                ?>
                                <span class="<?= $status_class ?>"><?= $status_text ?></span>
                            </td>
                            <td>
                                <a href="<?= ROOT_URL . '?ctl=order-detail&id=' . $order['id'] ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> Xem chi tiết
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php 
// Đảm bảo đường dẫn này đúng với cấu trúc của bạn
include_once ROOT_DIR . 'views/clients/footer.php'; 
?>