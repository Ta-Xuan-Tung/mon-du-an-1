<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container">
    <form action="<?= ADMIN_URL . '?ctl=storesp' ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Danh mục</label>
            <select name="category_id" id="" class="form-control">
                <?php foreach($categories as $cate) : ?>
                    <option value="<?= $cate['id']?>">
                        <?= $cate['cate_name']?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Hình ảnh</label>
            <input type="file" name="image" class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Giá</label>
            <input type="number" name="price" step="0.1" class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Số lượng</label>
            <input type="number" name="quantity"  class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Trạng thái</label>
            <input type="radio" name="status" value="1" checked> Đang kinh doanh
            <input type="radio" name="status" value="0" id=""> Ngừng kinh doanh
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Mô tả ngắn</label>
            <textarea name="description" rows="4" class="form-control" id=""></textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nội dung</label>
            <textarea name="content" rows="8" class="form-control" id=""></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </div>
    </form>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
