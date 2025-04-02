<?php

    // Model Product : làm việc với bảng Product

    class Product extends BaseModel {

        // lấy toàn bộ dữ liệu

        public function all(){
            $sql = "SELECT p.*, cate_name FROM products p Join categories c ON p.category_id = c.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        // lấy sản phẩm theo danh mục
        public function listProductInCategory($id){
            $sql = "SELECT p.*, cate_name FROM products p Join categories c ON p.category_id = c.id WHERE c.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //lấy dữ liệu cho trang chủ

        public function listProductInCategoryHome($id){
            $sql = "SELECT p.*, cate_name FROM products p Join categories c ON p.category_id = c.id WHERE c.id = :id ORDER BY id DESC LIMIT 4";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //sản phẩm liên quan
        // category_id là mã danh mục
        // id là mã sản phẩm
        public function listProductRelead($category_id, $id) {
            $sql = "SELECT p.*, cate_name FROM products p Join categories c ON p.category_id = c.id WHERE c.id = :category_id AND p.id <> :id ORDER BY id DESC LIMIT 4";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id, 'category_id' => $category_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // thêm dữ liệu

        public function create($data){
            $sql = "INSERT INTO products (name, image, price, quantity, description, content, status, category_id) VALUES (:name, :image, :price, :quantity, :description, :content, :status, :category_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt -> execute($data);
        }


        // cập nhật dữ liệu

        public function update ($id,$data){
            $sql = "UPDATE products SET name = :name, image = :image, price = :price, quantity = :quantity, description = :description, content = :content, status = :status, category_id = :category_id WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            // thêm id vào mảng data
            $data['id'] = $id;
            $stmt -> execute($data);
        }


        // xoá dữ liệu

        public function delete($id){
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt -> execute(['id' => $id]);
        }


        // tìm sản phẩm theo id

        public function find($id){
            $sql = "SELECT p.*, cate_name FROM products p Join categories c ON p.category_id = c.id WHERE p.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt -> execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


    }

?>