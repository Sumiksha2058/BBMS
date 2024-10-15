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
            $bloodStorage_date = date("Y-m-d"); // Set the blood storage date as the current date
            $expiryDate = date('Y-m-d', strtotime($donation_date. ' + 42 days')); // Set the blood expiry date 42 days from the donation date

            // Insert into the donors table
            $blood_units_donated = 1; // Assuming one unit of blood is donated each time
            $donor_insert_query = "INSERT INTO donors (user_id, donation_date, blood_units_donated, bloodStorage_date, bloodExpiry_date) 
                                   VALUES ('$user_id', '$donation_date', '$blood_units_donated', '$bloodStorage_date', '$expiryDate')";

            // Execute the query
            if (mysqli_query($conn, $donor_insert_query)) {
                // The insertion was successful

            } else {
                // The insertion failed
                // Handle the error as needed
            }
        } else {
            // The donation request was not approved
            // Handle this case appropriately
            echo '<div class="text-denger">
            <span>Donor is not accepted</span>
            </div>';
        }
    } else {
        // If the query fails to execute
        header("Location: ../Admin/donor_request.php?error=Failed To Donor Acceptance ");
        exit();
    }
}
