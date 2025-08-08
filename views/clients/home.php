<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/default.css">
    <style>
        .product-box {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #fff;
        }
        .product-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-info {
            padding: 15px;
            text-align: center;
        }
        .product-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            height: 40px; /* Chiều cao cố định */
            overflow: hidden; /* Ẩn nội dung vượt quá */
            text-overflow: ellipsis; /* Thêm dấu "..." nếu nội dung quá dài */
            white-space: nowrap; /* Không cho phép xuống dòng */
        }
        .product-price {
            font-size: 1rem;
            color: #007bff;
            font-weight: bold;
        }
        .product-buttons .btn {
            margin-top: 10px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Giày Nike</h2>
        <div class="row g-4">
            <?php foreach($nikes as $nike) : ?>
            <!-- box sản phẩm -->
            <div class="col-md-3">
                <div class="product-box">
                    <img src="<?= ROOT_URL . $nike['image'] ?>" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $nike['id'] ?>">
                            <h5 class="product-name"><?= $nike['name']?></h5>
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
            <!-- box sản phẩm -->
            <div class="col-md-3">
                <div class="product-box">
                    <img src="<?= ROOT_URL . $adidas['image'] ?>" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <a href="<?= ROOT_URL . '?ctl=detail&id=' . $adidas['id'] ?>">
                            <h5 class="product-name"><?= $adidas['name']?></h5>
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
    </div>
</body>
</html>

<?php include_once ROOT_DIR . "views/clients/footer.php" ?>