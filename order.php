<?php
require_once 'config.php';

// Get product details from URL
$product = isset($_GET['product']) ? sanitizeInput($_GET['product']) : '';
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0;

if (empty($product) || $price <= 0) {
    header('Location: index.php');
    exit();
}
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
    <title>Order - STARCOFFEE</title>
    <style>
        .order-container {
            min-height: 100vh;
            padding: 120px 20px 50px;
        }
        
        .order-card {
            max-width: 600px;
            margin: 0 auto;
            background: #fcfcfc;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        
        .order-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .order-header h1 {
            color: #7E6A56;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .product-preview {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .product-preview-icon {
            font-size: 3rem;
            color: #7E6A56;
        }
        
        .product-info h3 {
            color: #7E6A56;
            font-size: 1.3rem;
            margin-bottom: 5px;
        }
        
        .product-info .price {
            color: #666;
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .quantity-section {
            margin: 30px 0;
        }
        
        .quantity-section label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .quantity-control {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
        
        .quantity-btn {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #7E6A56;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .quantity-btn:hover {
            background-color: #63533f;
            transform: scale(1.1);
        }
        
        .quantity-input {
            width: 80px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            border: 2px solid #7E6A56;
            border-radius: 10px;
            padding: 10px;
            color: #7E6A56;
        }
        
        .total-section {
            background: #7E6A56;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
            text-align: center;
        }
        
        .total-section h3 {
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        
        .total-amount {
            font-size: 2rem;
            font-weight: bold;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
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
            background: #ddd;
            color: #333;
        }
        
        .btn-secondary:hover {
            background: #ccc;
        }
    </style>
</head>
<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.php" class="nav--logo">STARCOFFEE</a>
        </nav>
    </header>

    <!--==================== MAIN ====================-->
    <main class="main">
        <div class="order-container">
            <div class="order-card">
                <div class="order-header">
                    <h1>Your Order</h1>
                    <p>Customize your order below</p>
                </div>

                <div class="product-preview">
                    <i class="ri-cup-fill product-preview-icon"></i>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product); ?></h3>
                        <p class="price">₱<?php echo number_format($price, 2); ?></p>
                    </div>
                </div>

                <form action="checkout.php" method="POST" id="orderForm">
                    <input type="hidden" name="product" value="<?php echo htmlspecialchars($product); ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    
                    <div class="quantity-section">
                        <label>Select Quantity:</label>
                        <div class="quantity-control">
                            <button type="button" class="quantity-btn" onclick="decreaseQuantity()">
                                <i class="ri-subtract-line"></i>
                            </button>
                            <input type="number" id="quantity" name="quantity" class="quantity-input" value="1" min="1" max="10" readonly>
                            <button type="button" class="quantity-btn" onclick="increaseQuantity()">
                                <i class="ri-add-line"></i>
                            </button>
                        </div>
                    </div>

                    <div class="total-section">
                        <h3>Total Amount</h3>
                        <p class="total-amount" id="totalAmount">₱<?php echo number_format($price, 2); ?></p>
                        <input type="hidden" name="total" id="totalInput" value="<?php echo $price; ?>">
                    </div>

                    <div class="action-buttons">
                        <a href="index.php" class="btn btn-secondary">
                            <i class="ri-arrow-left-line"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Proceed to Checkout <i class="ri-arrow-right-line"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const pricePerUnit = <?php echo $price; ?>;
        
        function updateTotal() {
            const quantity = parseInt(document.getElementById('quantity').value);
            const total = pricePerUnit * quantity;
            document.getElementById('totalAmount').textContent = '₱' + total.toFixed(2);
            document.getElementById('totalInput').value = total.toFixed(2);
        }
        
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            if (input.value < 10) {
                input.value = parseInt(input.value) + 1;
                updateTotal();
            }
        }
        
        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
                updateTotal();
            }
        }
    </script>
</body>
</html>