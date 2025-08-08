<?php
session_start();
include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/head.php'; ?>
    <title>Welcome to the Health Shop</title>
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
            margin: 20px auto; 
            max-width: 800px; 
            color: white; 
        }
        h1 {
            color: blue;
            text-align: center; 
        }
        h2 {
            color: skyblue; 
            text-align: center; 
        }
        form {
            display: flex;
            justify-content: center; 
            margin-bottom: 20px; 
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            flex: 1; 
            margin-right: 10px; 
        }
        input[type="submit"] {
            background-color: skyblue; 
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer; 
        }
        input[type="submit"]:hover {
            background-color: #007BFF; 
        }
        ul {
            list-style-type: none; 
            padding: 0; 
        }
        li {
            padding: 15px;
            margin-bottom: 10px; 
        }
        li img {
            max-width: 100px; 
            margin-right: 15px; 
            float: left; 
        }
        strong {
            color: #333; 
        }
    </style>
</head>
<body>
<?php include '../includes/usheader.php'; ?>
    <main>
        <h2>Searching Hospital</h2>
    </main>
</body>
</html>

<?php
$hospitals = [];
$searchTerm = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchTerm = $_POST['search_term'];
    
    $stmt = $pdo->prepare("SELECT * FROM hospitals WHERE name LIKE ? OR best_treatment LIKE ?");
    $stmt->execute(["%$searchTerm%", "%$searchTerm%"]);
    $hospitals = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Search Hospitals</title>
</head>
<body>
    <main>
        <form method="POST">
            <input type="text" name="search_term" placeholder="Enter hospital name or treatment" value="<?php echo htmlspecialchars($searchTerm); ?>" required>
            <input type="submit" value="Search">
        </form>

        <?php if (!empty($hospitals)): ?>
            <h2>Search Results</h2>
            <ul>
                <?php foreach ($hospitals as $hospital): ?>
                    <li style="background: rgb(140, 151, 201); ,border: 1px solid #ddd; ,border-radius: 5px;">
                        <h3><?php echo htmlspecialchars($hospital['name']); ?></h3>
                        <img src="../uploads/<?php echo htmlspecialchars($hospital['image']); ?>" alt="<?php echo htmlspecialchars($hospital['name']); ?>" style="width:100px;">
                        <p><strong>Address : </strong><?php echo htmlspecialchars($hospital['description']); ?></p>
                        <p><strong>Best Treatment for : </strong> <?php echo htmlspecialchars($hospital['best_treatment']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>No hospitals found matching your search criteria.</p>
        <?php endif; ?>
    </main>

</body>
</html>