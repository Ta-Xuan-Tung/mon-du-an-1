<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container mt-5" style="min-height: 500px;">
    <h2 class="mb-4">Lịch sử đơn hàng của bạn</h2>

    <?php if (empty($orders)): ?>
        <div class="alert alert-info text-center">
            <p class="h4">Bạn chưa có đơn hàng nào.</p>
            <a href="<?= ROOT_URL ?>" class="btn btn-primary mt-3">Bắt đầu mua sắm</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Mã ĐH</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col" class="text-end">Tổng tiền</th>
                        <th scope="col" class="text-center">Trạng thái</th>
                        <th scope="col" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        // Mảng ánh xạ class màu của Bootstrap với trạng thái đơn hàng
                        $status_classes = [
                            1 => 'secondary', // Đang chờ xử lý
                            2 => 'primary',   // Đang giao hàng
                            3 => 'success',   // Đã giao hàng
                            4 => 'danger',    // Đã hủy
                        ];
                    ?>
                    <?php foreach($orders as $order) : ?>
                        <tr>
                            <th scope="row">#<?= $order['id'] ?></th>
                            <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                            <td class="text-end fw-bold"><?= number_format($order['total_price']) ?> VNĐ</td>
                            <td class="text-center">
                                <?php 
                                    $status_id = $order['status'];
                                    $status_name = (new Order)->status_details[$status_id] ?? 'Không xác định';
                                    $status_class = $status_classes[$status_id] ?? 'dark';
                                ?>
                                <span class="badge bg-<?= $status_class ?>"><?= $status_name ?></span>
                            </td>
                            <td class="text-center">
                                <a href="<?= ROOT_URL . '?ctl=order-detail&id=' . $order['id'] ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Xem
                                </a>

                                <?php if ($order['status'] == 1): ?>
                                    <a href="<?= ROOT_URL . '?ctl=cancel-order&id=' . $order['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')">
                                        Hủy đơn
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>