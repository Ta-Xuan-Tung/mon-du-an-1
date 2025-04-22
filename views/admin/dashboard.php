<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<h1>Trang Dashboard</h1>

<div class="container mt-4">
    <div class="row">
        <!-- Thống kê tổng số người dùng -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Người dùng</div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo (new User)->count(); ?> <!-- Logic đếm số người dùng -->
                    </h5>
                    <p class="card-text">Tổng số người dùng đã đăng ký.</p>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng số sản phẩm -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Sản phẩm</div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo (new Product)->count(); ?> <!-- Logic đếm số sản phẩm -->
                    </h5>
                    <p class="card-text">Tổng số sản phẩm hiện có.</p>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng số đơn hàng -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Đơn hàng</div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo (new Order)->count(); ?> <!-- Logic đếm số đơn hàng -->
                    </h5>
                    <p class="card-text">Tổng số đơn hàng đã đặt.</p>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng doanh thu -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Doanh thu</div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo number_format((new Order)->sumRevenue()); ?>đ <!-- Logic tính tổng doanh thu -->
                    </h5>
                    <p class="card-text">Tổng doanh thu từ các đơn hàng.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>
