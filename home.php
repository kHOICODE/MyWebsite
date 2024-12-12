<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to CSS file -->
</head>
<body>
    <!-- Search bar and logout button -->
    <div class="header">
        <form action="search.php" method="get" class="search-form">
            <input type="text" name="query" placeholder="Search for products..." class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>
        <a href="logout.php" class="logout-button">Logout</a>
    </div>

    <div class="container">
        <!-- Featured Products Section -->
        <div class="products">
            <h2>Featured Products</h2>
            <div class="product-list">
                <?php
                include 'Dtb_Connect.php';
                $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 10"; 
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='product-item'>";
                        echo "<img src='".$row['image']."' alt='".$row['name']."'>";
                        echo "<h3>".$row['name']."</h3>";
                        echo "<p>".$row['description']."</p>";
                        echo "<p>Price: ".$row['price']." VND</p>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>

        <!-- Best Seller Ranking -->
        <div class="ranking">
            <h2>Best Sellers Ranking</h2>
            <ul>
                <?php
                include 'Dtb_Connect.php';
                // Query products by sold quantity
                $sql_ranking = "SELECT * FROM products ORDER BY sold_quantity DESC LIMIT 5";
                $ranking_result = $conn->query($sql_ranking);
                if ($ranking_result->num_rows > 0) {
                    while($row = $ranking_result->fetch_assoc()) {
                        echo "<li><strong>".$row['name']."</strong> - Sold: ".$row['sold_quantity']." units</li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
<div class="products">
<h2>Product List</h2>
<div class="product-list">
    <?php
    include 'Dtb_Connect.php';
    $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 10"; 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='product-item'>";
            echo "<img src='".$row['image']."' alt='".$row['name']."' class='img-fluid'>";
            echo "<h3>".$row['name']."</h3>";
            echo "<p>".$row['description']."</p>";
            echo "<p>Price: ".$row['price']." VND</p>";
            
            // Add to cart form
            echo "<form action='add_to_cart.php' method='post'>";
            echo "<input type='hidden' name='product_id' value='".$row['id']."'>";
            echo "<input type='hidden' name='product_name' value='".$row['name']."'>";
            echo "<input type='hidden' name='product_price' value='".$row['price']."'>";
            echo "<input type='hidden' name='product_image' value='".$row['image']."'>";
            echo "<button type='submit' class='add-to-cart-button'>Add to Cart</button>";
            echo "</form>";

            // Button to view product details
            echo "<a href='product_details.php?id=".$row['id']."' class='btn btn-info'>View Details</a>";
            echo "</div>";
        }
    }
    ?>
</div>

</div>
<div class="header">
    <form action="search.php" method="get" class="search-form">
        <input type="text" name="query" placeholder="Search for products..." class="search-input">
        <button type="submit" class="search-button">Search</button>
    </form>
    <a href="logout.php" class="logout-button">Logout</a>
    <!-- View Cart Button -->
    <a href="cart.php" class="view-cart-button">View Cart</a>
</div>

<!-- User Profile -->
<div class="header">
    <form action="search.php" method="get" class="search-form">
        <input type="text" name="query" placeholder="Search for products..." class="search-input">
        <button type="submit" class="search-button">Search</button>
    </form>
    <a href="profile.php" class="profile-button">Profile</a> <!-- Profile Button -->
    <a href="cart.php" class="view-cart-button">View Cart</a>
    <a href="logout.php" class="logout-button">Logout</a>
</div>


<!--Nút add san pham-->
<div class="header">
    <form action="search.php" method="get" class="search-form">
        <input type="text" name="query" placeholder="Search for products..." class="search-input">
        <button type="submit" class="search-button">Search</button>
    </form>
    <a href="profile.php" class="profile-button">Profile</a> <!-- Profile Button -->
    <a href="add_product.php" class="add-product-button">Add Product</a> <!-- Add Product Button -->
    <a href="logout.php" class="logout-button">Logout</a> <!-- Logout Button -->
</div>

<!--nut xem gio hang-->
<div class="header">
    <!-- Form tìm kiếm -->
    <form action="search.php" method="get" class="search-form">
        <input type="text" name="query" placeholder="Search for products..." class="search-input">
        <button type="submit" class="search-button">Search</button>
    </form>

    <!-- Nút Profile, Add Product và Giỏ hàng -->
     
    <a href="profile.php" class="profile-button">Profile</a>
    <a href="add_product.php" class="add-product-button">Add Product</a>
    <a href="cart.php" class="view-cart-button">Cart</a> <!-- Nút Giỏ hàng -->
    <a href="logout.php" class="logout-button">Logout</a>
</div>



