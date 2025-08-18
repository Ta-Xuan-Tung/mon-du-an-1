<?php

class DashboardController {
    public function __construct() {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            return header('location: ' . ROOT_URL);
        }
    }

    /**
     * Hiển thị trang Dashboard (PHIÊN BẢN ĐÚNG CHUẨN)
     */
    public function index() {
        // 1. Controller đi thu thập tất cả thông tin cần thiết
        $totalUsers    = (new User)->count();
        $totalProducts = (new Product)->count();
        $totalOrders   = (new Order)->count();
        $totalRevenue  = (new Order)->sumRevenue();

        // 2. Gói tất cả thông tin vào một "tờ giấy" (biến $stats)
        $stats = [
            'users'    => $totalUsers,
            'products' => $totalProducts,
            'orders'   => $totalOrders,
            'revenue'  => $totalRevenue
        ];
        
        // 3. Đưa "tờ giấy" ra cho View
        return view('admin.dashboard', compact('stats'));
    }
}