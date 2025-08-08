<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?= $title ?? 'Dashboard' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="p-3 mb-3 border-bottom bg-light">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="<?= ADMIN_URL ?>" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none h4">
                    ADMIN
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="<?= ADMIN_URL ?>" class="nav-link px-2 link-secondary">Dashboard</a></li>
                    <li><a href="<?= ADMIN_URL . '?ctl=category-list' ?>" class="nav-link px-2 link-dark">Danh Mục</a></li>
                    <li><a href="<?= ADMIN_URL . '?ctl=product-list' ?>" class="nav-link px-2 link-dark">Sản Phẩm</a></li>
                    <li><a href="<?= ADMIN_URL . '?ctl=order-list' ?>" class="nav-link px-2 link-dark">Đơn Hàng</a></li>
                    <li><a href="<?= ADMIN_URL . '?ctl=user-list' ?>" class="nav-link px-2 link-dark">Người Dùng</a></li>
                </ul>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://i.pinimg.com/736x/e0/f3/32/e0f332d6990a8a654999a1e0a29a4336.jpg" alt="mdo" width="32" height="32" class="rounded-circle">
                        <span><?= $_SESSION['user']['fullname'] ?? 'Admin' ?></span>
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=profile' ?>">Thông tin cá nhân</a></li>
                        <li><a class="dropdown-item" href="<?= ROOT_URL ?>">Xem trang khách</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=logout' ?>">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        ```