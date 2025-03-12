<?php
session_start();
if (!isset($_SESSION['order'])) {
    header("Location: order.php");
    exit;
}
$order = $_SESSION['order'];
$totalAmount = $order['quantity'] * 50; // Each coconut costs Rs.50

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the uploaded payment screenshot
    $target_dir = "uploads/";
    $file_name = time() . "_" . basename($_FILES["payment_screenshot"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES["payment_screenshot"]["tmp_name"]);
    if ($check === false) {
        $error = "File is not a valid image.";
        $uploadOk = 0;
    }

    if ($uploadOk && move_uploaded_file($_FILES["payment_screenshot"]["tmp_name"], $target_file)) {
        // Prepare notification (email & SMS pseudo-code)
        $message = "New Order Details:\n\nName: {$order['name']}\nPhone: {$order['phone']}\nBlock: {$order['block']}\nFloor: {$order['floor']}\nHouse No: {$order['house_no']}\nQuantity: {$order['quantity']}\nTotal Amount: Rs. $totalAmount\nPayment Screenshot: $target_file";
        
        $to = "acpedwardlivingston@gmail.com"; // Replace with your email
        $subject = "New Coconut Water Order Received";
        $headers = "From: no-reply@yourdomain.com";
        $emailSent = mail($to, $subject, $message, $headers);

        // SMS Notification (pseudo-code)
        $admin_mobile = "9369250645";
        $sms_message = "New order from {$order['name']} for {$order['quantity']} coconut(s) (Rs. $totalAmount). Check details.";
        // Integration with your SMS API goes here.
        $smsSent = true; // For demonstration, assume SMS was sent

        // Clear session data
        unset($_SESSION['order']);
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Order Confirmation - Kalpatru Coconut Water Home Delivery</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background: url('images/summer-coconut.jpg') no-repeat center center fixed;
                    background-size: cover;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .container {
                    text-align: center;
                    background: rgba(255, 255, 255, 0.95);
                    padding: 40px;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
                }
                /* Simple fade-in animation */
                @keyframes fadeIn {
                    from { opacity: 0; transform: scale(0.9); }
                    to { opacity: 1; transform: scale(1); }
                }
                .confirmation {
                    animation: fadeIn 1s ease-in-out;
                }
                .home-button {
                    margin-top: 20px;
                    padding: 15px 30px;
                    background-color: #66bb6a;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    font-size: 16px;
                    cursor: pointer;
                    text-decoration: none;
                }
                .home-button:hover {
                    background-color: #4caf50;
                }
            </style>
        </head>
        <body>
            <div class="container confirmation">
                <h2>Order Placed Successfully!</h2>
                <p>Thank you, <?php echo htmlspecialchars($order['name']); ?>. Your order for <?php echo htmlspecialchars($order['quantity']); ?> coconut(s) totaling Rs. <?php echo $totalAmount; ?> has been received.</p>
                <p>You will receive order updates on your mobile shortly.</p>
                <a href="index.php" class="home-button">Return to Home</a>
            </div>
        </body>
        </html>
        <?php
        exit;
    } else {
        $error = isset($error) ? $error : "Error uploading payment screenshot.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment - Kalpatru Coconut Water Home Delivery</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('images/coconut3.jpeg') no-repeat center center fixed;
            background-size: cover;
            padding: 20px;
            margin: 0;
        }
        .container {
            background: rgba(255,255,255,0.9);
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            text-align: center;
        }
        h2 {
            color: #388e3c;
        }
        .payment-info {
            background: #f1f8e9;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            border: 1px solid #c5e1a5;
        }
        .payment-info img {
            max-width: 150px;
            margin-top: 10px;
        }
        form {
            margin-top: 20px;
        }
        input[type="file"] {
            padding: 10px;
        }
        button {
            width: 100%;
            padding: 15px;
            background-color: #66bb6a;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            margin-top: 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4caf50;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Payment</h2>
    <p>Dear <?php echo htmlspecialchars($order['name']); ?>, please complete your payment for your order of <?php echo htmlspecialchars($order['quantity']); ?> coconut(s).</p>
    <p><strong>Total Amount to be Paid: Rs. <?php echo $totalAmount; ?></strong></p>
    <div class="payment-info">
        <h3>Payment Details</h3>
        <p>UPI Number: 9369250645</p>
        <p>Scan the QR Code for quick payment:</p>
        <img src="images/upi.jpeg" alt="QR Code for Payment">
    </div>
    <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form action="payment.php" method="post" enctype="multipart/form-data">
        <label for="payment_screenshot">Upload Payment Screenshot:</label>
        <input type="file" name="payment_screenshot" accept="image/*" required>
        <button type="submit">Submit Payment</button>
    </form>
</div>
</body>
</html>

