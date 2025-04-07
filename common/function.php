<?php

//hàm view dùng để render view
function view($path_view, $data=[]) {
    // thay thế dấu . thành dấu /
    extract($data);
    $path_view = str_replace(".", "/", $path_view);
    // include
    include_once ROOT_DIR . "views/$path_view.php";
};
//Hàm dung để debug
function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

//Hàm session_flass, sẽ hủy session ngay lập tức
function session_flash($key){
    $message = $_SESSION[$key] ?? '';
    unset($_SESSION[$key]);
    return $message;
}

// chuyển đổi trạng thái đơn hàng
function getOrderStatus($status){
    $status_details = [
        1 => 'Đang chờ xử lý',
        2 => 'Đang giao hàng',
        3 => 'Đã giao hàng',
        4 => 'Đã hủy',
    ];
    return $status_details[$status];
}