<?php
// functions/approve.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../includes/config.php';

if (isset($_GET['request_recipient'])) {
    $request_id = $_GET['request_recipient'];
    $updateQuery = "UPDATE `blood_requests` SET `approval_status` = 'approved' WHERE `request_id` = '$request_id';";

    if (mysqli_query($conn, $updateQuery)) {
        // Success
        header("Location: ../recivers_request.php"); 
        exit();
    } else {
        // Error
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
