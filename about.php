<?php
session_start();
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
    <title>Welcome to the Health Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('uploads/background.jpg');
            background-size: cover; /
            background-position: center; 
            margin: 0;
            padding: 20px;
        }

        nav {
            background-color: skyblue; 
            padding: 10px;
            width: 100%; 
            position: relative; 
            z-index: 1000; 
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 15px;
        }
        nav ul li a {
            color: blue; 
            text-decoration: none;
            font-weight: bold;
        }
        nav ul li a:hover {
            text-decoration: underline; 
        }
        main {
            background-color: rgba(18, 48, 61, 0.8); 
            padding: 20px;
            border-radius: 8px;
            margin: 20px;
        }
        h1 {
            color: blue; 
        }
        h2 {
            color: rgba(238, 118, 20, 0.8);skyblue; 
        }
        p {
            margin: 10px 0; 
        }

       
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
    
        </center><h1>Health Shop</h1></center>
        <p>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; At Health Shop, we are dedicated to providing you with the highest quality fruits and herbs to support your health and wellness journey. Our mission is to offer natural products that promote a healthy lifestyle.</p>
        
        <h2>Our Mission</h2>
        <p>&nbsp;&nbsp;&nbsp;&nbsp; We believe in the power of nature and its ability to heal. Our mission is to source the best organic fruits and herbs, ensuring that our customers receive only the finest products.</p>
        
        <h2>Our Values</h2>
        <ul>
            <li>Quality: We prioritize quality in every product we offer.</li>
            <li>Integrity: We operate with honesty and transparency.</li>
            <li>Customer Satisfaction: Your satisfaction is our top priority.</li>
            <li>Sustainability: We are committed to sustainable practices that protect our planet.</li>
        </ul>
        
        <h2>Contact Us</h2>
        <p> &nbsp;&nbsp;&nbsp;&nbsp; If you have any questions or feedback, feel free to reach out to us at <a href="mailto:raji@healthshop.com" style="color: lightblue;">raji@healthshop.com</a>.</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp; Phone No: 877861931</p>

       
    </main>
</body>
</html>