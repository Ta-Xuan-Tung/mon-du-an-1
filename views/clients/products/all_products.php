<?php include_once ROOT_DIR . 'views/clients/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center section-title">Tất cả sản phẩm</h2>
    
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
                <div class="alert alert-info">Chưa có sản phẩm nào.</div>
            </div>
        <?php endif ?>
    </div>

    <!-- PHẦN PHÂN TRANG -->
    <nav aria-label="Page navigation" class="mt-5">
        <ul class="pagination justify-content-center">
            <?php if ($totalPages > 1): ?>
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ROOT_URL . '?ctl=all-products&page=' . ($page - 1) ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= ROOT_URL . '?ctl=all-products&page=' . $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="<?= ROOT_URL . '?ctl=all-products&page=' . ($page + 1) ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php include_once ROOT_DIR . 'views/clients/footer.php'; ?>