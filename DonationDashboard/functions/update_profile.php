<?php
include 'includes/config.php';
session_start();

header("Content-Type: application/json");

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

$email = $_SESSION['email'];

// Get JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit();
}

$fullName = $data['fullName'] ?? null;
$userEmail = $data['userEmail'] ?? null;
$phoneNumber = $data['phoneNumber'] ?? null;
$bloodGroup = $data['bloodGroup'] ?? null;

// Prepare and execute the update query
$stmt = $conn->prepare("UPDATE users SET fullname = ?, email = ?, contact = ?, blood_group = ? WHERE email = ?");
if ($stmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
    exit();
}

$stmt->bind_param("sssss", $fullName, $userEmail, $phoneNumber, $bloodGroup, $email);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Profile updated successfully',
        'fullName' => $fullName,
        'userEmail' => $userEmail,
        'phoneNumber' => $phoneNumber,
        'bloodGroup' => $bloodGroup
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update profile']);
}

$stmt->close();
$conn->close();
?>
