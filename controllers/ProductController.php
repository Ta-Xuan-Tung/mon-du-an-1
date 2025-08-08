<?php

class ProductController {

    // Hiện thị danh sách sản phẩm theo danh mục
    public function list() {
        $id = $_GET['id']; // Lấy id của danh mục
        $products = (new Product)->listProductInCategory($id);

        $category_name = (new Category)->find($id)['cate_name']; // Lấy tên danh mục

        $categories = (new Category)->all(); // Lấy danh sách danh mục
        $title = $category_name; // Tiêu đề trang

        return view('clients.products.list', compact('products', 'category_name', 'title', 'categories'));
    }

    // Chi tiết sản phẩm
    public function show() {
    $id = $_GET['id']; // Lấy id của sản phẩm
    $product = (new Product)->find($id); // Lấy thông tin sản phẩm
    $title = $product['name']; // Tiêu đề trang
    $categories = (new Category)->all(); // Lấy danh sách danh mục
    
    // Danh sách sản phẩm liên quan
    $productReleads = (new Product)->listProductRelead($product['category_id'], $id);
    
    // Lưu thông tin URI vào SESSION
    $_SESSION['URI'] = $_SERVER['REQUEST_URI'];
    
    // Sử dụng giá trị đã có trong session
    $_SESSION['totalQuantity'] = $_SESSION['totalQuantity'] ?? 0;

    return view('clients.products.detail', compact('product', 'title', 'categories', 'productReleads'));
}
}
?>