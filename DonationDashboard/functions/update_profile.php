<?php
include 'includes/config.php';


if (!isset($_SESSION['email'])) {
    die('Unauthorized access');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];

    // Sanitize and validate input data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);

    // Prepare update statement
    $stmt = $conn->prepare("UPDATE users SET fullname = ?, contact = ?, blood_group = ? WHERE email = ?");
    $stmt->bind_param("ssss", $fullname, $contact, $blood_group, $email);

    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
