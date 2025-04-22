<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giới thiệu - Giày Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script>
  <style>
    .hero {
      background-image: url('https://images.unsplash.com/photo-1528701800484-901d5adf0d5d?auto=format&fit=crop&w=1500&q=80');
      background-size: cover;
      background-position: center;
      height: 60vh;
      position: relative;
      color: white;
    }
    .hero-overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5);
    }
    .hero-content {
      position: relative;
      z-index: 2;
      top: 50%;
      transform: translateY(-50%);
      text-align: center;
    }
  </style>
</head>
<body>

 

  <!-- Hero Banner -->
  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content container">
      <h1 class="display-4 fw-bold">Giới Thiệu Về Giày Store</h1>
      <p class="lead">Nơi mang đến sự khác biệt cho từng bước chân của bạn.</p>
    </div>
  </section>

  <!-- Nội dung chính -->
  <section class="py-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6">
        <a class="navbar-brand" href="<?= ROOT_URL ?>">
                <img src="<?= ROOT_URL ?>images/oki.png" alt="Logo">
            </a>
        </div>
        <div class="col-md-6">
          <h2 class="mb-4">Về Chúng Tôi</h2>
          <p>Giày Store được thành lập từ năm 2020 với sứ mệnh mang đến cho khách hàng những đôi giày thời trang, chất lượng và phù hợp với mọi phong cách sống.</p>
          <p>Chúng tôi cam kết cung cấp sản phẩm chính hãng, giá cả hợp lý, cùng dịch vụ chăm sóc khách hàng tận tâm. Từ sneaker năng động đến giày da thanh lịch, Giày Store luôn đồng hành cùng bạn trên từng bước đường thành công.</p>
        </div>
      </div>

      <div class="row text-center">
        <div class="col-md-4">
          <i class="fas fa-shipping-fast fa-3x text-warning mb-3"></i>
          <h5>Giao hàng nhanh</h5>
          <p>Miễn phí giao hàng toàn quốc cho đơn từ 500k.</p>
        </div>
        <div class="col-md-4">
          <i class="fas fa-sync-alt fa-3x text-warning mb-3"></i>
          <h5>Đổi trả dễ dàng</h5>
          <p>Đổi trả trong 7 ngày nếu sản phẩm bị lỗi hoặc không vừa.</p>
        </div>
        <div class="col-md-4">
          <i class="fas fa-headset fa-3x text-warning mb-3"></i>
          <h5>Hỗ trợ 24/7</h5>
          <p>Luôn sẵn sàng giải đáp mọi thắc mắc của bạn.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white pt-4 pb-3">
    <div class="container text-center">
      <p class="mb-0">© 2025 Giày Store. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php include_once ROOT_DIR . "views/clients/footer.php" ?>
