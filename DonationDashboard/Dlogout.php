<?php
session_start(); // Start the session

// Include the configuration file to connect to the database
include 'includes/config.php';

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Update user status to 0 (logged out)
    $stmt = $conn->prepare("UPDATE users SET status = 0 WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    if ($stmt->execute()) {
        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    // If no session, just redirect to login page
    header("Location: ../index.php");
    exit();
}

$conn->close();
?>
