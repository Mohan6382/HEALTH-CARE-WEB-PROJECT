<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
       
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE patients SET name=?, age=?, gender=?, contact=?, email=?, address=? WHERE id=?");
        $stmt->execute([$name, $age, $gender, $contact, $email, $address, $id]);
    } else {
        
        $stmt = $pdo->prepare("INSERT INTO patients (name, age, gender, contact, email, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $age, $gender, $contact, $email, $address]);
    }

    header("Location: about.php");
    exit;
}


$stmt = $pdo->prepare("SELECT * FROM patients");
$stmt->execute();
$patients = $stmt->fetchAll();


$apptStmt = $pdo->prepare("SELECT CONCAT(d.name, ' (', d.specialization, ')') AS title, CONCAT(a.appointment_date, 'T', a.appointment_time) AS start FROM appointments a JOIN doctors d ON a.doctor_id = d.id");
$apptStmt->execute();
$appointments = $apptStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h2>About Us</h2>
        <p>We provide a comprehensive platform for managing doctor appointments and patient records efficiently. Our system ensures smooth operations for both patients and healthcare providers.</p>

        <h3>Add/Edit Patient Information</h3>
        <form action="about.php" method="post">
            <input type="hidden" name="id" id="patient_id">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" name="contact" id="contact" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h3 class="mt-5">Patient Information</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($patient['name']); ?></td>
                        <td><?php echo htmlspecialchars($patient['age']); ?></td>
                        <td><?php echo htmlspecialchars($patient['gender']); ?></td>
                        <td><?php echo htmlspecialchars($patient['contact']); ?></td>
                        <td><?php echo htmlspecialchars($patient['email']); ?></td>
                        <td><?php echo htmlspecialchars($patient['address']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" data-id="<?php echo $patient['id']; ?>" data-name="<?php echo htmlspecialchars($patient['name']); ?>" data-age="<?php echo $patient['age']; ?>" data-gender="<?php echo $patient['gender']; ?>" data-contact="<?php echo htmlspecialchars($patient['contact']); ?>" data-email="<?php echo htmlspecialchars($patient['email']); ?>" data-address="<?php echo htmlspecialchars($patient['address']); ?>">Edit</button>
                            <a href="delete.php?id=<?php echo $patient['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3 class="mt-5">Doctor Calendar</h3>
        <div id="calendar"></div>
    </div>
    <footer>
        <p>&copy; 2024 Doctor Management System | All Rights Reserved</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script>
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', event => {
                const patient = button.dataset;
                document.getElementById('patient_id').value = patient.id;
                document.getElementById('name').value = patient.name;
                document.getElementById('age').value = patient.age;
                document.getElementById('gender').value = patient.gender;
                document.getElementById('contact').value = patient.contact;
                document.getElementById('email').value = patient.email;
                document.getElementById('address').value = patient.address;
            });
        });

        $(document).ready(function() {
            $('#calendar').fullCalendar({
                events: <?php echo json_encode($appointments); ?>
            });
        });
    </script>
</body>
</html>
