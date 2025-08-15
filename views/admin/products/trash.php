<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thùng rác sản phẩm</h1>
        <a href="<?= ADMIN_URL . '?ctl=products' ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td><?= htmlspecialchars($product['name']) ?></td>
                                <td class="text-center">
                                    <img src="<?= ROOT_URL . $product['image'] ?>" alt="" style="width: 60px; height: 60px; object-fit: contain;">
                                </td>
                                <td class="text-center">
                                    <a href="<?= ADMIN_URL . '?ctl=product-restore&id=' . $product['id'] ?>" class="btn btn-success btn-sm">Khôi phục</a>
                                    <a href="<?= ADMIN_URL . '?ctl=product-force-delete&id=' . $product['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('HÀNH ĐỘNG NÀY KHÔNG THỂ HOÀN TÁC! Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này không?')">Xóa vĩnh viễn</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>