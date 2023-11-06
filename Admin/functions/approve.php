<?php
// functions/approve.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/config.php'; //  database configuration file

if (isset($_GET['approve_donor']) && isset($_GET['email'])) {
    $donorId = $_GET['approve_donor'];
    $email = $_GET['email'];

    // Update the database to change the approval_status for the donor
    $updateQuery = "UPDATE users SET approval_status = 'approved' WHERE user_id = '$donorId'";

    if (mysqli_query($conn, $updateQuery)) {
        $request_approval_status = 'approved'; // Assuming this variable contains the request approval status
        $approved_user_id = $donorId; // Assuming this variable contains the approved user's ID

        if ($request_approval_status === 'approved') {
            $user_id = $approved_user_id; // Obtain the approved user's ID
            $donation_date = date("Y-m-d"); // Get the current date

            // Insert into the donors table
            $blood_units_donated = 1; // Assuming one unit of blood is donated each time
            $donor_insert_query = "INSERT INTO donors (user_id, donation_date, blood_units_donated) VALUES ('$user_id', '$donation_date', '$blood_units_donated')";

            // Execute the query
            if (mysqli_query($conn, $donor_insert_query)) {
                // The insertion was successful
                // You can perform any necessary actions here
            } else {
                // The insertion failed
                // Handle the error as needed
            }
        } else {
            // The donation request was not approved
            // Handle this case appropriately
        }

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
