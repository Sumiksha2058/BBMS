<?php
include 'includes/config.php';
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    die(json_encode(['success' => false, 'message' => 'Unauthorized access.']));
}

$email = $_SESSION['email'];

// Using filter_input to sanitize input
$fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
$contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
$blood_group_id = filter_input(INPUT_POST, 'blood_group_id', FILTER_VALIDATE_INT);

$success = true;

// Prepare an array to hold any error messages
$errorMessages = [];

// Update user's personal information if provided
if ($fullname && $contact) {
    $stmt = $conn->prepare("UPDATE users SET fullname = ?, contact = ? WHERE email = ?");
    $stmt->bind_param("sss", $fullname, $contact, $email);
    
    if (!$stmt->execute()) {
        error_log("MySQL error (update personal info): " . $stmt->error);
        $success = false;
        $errorMessages[] = "Failed to update personal information.";
    }
    $stmt->close();
}

// Update blood group if a valid ID is provided
if ($blood_group_id !== null) { 
    $stmt = $conn->prepare("UPDATE users SET blood_group_id = ? WHERE email = ?");
    $stmt->bind_param("is", $blood_group_id, $email);
    
    if (!$stmt->execute()) {
        error_log("MySQL error (update blood group): " . $stmt->error);
        $success = false;
        $errorMessages[] = "Failed to update blood group.";
    }
    $stmt->close();
}

// Initialize variable for blood group response
$response_blood_group = null;

// Fetch the updated blood group if a valid ID was provided
if ($blood_group_id !== null) {
    $stmt = $conn->prepare("SELECT blood_group FROM blood_groups WHERE blood_group_id = ?");
    $stmt->bind_param("i", $blood_group_id);
    if ($stmt->execute()) {
        $stmt->bind_result($response_blood_group);
        $stmt->fetch();
    } else {
        error_log("MySQL error (fetch blood group): " . $stmt->error);
    }
    $stmt->close();
}

// If the response blood group is still null, fetch the current user's blood group
if ($response_blood_group === null) {
    $stmt = $conn->prepare("SELECT bg.blood_group FROM users u JOIN blood_groups bg ON u.blood_group_id = bg.blood_group_id WHERE u.email = ?");
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
        $stmt->bind_result($response_blood_group);
        $stmt->fetch();
    } else {
        error_log("MySQL error (fetch current blood group): " . $stmt->error);
    }
    $stmt->close();
}

// Debug output for tracking
if ($response_blood_group === null) {
    error_log("No blood group found for email: " . $email);
} else {
    error_log("Blood group found: " . $response_blood_group);
}

// Send the response back to the client, including any error messages
echo json_encode(['success' => $success, 'blood_group' => $response_blood_group, 'errors' => $errorMessages]);
?>
