<?php
require_once 'config.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Get and sanitize form data
$product = sanitizeInput($_POST['product']);
$price = floatval($_POST['price']);
$quantity = intval($_POST['quantity']);
$total = floatval($_POST['total']);
$customer_name = sanitizeInput($_POST['customer_name']);
$customer_email = sanitizeInput($_POST['customer_email']);
$customer_phone = sanitizeInput($_POST['customer_phone']);
$customer_address = sanitizeInput($_POST['customer_address']);
$payment_method = sanitizeInput($_POST['payment_method']);
$terms_accepted = isset($_POST['terms_accepted']) ? 1 : 0;

// Validate data
$errors = [];

if (empty($product) || $price <= 0 || $quantity <= 0) {
    $errors[] = "Invalid product information";
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

// Prepare SQL statement
$sql = "INSERT INTO orders (order_number, customer_name, customer_email, customer_phone, 
        customer_address, product_name, quantity, price, total_amount, payment_method, 
        terms_accepted, order_status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssiddsi", $order_number, $customer_name, $customer_email, 
                  $customer_phone, $customer_address, $product, $quantity, 
                  $price, $total, $payment_method, $terms_accepted);

// Execute the statement
if ($stmt->execute()) {
    $order_id = $stmt->insert_id;
    
    // Close connections
    $stmt->close();
    $conn->close();
    
    // Redirect to success page
    header("Location: order_success.php?order=" . urlencode($order_number));
    exit();
} else {
    // Error occurred
    $error_message = "Error processing order: " . $conn->error;
    $stmt->close();
    $conn->close();
    
    // Redirect back with error
    header("Location: checkout.php?error=" . urlencode($error_message));
    exit();
}
?>