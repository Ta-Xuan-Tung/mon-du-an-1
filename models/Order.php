<?php

class Order extends BaseModel {

    public $status_details = [
        1 => 'Đang chờ xử lý',
        2 => 'Đang giao hàng',
        3 => 'Đã giao hàng',
        4 => 'Đã hủy',
    ];

    // Lấy tất cả đơn hàng (cho trang admin)
    public function all() {
        $sql = "SELECT o.*, u.fullname, u.email, u.phone, u.address
                FROM orders o 
                LEFT JOIN users u ON o.user_id = u.id 
                ORDER BY o.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm một đơn hàng theo ID
    public function find($id) {
        $sql = "SELECT o.*, u.fullname, u.email, u.phone, u.address
                FROM orders o 
                LEFT JOIN users u ON o.user_id = u.id 
                WHERE o.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả đơn hàng của một người dùng cụ thể
    public function getOrdersByUserId($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Lấy danh sách sản phẩm trong một đơn hàng
    public function listOrderDetail($id) {
        $sql = "SELECT od.*, p.name, p.image
                FROM order_details od 
                JOIN products p ON od.product_id = p.id
                WHERE od.order_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm đơn hàng mới
    public function create($data) {
        $sql = "INSERT INTO orders(user_id, status, payment_method, total_price) 
                VALUES(:user_id, :status, :payment_method, :total_price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    // Thêm chi tiết đơn hàng
    public function createOrderDetail($data) {
        $sql = "INSERT INTO order_details(order_id, product_id, price, quantity, size)
                VALUES(:order_id, :product_id, :price, :quantity, :size)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus($id, $status) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'status' => $status]);
    }

    // Đếm tổng số đơn hàng
    public function count() {
        $sql = "SELECT COUNT(id) as total FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Lấy đơn hàng theo từng trang (cho admin)
    public function listByPage($page, $perPage) {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT o.*, u.fullname, u.email, u.phone, u.address
                FROM orders o 
                LEFT JOIN users u ON o.user_id = u.id 
                ORDER BY o.id DESC 
                LIMIT :perPage OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Tính tổng doanh thu từ các đơn hàng đã hoàn thành (HÀM BẠN ĐANG THIẾU)
     */
    public function sumRevenue() {
        // Chỉ tính tổng tiền của các đơn hàng có status = 3 (Đã giao hàng)
        $sql = "SELECT SUM(total_price) as revenue FROM orders WHERE status = 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        // Dùng ?? 0 để nếu không có đơn nào hoàn thành thì trả về 0
        return $stmt->fetch(PDO::FETCH_ASSOC)['revenue'] ?? 0;
    }
}