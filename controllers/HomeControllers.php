<?php

class HomeController {
    
    /**
     * Hiển thị trang chủ
     */
    public function index() {
        $product = new Product;
        
        $nikes = $product->listProductInCategoryHome(1);
        $adidass = $product->listProductInCategoryHome(2);
        $mlbs = $product->listProductInCategoryHome(3); 

        $title = 'Trang chủ | Website bán giày';
        $categories = (new Category)->all();

        return view('clients.home', compact('nikes', 'adidass', 'mlbs', 'title', 'categories'));
    }

    /**
     * Hiển thị trang giới thiệu
     */
    public function infor() {
        $title = 'Giới thiệu';
        $categories = (new Category)->all();
        return view('clients.infor', compact('title', 'categories'));
    }

    /**
     * Hiển thị trang thông tin cá nhân (profile)
     */
    public function profile() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . ROOT_URL . '?ctl=login');
            die;
        }
        $title = 'Thông tin cá nhân';
        $categories = (new Category)->all();
        $message = session_flash('message');
        return view('clients.users.profile', compact('title', 'categories', 'message'));
    }

    /**
     * Hiển thị lịch sử đơn hàng của người dùng
     * ĐÃ SỬA: Bổ sung lại $categories để không lỗi header
     */
    public function orderHistory() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . ROOT_URL . '?ctl=login');
            die;
        }

        $categories = (new Category)->all(); // Lấy danh mục cho header
        $user_id = $_SESSION['user']['id'];
        $orders = (new Order)->getOrdersByUserId($user_id);
        $title = 'Lịch sử đơn hàng';

        // Gửi cả $categories ra view
        return view('clients.orders.history', compact('orders', 'title', 'categories'));
    }
    
    /**
     * Hiển thị chi tiết một đơn hàng cho người dùng
     * ĐÃ SỬA: Bổ sung lại $categories để không lỗi header
     */
    public function orderDetail() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . ROOT_URL . '?ctl=login');
            die;
        }

        $categories = (new Category)->all(); // Lấy danh mục cho header
        $order_id = $_GET['id'];
        $user_id = $_SESSION['user']['id'];
        
        $orderModel = new Order();
        $order = $orderModel->find($order_id);

        // Kiểm tra bảo mật
        if (!$order || $order['user_id'] != $user_id) {
            header('Location: ' . ROOT_URL . '?ctl=order-history');
            die;
        }

        $order_details = $orderModel->listOrderDetail($order_id);
        $title = 'Chi tiết đơn hàng #' . $order_id;
        
        // Gửi cả $categories ra view
        return view('clients.orders.detail', compact('order', 'order_details', 'title', 'categories'));
    }
    
    /**
     * Xử lý hủy đơn hàng từ phía người dùng
     */
    public function cancelOrder() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . ROOT_URL . '?ctl=login');
            die;
        }

        $order_id = $_GET['id'];
        $user_id = $_SESSION['user']['id'];
        
        $orderModel = new Order();
        $order = $orderModel->find($order_id);

        // Kiểm tra bảo mật
        if (!$order || $order['user_id'] != $user_id || $order['status'] != 1) {
            header('Location: ' . ROOT_URL . '?ctl=order-history');
            die;
        }

        // Cập nhật trạng thái
        $orderModel->updateStatus($order_id, 4); 

        // Chuyển hướng
        header('Location: ' . ROOT_URL . '?ctl=order-history');
        die;
    }
     public function listNews() {
        $newsModel = new News();
        $newsList = $newsModel->all();
        $categories = (new Category)->all();

        return view('clients.news.list', [
            'newsList' => $newsList,
            'categories' => $categories
        ]);
    }

    /**
     * Hiển thị chi tiết một bài viết
     */
    public function newsDetail() {
        $id = $_GET['id'];
        $newsModel = new News();
        $news = $newsModel->find($id);
        $categories = (new Category)->all();

        return view('clients.news.detail', [
            'news' => $news,
            'categories' => $categories
        ]);
    }
}