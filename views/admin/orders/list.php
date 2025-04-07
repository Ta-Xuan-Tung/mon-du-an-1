<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container mt-4">
  <h3 class="text-center mb-4">Danh sách đơn hàng</h3>
  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#ID</th>
        <th scope="col">Họ và tên</th>
        <th scope="col">Số điện thoại</th>
        <th scope="col">Phương thức thanh toán</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Tổng tiền</th>
        <th scope="col">Ngày mua</th>
        <th scope="col">Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($orders as $order) : ?>
      <tr>
        <th scope="row"><?= $order['id'] ?></th>
        <td><?= $order['fullname'] ?></td>
        <td><?= $order['phone'] ?></td>
        <td><?= $order['payment_method'] ?></td>
        <td><?= getOrderStatus($order['status']) ?></td>
        <td><?= number_format($order['total_price']) ?> VNĐ</td>
        <td><?= $order['created_at'] ?></td>
        <td>
          <a href="<?= ADMIN_URL . '?ctl=detail-order&id=' . $order['id'] ?>" class="btn btn-info btn-sm">Cập nhật</a>
        </td>
      </tr> 
      <?php endforeach ?>  
    </tbody>
  </table>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
