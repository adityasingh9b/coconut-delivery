<!-- order.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Place Your Order - Kalpatru Coconut Water Home Delivery</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('images/coconut2.jpeg') no-repeat center center fixed;
            background-size: cover;
            padding: 20px;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
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
        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 16px;
            color: #2e7d32;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #81c784;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: #66bb6a;
            box-shadow: 0 0 5px rgba(102, 187, 106, 0.5);
        }
        button {
            width: 100%;
            padding: 15px;
            background-color: #66bb6a;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }
        button:hover {
            background-color: #4caf50;
        }
    </style>
</head>
<body>

<div class="container">
    <h2> Fill Your Delivery Details & take a Screenshot </h2>

    <form action="payment.php" method="get">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required placeholder="Enter your full name">

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required placeholder="Enter 10-digit phone number">

        <label for="block">Block:</label>
        <select id="block" name="block" required>
            <option value="" disabled selected>Select Block</option>
            <option value="D">Block D</option>
            <option value="E">Block E</option>
        </select>

        <label for="floor">Floor:</label>
        <input type="number" id="floor" name="floor" min="1" max="12" required placeholder="1-12">

        <label for="house_no">House Number:</label>
        <input type="text" id="house_no" name="house_no" required placeholder="E.g., 101, 202...">

        <label for="remarks">Remarks (Optional):</label>
        <textarea id="remarks" name="remarks" rows="3" placeholder="Any additional instructions..."></textarea>

        <button type="submit">Proceed to Payment</button>
    </form>
</div>

</body>
</html>

