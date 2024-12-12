<?php
include 'Dtb_Connect.php'; // Kết nối cơ sở dữ liệu

// Lấy giá trị tìm kiếm từ URL (nếu có)
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Truy vấn cơ sở dữ liệu để tìm kiếm sản phẩm
$sql = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?";
$stmt = $conn->prepare($sql);
$search_term = "%$query%"; // Thêm ký tự % để tìm kiếm theo chuỗi chứa từ khóa
$stmt->bind_param('ss', $search_term, $search_term); // Liên kết tham số với câu truy vấn
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Thanh tìm kiếm -->
    <div class="header">
        <form action="search.php" method="get" class="search-form">
            <input type="text" name="query" placeholder="Search for products..." class="search-input" value="<?php echo htmlspecialchars($query); ?>">
            <button type="submit" class="search-button">Search</button>
        </form>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>

    <div class="container">
        <!-- Kết quả tìm kiếm -->
        <div class="products">
            <h2>Search Results for "<?php echo htmlspecialchars($query); ?>"</h2>
            <div class="product-list">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='product-item'>";
                        echo "<img src='".$row['image']."' alt='".$row['name']."'>";
                        echo "<h3>".$row['name']."</h3>";
                        echo "<p>".$row['description']."</p>";
                        echo "<p>Price: ".$row['price']." VND</p>";

                        // Thêm nút "Add to Cart"
                        echo "<form action='add_to_cart.php' method='post'>";
                        echo "<input type='hidden' name='product_id' value='".$row['id']."'>";
                        echo "<input type='hidden' name='product_name' value='".$row['name']."'>";
                        echo "<input type='hidden' name='product_price' value='".$row['price']."'>";
                        echo "<input type='hidden' name='product_image' value='".$row['image']."'>";
                        echo "<button type='submit' class='add-to-cart-button'>Add to Cart</button>";
                        echo "</form>";

                        echo "</div>";
                    }
                } else {
                    echo "<p>No products found matching your search.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
