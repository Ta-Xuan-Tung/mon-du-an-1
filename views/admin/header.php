<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Trang Quản trị' ?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <header class="p-3 mb-3 border-bottom bg-light shadow-sm">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                
                <a href="<?= ADMIN_URL ?>" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none h4 me-lg-4">
                    ADMIN
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="<?= ADMIN_URL ?>" class="nav-link px-2 link-dark">Dashboard</a></li>
                    <li><a href="<?= ADMIN_URL ?>?ctl=category-list" class="nav-link px-2 link-dark">Danh Mục</a></li>
                    <li><a href="<?= ADMIN_URL ?>?ctl=product-list" class="nav-link px-2 link-dark">Sản Phẩm</a></li>
                    <li><a href="<?= ADMIN_URL ?>?ctl=news-list" class="nav-link px-2 link-dark">Tin Tức</a></li>
                    <li><a href="<?= ADMIN_URL ?>?ctl=order-list" class="nav-link px-2 link-dark">Đơn Hàng</a></li>
                    <li><a href="<?= ADMIN_URL ?>?ctl=user-list" class="nav-link px-2 link-dark">Người Dùng</a></li>
                </ul>

                <div class="dropdown text-end">
                    <?php if (isset($_SESSION['user'])): ?>
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4 me-1"></i>
                            <span><?= htmlspecialchars($_SESSION['user']['fullname']) ?></span>
                        </a>
                        <ul class="dropdown-menu text-small">
                            <li><a class="dropdown-item" href="<?= ROOT_URL ?>" target="_blank"><i class="bi bi-house"></i> Xem trang web</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=logout' ?>">Đăng xuất</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </header>

    <main class="container">