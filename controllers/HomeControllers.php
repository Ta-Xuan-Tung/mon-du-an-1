<?php
    class HomeController {
        
        /**
         * Hiển thị trang chủ
         */
        public function index() {
            $product = new Product;
            
            // Lấy sản phẩm cho từng danh mục
            $nikes = $product->listProductInCategoryHome(1);
            $adidass = $product->listProductInCategoryHome(2);

            // ĐÃ THÊM: Lấy sản phẩm cho danh mục MLB (giả sử ID là 3)
            $mlbs = $product->listProductInCategoryHome(3); 

            $title = 'Trang chủ | Website bán giày';
            $categories = (new Category)->all();

            // ĐÃ THÊM: Truyền biến $mlbs ra view
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
         */
        public function orderHistory() {
            if (!isset($_SESSION['user'])) {
                header('Location: ' . ROOT_URL . '?ctl=login');
                die;
            }
            $user_id = $_SESSION['user']['id'];
            $orders = (new Order)->getOrdersByUserId($user_id);
            $title = 'Lịch sử đơn hàng';
            return view('clients.orders.history', compact('orders', 'title'));
        }
        
        /**
         * Hiển thị chi tiết một đơn hàng cho người dùng
         */
        public function orderDetail() {
            if (!isset($_SESSION['user'])) {
                header('Location: ' . ROOT_URL . '?ctl=login');
                die;
            }

            $order_id = $_GET['id'];
            $user_id = $_SESSION['user']['id'];
            
            $orderModel = new Order();
            $order = $orderModel->find($order_id);

            // Kiểm tra bảo mật: Đảm bảo người dùng chỉ xem đơn hàng của chính mình
            if (!$order || $order['user_id'] != $user_id) {
                header('Location: ' . ROOT_URL . '?ctl=order-history');
                die;
            }

            $order_details = $orderModel->listOrderDetail($order_id);
            $title = 'Chi tiết đơn hàng #' . $order_id;
            
            return view('clients.orders.detail', compact('order', 'order_details', 'title'));
        }
    }
?>