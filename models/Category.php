<?php
    //Model Category thao tác với bảng Categories
    class Category extends BaseModel {
        // phương thức all: lấy all toàn bộ dữ liệu bảng categories
        public function all(){
            $sql = "SELECT * FROM categories";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // phương thức create: thêm mới dữ liệu
        // @data: là mảng dữ liệu cần thêm

        public function create($data){
            $sql = "INSERT INTO categories (cate_name) VALUES (:cate_name)";
            $stmt = $this->conn->prepare($sql);
            $stmt -> execute($data);
        }


        // phương thức update: cập nhật dữ liệu
        // @id: mã danh mục
        // @data: là mảng dữ liệu cần cập nhật

        public function update ($id,$data){
            $sql = "UPDATE categories SET cate_name = :cate_name WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            // thêm id và data
            $data['id'] = $id;
            $stmt -> execute($data);
        }


        // phương thức find: tìm danh mục theo id
        // @id: mã danh mục cần tìm
        public function find($id){
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt -> execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        // phương thức delete: xóa dữ liệu
        // @id: mã danh mục cần xóa
        public function delete($id){
            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt -> execute(['id' => $id]);
        }
/**
 * Đếm TẤT CẢ sản phẩm thuộc về một danh mục, không phân biệt trạng thái
 * ĐÃ SỬA: Bỏ điều kiện "AND status = 'active'"
 */
public function countProducts($category_id) {
    $sql = "SELECT COUNT(*) as total FROM products WHERE category_id = :category_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['category_id' => $category_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}
    }

?>