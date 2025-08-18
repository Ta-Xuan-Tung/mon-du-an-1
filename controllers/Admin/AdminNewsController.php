<?php

class AdminNewsController {
    /**
     * Hiển thị danh sách tin tức (ĐÃ THÊM PHÂN TRANG)
     */
    public function index() {
        $page = $_GET['page'] ?? 1;
        if ($page < 1) $page = 1;

        // Đặt số lượng bài viết trên mỗi trang
        $perPage = 5; 

        $newsModel = new News();
        $totalNews = $newsModel->count();
        $totalPages = ceil($totalNews / $perPage);

        // Lấy đúng số bài viết cho trang hiện tại
        $newsList = $newsModel->listByPage($page, $perPage);
        
        $message_success = session_flash('message_success');
        
        // Gửi các biến phân trang ra view
        return view('admin.news.list', compact('newsList', 'message_success', 'totalPages', 'page'));
    }


    // Hiển thị form thêm mới
    public function create() {
        return view('admin.news.create');
    }

    // Lưu dữ liệu từ form thêm mới (ĐÃ SỬA CHUYỂN HƯỚỚNG)
    public function store() {
        $hinh = save_file('image', 'images/');
        $data = [
            'title' => $_POST['title'],
            'image' => $hinh,
            'content' => $_POST['content'],
        ];
        (new News)->create($data);
        $_SESSION['message_success'] = "Thêm bài viết thành công";
        // Sửa lại link ở đây
        header("Location: " . ADMIN_URL . "?ctl=news-list"); 
        die;
    }

    // Hiển thị form sửa
    public function edit() {
        $id = $_GET['id'];
        $news = (new News)->find($id);
        return view('admin.news.edit', compact('news'));
    }

    // Cập nhật dữ liệu từ form sửa (ĐÃ SỬA CHUYỂN HƯỚỚNG)
    public function update() {
        $id = $_POST['id'];
        $news = (new News)->find($id);
        $hinh = $news['image'];

        if (!empty($_FILES['image']['name'])) {
            $hinh = save_file('image', 'images/');
        }

        $data = [
            'title' => $_POST['title'],
            'image' => $hinh,
            'content' => $_POST['content'],
        ];
        (new News)->update($id, $data);
        $_SESSION['message_success'] = "Cập nhật bài viết thành công";
        // Sửa lại link ở đây
        header("Location: " . ADMIN_URL . "?ctl=news-list"); 
        die;
    }

    // Xóa bài viết (ĐÃ SỬA CHUYỂN HƯỚỚNG)
    public function delete() {
        $id = $_GET['id'];
        (new News)->delete($id);
        $_SESSION['message_success'] = "Xóa bài viết thành công";
        // Sửa lại link ở đây
        header('Location: ' . ADMIN_URL . '?ctl=news-list'); 
        die;
    }

}