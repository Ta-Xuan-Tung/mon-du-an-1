<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<div class="container mt-5">
<div class="card shadow p-4 text-center" style="max-width: 500px;">
    <div class="card-body">
      <div class="mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.08 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.44 6.02 7.97a.75.75 0 1 0-1.04 1.08l1.99 1.99z"/>
        </svg>
      </div>
      <h3 class="mb-3">Đặt hàng thành công!</h3>
      <p class="text-muted">Cảm ơn bạn đã mua hàng. Chúng tôi sẽ sớm liên hệ để xác nhận đơn hàng.</p>

      <div class="d-grid gap-2 mt-4">
        <a href="<?= ROOT_URL . '?ctl=' ?>" class="btn btn-primary">Về trang chủ</a>
        <a href="/don-hang" class="btn btn-outline-secondary">Xem đơn hàng</a>
      </div>
    </div>
  </div>
</div>


<?php include_once ROOT_DIR . "views/clients/footer.php" ?>
