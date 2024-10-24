<?php
// Start output buffering at the very beginning
ob_start();

// Enable error reporting
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Start the session
// session_start(); 

// Define the input_filter function
function input_filter($data) { 
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if (isset($_POST['login'])) {
    // Check if the database connection is properly configured
    $conn = mysqli_connect("localhost", "root", "", "vitacare_db");
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $userType = input_filter($_POST['userType']); // Get the selected user type
    $email = input_filter($_POST['Loginemail']);
    $password = input_filter($_POST['Loginpassword']);

    // Escape special characters to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);

    // Query template
    $sql = "SELECT * FROM users WHERE email = '$email' AND user_type = '$userType'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    // Check if a single row was returned
    if (mysqli_num_rows($result) == 1) {
        // Fetch user data
        $row = mysqli_fetch_assoc($result);

        // Verify the password using password_verify
        if (password_verify($password, $row['password'])) {
            // Login successful
            $_SESSION['user_type'] = $userType;
            $_SESSION['email'] = $email;

            // Redirect based on user type
            if ($userType === 'donor') {
                header("Location: DonationDashboard/index.php");
                exit();
            } 
            if ($userType === 'recipient') {
                header("Location: RecipientDashboard/index.php");
                exit();
            }
        } 
    }

    // Login failed
    $error_message = "Invalid Email or Password";

    // Pass the error message as a query parameter
    header("Location: index.php?error=" . urlencode($error_message));
    exit();

    // Close the database connection
    mysqli_close($conn);
}
ob_end_flush(); // Send output to the browser
?>
