<?php
session_start();
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/adhead.php'; ?>
    <title>Welcome to the Health Shop</title>
    <style>
        body {
            background-image: url('../uploads/background.jpg'); 
            background-size: cover;
            color: white; 
            font-family: Arial, sans-serif;
            margin: 0; 
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
            color: skyblue;
        }
        input[type="text"],
        input[type="file"],
        input[type="number"],
        textarea {
            width: 100%; 
            padding: 10px;
            margin: 5px 0 20px 0; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
        }
        input[type="submit"] {
            background-color: blue; 
            color: white; 
            border: none; 
            padding: 10px 15px; 
            border-radius: 4px; 
            cursor: pointer; 
        }
        input[type="submit"]:hover {
            background-color: darkblue; 
        }
    </style>
</head>
<body>
    <?php include '../includes/admin_header.php'; ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['fruit_name'];
        $image = $_FILES['fruit_image']['name'];
        $description = $_POST['fruit_description'];
        $price = $_POST['fruit_price']; 

        move_uploaded_file($_FILES['fruit_image']['tmp_name'], "../uploads/$image");

        $stmt = $pdo->prepare("INSERT INTO fruits (name, image, description, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $image, $description, $price]);

        echo "<p>Fruit added successfully!</p>";
    }
    ?>

    <main>
        <h2>Add Fruit</h2><br><br>
        <form method="POST" enctype="multipart/form-data">
            Fruit Name: <input type="text" name="fruit_name" required><br><br>
            Fruit Image: <input type="file" name="fruit_image" required><br><br>
            Description: <textarea name="fruit_description" required></textarea><br><br>
            Price: <input type="number" name="fruit_price" step="0.01" required><br><br> 
            <input type="submit" value="Submit">
        </form>
    </main>
</body>
</html>