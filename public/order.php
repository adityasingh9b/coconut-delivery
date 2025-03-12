<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and trim form data
    $name     = trim($_POST['name']);
    $phone    = trim($_POST['phone']);
    $block    = strtoupper(trim($_POST['block']));
    $floor    = trim($_POST['floor']);
    $house_no = trim($_POST['house_no']);
    $quantity = trim($_POST['quantity']);
    $remarks  = trim($_POST['remarks']);  // New remarks field

    $errors = [];

    // Validate phone number: exactly 10 digits
    if (!preg_match('/^\d{10}$/', $phone)) {
        $errors[] = "Invalid phone number. Please enter exactly 10 digits.";
    }
    // Validate block: must be D or E
    if (!in_array($block, ['D', 'E'])) {
        $errors[] = "Invalid block. Please select either D or E.";
    }
    // Validate floor: 1 to 12
    if (!preg_match('/^(1[0-2]|[1-9])$/', $floor)) {
        $errors[] = "Invalid floor. Please select a floor between 1 and 12.";
    }
    // Validate house number:
    $expectedPattern = '/^' . $floor . '0[1-8]$/';
    if (!preg_match($expectedPattern, $house_no)) {
        $errors[] = "Invalid house number for floor $floor. It should be in the format {$floor}0X (where X is between 1 and 8).";
    }
    // Validate quantity: positive integer
    if (!preg_match('/^[1-9]\d*$/', $quantity)) {
        $errors[] = "Quantity must be a positive integer.";
    }

    // If no errors, store the details in session and redirect to payment page
    if (empty($errors)) {
        $_SESSION['order'] = [
            'name'     => $name,
            'phone'    => $phone,
            'block'    => $block,
            'floor'    => $floor,
            'house_no' => $house_no,
            'quantity' => $quantity,
            'remarks'  => $remarks
        ];
        header("Location: payment.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Place Your Order - Kalpatru Coconut Water Home Delivery</title>
    <style>
        /* Different full-page background image for order page */
        body {
            font-family: 'Arial', sans-serif;
            background: url('images/coconut2.jpeg') no-repeat center center fixed;
            background-size: cover;
            padding: 20px;
            margin: 0;
        }
        /* Semi-transparent container for form */
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #388e3c;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #2e7d32;
        }
        input[type="text"], select, input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #81c784;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
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
        /* Responsive styles */
        @media (max-width: 480px) {
            .container {
                margin: 20px;
                padding: 20px;
            }
            h2 {
                font-size: 1.5rem;
            }
            button {
                font-size: 1rem;
                padding: 10px;
            }
        }
    </style>
    <script>
        function validateForm() {
            var phone = document.forms["orderForm"]["phone"].value;
            var floor = document.forms["orderForm"]["floor"].value;
            var house_no = document.forms["orderForm"]["house_no"].value;
            var quantity = document.forms["orderForm"]["quantity"].value;

            // Validate phone number: exactly 10 digits
            var phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(phone)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }
            // Validate house number based on floor
            var f = parseInt(floor);
            var houseRegex = new RegExp("^" + f + "0[1-8]$");
            if (!houseRegex.test(house_no)) {
                alert("For floor " + f + ", house number must be in the format " + f + "0X (X between 1 and 8).");
                return false;
            }
            // Validate quantity: positive integer
            if (parseInt(quantity) < 1) {
                alert("Quantity must be a positive integer.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container">
    <h2>Place Your Order</h2>
    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p class='error'>" . htmlspecialchars($error) . "</p>";
        }
    }
    ?>
    <form name="orderForm" action="order.php" method="post" onsubmit="return validateForm()">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" pattern="\d{10}" title="Enter exactly 10 digits" required>

        <label for="block">Block:</label>
        <select name="block" required>
            <option value="">Select Block</option>
            <option value="D">D</option>
            <option value="E">E</option>
        </select>

        <label for="floor">Floor:</label>
        <select name="floor" required>
            <option value="">Select Floor</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>

        <label for="house_no">House Number:</label>
        <input type="text" name="house_no" required placeholder="e.g. 301 for floor 3">

        <label for="quantity">Quantity of Coconut:</label>
        <input type="number" name="quantity" min="1" required>

        <label for="remarks">Remarks:</label>
        <textarea name="remarks" rows="3" placeholder="Any special instructions or notes (optional)"></textarea>

        <button type="submit">Proceed to Payment</button>
    </form>
</div>
</body>
</html>

