<?php

class AdminUserController {

    public function __construct() {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            header('location: '.ROOT_URL);
            die;
        }
    }

    // Hiển thị danh sách người dùng
    public function index() {
        $users = (new User)->all();
        $message = session_flash('message');
        return view('admin.users.list', compact('users', 'message'));
    }

    // Cập nhật trạng thái (active/inactive) của người dùng
    public function updateStatus() {
        $id = $_GET['id'];
        $status = $_GET['status'];

        (new User)->updateStatus($id, $status);

        $_SESSION['message'] = "Cập nhật trạng thái người dùng thành công!";
        header('location: '.ADMIN_URL.'?ctl=user-list');
        die;
    }
}