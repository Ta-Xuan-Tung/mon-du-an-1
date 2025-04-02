<?php

    class ProductController {

        // hiện thị danh sách sản phẩm theo danh mục
        public function list(){
            $id = $_GET['id']; // lấy id của danh mục
            $products = (new Product) ->listProductInCategory($id);

            $category_name = (new Category) ->find($id)['cate_name']; // lấy tên danh mục

            $categories = (new Category) ->all(); // lấy danh sách danh mục
            $title = $category_name; // tiêu đề trang

            return view('clients.products.list', compact('products', 'category_name', 'title', 'categories'));

        }


            // Chi tiết sản phẩm
    public function show(){
        $id = $_GET['id']; // lấy id của sản phẩm
        $product = (new Product) ->find($id); // lấy thông tin sản phẩm
        $title = $product['name']; // tiêu đề trang
        $categories = (new Category) ->all(); // lấy danh sách danh mục
      
        // danh sách sản phẩm liên quan
        $productReleads = (new Product)-> listProductRelead($product['category_id'],$id);

        return view('clients.products.detail', compact('product', 'title', 'categories', 'productReleads'));
    }

    }


?>