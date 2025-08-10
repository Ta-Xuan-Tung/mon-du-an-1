<?php

session_start();
require_once __DIR__ . "/env.php";
require_once __DIR__ . "/common/function.php";

//models 
require_once __DIR__ . "/models/BaseModel.php";
require_once __DIR__ . "/models/Category.php";
require_once __DIR__ . "/models/Product.php";
require_once __DIR__ . "/models/User.php";
require_once __DIR__ . "/models/Order.php";

//controllers 
require_once __DIR__ . "/controllers/HomeControllers.php";
require_once __DIR__ . "/controllers/ProductController.php";
require_once __DIR__ . "/controllers/AuthControllers.php";
require_once __DIR__ . "/controllers/CartController.php";
// Bỏ require_once OrderController.php vì nó không còn được dùng trực tiếp ở đây

// Lấy tham số ctl từ URL, mặc định là rỗng
$ctl = $_GET['ctl'] ?? '';

match ($ctl) {
    // --- Trang chính ---
    ''             => (new HomeController)->index(),
    'infor'        => (new HomeController)->infor(),

    // --- Sản phẩm ---
    'category'     => (new ProductController)->list(),
    'detail'       => (new ProductController)->show(),

    // --- Xác thực ---
    'register'     => (new AuthControllers)->register(),
    'login'        => (new AuthControllers)->login(),
    'logout'       => (new AuthControllers)->logout(),
    'profile'      => (new HomeController)->profile(),
    'edit-profile' => (new AuthControllers)->updateProfile(),

    // --- Giỏ hàng & Thanh toán ---
    'add-cart'     => (new CartController)->addToCart(),
    'view-cart'    => (new CartController)->viewCart(),
    'delete-cart'  => (new CartController)->deleteProductInCart(),
    'update-cart'  => (new CartController)->updateCart(),
    'view-checkout'=> (new CartController)->viewCheckout(),
    'checkout'     => (new CartController)->checkout(),
    'success'      => (new CartController)->success(),

    // --- Đơn hàng của người dùng (ĐÃ THÊM) ---
    'order-history' => (new HomeController)->orderHistory(),
    'order-detail'  => (new HomeController)->orderDetail(),
    
    // **THÊM DÒNG NÀY VÀO**
    'search'       => (new ProductController)->search(),

    'register'     => (new AuthControllers)->register(),
    // ...
    // **THÊM DÒNG NÀY VÀO**
    'all-products' => (new ProductController)->allProducts(),

    'register'     => (new AuthControllers)->register(),
    // ...
    // --- Mặc định ---
    default        => (new HomeController)->index(),
};