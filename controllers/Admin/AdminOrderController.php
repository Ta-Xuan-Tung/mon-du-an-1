<?php

class AdminOrderController {

    public function __construct() {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            header('location: '.ROOT_URL);
            die;
        }
    }

    /**
     * Hiển thị danh sách đơn hàng (có phân trang)
     */
    public function index() {
        $page = $_GET['page'] ?? 1;
        $perPage = 5; // Bạn có thể thay đổi số đơn hàng mỗi trang ở đây
        $orderModel = new Order();
        $totalOrders = $orderModel->count();
        $totalPages = ceil($totalOrders / $perPage);
        $orders = $orderModel->listByPage($page, $perPage);
        $message = session_flash('message');
        
        return view('admin.orders.list', compact('orders', 'message', 'totalPages', 'page'));
    }

    /**
     * Hiển thị chi tiết một đơn hàng
     */
    public function show() {
        $id = $_GET['id'];
        $orderModel = new Order();

        $order = $orderModel->find($id);
        $order_details = $orderModel->listOrderDetail($id);
        $status_list = $orderModel->status_details;

        // **SỬA LỖI Ở ĐÂY: Thêm dòng này để lấy thông báo từ session**
        $message = session_flash('message');

        // Truyền biến $message ra view
        return view('admin.orders.detail', compact('order', 'order_details', 'status_list', 'message'));
    }

    /**
     * Cập nhật trạng thái một đơn hàng
     */
    public function updateStatus() {
        $id = $_GET['id'];
        $status = $_POST['status'];

        (new Order)->updateStatus($id, $status);
        
        // Dòng này lưu thông báo vào session
        $_SESSION['message'] = "Cập nhật trạng thái đơn hàng thành công!";

        // Chuyển hướng về trang chi tiết để hàm show() có thể lấy thông báo ra
        header('location: '.ADMIN_URL.'?ctl=order-detail&id='.$id);
        die;
    }
}