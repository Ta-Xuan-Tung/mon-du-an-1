<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán hàng - <?= $title ?? ''?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/detail.css">
</head>

<body>
    <div class="container w-90">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= ROOT_URL ?>">LOGO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= ROOT_URL?>">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Giới thiệu</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sản phẩm
          </a>
          <ul class="dropdown-menu">
            <?php foreach($categories as $cate) :  ?>
            <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=category&id=' . $cate['id'] ?>"><?= $cate['cate_name'] ?></a></li>
            <?php endforeach ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="<?= ROOT_URL ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-solid fa-user"></i>
          <?= $_SESSION['user']['fullname'] ?? '' ?>
        </a>
          <ul class="dropdown-menu">
            <?php if (isset($_SESSION['user'])) : ?>
            <li>
              <a class="dropdown-item" href="<?= ROOT_URL ?>">
                Profile
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=logout' ?>">
                logout
              </a>
            </li>
            <?php else : ?>
              <li>
              <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=login' ?>">
                Đăng nhập
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=register' ?>">
                Đăng ký
              </a>
            </li>
            <?php endif ?>
          </ul>
        </li>
        <li class="nav-item">
              <a href="<?= ROOT_URL . '?ctl=view-cart' ?>" class="nav-link">Giỏ Hàng (<?= $_SESSION['totalQuantity'] ?? '0' ?>)</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
