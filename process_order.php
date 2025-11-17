<?php
require_once 'config.php';
session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: order.php');
    exit();
}

// Get and sanitize form data
$cart_data = isset($_POST['cart_data']) ? $_POST['cart_data'] : '';
$total_amount = floatval($_POST['total_amount']);
$customer_name = sanitizeInput($_POST['customer_name']);
$customer_email = sanitizeInput($_POST['customer_email']);
$customer_phone = sanitizeInput($_POST['customer_phone']);
$customer_address = sanitizeInput($_POST['customer_address']);
$payment_method = sanitizeInput($_POST['payment_method']);
$terms_accepted = isset($_POST['terms_accepted']) ? 1 : 0;

// Validate data
$errors = [];

// Validate cart data
$cart_items = json_decode($cart_data, true);
if (empty($cart_items) || !is_array($cart_items)) {
    $errors[] = "Invalid cart data";
}

if ($total_amount <= 0) {
    $errors[] = "Invalid total amount";
}

if (strlen($customer_name) < 3) {
    $errors[] = "Please provide a valid name";
}

if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please provide a valid email address";
}

if (strlen($customer_phone) < 10) {
    $errors[] = "Please provide a valid phone number";
}

if (strlen($customer_address) < 10) {
    $errors[] = "Please provide a complete delivery address";
}

if (!in_array($payment_method, ['gcash', 'paymaya', 'cod'])) {
    $errors[] = "Please select a valid payment method";
}

if (!$terms_accepted) {
    $errors[] = "You must accept the terms and conditions";
}

// If there are errors, redirect back
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: checkout.php');
    exit();
}

// Generate order number
$order_number = generateOrderNumber();

// Connect to database
$conn = getDBConnection();

// Begin transaction
$conn->begin_transaction();

try {
    // Insert main order
    $sql = "INSERT INTO orders (order_number, customer_name, customer_email, customer_phone, 
            customer_address, total_amount, payment_method, terms_accepted, order_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssdsi", $order_number, $customer_name, $customer_email, 
                      $customer_phone, $customer_address, $total_amount, 
                      $payment_method, $terms_accepted);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to create order");
    }
    
    $order_id = $stmt->insert_id;
    $stmt->close();
    
    // Insert order items
    $sql = "INSERT INTO order_items (order_id, product_name, quantity, price, subtotal) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    foreach ($cart_items as $item) {
        $product_name = sanitizeInput($item['name']);
        $quantity = intval($item['quantity']);
        $price = floatval($item['price']);
        $subtotal = $quantity * $price;
        
        $stmt->bind_param("isidd", $order_id, $product_name, $quantity, $price, $subtotal);
        
        if (!$stmt->execute()) {
            throw new Exception("Failed to add order items");
        }
    }
    
    $stmt->close();
    
    // Commit transaction
    $conn->commit();
    $conn->close();
    
    // Clear session errors if any
    unset($_SESSION['errors']);
    
    // Redirect to success page with script to clear cart
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Processing Order...</title>
    </head>
    <body>
        <script>
            // Clear the cart from localStorage
            localStorage.removeItem('coffeeCart');
            // Redirect to success page
            window.location.href = 'order_success.php?order=<?php echo urlencode($order_number); ?>';
        </script>
    </body>
    </html>
    <?php
    exit();
    
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    $conn->close();
    
    $_SESSION['errors'] = ["Error processing order: " . $e->getMessage()];
    header("Location: checkout.php");
    exit();
}
?>