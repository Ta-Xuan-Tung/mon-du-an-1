<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa danh mục</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= ADMIN_URL . '?ctl=category-update' ?>" method="POST">
                
                <input type="hidden" name="id" value="<?= $category['id'] ?>">

                <div class="mb-3">
                    <label for="cate_name" class="form-label">Tên danh mục:</label>
                    <input type="text" class="form-control" id="cate_name" name="cate_name" 
                           value="<?= htmlspecialchars($category['cate_name']) ?>" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="<?= ADMIN_URL . '?ctl=category-list' ?>" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>