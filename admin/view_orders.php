<?php
session_start();
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/adhead.php'; ?>
    <title>View Orders - Health Shop</title>
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
            background-color: rgb(133, 182, 221);
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
        <h1>View Orders</h1>

        <?php
        $stmt = $pdo->query("
            SELECT o.id AS order_id, o.user_id, o.order_date, 
                   f.id AS fruit_id, f.name AS fruit_name, o.quantity AS fruit_quantity,
                   h.id AS herb_id, h.name AS herb_name, o.herb_quantity AS herb_quantity
            FROM orders o 
            LEFT JOIN fruits f ON o.fruit_id = f.id 
            LEFT JOIN herbs h ON o.herb_id = h.id
        ");
        $orders = $stmt->fetchAll();

        if (count($orders) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Fruit ID</th>
                    <th>Fruit Name</th>
                    <th>Herb ID</th>
                    <th>Herb Name</th>
                    <th>Order Date</th>
                  </tr>";

            foreach ($orders as $order) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($order['order_id']) . "</td>";
                echo "<td>" . (isset($order['user_id']) ? htmlspecialchars($order['user_id']) : 'N/A') . "</td>";
                echo "<td>" . (isset($order['fruit_id']) ? htmlspecialchars($order['fruit_id']) : 'N/A') . "</td>";
                echo "<td>" . (isset($order['fruit_name']) ? htmlspecialchars($order['fruit_name']) : 'N/A') . "</td>";
                echo "<td>" . (isset($order['herb_id']) ? htmlspecialchars($order['herb_id']) : 'N/A') . "</td>";
                echo "<td>" . (isset($order['herb_name']) ? htmlspecialchars($order['herb_name']) : 'N/A') . "</td>";
                echo "<td>" . htmlspecialchars($order['order_date']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No orders found.</p>";
        }
        ?>
    </main>
</body>
</html>