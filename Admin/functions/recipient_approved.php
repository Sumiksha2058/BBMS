<?php
include '../includes/config.php';
$updateQuery = "UPDATE `blood_requests` SET `approval_status` = 'approved' WHERE `blood_requests`.`request_id` = `request_id`;";
if (mysqli_query($conn, $updateQuery)) {
    // Success
    header("Location: ../recivers_request.php"); 
    exit();
} else {
    // Error
    echo "Error updating record: " . mysqli_error($conn);
}

?>