<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $error = "Username or email already exists. Please choose a different one.";
    } else {
        
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <?php if (isset($error)): ?>
                <p class="text-danger mt-2"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>
    <footer>
        <p>&copy; 2024 Doctor Management System | All Rights Reserved</p>
    </footer>
</body>
</html>
