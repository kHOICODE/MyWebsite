<?php
session_start();

// Kiểm tra xem người dùng đã gửi thông tin sản phẩm chưa
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    
    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }

    // Nếu sản phẩm chưa có trong giỏ, thêm vào giỏ
    if (!$found) {
        $_SESSION['cart'][] = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_image' => $product_image,
            'quantity' => 1
        );
    }
}

// Chuyển hướng người dùng trở lại trang chủ sau khi thêm sản phẩm vào giỏ
header('Location: home.php');
exit();
?>
