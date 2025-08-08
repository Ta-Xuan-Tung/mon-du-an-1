<?php

class CartController {

    
    //Thêm vào giỏ hàng
  public function addToCart() {
    $carts = $_SESSION['cart'] ?? [];

    $id = $_GET['id'] ?? $_POST['id'] ?? null;
    $size = $_GET['size'] ?? $_POST['size'] ?? null;

    error_log("Add to cart - ID: $id, Size: $size");

    if (!$id) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'ID sản phẩm không hợp lệ!'];
        error_log("Add to cart failed: No ID provided");
        return header("Location: " . ($_SESSION['URI'] ?? ROOT_URL . "?ctl=detail&id=$id"));
    }

    $product = (new Product)->find($id);
    if (!$product) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Sản phẩm không tồn tại!'];
        error_log("Add to cart failed: Product $id not found");
        return header("Location: " . ($_SESSION['URI'] ?? ROOT_URL));
    }

    $sizes = (new Product)->getSizes($id);
    error_log("Sizes for product $id: " . json_encode($sizes));
    if (empty($sizes)) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Không có size nào khả dụng cho sản phẩm này!'];
        return header("Location: " . ($_SESSION['URI'] ?? ROOT_URL . "?ctl=detail&id=$id"));
    }

    $sizeAvailable = false;
    $availableQuantity = 0;
    foreach ($sizes as $availableSize) {
        error_log("Checking size: " . $availableSize['size'] . ", Quantity: " . $availableSize['quantity']);
        if ($availableSize['size'] === $size) {
            $availableQuantity = $availableSize['quantity'];
            if ($availableQuantity > 0) {
                $sizeAvailable = true;
            }
            break;
        }
    }

    if (!$size || !$sizeAvailable) {
        $_SESSION['message'] = ['type' => 'error', 'text' => 'Size không hợp lệ hoặc đã hết hàng!'];
        error_log("Add to cart failed: Size $size not available for product $id, Sizes: " . json_encode($sizes));
        return header("Location: " . ($_SESSION['URI'] ?? ROOT_URL . "?ctl=detail&id=$id"));
    }

    $cartKey = $id . '_' . $size;
    if (isset($carts[$cartKey])) {
        if ($carts[$cartKey]['quantity'] < $availableQuantity) {
            $carts[$cartKey]['quantity'] += 1;
        }
    } else {
        $carts[$cartKey] = [
            'name' => $product['name'],
            'image' => $product['image'],
            'price' => $product['price'],
            'quantity' => 1,
            'size' => $size
        ];
    }

    $_SESSION['cart'] = $carts;
    $_SESSION['totalQuantity'] = array_sum(array_column($carts, 'quantity'));
    $_SESSION['message'] = ['type' => 'success', 'text' => 'Thêm vào giỏ hàng thành công!'];
    error_log("Add to cart success: Product $id, Size $size, Quantity " . $carts[$cartKey]['quantity']);
    return header("Location: " . ROOT_URL . "?ctl=view-cart");
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
    public function totalSumQuantity()
    {
        $carts = $_SESSION['cart'] ?? [];
        $totalQuantity = 0;

        foreach ($carts as $cart) {
            $totalQuantity += $cart['quantity'];
        }

        return $totalQuantity;
    }
    // xoa sản phẩm trongtrong giỏ hàng
    public function deleteProductInCart() {
    $id = $_GET['id'];
    $size = $_GET['size'] ?? null; // Thêm size từ URL (nếu có)
    $cartKey = $id . '_' . $size; // Tạo key đầy đủ

    if (isset($_SESSION['cart'][$cartKey])) {
        unset($_SESSION['cart'][$cartKey]);
    }
    $_SESSION['totalQuantity'] = $this->totalSumQuantity();
    return header("Location: " . ROOT_URL . "?ctl=view-cart");
}

    //Cập nhật giỏ hàng
    public function updateCart() {
    $quantities = $_POST['quantity'];
    $carts = $_SESSION['cart'] ?? [];

    foreach ($quantities as $key => $qty) {
        if (isset($carts[$key])) {
            $id = explode('_', $key)[0];
            $size = $carts[$key]['size'];
            $sizes = (new Product)->getSizes($id);
            $availableQuantity = 0;
            foreach ($sizes as $availableSize) {
                if ($availableSize['size'] === $size) {
                    $availableQuantity = $availableSize['quantity'];
                    break;
                }
            }
            if ($qty <= $availableQuantity) {
                $carts[$key]['quantity'] = $qty;
            } else {
                $carts[$key]['quantity'] = $availableQuantity; // Giới hạn tối đa
            }
        }
    }
    $_SESSION['cart'] = $carts;
    return header("Location: " . ROOT_URL . "?ctl=view-cart");
}

    //Hiển thị thông tin thanh toán
    public function viewCheckout(){
        //kiểm tra xem người dùng đã đăng nhập chưa nếu chưa thì quay lại trang login
        if(!isset($_SESSION['user'])){
            return header("Location: ". ROOT_URL . "?ctl=login");
        }

        $user = $_SESSION['user'];
        $carts = $_SESSION['cart'] ?? [];
        $sumPrice = (new CartController)->sumPrice();

        return view("clients.carts.checkout", compact('user', 'carts', 'sumPrice')); 
    }

    //thanh toán
    public function checkOut() {
    $user = [
        'id' => $_POST['id'],
        'fullname' => $_POST['fullname'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'role' => $_SESSION['user']['role'],
        'active' => $_SESSION['user']['active'],
    ];

    $order = [
        'user_id' => $_POST['id'],
        'status' => 1,
        'payment_method' => $_POST['payment_method'],
        'total_price' => $this->sumPrice(),
    ];

    (new User)->update($user['id'], $user);
    $order_id = (new Order)->create($order);
    
    $order_detail = new Order;
    $carts = $_SESSION['cart'];
    foreach ($carts as $key => $cart) {
        $parts = explode('_', $key);
        $id = $parts[0];
        $size = $cart['size'];
        $order_detail = [
            'order_id' => $order_id,
            'product_id' => $id,
            'size' => $size, // Thêm size
            'price' => $cart['price'],
            'quantity' => $cart['quantity'],
        ];
        (new Order)->createOrderDetail($order_detail);

        // Giảm số lượng trong product_sizes
        // Sửa lại cho đúng
$stmt = (new Product)->conn->prepare("UPDATE product_sizes SET quantity = quantity - :qty WHERE product_id = :id AND size = :size");
        $stmt->execute(['qty' => $cart['quantity'], 'id' => $id, 'size' => $size]);
    }
    $this->clearCart();
    return header("Location: " . ROOT_URL . "?ctl=success");
}

    //Xóa giỏ hàng
    public function clearCart(){
        unset($_SESSION['cart']);
        unset($_SESSION['totalQuantity']);
        unset($_SESSION['URI']);
    }

    public function success(){
        return view("clients.carts.success");
    }
}