<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Website bán giày' ?></title>
    
    <!-- Link Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Link Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Link file CSS tùy chỉnh của bạn -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
</head>
<body>
    <header class="p-3 mb-3 border-bottom bg-light shadow-sm">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                
                <a href="<?= ROOT_URL ?>" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none h4 me-lg-4">
                    <!-- SỬA LỖI Ở ĐÂY: Thêm style để giới hạn chiều cao logo -->
                    <img src="<?= ROOT_URL ?>images/logo.png" alt="Logo" class="me-2" style="height: 40px; width: auto;">
                    
                    GIÀY STORE
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="<?= ROOT_URL ?>" class="nav-link px-2 link-secondary">Trang chủ</a></li>
                       <!-- **THÊM DÒNG NÀY VÀO** -->
    <li><a href="<?= ROOT_URL . '?ctl=all-products' ?>" class="nav-link px-2 link-dark">Cửa hàng</a></li>

    <li class="nav-item dropdown">
        <!-- ... -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sản phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($categories as $category) : ?>
                                <li>
                                    <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=category&id=' . $category['id'] ?>">
                                        <?= htmlspecialchars($category['cate_name']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li><a href="<?= ROOT_URL . '?ctl=infor' ?>" class="nav-link px-2 link-dark">Giới thiệu</a></li>
                </ul>

           <!-- THANH TÌM KIẾM ĐÃ ĐƯỢC SỬA LẠI -->
<form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" action="<?= ROOT_URL ?>" method="GET">
    <!-- Thêm input ẩn để chỉ định controller -->
    <input type="hidden" name="ctl" value="search">
    <!-- Thêm name="keyword" để gửi từ khóa đi -->
    <input type="search" class="form-control" name="keyword" placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
</form>

                <div class="d-flex align-items-center">
                    <a href="<?= ROOT_URL . '?ctl=view-cart' ?>" class="btn btn-outline-primary me-3 position-relative">
                        <i class="bi bi-cart"></i> Giỏ hàng
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= $_SESSION['totalQuantity'] ?? 0 ?>
                        </span>
                    </a>

                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- Nếu người dùng đã đăng nhập -->
                        <div class="dropdown text-end">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= ROOT_URL . ($_SESSION['user']['avatar'] ?? 'images/default-avatar.png') ?>" alt="avatar" width="32" height="32" class="rounded-circle">
                                <span><?= htmlspecialchars($_SESSION['user']['fullname']) ?></span>
                            </a>
                            <ul class="dropdown-menu text-small">
                                <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                                    <li>
                                        <a class="dropdown-item fw-bold text-danger" href="<?= ADMIN_URL ?>">
                                            <i class="bi bi-speedometer2"></i> Quay về trang Admin
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                
                                <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=profile' ?>">Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=order-history' ?>">Lịch sử đơn hàng</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=logout' ?>">Đăng xuất</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Nếu người dùng chưa đăng nhập -->
                        <a href="<?= ROOT_URL . '?ctl=login' ?>" class="btn btn-primary">Đăng nhập</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <main class="container">