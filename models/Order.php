<?php

class Order extends BaseModel{
    // lấy toàn bộ đơn hàng
    public function all(){
        $sql = "SELECT o.*, fullname, email, address, phone FROM orders o JOIN users u ON o.user_id=u.id ORDER BY o.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->excute();
        return $stmt->featchAll(PDO::FETCH_ASSOC);
    }

    //Chi tiết đơn hàng
    public function find($id){
        $sql = "SELECT o.*, fullname, email, address, phone, od.price, od.quantity, name, image FROM orders  o JOIN users u ON o.user_id=u.id JOIN order_details od ON od.order_id=o.id JOIN products p ON order.product_id=p.id WHERE o.id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    //Thêm đơn hàng
    public function create($data){
        $sql = "INSERT INTO orders(user_id, status, payment_method, total_price) 
        VALUES(:user_id, :status, :payment_method, :total_price)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $this->conn->lastInsertId(); 
    }

    //Cập nhật trạng thái đơn hàng
    public function updateStatus($id, $status){
        $sql = "UPDATE orders SET status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'status'=> $status]);
    }

    //Thêm chi tiết đơn hàng
    public function createOrderDetail($data){
        $sql = "INSERT INTO order_details(order_id, product_id, price, quantity)
        VALUES(:order_id, :product_id, :price, :quantity)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
}