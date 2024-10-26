<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the configuration file to connect to the database
include 'includes/config.php';
// session_start();

// // Check if the user is logged in
// if (!isset($_SESSION['email'])) {
//     header("location: ../VitaCare/Rprofile.php");
//     exit();
// }

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize the form inputs
    $email = $_SESSION['email']; // Assuming you store the logged-in user's email in the session
    $bloodType = mysqli_real_escape_string($conn, $_POST['blood_group']); // Note: Make sure the input name is blood_group
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Validate form fields
    if (empty($bloodType) || empty($message)) {
        echo "All fields are required!";
        exit();
    }

    // Fetch user ID from the database using the session email
    $user_stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $user_stmt->bind_param("s", $email);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();

    if ($user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
        $user_id = $user['user_id'];

        // Prepare the SQL statement to insert into blood_requests table
        $stmt = $conn->prepare("INSERT INTO blood_requests (email, requested_blood_group, message, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $email, $bloodType, $message, $user_id);

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
    } else {
        echo "User not found.";
    }

    // Close the user statement
    $user_stmt->close();
}

// Close the database connection
$conn->close();
?>
