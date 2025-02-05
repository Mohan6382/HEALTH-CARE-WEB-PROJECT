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
    <title>Doctor Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <header>
        <div class="container">
            <h1>Welcome to Doctor Management System</h1>
            <p class="lead">Your one-stop solution for managing doctor appointments, patient records, and more.</p>
        </div>
    </header>

   
    <div class="container my-5">
        <h2>About Us</h2>
        <p>We provide a comprehensive platform for managing doctor appointments and patient records efficiently. Our system ensures smooth operations for both patients and healthcare providers.</p>

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

   
    <div class="container my-5">
        <h2>Meet Our Doctors</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <img class="card-img-top" src="doctor2.jpg" alt="Doctor 2">
                    <div class="card-body">
                        <h5 class="card-title">Dr. John Doe</h5>
                        <p class="card-text">Specialist in Cardiology with over 10 years of experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <img class="card-img-top" src="doctor3.jpg" alt="Doctor 3">
                    <div class="card-body">
                        <h5 class="card-title">Dr. Jane Smith</h5>
                        <p class="card-text">Expert in Pediatrics, providing compassionate care for children.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
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

   
    <footer>
        <p>&copy; 2024 Doctor Management System | All Rights Reserved</p>
    </footer>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
