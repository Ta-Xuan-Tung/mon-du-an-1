<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container mt-4">
    <h3>Danh sách sản phẩm</h3>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-success mt-3">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-end mb-3">
        <a href="<?= ADMIN_URL . '?ctl=product-create' ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm Mới
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Hình ảnh</th>
                <th scope="col">Giá</th>
                <th scope="col">Kho hàng (Size / Số lượng)</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" style="width: 15%;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $pro) : ?>
                <tr>
                    <th scope="row"><?= $pro['id'] ?></th>
                    <td>
                        <strong><?= htmlspecialchars($pro['name']) ?></strong><br>
                        <small class="text-muted">Danh mục: <?= htmlspecialchars($pro['cate_name']) ?></small>
                    </td>
                    <td>
                        <?php if (!empty($pro['image']) && file_exists(ROOT_DIR . $pro['image'])): ?>
                            <img src="<?= ROOT_URL . $pro['image'] ?>" width="70" alt="Ảnh sản phẩm">
                        <?php else: ?>
                            <small>Không có ảnh</small>
                        <?php endif; ?>
                    </td>
                    <td><?= number_format($pro['price'], 0, ',', '.') ?> VNĐ</td>
                    <td>
                        <?php
                            $sizes = (new Product())->getSizes($pro['id']);
                            if (!empty($sizes)) {
                                foreach ($sizes as $s) {
                                    echo '<div><span class="badge bg-primary me-2">' . htmlspecialchars($s['size']) . '</span>' . 'còn: ' . htmlspecialchars($s['quantity']) . '</div>';
                                }
                            } else {
                                echo '<span class="badge bg-danger">Chưa có size</span>';
                            }
                        ?>
                    </td>
                    <td>
                        <?php if ($pro['status'] == 1): ?>
                            <span class="badge bg-success">Đang kinh doanh</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Ngừng kinh doanh</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= ADMIN_URL . '?ctl=product-edit&id=' . $pro['id'] ?>" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i> Sửa
                        </a>
                        <a href="<?= ADMIN_URL . '?ctl=product-delete&id=' . $pro['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không? Hành động này không thể hoàn tác.')">
                            <i class="bi bi-trash"></i> Xóa
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
                    <a class="page-link" href="<?= ADMIN_URL . '?ctl=product-list&page=' . ($page - 1) ?>">Previous</a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= ADMIN_URL . '?ctl=product-list&page=' . $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ADMIN_URL . '?ctl=product-list&page=' . ($page + 1) ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>