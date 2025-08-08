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
            background-size: cover; 
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
            color: blue; /* Header color */
        }
        h2 {
            color: skyblue; /* Header color */
        }
        .herb-item {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .herb-item img {
            max-width: 100%; 
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?> 
    <main>
        <h2>Available Herbs</h2>

        <?php
        
        $stmt = $pdo->query("SELECT * FROM herbs");
        $herbs = $stmt->fetchAll();

        
        foreach ($herbs as $herb) {
            echo "<div class='herb-item'>"; 
            echo "<h3>" . htmlspecialchars($herb['name']) . "</h3>";
            echo "<img src='uploads/" . htmlspecialchars($herb['image']) . "' alt='" . htmlspecialchars($herb['name']) . "' style='width:100px;'><br>";
            echo "<p>" . htmlspecialchars($herb['description']) . "</p>";
            echo "<p>Price (1/2 KG): ₹" . number_format($herb['price'], 2) . "</p>"; 
            echo "</div><br>";
        }
        ?>
    </main>
</body>
</html>