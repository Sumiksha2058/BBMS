<?php
include '';

// Check if form data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    
    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header("Location: ../VitaCare/Rprofile.php");
        exit();
    }

    $email = $_SESSION['email'];
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['contact']);
    $bloodGroupId = mysqli_real_escape_string($conn, $_POST['blood_group_id']);

    try {
        // Update personal information
        $stmt = $conn->prepare("UPDATE users SET fullname = ?, contact = ? WHERE email = ?");
        $stmt->bind_param("sss", $fullname, $phoneNumber, $email);
        $stmt->execute();
        $stmt->close();

        // Update health information (blood group)
        $stmt = $conn->prepare("UPDATE users SET blood_group = ? WHERE email = ?");
        $stmt->bind_param("ss", $bloodGroupId, $email);
        $stmt->execute();
        $stmt->close();

        // Return JSON response
        echo json_encode(['success' => true, 'blood_group' => $bloodGroupId]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>
