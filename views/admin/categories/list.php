<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách danh mục</h1>
    </div>

    <?php if (!empty($message_success)) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message_success) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($message_error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message_error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= ADMIN_URL . '?ctl=category-create' ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Thêm Mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Danh mục</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) : ?>
                            <tr>
                                <td><?= $category['id'] ?></td>
                                <td><?= htmlspecialchars($category['cate_name']) ?></td>
                                <td class="text-center">
                                    <a href="<?= ADMIN_URL . '?ctl=category-edit&id=' . $category['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="<?= ADMIN_URL . '?ctl=category-delete&id=' . $category['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>