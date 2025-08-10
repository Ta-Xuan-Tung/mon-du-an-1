<?php include_once ROOT_DIR . 'views/clients/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">
        Kết quả tìm kiếm cho: <span class="text-primary">"<?= htmlspecialchars($keyword) ?>"</span>
    </h2>
    
    <div class="row g-4">
        <?php if (!empty($products)) : ?>
            <?php foreach($products as $product) : ?>
                <div class="col-md-3">
                    <div class="product-box">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>">
                            <img src="<?= ROOT_URL . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-img">
                        </a>
                        <div class="product-info">
                            <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>">
                                <h5 class="product-name"><?= htmlspecialchars($product['name']) ?></h5>
                            </a>
                            <div>
                                <span class="product-price"><?= number_format($product['price']) ?>đ</span>
                            </div>
                            <div class="product-buttons">
                                <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>" class="btn btn-outline-primary w-100">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <p class="h4">Không tìm thấy sản phẩm nào</p>
                    <p>Chúng tôi không tìm thấy sản phẩm nào khớp với từ khóa "<?= htmlspecialchars($keyword) ?>". Vui lòng thử lại với từ khóa khác.</p>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

<?php include_once ROOT_DIR . 'views/clients/footer.php'; ?>