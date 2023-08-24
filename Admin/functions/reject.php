<?php
include '../includes/config.php';
$updateQuery = "UPDATE `donation_requests` SET `approval_status` = 'rejected' WHERE `donation_requests`.`donation_request_id` = `donation_request_id`;";

if (mysqli_query($conn, $updateQuery)) {
    // Success
    header("Location: ../donor_request.php"); 
    exit();
} else {
    // Error
    echo "Error updating record: " . mysqli_error($conn);
}

?>
