<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container mt-4">
    <h3>Quản lý Đơn hàng</h3>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-success mt-3">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th scope="col">Mã ĐH</th>
                <th scope="col">Khách hàng</th>
                <th scope="col">Thông tin liên hệ</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Thanh toán</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Ngày đặt</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <th scope="row">#<?= $order['id'] ?></th>
                    <td><?= htmlspecialchars($order['fullname']) ?></td>
                    <td>
                        <div>Email: <?= htmlspecialchars($order['email']) ?></div>
                        <div>SĐT: <?= htmlspecialchars($order['phone']) ?></div>
                    </td>
                    <td><strong><?= number_format($order['total_price'], 0, ',', '.') ?> VNĐ</strong></td>
                    <td><?= htmlspecialchars($order['payment_method']) ?></td>
                    <td>
                        <?php
                            // Dựa vào status_details từ Order Model để hiển thị tên trạng thái
                            $status_text = (new Order)->status_details[$order['status']] ?? 'Không xác định';
                            $status_class = 'badge bg-secondary'; // Mặc định
                            if ($order['status'] == 1) $status_class = 'badge bg-warning text-dark'; // Chờ xử lý
                            if ($order['status'] == 2) $status_class = 'badge bg-info text-dark';   // Đang giao
                            if ($order['status'] == 3) $status_class = 'badge bg-success';          // Đã giao
                            if ($order['status'] == 4) $status_class = 'badge bg-danger';           // Đã hủy
                        ?>
                        <span class="<?= $status_class ?>"><?= $status_text ?></span>
                    </td>
                    <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                    <td>
                        <a href="<?= ADMIN_URL . '?ctl=order-detail&id=' . $order['id'] ?>" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i> Xem
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
     <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($totalPages > 1): ?>
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ADMIN_URL . '?ctl=order-list&page=' . ($page - 1) ?>">Previous</a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= ADMIN_URL . '?ctl=order-list&page=' . $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ADMIN_URL . '?ctl=order-list&page=' . ($page + 1) ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>