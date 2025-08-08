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
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color:rgb(133, 182, 221);
        }
        img {
            width: 100px;
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
    </style>
</head>
<body>
<?php include '../includes/admin_header.php'; ?>
    <main>
        <h1>Available Fruits</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price (1/2 KG)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM fruits");
                $fruits = $stmt->fetchAll();

                foreach ($fruits as $fruit) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fruit['name']) . "</td>";
                    echo "<td><img src='../uploads/" . htmlspecialchars($fruit['image']) . "' alt='" . htmlspecialchars($fruit['name']) . "'></td>";
                    echo "<td>" . htmlspecialchars($fruit['description']) . "</td>";
                    echo "<td>₹" . number_format($fruit['price'], 2) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>