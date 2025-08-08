<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<div class="container mt-5">
    <div class="row">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-md-6">
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid" style="max-width: 50%; height: auto;">
        </div>
        <!-- Thông tin sản phẩm -->
        <div class="col-md-6">
            <h1 class="display-5"><?= $product['name'] ?></h1>
            <p class="text-muted">Trạng thái: 
                <?php if($product['quantity'] > 0) : ?>
                    <span class="badge bg-success">Còn hàng</span>
                <?php else : ?>
                    <span class="badge bg-danger">Hết hàng</span>
                <?php endif ?>
            </p>
            <h3 class="text-danger">Giá: <?= number_format($product['price']) ?> VNĐ</h3>
            <p><strong>Số lượng còn:</strong> <?= $product['quantity'] ?></p>
            <p class="mt-4">
                <strong>Mô tả sản phẩm:</strong>
                <br>
                <?= $product['description'] ?>
            </p>
            <!-- Nút thêm giỏ hàng -->
            <div class="mt-4">
                <form action="<?= ROOT_URL ?>?ctl=add-cart" method="POST">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <select name="size" class="form-select mb-2" style="width: 150px;" required>
                        <?php
                        $sizes = (new Product)->getSizes($product['id']);
                        if (empty($sizes)) {
                            echo "<option value=''>Không có size nào khả dụng</option>";
                        } else {
                            foreach ($sizes as $s) :
                                if ($s['quantity'] > 0) :
                        ?>
                                    <option value="<?= $s['size'] ?>"><?= $s['size'] ?> (Còn: <?= $s['quantity'] ?>)</option>
                        <?php endif; endforeach;
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary btn-lg" <?= empty($sizes) ? 'disabled' : '' ?>>
                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </form>
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?= $_SESSION['message']['type'] ?> mt-3"><?= $_SESSION['message']['text'] ?></div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Thêm phần mô tả chi tiết nếu cần -->
    <div class="row mt-5">
        <div class="col">
            <h2>Mô tả chi tiết</h2>
            <p><?= $product['content'] ?></p>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2>Sản phẩm liên quan</h2>
    <div class="row g-4">
        <?php foreach($productReleads as $product) : ?>
        <!-- Box sản phẩm -->
        <div class="col-md-3">
            <div class="product-box">
                <img src="<?= ROOT_URL . $product['image'] ?>" alt="Product Image" class="product-img" style="max-width: 50%; height: auto;">
                <div class="product-info">
                    <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>">
                        <h5 class="product-name"><?= $product['name'] ?></h5>
                    </a>
                    <div>
                        <span class="product-price"><?= number_format($product['price']) ?>đ</span>
                    </div>
                    <div class="product-buttons">
                        <form action="<?= ROOT_URL ?>?ctl=add-cart" method="POST">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <select name="size" class="form-select mb-2" style="width: 100px;" required>
                                <?php
                                $relatedSizes = (new Product)->getSizes($product['id']);
                                if (empty($relatedSizes)) {
                                    echo "<option value=''>Không có size nào khả dụng</option>";
                                } else {
                                    foreach ($relatedSizes as $s) :
                                        if ($s['quantity'] > 0) :
                                ?>
                                            <option value="<?= $s['size'] ?>"><?= $s['size'] ?> (Còn: <?= $s['quantity'] ?>)</option>
                                <?php endif; endforeach;
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-outline-success" <?= empty($relatedSizes) ? 'disabled' : '' ?>>Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php" ?>