<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'homie_bake_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add/Delete Product
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_product']) && isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $conn->query("DELETE FROM Products WHERE product_id = $product_id");
        exit;
    } elseif (isset($_POST['update_order_status']) && isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        $new_status = $_POST['new_status'];
        $stmt = $conn->prepare("UPDATE Orders SET status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $new_status, $order_id);
        $stmt->execute();
        $stmt->close();
        exit;
    } elseif (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $name = $_POST['product_name'];
        $description = $_POST['product_description'];
        $price = $_POST['product_price'];
        $category = $_POST['product_category'];
        $image = file_get_contents($_FILES['product_image']['tmp_name']);

        $stmt = $conn->prepare("INSERT INTO Products (product_name, description, price, image_data, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $name, $description, $price, $image, $category);
        $stmt->execute();
        $stmt->close();
        exit;
    }
}

// Fetch data
$product_results = $conn->query("SELECT * FROM Products");
$order_results = $conn->query(
    "SELECT o.order_id, c.name AS customer_name, o.total_price, o.status, 
            GROUP_CONCAT(p.product_name SEPARATOR ', ') AS products
     FROM Orders o
     JOIN Customers c ON o.customer_id = c.customer_id
     JOIN Order_Items oi ON o.order_id = oi.order_id
     JOIN Products p ON oi.product_id = p.product_id
     GROUP BY o.order_id"
);
$message_results = $conn->query("SELECT * FROM Feedback");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homie Bake - Admin Panel</title>
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <div class="admin-container">
        <header>
            <h1>Homie Bake Admin Panel</h1>
        </header>
        
        <div class="admin-content">
            <!-- Sidebar Navigation -->
            <aside class="sidebar">
                <button onclick="showSection('products')">Products</button>
                <button onclick="showSection('orders')">Orders</button>
                <button onclick="showSection('messages')">Messages</button>
            </aside>

            <!-- Product Management Section -->
            <section id="products" class="section active">
                <h2>Product Management</h2>
                
                <div class="product-list">
                    <h3>Product List</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="product-table">
                            <?php while ($product = $product_results->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $product['product_id'] ?></td>
                                    <td><?= $product['product_name'] ?></td>
                                    <td><?= $product['description'] ?></td>
                                    <td>$<?= $product['price'] ?></td>
                                    <td><img src="data:image/jpeg;base64,<?= base64_encode($product['image_data']) ?>" alt="<?= $product['product_name'] ?>" class="product-img"></td>
                                    <td><?= $product['category'] ?></td>
                                    <td><button class="btn delete-btn" onclick="deleteProduct(this, <?= $product['product_id'] ?>)">Delete</button></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <div class="add-product">
                    <h3>Add New Product</h3>
                    <input type="text" placeholder="Product Name" id="product-name">
                    <input type="text" placeholder="Description" id="product-description">
                    <input type="number" placeholder="Price" id="product-price">
                    <input type="file" id="product-image" accept="image/*">
                    <select id="product-category">
                        <option value="Cakes">Cakes</option>
                        <option value="Cupcakes">Cupcakes</option>
                        <option value="Cookies">Cookies</option>
                    </select>
                    <button class="btn" onclick="addProduct()">Add Product</button>
                </div>
            </section>

            <!-- Order Management Section -->
            <section id="orders" class="section">
                <h2>Order Management</h2>
                <div class="order-list">
                    <h3>Order List</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Products</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Change Status</th>
                            </tr>
                        </thead>
                        <tbody id="order-table">
                            <?php while ($order = $order_results->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $order['order_id'] ?></td>
                                    <td><?= $order['customer_name'] ?></td>
                                    <td><?= $order['products'] ?></td>
                                    <td>$<?= number_format($order['total_price'], 2) ?></td>
                                    <td class="status-<?= strtolower($order['status']) ?>">
                                        <?= $order['status'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <select onchange="updateOrderStatus(<?= $order['order_id'] ?>, this.value)">
                                            <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="Confirmed" <?= $order['status'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                            <option value="Cancelled" <?= $order['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Messages Section -->
            <section id="messages" class="section">
                <h2>User Messages</h2>
                <div class="message-list">
                    <h3>Messages</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody id="message-table">
                            <?php while ($message = $message_results->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $message['name'] ?></td>
                                    <td><?= $message['email'] ?></td>
                                    <td><?= $message['message'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script src="admin.js"></script>
    <script>
        function updateOrderStatus(orderId, newStatus) {
            fetch('', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `update_order_status=true&order_id=${orderId}&new_status=${encodeURIComponent(newStatus)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log('Order status updated:', data);
                alert('Order status updated successfully!');
            });
        }</script>
