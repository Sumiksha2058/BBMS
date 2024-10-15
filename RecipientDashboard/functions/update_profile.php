<?php
include 'includes/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the session email is set
    if (!isset($_SESSION['email'])) {
        die('Unauthorized access');
    }

    $email = $_SESSION['email'];

    // Sanitize the inputs
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    
    // Optional: Validate email if the user can update it
    if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
    }

    // Prepare the SQL query to update the user's profile
    $stmt = $conn->prepare("UPDATE users SET fullname = ?, contact = ? WHERE email = ?");
    $stmt->bind_param("sss", $fullname, $contact, $email);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
