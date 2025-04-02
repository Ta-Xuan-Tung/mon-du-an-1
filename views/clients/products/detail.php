<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<div class="container mt-5">
    <div class="row">

   
        <!-- hình ảnh sản phẩm -->
         <div class="col-md-6 ">
            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid" style="max-width: 50%; height: auto;">
         </div>
            <!-- thông tin sản phẩm -->
        <div class="col-md-6">
            <h1 class="display-5"><?= $product['name'] ?></h1>
            <p class="text-muted">Trạng thái: 
                <?php if($product['quantity']>0) : ?>
                <span class="badge bg-success">Còn hàng</span> <!-- thay đổi theo trạng thái -->
                <?php else : ?>
                    <span class="badge bg-danger">Hết hàng</span> <!-- thay đổi theo trạng thái -->
                <?php endif ?>
            </p>
            <h3 class="text-danger">Giá: <?= number_format($product['price']) ?> VNĐ</h3>
            <p><strong>Số lượng còn:</strong><?= $product['quantity'] ?></p>
            <p class="mt-4">
                <strong>Mô tả sản phẩm:</strong>
                <br>
                <?= $product['description'] ?>
            </p>
            <!-- nút thêm giỏ hàng -->
             <div class="mt-4">
                    <a class="btn btn-primary btn-lg">
                        <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                    </a>
             </div>
        </div>
    </div>
    
    <!-- thêm phần mô tả chi tiết nếu cần -->
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
    <!-- box sản phẩm -->
     <div class="col-md-3">
        <div class="product-box">
            <img src="<?= ROOT_URL . $product['image'] ?>" alt="Product Image" class="product-img" style="max-width: 50%; height: auto;">
            <div class="product-info">
            <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>">
                    <h5 class="product-name"><?= $product['name']?></h5>
                </a>
                <div>
                    <span class="product-price"><?= number_format($product['price']) ?>đ</span>
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

<?php include_once ROOT_DIR . "views/clients/footer.php" ?>
