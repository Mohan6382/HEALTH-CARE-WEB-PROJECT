<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM patients WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: about.php");
exit;
?>
