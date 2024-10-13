<!-- index.html -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .buy-now-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product-summary {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .qr-code-section {
            margin-top: 20px;
            text-align: center;
        }
        .qr-code-section img {
            width: 200px;
            height: 200px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="buy-now-container">
        <h1>Checkout</h1>

        <div class="product-summary">
            <h3>Product: <?= esc($product->name); ?></h3>
            <p>Price: ₹<?= esc($product->price); ?></p>
        </div>

        <!-- Payment Form -->
        <form action="<?= base_url('order/processPayment') ?>" method="post">
            <?= csrf_field() ?>

            <!-- Address Input -->
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required class="form-control"></textarea>
            </div>

            <!-- Phone Input -->
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required pattern="[0-9]{10}" class="form-control">
            </div>

            <!-- Razorpay Payment Button -->
            <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="your_razorpay_key"  <!-- Replace with your Razorpay Key -->
                data-amount="<?= $product->price * 100 ?>"  <!-- Amount in paise -->
                data-currency="INR"
                data-order_id="<?= esc($order_id); ?>"  <!-- Pass the generated order ID -->
                data-buttontext="Pay with Razorpay"
                data-name="<?= esc($product->name); ?>"
                data-description="Purchase Product"
                data-image="<?= base_url($product->image_path) ?>"
                data-prefill.name="<?= esc($user_name); ?>"
                data-prefill.email="<?= esc($user_email); ?>"
                data-theme.color="#F37254">
            </script>

            <!-- Hidden Input to Store Order ID -->
            <input type="hidden" name="order_id" value="<?= esc($order_id); ?>">

            <!-- Submit Button to Complete Payment -->
            <button type="submit" class="btn btn-primary">Complete Payment</button>
        </form>

        <!-- QR Code Section for UPI Payment -->
        <div class="qr-code-section">
            <h3>Pay via UPI</h3>
            <img src="<?= base_url('uploads/qr_codes/payment_qr_' . esc($order_id) . '.png') ?>" alt="QR Code for UPI Payment">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>