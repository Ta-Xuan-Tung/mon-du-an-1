<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container">
    <form action="<?= ADMIN_URL . '?ctl=category-store' ?>" method="post">
        <div class="mb-3">
            <label for="" class="form-label">Tên danh mục</label>
            <input type="text" name="cate_name" class="form-control" id="">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Thêm mới</button>
              <a href="<?= ADMIN_URL ?>?ctl=category-list" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
