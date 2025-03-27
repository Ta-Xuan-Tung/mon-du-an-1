<?php
    class HomeController {
        // hiện thị trang chủ
        public function index() {
            $product = new Product;
            $nikes = $product->listProductInCategory(1); // danh sách sản phẩm Nike
            $adidass = $product->listProductInCategory(2); // danh sách sản phẩm Adidas

            return view('clients.home', compact('nikes', 'adidass'));
        }
    }
?>