<?php
include '../includes/config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_id'])) {
    $appointment_id = $_POST['appointment_id'];
    $status = 'reject';

    $stmt = $conn->prepare("UPDATE active_donor_table SET request_status = ? WHERE id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("si", $status, $appointment_id);

    if ($stmt->execute()) {
        header("location: http://localhost/BBMS/DonationDashboard/Appointment.php");
        exit();
    } else {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
} else {
    die("Invalid request.");
}
?>
