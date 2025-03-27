<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container">
<?php if($message != '') : ?>
        <div class="alert alert-success mt-3">
            <?= $message ?>
        </div>
    <?php endif ?>
    <form action="<?= ADMIN_URL . '?ctl=updatesp' ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="" class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" value="<?= $product['name']?>" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Danh mục</label>
            <select name="category_id" id="" class="form-control">
                <?php foreach($categories as $cate) : ?>
                    <option value="<?= $cate['id']?>" 
                        <?= $cate['id']==$product['category_id'] ? 'selected' : ''  ?>
                    >
                        <?= $cate['cate_name']?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Hình ảnh</label> <br>
            <img src="<?= ROOT_URL . $product['image'] ?>" width="90" alt="">
            <input type="hidden" name="image" value="<?= $product['image'] ?>">
            <input type="file" name="image" class="form-control" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Giá</label>
            <input type="number" name="price" step="0.1" class="form-control" value="<?= $product['price']?>" id="">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Trạng thái</label>
            <input type="radio" name="status" value="1" <?= $product['status'] ? 'checked' : ''  ?> > Đang kinh doanh
            <input type="radio" name="status" value="0" <?= $product['status'] ==0 ? 'checked' : ''  ?>> Ngừng kinh doanh
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Mô tả ngắn</label>
            <textarea name="description" rows="4" class="form-control" id=""><?= $product['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Nội dung</label>
            <textarea name="content" rows="8" class="form-control" id=""><?= $product['content'] ?></textarea>
        </div>
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">cập nhật</button>
        </div>
    </form>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
