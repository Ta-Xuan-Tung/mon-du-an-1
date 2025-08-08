<?php

/**
 * Hàm view dùng để render (hiển thị) các file giao diện.
 *
 * @param string $path_view Đường dẫn đến file view, dùng dấu chấm để ngăn cách thư mục. Ví dụ: 'clients.home'
 * @param array  $data      Một mảng chứa dữ liệu cần truyền ra view.
 */
function view($path_view, $data = []) {
    // Chuyển các key của mảng $data thành các biến riêng biệt
    extract($data);
    
    // Thay thế dấu '.' trong đường dẫn thành dấu '/' để khớp với cấu trúc thư mục
    $path_view = str_replace(".", "/", $path_view);
    
    // Nạp file view
    include_once ROOT_DIR . "views/$path_view.php";
}

/**
 * Hàm debug, dùng để in ra dữ liệu của một biến một cách dễ nhìn.
 *
 * @param mixed $data Dữ liệu bất kỳ cần kiểm tra.
 */
function dd($data) {
    echo "<pre>";
    var_dump($data);
    die; // Dừng chương trình ngay sau khi in để dễ kiểm tra
}

/**
 * Hàm "flash session", dùng để lấy một giá trị từ session và xóa nó ngay lập tức.
 * Thường dùng để hiển thị các thông báo chỉ một lần.
 *
 * @param string $key Key của session cần lấy.
 * @return mixed Giá trị của session hoặc chuỗi rỗng nếu không tồn tại.
 */
function session_flash($key) {
    $message = $_SESSION[$key] ?? '';
    unset($_SESSION[$key]);
    return $message;
}

/*
 * GHI CHÚ: Hàm getOrderStatus($status) đã được loại bỏ.
 *
 * Lý do: Logic để chuyển đổi trạng thái đơn hàng đã được định nghĩa trong mảng
 * $status_details của class Order (trong file models/Order.php).
 *
 * Để lấy tên trạng thái, hãy dùng: (new Order)->status_details[$status]
 *
 * Việc này giúp tránh lặp lại code và đảm bảo logic được quản lý ở một nơi duy nhất.
 */