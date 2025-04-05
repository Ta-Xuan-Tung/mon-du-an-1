<?php

session_start();
require_once __DIR__ . "/../env.php";
require_once __DIR__ . "/../common/function.php";

//models
require_once __DIR__ . "/../models/BaseModel.php";
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/User.php";

//controllers
require_once __DIR__ . "/../controllers/Admin/DashboardController.php";
require_once __DIR__ . "/../controllers/Admin/AdminCategoryController.php";
require_once __DIR__ . "/../controllers/Admin/AdminProductController.php";
require_once __DIR__ . "/../controllers/AuthControllers.php";


// lay bien ctl lam dieu khien
$ctl = $_GET['ctl'] ?? '';

match ($ctl) {
    '' => (new DashboardController)->index(),
    //Danh mục
    'listdm' =>(new AdminCategoryController)->index(),
    'adddm'=> (new AdminCategoryController)->create(),
    'storedm' =>(new AdminCategoryController)->store(),
    'editdm' => (new AdminCategoryController)->edit(),
    'updatedm' => (new AdminCategoryController)->update(),
    'deletedm' => (new AdminCategoryController)->delete(),

    //Sản phẩm
    'listsp' =>(new AdminProductController)->index(),
    'addsp'=> (new AdminProductController)->create(),
    'storesp' =>(new AdminProductController)->store(),
    'editsp' => (new AdminProductController)->edit(),
    'updatesp' => (new AdminProductController)->update(),
    'deletesp' => (new AdminProductController)->delete(),

    //quản lý người dùng
    'listuser' => (new AuthControllers)->index(),
    'updateuser' => (new AuthControllers)->updateActive(),
};
