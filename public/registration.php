<?php
// registration.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = trim($_POST['name']);
    $house_no = trim($_POST['house_no']);

    // Handle file upload for payment screenshot
    $target_dir = "uploads/";
    // Append timestamp to the original file name to avoid overwrites
    $file_name = time() . "_" . basename($_FILES["payment_screenshot"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verify that the file is an image
    $check = getimagesize($_FILES["payment_screenshot"]["tmp_name"]);
    if($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($uploadOk && move_uploaded_file($_FILES["payment_screenshot"]["tmp_name"], $target_file)) {
        // Prepare notification email for new registration
        $to = "admin@example.com"; // Replace with your email
        $subject = "New Apartment Member Registration";
        $message = "A new member has registered:\n\nName: $name\nHouse No: $house_no\nPayment screenshot path: $target_file";
        $headers = "From: no-reply@yourdomain.com"; // Replace with your domain email

        // Send the notification email
        if(mail($to, $subject, $message, $headers)) {
            echo "Registration successful. Notification sent.";
        } else {
            echo "Registration saved, but failed to send notification.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Apartment Member Registration</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        .container { background: #fff; padding: 20px; max-width: 400px; margin: auto; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.3); }
        h2 { text-align: center; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Apartment Member Registration</h2>
        <form action="registration.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="house_no">House Number:</label>
            <input type="text" name="house_no" required>

            <label for="payment_screenshot">Upload Payment Screenshot:</label>
            <input type="file" name="payment_screenshot" accept="image/*" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

