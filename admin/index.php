<?php

session_start();
require_once __DIR__ . "/../env.php";
require_once __DIR__ . "/../common/function.php";

//models
require_once __DIR__ . "/../models/BaseModel.php";
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Product.php";

//controllers
require_once __DIR__ . "/../controllers/Admin/DashboardController.php";
require_once __DIR__ . "/../controllers/Admin/AdminCategoryController.php";

// lay bien ctl lam dieu khien
$ctl = $_GET['ctl'] ?? '';

match ($ctl) {
    '' => (new DashboardController)->index(),
    'listdm' =>(new AdminCategoryController)->index(),
    'adddm'=> (new AdminCategoryController)->create(),
    'storedm' =>(new AdminCategoryController)->store(),
    'editdm' => (new AdminCategoryController)->edit(),
    'updatedm' => (new AdminCategoryController)->update(),
    'deletedm' => (new AdminCategoryController)->delete(),
};
