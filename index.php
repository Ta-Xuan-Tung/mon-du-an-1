<?php
session_start();
require_once __DIR__ . "/env.php";
require_once __DIR__ . "/common/function.php";

// Tải các file Model
require_once __DIR__ . "/models/BaseModel.php";
require_once __DIR__ . "/models/Category.php";
require_once __DIR__ . "/models/Product.php";
require_once __DIR__ . "/models/User.php";
require_once __DIR__ . "/models/Order.php";
require_once __DIR__ . "/models/News.php";

// Tải các file Controller
require_once __DIR__ . "/controllers/HomeControllers.php";
require_once __DIR__ . "/controllers/ProductController.php";
require_once __DIR__ . "/controllers/AuthControllers.php";
require_once __DIR__ . "/controllers/CartController.php";
require_once __DIR__ . "/controllers/OrderController.php";

// Lấy tham số ctl từ URL, mặc định là 'home'
$ctl = $_GET['ctl'] ?? 'home';

match ($ctl) {
    // --- Trang chính, Giới thiệu & Tin tức ---
    'home'              => (new HomeController)->index(),
    'infor'             => (new HomeController)->infor(),
    'news'              => (new HomeController)->listNews(),
    'news-detail'       => (new HomeController)->newsDetail(),

    // --- Sản phẩm & Tìm kiếm ---
    'all-products'      => (new ProductController)->allProducts(),
    'category'          => (new ProductController)->list(),
    'detail'            => (new ProductController)->show(),
    'search'            => (new ProductController)->search(),

    // --- Xác thực & Người dùng ---
    'register'          => (new AuthControllers)->register(),
    'login'             => (new AuthControllers)->login(),
    'logout'            => (new AuthControllers)->logout(),
    'profile'           => (new HomeController)->profile(),
    'edit-profile'      => (new AuthControllers)->updateProfile(),
    'change-password'   => (new AuthControllers)->changePassword(),

    // --- Giỏ hàng & Thanh toán ---
    'add-cart'          => (new CartController)->addToCart(),
    'view-cart'         => (new CartController)->viewCart(),
    'delete-cart'       => (new CartController)->deleteProductInCart(),
    'update-cart'       => (new CartController)->updateCart(),
    'view-checkout'     => (new CartController)->viewCheckout(),
    'checkout'          => (new CartController)->checkout(),
    'success'           => (new CartController)->success(),

    // --- Lịch sử Đơn hàng của người dùng ---
    'order-history'     => (new HomeController)->orderHistory(),
    'order-detail'      => (new HomeController)->orderDetail(),
    'cancel-order'      => (new HomeController)->cancelOrder(),
    
    // --- Mặc định: Hiển thị trang 404 nếu không tìm thấy route ---
    default             => include_once __DIR__ . '/404.php',
};