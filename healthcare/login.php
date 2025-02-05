<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
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
