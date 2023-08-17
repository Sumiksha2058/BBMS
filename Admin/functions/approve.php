<?php
include 'includes/config.php'; // Include the database connection

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Update donor's approval status to 'approved'
    $updateQuery = "UPDATE donor SET approval_status = 'approved' WHERE d_id = $d_id";
    mysqli_query($conn, $updateQuery);

    // Redirect back to the page where the action was initiated
    header("Location: donor.php"); 
    exit();
}
?>