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
    <title>Our Services</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h2>Our Services</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="doctor1.jpg" alt="Doctor">
                    <div class="card-body">
                        <h5 class="card-title">Doctor Appointments</h5>
                        <p class="card-text">Book appointments with experienced doctors easily and conveniently.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="history.jpg" alt="Medical History">
                    <div class="card-body">
                        <h5 class="card-title">Medical History</h5>
                        <p class="card-text">Access and manage your medical history with ease.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="dashboard.jpg" alt="Dashboard">
                    <div class="card-body">
                        <h5 class="card-title">Dashboard</h5>
                        <p class="card-text">Manage your profile and appointments through a personal dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Doctor Management System | All Rights Reserved</p>
    </footer>
</body>
</html>
