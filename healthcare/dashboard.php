<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';


$user_id = $_SESSION['user_id'];
$userStmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$userStmt->execute([$user_id]);
$user = $userStmt->fetch();


$patientStmt = $pdo->prepare("SELECT gender, COUNT(*) as count FROM patients GROUP BY gender");
$patientStmt->execute();
$patientData = $patientStmt->fetchAll(PDO::FETCH_ASSOC);

$patientCounts = [];
$patientLabels = [];
foreach ($patientData as $data) {
    $patientCounts[] = $data['count'];
    $patientLabels[] = $data['gender'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        <h2>Your Dashboard</h2>

        
        <div class="row">
            <div class="col-md-6">
                <canvas id="patientPieChart"></canvas>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Doctor Management System | All Rights Reserved</p>
    </footer>

    <script>
        var ctx = document.getElementById('patientPieChart').getContext('2d');
        var patientPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($patientLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($patientCounts); ?>,
                    backgroundColor: ['#4a90e2', '#50c878'],
                    hoverBackgroundColor: ['#357abd', '#41b76e']
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Patient Gender Distribution'
                }
            }
        });
    </script>
</body>
</html>
