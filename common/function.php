<?php

//hàm view dùng để render view
function view($path_view) {
    // thay thế dấu . thành dấu /
    $path_view = str_replace(".", "/", $path_view);
    // include
    include_once ROOT_DIR . "view/$path_view.php";
}

//Hàm dung để debug
function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}