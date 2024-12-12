<?php
session_start();

// Kiểm tra nếu giỏ hàng có sản phẩm
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo "<h2>Thanh toán</h2>";
    echo "<ul>";
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        echo "<li>";
        echo "<img src='".$item['product_image']."' alt='".$item['product_name']."' style='width:50px;'>";
        echo "<strong>".$item['product_name']."</strong> - ".$item['product_price']." VND x ".$item['quantity'];
        echo "</li>";
        $total += $item['product_price'] * $item['quantity'];
    }
    echo "</ul>";
    echo "<p>Tổng cộng: ".$total." VND</p>";

    // Form thông tin thanh toán
    echo "<form action='process_checkout.php' method='POST'>
            <h3>Thông tin giao hàng</h3>
            <label for='name'>Họ và tên:</label><br>
            <input type='text' id='name' name='name' required><br><br>
            <label for='address'>Địa chỉ:</label><br>
            <input type='text' id='address' name='address' required><br><br>
            <label for='phone'>Số điện thoại:</label><br>
            <input type='text' id='phone' name='phone' required><br><br>
            <button type='submit' class='checkout-button'>Hoàn tất thanh toán</button>
          </form>";
} else {
    echo "<p>Giỏ hàng của bạn trống.</p>";
    echo "<a href='home.php' class='continue-shopping-button'>Tiếp tục mua sắm</a>";
}
?>
