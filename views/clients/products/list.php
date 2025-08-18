<?php 
// 1. Bắt đầu bằng việc include header
include_once ROOT_DIR . "views/clients/header.php"; 
?>

<div class="container mt-5">

    <h2 class="mb-4"><?= htmlspecialchars($category['cate_name'] ?? 'Tất cả sản phẩm') ?></h2>
    
    <div class="row g-4">
        <?php if (!empty($products)) : ?>
            <?php foreach($products as $product) : ?>
                <div class="col-md-3">
                    <div class="product-box">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>">
                            <div class="product-img-container">
                                 <img src="<?= ROOT_URL . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-img">
                            </div>
                        </a>
                        <div class="product-info">
                            <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>" style="text-decoration: none !important;">
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
                <div class="alert alert-info">
                    Danh mục <strong><?= htmlspecialchars($category['cate_name'] ?? '') ?></strong> hiện không có sản phẩm nào.
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

<?php 
// 3. Kết thúc bằng việc include footer
include_once ROOT_DIR . "views/clients/footer.php"; 
?>