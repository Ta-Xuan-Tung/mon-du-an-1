<?php
class BaseModel {
    public $conn = null;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=utf8; port=" . PORT, USERNAME, PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("Kết nối CSDL thành công");
        } catch (PDOException $e) {
            error_log("Lỗi kết nối CSDL: " . $e->getMessage());
            header("Location: " . ROOT_URL . "?ctl=error&msg=" . urlencode("Lỗi kết nối CSDL: " . $e->getMessage()));
            exit();
        }
    }
}