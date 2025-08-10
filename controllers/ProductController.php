<?php

class ProductController {

    /**
     * Hiển thị danh sách sản phẩm theo danh mục
     */
    public function list() {
        $category_id = $_GET['id']; // Lấy id của danh mục

        $categoryModel = new Category();
        $productModel = new Product();
        
        // Lấy thông tin cần thiết
        $products = $productModel->listProductInCategory($category_id);
        $category = $categoryModel->find($category_id);
        $categories = $categoryModel->all(); // Lấy tất cả danh mục cho menu
        
        $title = $category['cate_name'] ?? 'Danh mục không tồn tại';

        return view('clients.products.list', compact('products', 'category', 'title', 'categories'));
    }

    /**
     * Hiển thị chi tiết một sản phẩm
     */
    public function show() {
        $product_id = $_GET['id'];
        
        $productModel = new Product();
        $categoryModel = new Category();

        // 1. Lấy thông tin sản phẩm chính
        $product = $productModel->find($product_id);

        // Nếu không tìm thấy sản phẩm, có thể chuyển hướng về trang chủ hoặc báo lỗi 404
        if (!$product) {
            header('Location: ' . ROOT_URL);
            die;
        }

        // 2. Lấy danh sách sản phẩm liên quan
        $productReleads = $productModel->listProductRelead($product['category_id'], $product_id);
        
        // 3. ĐÃ THÊM: Lấy danh sách size có sẵn của sản phẩm này
        $available_sizes = $productModel->getSizes($product_id);

        // 4. Lấy danh sách tất cả danh mục (cho menu)
        $categories = $categoryModel->all();
        
        $title = $product['name'];

        // 5. Truyền tất cả dữ liệu ra View
        return view('clients.products.detail', compact(
            'product', 
            'title', 
            'categories', 
            'productReleads', 
            'available_sizes' // Truyền biến mới này ra
        ));
    }

/**
 * Xử lý tìm kiếm và hiển thị kết quả
 */
public function search() {
    // Lấy từ khóa từ URL
    $keyword = $_GET['keyword'] ?? '';
    
    // Gọi hàm searchByName trong model để lấy danh sách sản phẩm
    $products = (new Product)->searchByName($keyword);
    
    // Lấy danh sách danh mục cho menu
    $categories = (new Category)->all();
    $title = 'Kết quả tìm kiếm cho "' . htmlspecialchars($keyword) . '"';

    // Gọi đến một view mới để hiển thị kết quả
    return view('clients.products.search_results', compact('products', 'keyword', 'title', 'categories'));
}

/**
 * Hiển thị TẤT CẢ sản phẩm (có phân trang)
 */
public function allProducts() {
    // 1. Xác định trang hiện tại
    $page = $_GET['page'] ?? 1;
    $perPage = 8; // Hiển thị 8 sản phẩm mỗi trang

    $productModel = new Product();

    // 2. Lấy tổng số sản phẩm để tính toán
    $totalProducts = $productModel->count();
    $totalPages = ceil($totalProducts / $perPage);

    // 3. Lấy sản phẩm cho trang hiện tại
    $products = $productModel->listByPage($page, $perPage);

    // Lấy danh mục cho menu và đặt tiêu đề
    $categories = (new Category)->all();
    $title = 'Tất cả sản phẩm';

    // 4. Truyền dữ liệu ra view
    return view('clients.products.all_products', compact('products', 'title', 'categories', 'totalPages', 'page'));
}
}