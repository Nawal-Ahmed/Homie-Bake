<?php
session_start();
$servername = "localhost";     
$username = "root";       
$password = "";       
$dbname = "homie_bake_db";   

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 1: Capture customer details
    $name = htmlspecialchars($conn->real_escape_string($_POST['name']));
    $email = htmlspecialchars($conn->real_escape_string($_POST['email']));
    $phone = htmlspecialchars($conn->real_escape_string($_POST['phone']));
    $address = htmlspecialchars($conn->real_escape_string($_POST['address']));

    // Validate session data
    if (!isset($_SESSION['cart']) || !isset($_SESSION['total_bill'])) {
        die("Cart or total bill information is missing.");
    }

    // Check if customer exists
    $stmt = $conn->prepare("SELECT customer_id FROM Customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Existing customer
        $stmt->bind_result($customer_id);
        $stmt->fetch();
    } else {
        // New customer
        $stmt = $conn->prepare("INSERT INTO customers (name, email, phone_number, address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $address);
        $stmt->execute();
        if ($stmt->error) {
            die("Error inserting customer: " . $stmt->error);
        }
        $customer_id = $stmt->insert_id;
    }
    $stmt->close();

    // Step 2: Insert order
    $total_price = $_SESSION['total_bill'];
    $stmt = $conn->prepare("INSERT INTO orders (customer_id, total_price, status) VALUES (?, ?, 'Pending')");
    $stmt->bind_param("id", $customer_id, $total_price);
    $stmt->execute();
    if ($stmt->error) {
        die("Error inserting order: " . $stmt->error);
    }
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Step 3: Insert order items
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $quantity = $item['quantity'];
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $order_id, $product_id, $quantity);
        $stmt->execute();
        if ($stmt->error) {
            die("Error inserting order item: " . $stmt->error);
        }
    }

    // Clear cart session and redirect
    unset($_SESSION['cart']);
    unset($_SESSION['total_bill']);

    echo "<script>alert('Your order has been confirmed! Thank you for your purchase.'); window.location.href = 'index.php';</script>";
    exit;
}

$conn->close();
?>