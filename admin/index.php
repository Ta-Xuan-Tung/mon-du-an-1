<?php

session_start();
require_once __DIR__ . "/../env.php";
require_once __DIR__ . "/../common/function.php";

// --- Tải các file Model cần thiết ---
require_once __DIR__ . "/../models/BaseModel.php";
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Order.php";
require_once __DIR__ . "/../models/News.php"; // Thêm Model Tin tức

// --- Tải các file Controller cho trang Admin ---
require_once __DIR__ . "/../controllers/Admin/DashboardController.php";
require_once __DIR__ . "/../controllers/Admin/AdminCategoryController.php";
require_once __DIR__ . "/../controllers/Admin/AdminProductController.php";
require_once __DIR__ . "/../controllers/Admin/AdminUserController.php"; 
require_once __DIR__ . "/../controllers/Admin/AdminOrderController.php"; 
require_once __DIR__ . "/../controllers/Admin/AdminNewsController.php"; // Thêm Controller Tin tức

// Lấy biến ctl làm điều khiển
$ctl = $_GET['ctl'] ?? '';

match ($ctl) {
    // --- Dashboard ---
    '' => (new DashboardController)->index(),

    // --- Quản lý Danh mục ---
    'category-list'   => (new AdminCategoryController)->index(),
    'category-create' => (new AdminCategoryController)->create(),
    'category-store'  => (new AdminCategoryController)->store(),
    'category-edit'   => (new AdminCategoryController)->edit(),
    'category-update' => (new AdminCategoryController)->update(),
    'category-delete' => (new AdminCategoryController)->delete(),

    // --- Quản lý Sản phẩm ---
    'product-list'    => (new AdminProductController)->index(),
    'product-create'  => (new AdminProductController)->create(),
    'product-store'   => (new AdminProductController)->store(),
    'product-edit'    => (new AdminProductController)->edit(),
    'product-update'  => (new AdminProductController)->update(),
    'product-delete'  => (new AdminProductController)->delete(),

    // --- Quản lý Người dùng ---
    'user-list'          => (new AdminUserController)->index(),
    'user-update-status' => (new AdminUserController)->updateStatus(),

    // --- Quản lý Đơn hàng ---
    'order-list'          => (new AdminOrderController)->index(),
    'order-detail'        => (new AdminOrderController)->show(),
    'order-update-status' => (new AdminOrderController)->updateStatus(),

    // --- THÊM MỚI: Quản lý Tin tức ---
    'news-list'       => (new AdminNewsController)->index(),
    'news-create'     => (new AdminNewsController)->create(),
    'news-store'      => (new AdminNewsController)->store(),
    'news-edit'       => (new AdminNewsController)->edit(),
    'news-update'     => (new AdminNewsController)->update(),
    'news-delete'     => (new AdminNewsController)->delete(),

    // Mặc định, nếu route không tồn tại, quay về trang dashboard
    default => (new DashboardController)->index(),
};