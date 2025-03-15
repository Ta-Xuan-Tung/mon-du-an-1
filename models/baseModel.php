<?php
// class baseModel chứa thông tin kết nối
class baseModel{
    //biên $conn lưu trữ thông tin kết nối
    public $conn = null;
    //hàm khởi tạo
    public function _construct(){
        try {
            $this->conn = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME . "; charset = utf8; port=" . PROT, USERNAME, PASSWORD);
        } catch (PDOException $e) {
            echo "loi ket noi du lieu" . $e->getMessage();
        }
    }
}