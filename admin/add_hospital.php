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
        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
    $name = $_POST['hospital_name'];
    $image = $_FILES['hospital_image']['name'];
    $description = $_POST['hospital_description'];
    $best_treatment = $_POST['best_treatment'];

    move_uploaded_file($_FILES['hospital_image']['tmp_name'], "../uploads/$image");

    $stmt = $pdo->prepare("INSERT INTO hospitals (name, image, description, best_treatment) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $image, $description, $best_treatment]);

    echo "Hospital added successfully!";
}
?>
<main>
<h2>Add Hospital</h2><br><br>
<form method="POST" enctype="multipart/form-data">
    Hospital Name: <input type="text" name="hospital_name" required><br><br><br>
    Hospital Image: <input type="file" name="hospital_image" required><br><br><br>
    Address: <textarea name="hospital_description" required></textarea><br><br><br>
    Best Treatment Disease: <input type="text" name="best_treatment" required><br><br><br>
    <input type="submit" value="Submit">
</form>
</main>
</body>
</html>