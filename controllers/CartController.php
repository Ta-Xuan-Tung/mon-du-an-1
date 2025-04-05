<?php

class CartController {
    //Thêm vào giỏ hàng
    public function addToCart(){
        // Tạo một giỏ hàng
        $carts = $_SESSION['cart'] ?? [];

        //Lấy sản phẩm theo id để thêm vào giỏ hàng
        $id = $_GET['id'];

        $product = (new Product)->find($id);

        if(isset($carts[$id])) {
            $carts[$id]['quantity'] += 1;
        }else{
            $carts[$id]=[
                'name'=> $product['name'],
                'image'=> $product['image'],
                'price'=> $product['price'],
                'quantity'=> 1,
            ];
        }
        //Lưu giỏ hàng vào session
        $_SESSION['cart']= $carts;

        $url = $_SESSION['URI'];

        return header("Location: " . $url);
    }

    //Tính tổng số lượng sản phẩm để hiển thị giỏ hàng
    public function totalSumQuantity(){
        $carts = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach($carts as $cart){
            $total += $cart['quantity'];
        }
        return $total;
    }

    public function viewCart(){
        $carts = $_SESSION['cart'] ?? [];
        $sumPrice = (new CartController)->sumPrice();
        $categories = (new Category) ->all();

        return view("clients.carts.cart", compact('carts', 'categories', 'sumPrice')); 
    }

        public function sumPrice(){
            $carts = $_SESSION['cart'] ?? [];
            $total = 0;
            foreach($carts as $cart){
                $total += $cart['quantity'] * $cart['price'];
            }
            return $total;
        }
}