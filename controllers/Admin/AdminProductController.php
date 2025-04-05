<?php

class AdminproductController {

    public function __construct(){
        $user= $_SESSION['user'] ?? [];
        if(!$user || $user['role'] != 'admin'){
            return header('location: ' . ROOT_URL);
        }
    }
    // hiển thị danh sách
    public function index() {
        $products = (new Product)-> all();
        $message = session_flash('message');
        return view('admin.products.list', compact('products', 'message'));
    }

    //thêm mới sản phẩm
    public function create(){
        $categories  = (new Category)-> all();
        return view('admin.products.add', compact('categories'));
    }

    //lưu dữ liệu thêm vào csdl
    public function store(){
        $data = $_POST;

        // nếu không nhập ảnh
        $image = '';
        // nếu nhập ảnh
        $file = $_FILES['image'];
        if ($file['size'] > 0){
            $image = 'images/' .$file['name'];
            move_uploaded_file($file['tmp_name'], ROOT_DIR . $image);
        }
        //đưa ảnh vào mảng data
        $data['image'] = $image;
        //lưu vào csdl
        (new Product)->create($data);

        $_SESSION['message']= "thêm dữ liệu thành công";

        header("Location: " . ADMIN_URL . "?ctl=listsp");
        die;
    }

    //form sửa
    public function edit(){
        $id = $_GET['id'];
        $product = (new Product)->find($id);
        $categories = (new Category)->all();

        // lấy session flash message
        $message = session_flash('message');

        return view('admin.products.edit', compact('product', 'categories', 'message'));
    }
    
    //Cập nhật cơ sở dữ liệu
    public function update(){
        $data = $_POST;

    //neu thay doi hinh anh
    $file = $_FILES['image'];
    if ($file['size'] > 0) {
        $image = "images/" . $file['name'];
        move_uploaded_file($file['tmp_name'], ROOT_DIR .$image);
        //cap nhat image vao mang date
        $data['image'] = $image;
    }
    //Luu data vao CSDL
    (new Product)->update($data['id'], $data);

    $_SESSION['message'] = "Cap nhat du lieu thanh cong" ;

    header("Location: " . ADMIN_URL . "?ctl=editsp&id=" . $data['id']);
    die;
    }

    //Xóa
    public function delete(){
        $id = $_GET['id'];
    (new Product)->delete($id);
    $_SESSION['mesage'] = 'Xoa du lieu thanh cong';
    header('Location: ' . ADMIN_URL . '?ctl=listsp');
    die;
    }
}