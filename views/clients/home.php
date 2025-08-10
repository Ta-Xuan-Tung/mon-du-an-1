<?php 
// Bắt đầu bằng việc include header
include_once ROOT_DIR . "views/clients/header.php"; 
?>

<div class="container mt-5">

    <h2 class="text-center mb-4">Giày Nike</h2>
    <div class="row g-4">
        <?php foreach($nikes as $nike) : ?>
            <div class="col-md-3">
                <div class="product-box">
                    <a href="<?= ROOT_URL . '?ctl=detail&id=' . $nike['id'] ?>">
                        <img src="<?= ROOT_URL . $nike['image'] ?>" alt="<?= htmlspecialchars($nike['name']) ?>" class="product-img">
                    </a>
                    <div class="product-info">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $nike['id'] ?>">
                            <h5 class="product-name"><?= htmlspecialchars($nike['name']) ?></h5>
                        </a>
                        <div>
                            <span class="product-price"><?= number_format($nike['price']) ?>đ</span>
                        </div>
                        <div class="product-buttons">
                           <a href="<?= ROOT_URL . '?ctl=detail&id=' . $nike['id'] ?>" class="btn btn-outline-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <h2 class="text-center mt-5 mb-4">Giày Adidas</h2>
    <div class="row g-4">
        <?php foreach($adidass as $adidas) : ?>
            <div class="col-md-3">
                <div class="product-box">
                     <a href="<?= ROOT_URL . '?ctl=detail&id=' . $adidas['id'] ?>">
                        <img src="<?= ROOT_URL . $adidas['image'] ?>" alt="<?= htmlspecialchars($adidas['name']) ?>" class="product-img">
                    </a>
                    <div class="product-info">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $adidas['id'] ?>">
                            <h5 class="product-name"><?= htmlspecialchars($adidas['name']) ?></h5>
                        </a>
                        <div>
                            <span class="product-price"><?= number_format($adidas['price']) ?>đ</span>
                        </div>
                        <div class="product-buttons">
                           <a href="<?= ROOT_URL . '?ctl=detail&id=' . $adidas['id'] ?>" class="btn btn-outline-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    
    <h2 class="text-center mt-5 mb-4">Giày MLB</h2>
    <div class="row g-4">
        <?php foreach($mlbs as $mlb) : ?>
            <div class="col-md-3">
                <div class="product-box">
                     <a href="<?= ROOT_URL . '?ctl=detail&id=' . $mlb['id'] ?>">
                        <img src="<?= ROOT_URL . $mlb['image'] ?>" alt="<?= htmlspecialchars($mlb['name']) ?>" class="product-img">
                    </a>
                    <div class="product-info">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $mlb['id'] ?>">
                            <h5 class="product-name"><?= htmlspecialchars($mlb['name']) ?></h5>
                        </a>
                        <div>
                            <span class="product-price"><?= number_format($mlb['price']) ?>đ</span>
                        </div>
                        <div class="product-buttons">
                           <a href="<?= ROOT_URL . '?ctl=detail&id=' . $mlb['id'] ?>" class="btn btn-outline-primary">Xem chi tiết</a>
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