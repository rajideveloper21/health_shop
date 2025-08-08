<?php
session_start();
include 'includes/db.php';

$errors = [];
$username = '';
$cell_number = '';
$address = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $cell_number = trim($_POST['cell_number']);
    $address = trim($_POST['address']);

    if (empty($username)) {
        $errors[] = 'Username is required.';
    }
    if (empty($password)) {
        $errors[] = 'Password is required.';
    }
    if (empty($cell_number)) {
        $errors[] = 'Cell number is required.';
    }
    if (empty($address)) {
        $errors[] = 'Address is required.';
    }


    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $errors[] = 'Username already exists. Please choose another one.';
        }
    }


    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password, cell_number, address) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$username, $hashed_password, $cell_number, $address])) {
            $_SESSION['success'] = 'Registration successful! You can now log in.';
            header('Location: login.php');
            exit;
        } else {
            $errors[] = 'An error occurred while registering. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <main>
        <h1>Register</h1>

        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="cell_number">Cell Number:</label>
            <input type="text" name="cell_number" id="cell_number" value="<?php echo htmlspecialchars($cell_number); ?>" required>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($address); ?>" required>

            <input type="submit" value="Register">
        </form>

        <p>Already have an account? <a href="login.php">Log in here</a>.</p>
    </main>

</body>
</html>