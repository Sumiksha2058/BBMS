<?php
include '../includes/config.php';
$updateQuery = "UPDATE `donation_requests` SET `approval_status` = 'approved' WHERE `donation_requests`.`donation_request_id` = `donation_request_id`;";
if (mysqli_query($conn, $updateQuery)) {
    // Success
    header("Location: ../recivers.php"); 
    exit();
} else {
    // Error
    echo "Error updating record: " . mysqli_error($conn);
}

?>