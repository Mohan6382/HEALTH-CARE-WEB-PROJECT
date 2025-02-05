<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h2>Contact Us</h2>
        <form>
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="4" placeholder="Write your message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Send Message</button>
        </form>
    </div>
</body>
</html>
