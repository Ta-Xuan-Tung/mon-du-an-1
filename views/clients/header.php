<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bán hàng - <?= $title ?? ''?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> <!-- Thêm CDN Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/v4-shims.min.css"> <!-- Tùy chọn: hỗ trợ icon cũ nếu cần -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css"> <!-- Tùy chọn: hỗ trợ icon thương hiệu -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/detail.css">
    <style>
        .navbar {
            background-color: #f8f9fa !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand img {
            height: 80px;
        }
        .nav-link {
            font-size: 1.1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #007bff !important;
        }
        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-outline-success {
            border-radius: 20px;
        }
        .form-control {
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="container w-90 mt-3">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= ROOT_URL ?>">
                <img src="<?= ROOT_URL ?>images/oki.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= ROOT_URL ?>">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ROOT_URL . '?ctl=infor' ?>">Giới thiệu</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Danh mục sản phẩm">
                            Sản phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach($categories as $cate) : ?>
                            <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=category&id=' . $cate['id'] ?>"><?= $cate['cate_name'] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Tài khoản người dùng">
                            <i class="fa-solid fa-user"></i>
                            <?= $_SESSION['user']['fullname'] ?? '' ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['user'])) : ?>
                            <li>
                                <a class="dropdown-item" href="<?= ROOT_URL .'?ctl=profile' ?>">Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=logout' ?>">Logout</a>
                            </li>
                            <?php else : ?>
                            <li>
                                <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=login' ?>">Đăng nhập</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=register' ?>">Đăng ký</a>
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
            <div class="social-icons ms-3">
                <a href="https://facebook.com" class="text-white me-4 fs-4" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com" class="text-white me-4 fs-4" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://tiktok.com" class="text-white me-4 fs-4" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="https://youtube.com" class="text-white fs-4" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </nav>
</div>