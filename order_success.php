<?php
require_once 'config.php';

// Get order number from URL
$order_number = isset($_GET['order']) ? sanitizeInput($_GET['order']) : '';

if (empty($order_number)) {
    header('Location: index.php');
    exit();
}

// Fetch order details from database
$conn = getDBConnection();
$sql = "SELECT * FROM orders WHERE order_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $order_number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: index.php');
    exit();
}

$order = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/order.css">
    <title>Order Confirmed - STARCOFFEE</title>
    <style>
        .success-container {
            min-height: 100vh;
            padding: 120px 20px 50px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        .success-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .success-card {
            background: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            text-align: center;
            animation: slideUp 0.6s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .success-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounce 1s ease infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .success-icon i {
            font-size: 3.5rem;
            color: white;
        }
        
        .success-title {
            color: #7E6A56;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .success-message {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 40px;
        }
        
        .order-number-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
        }
        
        .order-number-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .order-number {
            color: #7E6A56;
            font-size: 1.8rem;
            font-weight: bold;
            letter-spacing: 2px;
        }
        
        .details-card {
            background: #fcfcfc;
            padding: 30px;
            border-radius: 15px;
            margin-top: 30px;
            text-align: left;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .details-title {
            color: #7E6A56;
            font-size: 1.3rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: #666;
            font-weight: 500;
        }
        
        .detail-value {
            color: #333;
            font-weight: 600;
            text-align: right;
        }
        
        .payment-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .payment-gcash {
            background: #007DFE;
            color: white;
        }
        
        .payment-paymaya {
            background: #00D632;
            color: white;
        }
        
        .payment-cod {
            background: #FFB800;
            color: white;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 40px;
        }
        
        .btn {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-primary {
            background: #7E6A56;
            color: white;
        }
        
        .btn-primary:hover {
            background: #63533f;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: white;
            color: #7E6A56;
            border: 2px solid #7E6A56;
        }
        
        .btn-secondary:hover {
            background: #f5f5f5;
        }
        
        .info-message {
            background: #e8f4f8;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            border-left: 4px solid #7E6A56;
        }
        
        .info-message i {
            color: #7E6A56;
            margin-right: 10px;
        }
        
        .info-message p {
            color: #555;
            margin: 0;
        }
    </style>
</head>
<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.php" class="nav--logo">STARCOFFEE</a>
        </nav>
    </header>

    <main class="main">
        <div class="success-container">
            <div class="success-wrapper">
                <div class="success-card">
                    <div class="success-icon">
                        <i class="ri-check-line"></i>
                    </div>
                    
                    <h1 class="success-title">Order Confirmed!</h1>
                    <p class="success-message">
                        Thank you for your order. We've received your request and will process it shortly.
                    </p>
                    
                    <div class="order-number-section">
                        <p class="order-number-label">Your Order Number</p>
                        <div class="order-number"><?php echo htmlspecialchars($order['order_number']); ?></div>
                    </div>
                    
                    <!-- Order Details -->
                    <div class="details-card">
                        <h3 class="details-title">
                            <i class="ri-file-list-3-line"></i>
                            Order Details
                        </h3>
                        <div class="detail-row">
                            <span class="detail-label">Product:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($order['product_name']); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Quantity:</span>
                            <span class="detail-value"><?php echo $order['quantity']; ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Price per item:</span>
                            <span class="detail-value">₱<?php echo number_format($order['price'], 2); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Total Amount:</span>
                            <span class="detail-value" style="color: #7E6A56; font-size: 1.3rem;">
                                ₱<?php echo number_format($order['total_amount'], 2); ?>
                            </span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Payment Method:</span>
                            <span class="detail-value">
                                <?php
                                $payment_class = 'payment-' . $order['payment_method'];
                                $payment_text = strtoupper($order['payment_method']);
                                if ($order['payment_method'] == 'cod') {
                                    $payment_text = 'Cash on Delivery';
                                }
                                echo "<span class='payment-badge $payment_class'>$payment_text</span>";
                                ?>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Customer Details -->
                    <div class="details-card">
                        <h3 class="details-title">
                            <i class="ri-user-line"></i>
                            Customer Information
                        </h3>
                        <div class="detail-row">
                            <span class="detail-label">Name:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($order['customer_name']); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($order['customer_email']); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Phone:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($order['customer_phone']); ?></span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Delivery Address:</span>
                            <span class="detail-value"><?php echo htmlspecialchars($order['customer_address']); ?></span>
                        </div>
                    </div>
                    
                    <div class="info-message">
                        <i class="ri-information-line"></i>
                        <p>
                            <strong>What's next?</strong><br>
                            We'll send you a confirmation email shortly. You can track your order status 
                            or contact our support team if you have any questions.
                        </p>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="index.php" class="btn btn-primary">
                            <i class="ri-home-line"></i> Back to Home
                        </a>
                        <button onclick="window.print()" class="btn btn-secondary">
                            <i class="ri-printer-line"></i> Print Receipt
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        // Confetti animation on load
        window.addEventListener('load', function() {
            // Simple celebration effect
            const card = document.querySelector('.success-card');
            card.style.animation = 'slideUp 0.6s ease';
        });
    </script>
</body>
</html>