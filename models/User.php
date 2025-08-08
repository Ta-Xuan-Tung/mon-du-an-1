<?php

class User extends BaseModel {

    // Lấy tất cả người dùng (cho trang admin)
    public function all() {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm một người dùng theo ID
    public function find($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tìm người dùng theo email (dùng để kiểm tra khi đăng nhập/đăng ký)
    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Thêm người dùng mới (đăng ký)
    public function create($data) {
        $sql = "INSERT INTO users (fullname, email, password, phone, address, role, active) 
                VALUES (:fullname, :email, :password, :phone, :address, :role, :active)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // Cập nhật thông tin cá nhân (profile)
    public function update($id, $data) {
        unset($data['id']); 
        
        $setClauses = [];
        foreach (array_keys($data) as $key) {
            $setClauses[] = "$key = :$key";
        }
        $sql = "UPDATE users SET " . implode(', ', $setClauses) . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
    }

    // Cập nhật trạng thái (active/inactive) của người dùng
    public function updateStatus($id, $status) {
        $sql = "UPDATE users SET active = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'status' => $status]);
    }
    
    /**
     * Đếm tổng số người dùng (HÀM BẠN ĐANG THIẾU LÀ HÀM NÀY)
     */
    public function count() {
        $sql = "SELECT COUNT(id) as total FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Xóa người dùng (chức năng này cần cẩn trọng khi dùng)
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}