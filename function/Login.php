<?php
// Start output buffering and enable error reporting
ob_start();
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Start the session
session_start();

// Define the input_filter function
function input_filter($data) { 
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if (isset($_POST['login'])) {
    // Database connection settings
    $conn = mysqli_connect("localhost", "root", "", "vitacare_db");

    // Check connection
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Get sanitized input data
    $userType = input_filter($_POST['userType']); 
    $email = input_filter($_POST['Loginemail']);
    $password = input_filter($_POST['Loginpassword']);

    // SQL query template with prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND user_type = ?");
    $stmt->bind_param("ss", $email, $userType);

    // Execute the prepared statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Check if a single row was returned
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Successful login
                $_SESSION['user_type'] = $userType;
                $_SESSION['email'] = $email;

                // If the user is a donor, set their status to active (1)
                if ($userType === 'donor') {
                    updateActivity($row['user_id'], 1);  // Assuming 'id' is the donor's ID in the 'users' table
                }

                // Redirect based on user type
                $redirectPage = ($userType === 'donor') ? "DonationDashboard/index.php" : "RecipientDashboard/index.php";
                header("Location: $redirectPage");
                exit();
            } else {
                $error_message = "Invalid Email or Password";
            }
        } else {
            $error_message = "Invalid Email or Password";
        }
    } else {
        die("Database query execution failed: " . $stmt->error);
    }

    // Login failed, set error message
    if (isset($error_message)) {
        header("Location: index.php?error=" . urlencode($error_message));
        exit();
    }
}

// Close statement and connection only if they exist
if (isset($stmt)) {
    $stmt->close();
}
if (isset($conn)) {
    $conn->close();
}

ob_end_flush(); // Send output to the browser

// Function to update donor activity status to active
function updateActivity($donorId, $status = 1) {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'vitacare_db');  // Replace with your DB credentials

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);  // If connection fails
    }

    // Update the 'active_donor' table with the donor's status and last_seen timestamp
    $stmt = $conn->prepare("UPDATE users SET last_seen = NOW(), status = ? WHERE user_id = ?");
    $stmt->bind_param("ii", $status, $donorId);  // Bind status and donor ID
    $stmt->execute();  // Execute the update

    // Close the connection and statement
    $stmt->close();
    $conn->close();
}
?>
