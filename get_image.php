<?php
// get_image.php

function displayProducts($category) {
    $conn = new mysqli('localhost', 'root', '', 'homie_bake_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT product_id, product_name, price, image_data, description FROM products WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['product_id'];
            $name = htmlspecialchars($row['product_name']);
            $price = htmlspecialchars($row['price']);
            $imageData = base64_encode($row['image_data']);
            $description = htmlspecialchars($row['description']);
            echo '
            <div class="post-slide">
                <div class="post-img">
                    <div class="post-abs">
                        <p>' . $description . '</p>
                    </div>
                    <img src="data:image/png;base64,' . $imageData . '" alt="' . $name . '">
                </div>
                <h3 class="post-title"><a href="#">' . $name . '</a></h3>
                <p class="post-description">' . $price . '$</p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="' . $id . '">
                    <input type="hidden" name="product_name" value="' . $name . '">
                    <input type="hidden" name="product_price" value="' . $price . '">
                    <button type="submit" class="cart-btn">Add to Cart</button>
                </form>
            </div>';
        }
    } else {
        echo "<p>No products found for this category.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
