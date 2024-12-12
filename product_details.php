<?php
// Kết nối đến cơ sở dữ liệu
include 'Dtb_Connect.php';

// Lấy ID sản phẩm từ URL
$product_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Truy vấn sản phẩm theo ID
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc(); // Lấy thông tin sản phẩm
} else {
    echo "Sản phẩm không tồn tại.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Sản phẩm</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link tới file CSS của bạn -->
</head>
<body>
    <!-- Phần header, bạn có thể chèn lại phần tìm kiếm, giỏ hàng, logout như trên -->
    <div class="header">
        <form action="search.php" method="get" class="search-form">
            <input type="text" name="query" placeholder="Tìm kiếm sản phẩm..." class="search-input">
            <button type="submit" class="search-button">Tìm kiếm</button>
        </form>
        <a href="logout.php" class="logout-button">Đăng xuất</a>
    </div>

    <!-- Phần chi tiết sản phẩm -->
    <div class="product-details">
        <h2><?php echo $product['name']; ?></h2> <!-- Tên sản phẩm -->
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image"> <!-- Hình ảnh sản phẩm -->
        <p><strong>Mô tả:</strong> <?php echo $product['description']; ?></p> <!-- Mô tả sản phẩm -->
        <p><strong>Giá:</strong> <?php echo number_format($product['price'], 0, ',', '.') . " VND"; ?></p> <!-- Giá sản phẩm -->

        <!-- Form thêm sản phẩm vào giỏ hàng -->
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
            <button type="submit" class="add-to-cart-button">Thêm vào giỏ hàng</button>
        </form>
    </div>
</body>
</html>
