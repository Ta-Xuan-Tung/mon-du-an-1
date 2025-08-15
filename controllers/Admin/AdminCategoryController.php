<?php

class AdminCategoryController {
    
    public function __construct() {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            header('location: ' . ROOT_URL);
            die;
        }
    }

    /**
     * Hiển thị danh sách danh mục
     */
    public function index() {
        $categories = (new Category)->all();
        // Sửa lại để view có thể nhận cả 2 loại message
        $message_success = session_flash('message_success');
        $message_error = session_flash('message_error');
        return view('admin.categories.list', compact('categories', 'message_success', 'message_error'));
    }

    /**
     * Hiển thị form thêm mới
     */
    public function create() {
        return view('admin.categories.add');
    }

    /**
     * Lưu dữ liệu mới
     */
    public function store() {
        $data = $_POST;
        (new Category)->create($data);

        $_SESSION['message_success'] = "Thêm danh mục thành công";
        // Sửa lại route cho đúng
        header("location: " . ADMIN_URL . "?ctl=category-list");
        die;
    }

    /**
     * Hiển thị form sửa
     */
    public function edit() {
        $id = $_GET['id'];
        $category = (new Category)->find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Cập nhật dữ liệu
     */
    public function update() {
        $data = $_POST;
        (new Category)->update($data['id'], $data);
        
        $_SESSION['message_success'] = "Cập nhật dữ liệu thành công";
        // Sửa lại route cho đúng
        header("location: " . ADMIN_URL . '?ctl=category-list');
        die;
    }

    /**
     * Xử lý xóa danh mục (Đã hoàn thiện)
     */
    public function delete() {
        $id = $_GET['id'];
        $categoryModel = new Category();

        // Đếm TẤT CẢ sản phẩm (không phân biệt status)
        $productCount = $categoryModel->countProducts($id);

        if ($productCount > 0) {
            // SỬA LỖI Ở ĐÂY: Dùng message_error cho thông báo lỗi (màu đỏ)
            $_SESSION['message_error'] = "Không thể xóa! Danh mục này vẫn còn ($productCount) sản phẩm.";
        } else {
            // Dùng message_success cho thông báo thành công (màu xanh)
            $categoryModel->delete($id);
            $_SESSION['message_success'] = 'Xóa danh mục thành công!';
        }
        
        // SỬA LỖI Ở ĐÂY: Chuyển hướng về trang danh sách đúng
        header('Location: ' . ADMIN_URL . '?ctl=category-list');
        die;
    }
}