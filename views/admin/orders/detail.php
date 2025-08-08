<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container mt-4">
    <h3>Chi tiết Đơn hàng #<?= $order['id'] ?></h3>

    <?php
    // **SỬA LỖI Ở ĐÂY: Thêm đoạn code này để hiển thị thông báo**
    if (!empty($message)) :
    ?>
        <div class="alert alert-success mt-3">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Thông tin Khách hàng</strong>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Tên:</strong> <?= htmlspecialchars($order['fullname'] ?? 'Khách vãng lai') ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($order['email'] ?? 'N/A') ?></li>
                    <li class="list-group-item"><strong>Số điện thoại:</strong> <?= htmlspecialchars($order['phone'] ?? 'N/A') ?></li>
                    <li class="list-group-item"><strong>Địa chỉ giao hàng:</strong> <?= htmlspecialchars($order['address'] ?? 'N/A') ?></li>
                </ul>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <strong>Thông tin Đơn hàng</strong>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></li>
                    <li class="list-group-item"><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['payment_method']) ?></li>
                    <li class="list-group-item"><strong>Tổng giá trị:</strong> <span class="text-danger h5"><?= number_format($order['total_price'], 0, ',', '.') ?> VNĐ</span></li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Cập nhật trạng thái</strong>
                </div>
                <div class="card-body">
                    <form action="<?= ADMIN_URL . '?ctl=order-update-status&id=' . $order['id'] ?>" method="POST">
                        <div class="input-group">
                            <select name="status" class="form-select">
                                <?php foreach ($status_list as $key => $value) : ?>
                                    <option value="<?= $key ?>" <?= ($key == $order['status']) ? 'selected' : '' ?>>
                                        <?= $value ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <strong>Danh sách Sản phẩm</strong>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <?php foreach ($order_details as $item): ?>
                                <tr>
                                    <td><img src="<?= ROOT_URL . $item['image'] ?>" width="60"></td>
                                    <td>
                                        <?= htmlspecialchars($item['name']) ?><br>
                                        <small class="text-muted">Size: <?= htmlspecialchars($item['size']) ?></small>
                                    </td>
                                    <td>x <?= $item['quantity'] ?></td>
                                    <td class="text-end"><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="<?= ADMIN_URL . '?ctl=order-list' ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại danh sách
        </a>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>