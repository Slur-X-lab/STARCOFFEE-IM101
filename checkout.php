<?php
require_once 'config.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$product = sanitizeInput($_POST['product']);
$price = floatval($_POST['price']);
$quantity = intval($_POST['quantity']);
$total = floatval($_POST['total']);

// Validate data
if (empty($product) || $price <= 0 || $quantity <= 0) {
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
    <title>Checkout - STARCOFFEE</title>
    <style>
        .checkout-container {
            min-height: 100vh;
            padding: 120px 20px 50px;
        }
        
        .checkout-wrapper {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            gap: 30px;
        }
        
        .section-card {
            background: #fcfcfc;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        
        .section-title {
            color: #7E6A56;
            font-size: 1.5rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .order-summary-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .order-summary-item:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 1.2rem;
            color: #7E6A56;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        
        .form-group label .required {
            color: #e74c3c;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #7E6A56;
            outline: none;
        }
        
        .payment-methods {
            display: grid;
            gap: 15px;
            margin-top: 15px;
        }
        
        .payment-option {
            position: relative;
        }
        
        .payment-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }
        
        .payment-label {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .payment-option input[type="radio"]:checked + .payment-label {
            border-color: #7E6A56;
            background: #f5f5f5;
        }
        
        .payment-icon {
            font-size: 2rem;
            color: #7E6A56;
        }
        
        .payment-info h4 {
            color: #333;
            margin-bottom: 5px;
        }
        
        .payment-info p {
            color: #666;
            font-size: 0.9rem;
        }
        
        .terms-section {
            margin: 20px 0;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }
        
        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        
        .terms-checkbox input[type="checkbox"] {
            margin-top: 4px;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        
        .terms-checkbox label {
            cursor: pointer;
            user-select: none;
        }
        
        .terms-checkbox a {
            color: #7E6A56;
            text-decoration: underline;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 5px;
            display: none;
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
        
        .btn-primary:hover:not(:disabled) {
            background: #63533f;
            transform: translateY(-2px);
        }
        
        .btn-primary:disabled {
            background: #ccc;
            cursor: not-allowed;
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
    <header class="header" id="header">
        <nav class="nav container">
            <a href="index.php" class="nav--logo">STARCOFFEE</a>
        </nav>
    </header>

    <main class="main">
        <div class="checkout-container">
            <div class="checkout-wrapper">
                <!-- Order Summary -->
                <div class="section-card">
                    <h2 class="section-title">
                        <i class="ri-shopping-cart-2-line"></i>
                        Order Summary
                    </h2>
                    <div class="order-summary-item">
                        <span>Product:</span>
                        <strong><?php echo htmlspecialchars($product); ?></strong>
                    </div>
                    <div class="order-summary-item">
                        <span>Price per item:</span>
                        <span>₱<?php echo number_format($price, 2); ?></span>
                    </div>
                    <div class="order-summary-item">
                        <span>Quantity:</span>
                        <span><?php echo $quantity; ?></span>
                    </div>
                    <div class="order-summary-item">
                        <span>Total Amount:</span>
                        <span>₱<?php echo number_format($total, 2); ?></span>
                    </div>
                </div>

                <!-- Customer Information Form -->
                <form action="process_order.php" method="POST" id="checkoutForm">
                    <input type="hidden" name="product" value="<?php echo htmlspecialchars($product); ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                    
                    <div class="section-card">
                        <h2 class="section-title">
                            <i class="ri-user-line"></i>
                            Customer Information
                        </h2>
                        
                        <div class="form-group">
                            <label>Full Name <span class="required">*</span></label>
                            <input type="text" name="customer_name" id="customerName" required 
                                   placeholder="Enter your full name">
                            <span class="error-message" id="nameError">Please enter your full name</span>
                        </div>
                        
                        <div class="form-group">
                            <label>Email Address <span class="required">*</span></label>
                            <input type="email" name="customer_email" id="customerEmail" required 
                                   placeholder="your.email@example.com">
                            <span class="error-message" id="emailError">Please enter a valid email</span>
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <input type="tel" name="customer_phone" id="customerPhone" required 
                                   placeholder="+63 912 345 6789" pattern="[0-9+\s-]+">
                            <span class="error-message" id="phoneError">Please enter a valid phone number</span>
                        </div>
                        
                        <div class="form-group">
                            <label>Delivery Address <span class="required">*</span></label>
                            <textarea name="customer_address" id="customerAddress" required 
                                      rows="3" placeholder="Enter your complete delivery address"></textarea>
                            <span class="error-message" id="addressError">Please enter your delivery address</span>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="section-card">
                        <h2 class="section-title">
                            <i class="ri-bank-card-line"></i>
                            Payment Method
                        </h2>
                        
                        <div class="payment-methods">
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="gcash" value="gcash" required>
                                <label for="gcash" class="payment-label">
                                    <i class="ri-smartphone-line payment-icon"></i>
                                    <div class="payment-info">
                                        <h4>GCash</h4>
                                        <p>Pay securely using GCash mobile wallet</p>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="paymaya" value="paymaya">
                                <label for="paymaya" class="payment-label">
                                    <i class="ri-wallet-3-line payment-icon"></i>
                                    <div class="payment-info">
                                        <h4>PayMaya</h4>
                                        <p>Pay securely using PayMaya digital wallet</p>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="payment-option">
                                <input type="radio" name="payment_method" id="cod" value="cod">
                                <label for="cod" class="payment-label">
                                    <i class="ri-hand-coin-line payment-icon"></i>
                                    <div class="payment-info">
                                        <h4>Cash on Delivery</h4>
                                        <p>Pay with cash when your order arrives</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <span class="error-message" id="paymentError">Please select a payment method</span>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="section-card">
                        <div class="terms-section">
                            <div class="terms-checkbox">
                                <input type="checkbox" name="terms_accepted" id="termsAccepted" required>
                                <label for="termsAccepted">
                                    I agree to the <a href="#" onclick="showTerms(); return false;">Terms and Conditions</a> 
                                    and <a href="#" onclick="showPrivacy(); return false;">Privacy Policy</a>
                                </label>
                            </div>
                            <span class="error-message" id="termsError">You must accept the terms and conditions</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button type="button" class="btn btn-secondary" onclick="history.back()">
                            <i class="ri-arrow-left-line"></i> Back
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            Place Order <i class="ri-check-line"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        const form = document.getElementById('checkoutForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            let isValid = true;
            
            // Validate name
            const name = document.getElementById('customerName');
            if (name.value.trim().length < 3) {
                document.getElementById('nameError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('nameError').style.display = 'none';
            }
            
            // Validate email
            const email = document.getElementById('customerEmail');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                document.getElementById('emailError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('emailError').style.display = 'none';
            }
            
            // Validate phone
            const phone = document.getElementById('customerPhone');
            if (phone.value.trim().length < 10) {
                document.getElementById('phoneError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('phoneError').style.display = 'none';
            }
            
            // Validate address
            const address = document.getElementById('customerAddress');
            if (address.value.trim().length < 10) {
                document.getElementById('addressError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('addressError').style.display = 'none';
            }
            
            // Validate payment method
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethod) {
                document.getElementById('paymentError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('paymentError').style.display = 'none';
            }
            
            // Validate terms
            const terms = document.getElementById('termsAccepted');
            if (!terms.checked) {
                document.getElementById('termsError').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('termsError').style.display = 'none';
            }
            
            if (isValid) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="ri-loader-4-line"></i> Processing...';
                form.submit();
            }
        });
        
        function showTerms() {
            alert('Terms and Conditions:\n\n1. All orders are subject to availability\n2. Delivery times may vary\n3. Payment must be made upon delivery for COD orders\n4. Cancellations must be made at least 1 hour before delivery\n5. We reserve the right to refuse service');
        }
        
        function showPrivacy() {
            alert('Privacy Policy:\n\nYour personal information will be used solely for processing your order. We do not share your information with third parties except as necessary for order fulfillment.');
        }
    </script>
</body>
</html>