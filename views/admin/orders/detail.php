<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Chi tiết đơn hàng</h4>
        </div>
        <div class="card-body">
            <!-- Thông tin đơn hàng -->
            <div class="mb-4">
                <h5>Mã đơn hàng: <span class="text-info"><?= $order['id'] ?></span></h5>
                <p><strong>Ngày đặt hàng: </strong><span class="text-muted"><?= date('d-m-Y H:i:s', strtotime($order['created_at'])) ?></span></p>
            </div>

            <!-- Thông tin của khách hàng -->
            <div class="mb-4">
                <h5 class="text-primary">Thông tin khách hàng</h5>
                <p><strong>Họ và tên: </strong><span><?= $order['fullname'] ?></span></p>
                <p><strong>Email: </strong><span><?= $order['email'] ?></span></p>
                <p><strong>Điện thoại: </strong><span><?= $order['phone'] ?></span></p>
                <p><strong>Địa chỉ: </strong><span><?= $order['address'] ?></span></p>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="mb-4">
                <h5 class="text-primary">Danh sách sản phẩm</h5>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($order_detail as $stt => $detail) : ?>
                            <tr>
                                <td><?= $stt+1 ?></td>
                                <td><?= $detail['name'] ?></td>
                                <td><img src="<?= ROOT_URL . $detail['image'] ?>" alt="Product Image" class="img-fluid" style="max-width: 50px;"></td>
                                <td><?= $detail['quantity'] ?></td>
                                <td><?= number_format($detail['price']) ?> VNĐ</td>
                                <td><?= number_format($detail['price'] * $detail['quantity']) ?> VNĐ</td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Tổng cộng: </th>
                            <th class="fw-bold"><?= number_format($order['total_price']) ?> VNĐ</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Cập nhật trạng thái đơn hàng -->
            <div class="mb-4">
                <h5 class="text-primary">Cập nhật trạng thái đơn hàng</h5>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="orderStatus" class="form-label">Trạng thái đơn hàng</label>
                        <select name="status" id="orderStatus" class="form-select">
                            <?php foreach($status as $key => $value) : ?>
                                <option value="<?= $key ?>" <?= $order['status'] == $key ? 'selected' : '' ?>>
                                    <?= $value ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Cập nhật trạng thái</button>
                </form>
            </div>
        </div>

        <!-- Nút thao tác -->
        <div class="d-flex justify-content-between card-footer">
            <a href="<?= ADMIN_URL . '?ctl=list-order' ?>" class="btn btn-secondary">Quay lại danh sách đơn hàng</a>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
