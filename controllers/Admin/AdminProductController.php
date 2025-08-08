<?php

class AdminProductController {

    public function __construct(){
        // Kiểm tra quyền admin, nếu không phải thì chuyển về trang chủ
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            header('location: ' . ROOT_URL);
            die;
        }
    }

    /**
     * Hiển thị danh sách sản phẩm (có phân trang)
     */
    public function index() {
        $page = $_GET['page'] ?? 1;
        $perPage = 5; // Số sản phẩm trên mỗi trang

        $productModel = new Product();
        $totalProducts = $productModel->count();
        $totalPages = ceil($totalProducts / $perPage);

        $products = $productModel->listByPage($page, $perPage);
        $message = session_flash('message');

        return view('admin.products.list', compact('products', 'message', 'totalPages', 'page'));
    }

    /**
     * Hiển thị form thêm mới sản phẩm
     */
    public function create() {
        $categories = (new Category)->all();
        return view('admin.products.add', compact('categories'));
    }

    /**
     * Lưu dữ liệu từ form thêm mới vào CSDL
     */
    public function store() {
        $data = $_POST;

        $image_path = '';
        $file = $_FILES['image'] ?? null;
        if ($file && $file['size'] > 0) {
            $image_path = 'images/' . time() . '_' . $file['name'];
            move_uploaded_file($file['tmp_name'], ROOT_DIR . $image_path);
        }
        $data['image'] = $image_path;

        $sizes = $data['sizes'] ?? [];
        $quantities = $data['quantities'] ?? [];
        unset($data['sizes'], $data['quantities']);

        $product_id = (new Product)->create($data);

        if (!empty($sizes) && $product_id) {
            $productModel = new Product();
            for ($i = 0; $i < count($sizes); $i++) {
                if (!empty($sizes[$i]) && isset($quantities[$i])) {
                    $sizeData = [
                        'product_id' => $product_id,
                        'size'       => $sizes[$i],
                        'quantity'   => $quantities[$i]
                    ];
                    $productModel->createSize($sizeData);
                }
            }
        }

        $_SESSION['message'] = "Thêm sản phẩm thành công";
        // SỬA LẠI ĐƯỜNG DẪN CHUYỂN HƯỚNG
        header("Location: " . ADMIN_URL . "?ctl=product-list");
        die;
    }

    /**
     * Hiển thị form sửa sản phẩm
     */
    public function edit() {
        $id = $_GET['id'];
        $productModel = new Product();
        $product = $productModel->find($id);
        $categories = (new Category)->all();
        $sizes = $productModel->getSizes($id);
        $message = session_flash('message');

        return view('admin.products.edit', compact('product', 'categories', 'sizes', 'message'));
    }

    /**
     * Cập nhật dữ liệu từ form sửa vào CSDL
     */
    public function update() {
        $data = $_POST;
        $id = $data['id'];

        $file = $_FILES['image'] ?? null;
        if ($file && $file['size'] > 0) {
            $image_path = 'images/' . time() . '_' . $file['name'];
            move_uploaded_file($file['tmp_name'], ROOT_DIR . $image_path);
            $data['image'] = $image_path;
        }

        $new_sizes = $data['sizes'] ?? [];
        $new_quantities = $data['quantities'] ?? [];
        unset($data['sizes'], $data['quantities']);

        (new Product)->update($id, $data);

        $productModel = new Product();
        $productModel->deleteSizesByProductId($id);

        if (!empty($new_sizes)) {
            for ($i = 0; $i < count($new_sizes); $i++) {
                if (!empty($new_sizes[$i]) && isset($new_quantities[$i])) {
                    $sizeData = [
                        'product_id' => $id,
                        'size'       => $new_sizes[$i],
                        'quantity'   => $new_quantities[$i]
                    ];
                    $productModel->createSize($sizeData);
                }
            }
        }

        $_SESSION['message'] = "Cập nhật dữ liệu thành công";
        // SỬA LẠI ĐƯỜNG DẪN CHUYỂN HƯỚNG
        header("Location: " . ADMIN_URL . "?ctl=product-list");
        die;
    }

    /**
     * Xóa sản phẩm
     */
    public function delete() {
        $id = $_GET['id'];
        $productModel = new Product();
        $productModel->deleteSizesByProductId($id);
        $productModel->delete($id);

        $_SESSION['message'] = 'Xóa dữ liệu thành công';
        // SỬA LẠI ĐƯỜNG DẪN CHUYỂN HƯỚNG
        header('Location: ' . ADMIN_URL . '?ctl=product-list');
        die;
    }
}