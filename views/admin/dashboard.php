<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<h1>Trang Dashboard</h1>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Người dùng</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $stats['users'] ?></h5>
                    <p class="card-text">Tổng số người dùng đã đăng ký.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Sản phẩm</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $stats['products'] ?></h5>
                    <p class="card-text">Tổng số sản phẩm hiện có.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Đơn hàng</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $stats['orders'] ?></h5>
                    <p class="card-text">Tổng số đơn hàng đã đặt.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Doanh thu</div>
                <div class="card-body">
                    <h5 class="card-title"><?= number_format($stats['revenue']) ?>đ</h5>
                    <p class="card-text">Tổng doanh thu từ các đơn hàng.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>