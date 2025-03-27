<?php include_once ROOT_DIR . "views/clients/header.php" ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/default.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Giày Nike</h2>
        <div class="row g-4">
            <?php foreach($nikes as $nike) : ?>
            <!-- box sản phẩm -->
             <div class="col-md-3">
                <div class="product-box">
                    <img src="<?= ROOT_URL . $nike['image'] ?>" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <a href="">
                            <h5 class="product-name"><?= $nike['name']?></h5>
                        </a>
                        <div>
                            <span class="product-price"><?= number_format($nike['price']) ?>đ</span>
                        </div>
                        <div class="product-buttons">
                            <a class="btn btn-outline-success">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
             </div>
             <?php endforeach ?>
        </div>
        <h2>Giày Adidas</h2>
        <div class="row g-4">
        <?php foreach($adidass as $adidas) : ?>
            <!-- box sản phẩm -->
            <div class="col-md-3">
                <div class="product-box">
                    <img src="<?= ROOT_URL . $adidas['image'] ?>" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <a href="">
                            <h5 class="product-name"><?= $adidas['name']?></h5>
                        </a>
                        <div>
                            <span class="product-price"><?= number_format($adidas['price']) ?>đ</span>
                        </div>
                        <div class="product-buttons">
                            <a class="btn btn-outline-success">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
             </div>

                <?php endforeach ?>
        </div>
    </div>
</body>
</html>




<?php include_once ROOT_DIR . "views/clients/footer.php" ?>
