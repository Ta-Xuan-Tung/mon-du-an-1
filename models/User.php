<?php
    class User extends BaseModel {
        // lấy toàn bộ users
        public function all(){
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // lấy ra 1 user
        public function find($id){
            $sql = "SELECT * FROM users where id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' =>$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // lấy ra 1 user theo mail
        public function findUserOfEmail($email){
            $sql = "SELECT * FROM users where email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' =>$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // thêm 1 user
        public function create($data){
            $sql = "INSERT INTO users(fullname, email, password, phone, address) VALUES(:fullname, :email, :password, :phone, :address)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
        }

        // cập nhật user

        public function update($id, $data){
            $sql = "UPDATE users SET fullname=:fullname, phone=:phone, address=:address, role=:role, active=:active WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            // thêm id vào data
            $data['id'] =  $id;
            $stmt->execute($data);
        }

        //cap nhật trạng thái user
        public function updateActive($id, $active){
            $sql = "UPDATE users SET active = :active WHERE id=:id";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute(['id' => $id, 'active' => $active]);
        }
    }
?>