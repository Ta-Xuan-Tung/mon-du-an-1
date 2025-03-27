<?php

class AdminproductController {

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
        
    }
    
    //Cập nhật cơ sở dữ liệu
    public function uppdate(){

    }

    //Xóa
    public function delete(){

    }
}