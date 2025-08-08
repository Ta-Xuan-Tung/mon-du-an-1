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
        $message = session_flash('message');
        return view('admin.categories.list', compact('categories', 'message'));
    }

    /**
     * Hiển thị form thêm mới danh mục
     */
    public function create() {
        return view('admin.categories.add');
    }

    /**
     * Lưu dữ liệu từ form thêm mới vào CSDL
     */
    public function store() {
        $data = $_POST;
        (new Category)->create($data);

        $_SESSION['message'] = "Thêm danh mục thành công";
        // SỬA LẠI: Chuyển hướng về trang danh sách danh mục
        header("location: " . ADMIN_URL . "?ctl=category-list");
        die;
    }

    /**
     * Hiển thị form sửa danh mục
     */
    public function edit() {
        $id = $_GET['id'];
        $category = (new Category)->find($id);
        $message = session_flash('message');
        return view('admin.categories.edit', compact('category', 'message'));
    }

    /**
     * Cập nhật dữ liệu từ form sửa vào CSDL
     */
    public function update() {
        $data = $_POST;
        (new Category)->update($data['id'], $data);
        
        $_SESSION['message'] = "Cập nhật dữ liệu thành công";
        // SỬA LẠI: Chuyển hướng về trang danh sách danh mục sau khi sửa
        header("location: " . ADMIN_URL . '?ctl=category-list');
        die;
    }

    /**
     * Xóa danh mục
     */
    public function delete() {
        $id = $_GET['id'];
        
        // Kiểm tra xem có sản phẩm nào thuộc danh mục này không
        $products = (new Product)->listProductInCategory($id);

        if ($products) {
            $_SESSION['message'] = "Không thể xóa vì danh mục đang chứa sản phẩm.";
        } else {
            // Nếu không có sản phẩm nào, tiến hành xóa
            (new Category)->delete($id);
            $_SESSION['message'] = "Xóa danh mục thành công";
        }

        // SỬA LẠI: Chuyển hướng về trang danh sách danh mục trong mọi trường hợp
        header("location: " . ADMIN_URL . "?ctl=category-list");
        die;
    }
}