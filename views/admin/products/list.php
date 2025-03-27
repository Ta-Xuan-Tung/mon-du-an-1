<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container">
    <?php if($message != '') : ?>
        <div class="alert alert-success">
            <?= $message ?>
        </div>
    <?php endif ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Tên sản phẩm</th>
      <th scope="col">Hình ảnh</th>
      <th scope="col">Giá</th>
      <th scope="col">Trạng thái</th>
      <th scope="col">Danh mục</th>
      <th scope="col">
        <a href="<?= ADMIN_URL . '?ctl=addsp'?>" class="btn btn-primary">Thêm Mới</a>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $pro) : ?>
    <tr>    
      <th scope="row"><?= $pro['id'] ?></th>
      <td><?= $pro['name'] ?></td>
      <td>
        <img src="<?= ROOT_URL . $pro['image']?>" width="60"  alt=""> 
      </td>
      <td><?= number_format($pro['price']) ?> VNĐ</td>
      <td><?= $pro['status']?'Đang kinh doanh': 'Ngừng kinh doanh' ?></td>
      <td><?= $pro['cate_name'] ?></td>
      <td>
        <a href="<?= ADMIN_URL . '?ctl=editsp&id'. $pto['id']?>" class="btn btn-primary">Sửa</a>
        <a href="<?= ADMIN_URL . '?ctl=deletesp&id'. $pto['id']?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chăn muốn xóa?')">Xóa</a>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
