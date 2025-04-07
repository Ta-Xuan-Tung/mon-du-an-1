<?php

session_start();
require_once __DIR__ . "/env.php";
require_once __DIR__ . "/common/function.php";

//models 
require_once __DIR__ . "/models/BaseModel.php";
require_once __DIR__ . "/models/Category.php";
require_once __DIR__ . "/models/Product.php";
require_once __DIR__ . "/models/User.php";

//controllers 
require_once __DIR__ . "/controllers/HomeControllers.php";
require_once __DIR__ . "/controllers/ProductController.php";
require_once __DIR__ . "/controllers/AuthControllers.php";
require_once __DIR__ . "/controllers/CartController.php";


$ctl = $_GET['ctl'] ?? '';

match ($ctl) {
    ''          => (new HomeController)->index(),
    'category' => (new ProductController)->list(),
    'detail'  => (new ProductController)->show(),
    'register' => (new AuthControllers)->register(),
    'login' => (new AuthControllers)->login(),
    'logout' => (new AuthControllers)->logout(),
    'add-cart'=> (new CartController)->addToCart(),
    'view-cart'=> (new CartController)->viewCart(),
    'delete-cart'=> (new CartController)->deleteProductInCart(),
    'update-cart' => (new CartController)->updateCart(),
    'checkout'=> (new CartController)->viewCheckout(),
};