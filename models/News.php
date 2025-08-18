<?php

class News extends BaseModel {
    // Lấy tất cả tin tức, sắp xếp mới nhất lên đầu
    public function all() {
        $sql = "SELECT * FROM news ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm một tin tức theo ID
    public function find($id) {
        $sql = "SELECT * FROM news WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
     /**
     * THÊM HÀM MỚI: Thêm bài viết mới
     */
    public function create($data) {
        $sql = "INSERT INTO news (title, image, content) 
                VALUES (:title, :image, :content)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    /**
     * THÊM HÀM MỚI: Cập nhật bài viết
     */
    public function update($id, $data) {
        $setClauses = [];
        foreach (array_keys($data) as $key) {
            $setClauses[] = "$key = :$key";
        }
        $sql = "UPDATE news SET " . implode(', ', $setClauses) . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id;
        $stmt->execute($data);
    }

    /**
     * THÊM HÀM MỚI: Xóa bài viết
     */
    public function delete($id) {
        $sql = "DELETE FROM news WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
     /**
     * THÊM HÀM MỚI: Đếm tổng số bài viết để phân trang
     */
    public function count() {
        $sql = "SELECT COUNT(*) as total FROM news";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * THÊM HÀM MỚI: Lấy bài viết theo từng trang
     */
    public function listByPage($page, $perPage) {
        $offset = ($page - 1) * $perPage;
        
        $sql = "SELECT * FROM news 
                ORDER BY id DESC 
                LIMIT :perPage OFFSET :offset";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}