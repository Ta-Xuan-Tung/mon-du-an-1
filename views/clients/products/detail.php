<?php 
// Bắt đầu bằng việc include header
include_once ROOT_DIR . "views/clients/header.php"; 
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
             <div class="product-img-container">
                <img src="<?= ROOT_URL . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid rounded shadow-sm">
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="display-5"><?= htmlspecialchars($product['name']) ?></h1>
            <p class="text-muted">
                Trạng thái: 
                <?php 
                $totalQuantity = 0;
                $sizes = (new Product)->getSizes($product['id']);
                foreach ($sizes as $s) {
                    if ($s['quantity'] > 0) {
                        $totalQuantity += $s['quantity'];
                    }
                }
                ?>
                <?php if($totalQuantity > 0) : ?>
                    <span class="badge bg-success">Còn hàng</span>
                <?php else : ?>
                    <span class="badge bg-danger">Hết hàng</span>
                <?php endif ?>
            </p>
            
            <h3 class="text-danger my-3" style="font-size: 2.5rem; font-weight: 700;">
                <?= number_format($product['price']) ?> VNĐ
            </h3>
            
            <p><strong>Số lượng còn trong kho:</strong> <?= $totalQuantity ?></p>
            
            <p class="mt-3">
                <strong>Mô tả ngắn:</strong><br>
                <?= nl2br(htmlspecialchars($product['description'])) ?>
            </p>

            <div class="mt-4">
                <form action="<?= ROOT_URL ?>?ctl=add-cart" method="POST">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    
                    <div class="mb-3">
                        <label for="size-select" class="form-label"><strong>Chọn size:</strong></label>
                        <select id="size-select" name="size" class="form-select" style="width: 200px;" required>
                            <?php 
                            if (empty($sizes) || $totalQuantity <= 0) {
                                echo "<option value='' disabled>Hết size</option>";
                            } else {
                                foreach ($sizes as $s) :
                                    if ($s['quantity'] > 0) : ?>
                                        <option value="<?= $s['size'] ?>">Size: <?= $s['size'] ?> (Còn <?= $s['quantity'] ?>)</option>
                                    <?php endif; 
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" <?= (empty($sizes) || $totalQuantity <= 0) ? 'disabled' : '' ?>>
                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col">
            <h2 class="section-title">Mô tả chi tiết</h2>
            <div class="product-content">
                <?= $product['content'] ?>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="section-title text-center">Sản phẩm liên quan</h2>
    <div class="row g-4">
        <?php foreach($productReleads as $related_product) : ?>
            <div class="col-md-3">
                <div class="product-box">
                    <a href="<?= ROOT_URL . '?ctl=detail&id=' . $related_product['id'] ?>">
                         <div class="product-img-container">
                            <img src="<?= ROOT_URL . $related_product['image'] ?>" alt="<?= htmlspecialchars($related_product['name']) ?>" class="product-img">
                        </div>
                    </a>
                    <div class="product-info">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $related_product['id'] ?>" style="text-decoration: none !important;">
                            <h5 class="product-name"><?= htmlspecialchars($related_product['name']) ?></h5>
                        </a>
                        <div>
                            <span class="product-price"><?= number_format($related_product['price']) ?>đ</span>
                        </div>
                        <div class="product-buttons">
                            <a href="<?= ROOT_URL . '?ctl=detail&id=' . $related_product['id'] ?>" class="btn btn-outline-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php 
// Kết thúc bằng việc include footer
include_once ROOT_DIR . "views/clients/footer.php"; 
?>