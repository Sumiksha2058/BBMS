<?php
// functions/approve.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// phpinfo();

include '../includes/config.php'; //  database configuration file

if (isset($_GET['approve_donor']) && isset($_GET['email'])) {
    $donorId = $_GET['approve_donor'];
    $email = $_GET['email'];

    // Update the database to change the approval_status for the donor
    $updateQuery = "UPDATE users SET approval_status = 'approved' WHERE user_id = '$donorId'";

    if (mysqli_query($conn, $updateQuery)) {
        // Sending the email
        $to = $email;
        $subject = "Donation Accepted";
        $message = "Your donation request has been accepted. Here are the details: Donation Address, Donation Date, etc.";
        $headers = "From: npsumiksha@gmail.com"; // Set your own email address here

        // Check if the email was sent successfully
        if (mail($to, $subject, $message, $headers)) {
            header("Location: ../Admin/donor_request.php?success=Email sent successfully");
            exit();
        } else {
            header("Location: ../Admin/donor_request.php?error=Email sending failed");
            exit();
        }
    } else {
        // If the query fails to execute
        header("Location: ../Admin/donor_request.php?error=Failed To Donor Acceptance ");
        exit();
    }
}
?>
    