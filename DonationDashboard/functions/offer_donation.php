<?php
include 'includes/config.php';
// Check if the session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

// Handle donation offer submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $request_id = mysqli_real_escape_string($conn, $_POST['request_id']);
    $user_id = $_SESSION['user_id']; // Ensure user_id is stored in the session

    $stmt = $conn->prepare("INSERT INTO donation_offers (user_id, request_id, donor_email) VALUES (?, ?, ?)");
    $donor_email = $_SESSION['email']; // Get donor email from the session
    $stmt->bind_param("iis", $user_id, $request_id, $donor_email);
    
    // Execute the statement and check for errors
    if ($stmt->execute()) {
        header("Location: ../DonationDashboard/index.php?success=1");
        exit();
    } else {
        error_log("Error inserting offer: " . $stmt->error); // Log the error
        header("Location: ../DonationDashboard/index.php?error=" . urlencode($stmt->error));
        exit();
    }
    

    $stmt->close();
}
?>
