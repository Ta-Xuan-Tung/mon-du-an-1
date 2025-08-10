<?php

class Product extends BaseModel {

    // Lấy tất cả sản phẩm (cho trang admin)
    public function all() {
        $sql = "SELECT p.*, c.cate_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm một sản phẩm theo ID (lấy cả tên danh mục)
    public function find($id) {
        $sql = "SELECT p.*, c.cate_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm sản phẩm mới (đã bỏ cột quantity chung)
    public function create($data) {
        // Lưu ý: Đã xóa 'quantity' khỏi câu lệnh SQL
        $sql = "INSERT INTO products (name, image, price, description, content, status, category_id) 
                VALUES (:name, :image, :price, :description, :content, :status, :category_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        // Trả về ID của sản phẩm vừa tạo để có thể thêm size
        return $this->conn->lastInsertId();
    }

    // Cập nhật dữ liệu sản phẩm (đã bỏ cột quantity chung)
    public function update($id, $data) {
        // Loại bỏ ID khỏi mảng data để tránh lỗi
        unset($data['id']); 

        $setClauses = [];
        foreach (array_keys($data) as $key) {
            // Đảm bảo không cập nhật cột quantity không còn tồn tại
            if ($key != 'quantity') { 
                $setClauses[] = "$key = :$key";
            }
        }

        // Loại bỏ key quantity nếu nó vẫn còn trong mảng
        unset($data['quantity']);

        $sql = "UPDATE products SET " . implode(', ', $setClauses) . " WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        $data['id'] = $id; // Thêm ID vào lại để binding
        $stmt->execute($data);
    }

    // Xoá dữ liệu sản phẩm
    public function delete($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }


    // --- CÁC HÀM XỬ LÝ SIZE (CÁC HÀM BẠN ĐANG THIẾU) ---

    /**
     * Lấy tất cả size của một sản phẩm
     */
    public function getSizes($product_id) {
        $sql = "SELECT * FROM product_sizes WHERE product_id = :product_id ORDER BY size ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['product_id' => $product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Thêm một size mới cho sản phẩm
     */
    public function createSize($data) {
        $sql = "INSERT INTO product_sizes (product_id, size, quantity) VALUES (:product_id, :size, :quantity)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    /**
     * Xóa tất cả size của một sản phẩm (HÀM GÂY LỖI DO BỊ THIẾU)
     */
    public function deleteSizesByProductId($product_id) {
        $sql = "DELETE FROM product_sizes WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['product_id' => $product_id]);
    }


    // --- CÁC HÀM CHO TRANG KHÁCH HÀNG & PHÂN TRANG ---

    // Lấy sản phẩm theo danh mục
    public function listProductInCategory($id) {
        $sql = "SELECT p.*, c.cate_name 
                FROM products p JOIN categories c ON p.category_id = c.id 
                WHERE c.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 4 sản phẩm mới nhất của danh mục cho trang chủ
    public function listProductInCategoryHome($id) {
        $sql = "SELECT p.*, c.cate_name 
                FROM products p JOIN categories c ON p.category_id = c.id 
                WHERE c.id = :id ORDER BY id DESC LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 4 sản phẩm liên quan
    public function listProductRelead($category_id, $id) {
        $sql = "SELECT p.*, c.cate_name 
                FROM products p JOIN categories c ON p.category_id = c.id 
                WHERE c.id = :category_id AND p.id <> :id 
                ORDER BY id DESC LIMIT 4";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'category_id' => $category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tổng số sản phẩm để phân trang
    public function count() {
        $sql = "SELECT COUNT(*) as total FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Lấy sản phẩm theo từng trang
    public function listByPage($page, $perPage) {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT p.*, c.cate_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC 
                LIMIT :perPage OFFSET :offset";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // File: models/Product.php

// ... (bên trong class Product) ...

/**
 * Tìm kiếm sản phẩm theo tên
 */
public function searchByName($keyword) {
    $sql = "SELECT p.*, c.cate_name 
            FROM products p 
            JOIN categories c ON p.category_id = c.id 
            WHERE p.name LIKE :keyword";
            
    $stmt = $this->conn->prepare($sql);
    // Thêm dấu % để tìm kiếm gần đúng
    $stmt->execute(['keyword' => '%' . $keyword . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}