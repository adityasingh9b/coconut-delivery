<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalpatru Coconut Water Home Delivery</title>
    <style>
        /* Full screen hero with background image */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Arial', sans-serif;
        }
        .hero {
            position: relative;
            height: 100vh;
            background: url('images/coconut1.jpeg') no-repeat center center/cover;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
        }
        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: left;
            max-width: 90%;
            padding: 0 10px;
            color: #fff;
        }
        .hero-text h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: bold;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.8);
        }
        .hero-details p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            padding: 10px 20px;
            background: rgba(0,0,0,0.6);
            display: inline-block;
            border-radius: 8px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        }
        .hero-button {
            text-align: center;
            margin-top: 20px;
        }
        a.button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #66bb6a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.25rem;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.5);
            transition: background-color 0.3s ease;
        }
        a.button:hover {
            background-color: #4caf50;
        }
        /* Responsive adjustments */
        @media (max-width: 480px) {
            .hero-text h1 {
                font-size: 2rem;
            }
            .hero-details p {
                font-size: 1rem;
            }
            a.button {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-text">
            <h1>Kalpatru Coconut Water Home Delivery</h1>
            <div class="hero-details">
                <p>
                    <strong>Why Choose Coconut Water?</strong><br>
                    • Replenishes vital electrolytes lost in the heat<br>
                    • Provides pure, natural hydration without added sugars<br>
                    • Boosts energy and aids digestion<br>
                    • Keeps you cool and refreshed all summer long
                </p>
            </div>
            <div class="hero-button">
                <a href="order.html" class="button">Click here to Order Now</a>
            </div>
        </div>
    </div>
</body>
</html>


