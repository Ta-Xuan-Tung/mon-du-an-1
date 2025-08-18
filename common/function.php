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

/**
 * **HÀM BỊ THIẾU ĐÃ ĐƯỢỢC BỔ SUNG**
 *
 * Hàm xử lý việc upload file lên server.
 *
 * @param string $ten_file_input Tên của thẻ <input type="file"> trong form.
 * @param string $thu_muc_luu    Đường dẫn đến thư mục sẽ lưu file.
 * @return string Đường dẫn tương đối đến file đã lưu, hoặc chuỗi rỗng nếu có lỗi.
 */
function save_file($ten_file_input, $thu_muc_luu) {
    // Kiểm tra xem file có được tải lên không và có lỗi không
    if (!isset($_FILES[$ten_file_input]) || $_FILES[$ten_file_input]['error'] != UPLOAD_ERR_OK) {
        return '';
    }

    $file_tai_len = $_FILES[$ten_file_input];

    // Chỉ xử lý nếu file có dung lượng lớn hơn 0
    if ($file_tai_len['size'] > 0) {
        $ten_file = basename($file_tai_len['name']);
        $duong_dan_day_du = ROOT_DIR . $thu_muc_luu . $ten_file;
        
        // Di chuyển file từ thư mục tạm vào thư mục lưu trữ chính
        if (move_uploaded_file($file_tai_len['tmp_name'], $duong_dan_day_du)) {
            // Trả về đường dẫn tương đối để lưu vào database
            return $thu_muc_luu . $ten_file;
        }
    }
    
    return ''; // Trả về chuỗi rỗng nếu có lỗi hoặc không có file
}