<?php
    class HomeController {
        // hiện thị trang chủ
        public function index() {
            $product = new Product;
            $nikes = $product->listProductInCategoryHome(1); // danh sách sản phẩm Nike
            $adidass = $product->listProductInCategoryHome(2); // danh sách sản phẩm Adidas


            // Tiêu đề
            $title = 'Trang chủ webiste bán giày';
            $categories = (new Category) ->all(); // lấy danh sách danh mục



            return view('clients.home', compact('nikes', 'adidass', 'title', 'categories'));
        }
    }
?>