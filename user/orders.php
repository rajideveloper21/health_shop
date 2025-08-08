<?php
session_start();
include '../includes/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $item_id_to_remove = $_POST['item_id'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if (isset($item['fruit_id']) && $item['fruit_id'] == $item_id_to_remove) {
            unset($_SESSION['cart'][$key]); 
            break; 
        } elseif (isset($item['herb_id']) && $item['herb_id'] == $item_id_to_remove) {
            unset($_SESSION['cart'][$key]); 
            break; 
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $user_id = $_SESSION['user_id']; 

        foreach ($_SESSION['cart'] as $item) {
            if (isset($item['fruit_id']) && isset($item['quantity'])) {
                $fruit_id = $item['fruit_id'];
                $quantity = $item['quantity'];

                $stmt = $pdo->prepare("INSERT INTO orders (user_id, fruit_id, quantity) VALUES (?, ?, ?)");
                $stmt->execute([$user_id, $fruit_id, $quantity]);
            } elseif (isset($item['herb_id']) && isset($item['quantity'])) {
                $herb_id = $item['herb_id'];
                $quantity = $item['quantity'];

                $stmt = $pdo->prepare("INSERT INTO orders (user_id, herb_id, quantity) VALUES (?, ?, ?)");
                $stmt->execute([$user_id, $herb_id, $quantity]);
            }
        }

        unset($_SESSION['cart']);
        echo "<script>alert('Order placed successfully!'); window.location.href='view_fruits.php';</script>";
        exit();
    } else {
        echo "<script>alert('Your cart is empty.'); window.location.href='view_fruits.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Your Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../uploads/background.jpg');
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
        h2 {
            color: skyblue;
        }
        h3 {
            color: rgba(226, 111, 201, 0.8);  
        }
        .item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .item img {
            width: 100px;
            height: auto;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php include '../includes/usheader.php'; ?>
<main>
    <center><h2>Your Cart</h2></center>
    
    <h3>Cash on delivery Only</h3><br>

    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo "<ul>";
        foreach ($_SESSION['cart'] as $item) {
            if (isset($item['fruit_id'])) {
                $stmt = $pdo->prepare("SELECT * FROM fruits WHERE id = ?");
                $stmt->execute([$item['fruit_id']]);
                $fruit = $stmt->fetch();

                if ($fruit) {
                    echo "<li class='item'>";
                    $imagePath = '../uploads/' . htmlspecialchars($fruit['image']); 
                    echo "<img src='" . $imagePath . "' alt='" . htmlspecialchars($fruit['name']) . "'>";
                    echo "<div>";
                    echo "<strong>" . htmlspecialchars($fruit['name']) . "</strong> - Quantity: " . (isset($item['quantity']) ? $item['quantity'] : 0) . " - Price: ₹" . number_format($fruit['price'], 2);
                    echo " ";
                    echo "<form method='POST' style='display:inline;'>";
                    echo "<input type='hidden' name='item_id' value='" . htmlspecialchars($item['fruit_id']) . "'>";
                    echo "<input type='submit' name='remove_item' value='Remove'>";
                    echo "</form>";
                    echo "</div>";
                    echo "</li>";
                } else {
                    echo "<li>Fruit not found for ID: " . htmlspecialchars($item['fruit_id']) . "</li>";
                }
            } elseif (isset($item['herb_id'])) {
                $stmt = $pdo->prepare("SELECT * FROM herbs WHERE id = ?");
                $stmt->execute([$item['herb_id']]);
                $herb = $stmt->fetch();

                if ($herb) {
                    echo "<li class='item'>";
                    $imagePath = '../uploads/' . htmlspecialchars($herb['image']); 
                    echo "<img src='" . $imagePath . "' alt='" . htmlspecialchars($herb['name']) . "'>"; 
                    echo "<strong>" . htmlspecialchars($herb['name']) . "</strong> - Quantity: " . (isset($item['quantity']) ? $item['quantity'] : 0) . " - Price: ₹" . number_format($herb['price'], 2);
                    echo " ";
                    echo "<form method='POST' style='display:inline;'>";
                    echo "<input type='hidden' name='item_id' value='" . htmlspecialchars($item['herb_id']) . "'>";
                    echo "<input type='submit' name='remove_item' value='Remove'>";
                    echo "</form>";
                    echo "</div>";
                    echo "</li>";
                } else {
                    echo "<li>Herb not found for ID: " . htmlspecialchars($item['herb_id']) . "</li>";
                }
            }
        }
        echo "</ul>";
        echo "<form method='POST' action='orders.php'>";
        echo "<input type='hidden' name='confirm_order' value='1'>";
        echo "<input type='submit' value='Confirm Order'>";
        echo "</form>";
    } else {
        echo "<p>Your cart is empty.</p>";
    }
    ?>
</main>
</body>
</html>