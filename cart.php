<?php
session_start();

// Kiểm tra nếu có yêu cầu xóa sản phẩm
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['index'])) {
    $index = $_GET['index']; // Lấy chỉ số sản phẩm cần xóa
    unset($_SESSION['cart'][$index]); // Xóa sản phẩm khỏi giỏ hàng
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Đảm bảo chỉ số mảng liên tục
    header("Location: cart.php"); // Chuyển hướng lại trang giỏ hàng sau khi xóa
    exit();
}

// Tiếp tục xử lý giỏ hàng ở dưới (hiển thị sản phẩm)
?>

<?php
session_start();

// Kiểm tra nếu giỏ hàng có sản phẩm
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo "<h2>Giỏ hàng của bạn</h2>";
    echo "<ul>";
    $total = 0;
    foreach ($_SESSION['cart'] as $index => $item) {
        echo "<li>";
        echo "<img src='".$item['product_image']."' alt='".$item['product_name']."' style='width:50px;'>";
        echo "<strong>".$item['product_name']."</strong> - ".$item['product_price']." VND x ".$item['quantity'];
        // Thêm liên kết xóa sản phẩm
        echo " <a href='cart.php?action=remove&index=".$index."' class='remove-item-button'>Xóa</a>";
        echo "</li>";
        $total += $item['product_price'] * $item['quantity'];
    }
    echo "</ul>";
    echo "<p>Tổng cộng: ".$total." VND</p>";
    echo "<a href='checkout.php' class='checkout-button'>Thanh toán</a>"; // Link đến trang thanh toán
} else {
    echo "<p>Giỏ hàng của bạn trống.</p>";
    echo "<a href='home.php' class='continue-shopping-button'>Tiếp tục mua sắm</a>";
}
?>
