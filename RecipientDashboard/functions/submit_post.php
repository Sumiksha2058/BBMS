<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
// Include the configuration file to connect to the database
include 'includes/config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("location: .../VitaCare/Rprofile.php");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize the form inputs
    $email = $_SESSION['email']; // Assuming you store the logged-in user's email in the session
    $bloodType = mysqli_real_escape_string($conn, $_POST['bloodType']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Validate form fields
    if (empty($bloodType) || empty($contactNumber) || empty($message)) {
        echo "All fields are required!";
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO donation_requests (user_email, blood_type, contact_number, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $bloodType, $contactNumber, $message);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the dashboard or success page
        header("location: dashboard.php");
        exit(); // Important to stop further script execution
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>
