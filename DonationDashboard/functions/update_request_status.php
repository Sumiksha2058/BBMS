<?php
include '../includes\config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

// Check if the form is submitted and action is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_id'], $_POST['action'])) {

    $appointment_id = $_POST['appointment_id'];
    $action = $_POST['action'];

    // Define the new status based on action
    $status = ($action === 'accept') ? 'Accepted' : 'Rejected';

    // Update the appointment status in the database
    $stmt = $conn->prepare("UPDATE active_donor_table SET request_status = ? WHERE id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("si", $status, $appointment_id);

    // Execute the update statement
    if ($stmt->execute()) {
        // Redirect back to the previous page after successful update
        header("location: appointments.php"); // Change 'appointments.php' to your appointments page
        exit();
    } else {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
} else {
    die("Invalid request.");
}
?>
