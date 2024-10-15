<?php
include '../includes/config.php';

if (isset($_GET['rejected_donor'])) {
    $user_id = $_GET['rejected_donor'];

    // Use prepared statement to update the approval_status
    $stmt = $conn->prepare("UPDATE users SET approval_status = 'rejected' WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Redirect back to the donor requests page
    header("Location: ../donor_request.php");
    exit();
} else {
    echo "Invalid request";
}
?>
