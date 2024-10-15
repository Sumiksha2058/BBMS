<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);



// Include your database connection code here
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vitacare_db';

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the $errors array
$errors = array();
$userType = "";
$fullname = "";
$gender = "";
$age = "";
$email = "";
$contact = "";
$blood_group = "";

if (isset($_POST['submitForm'])) {
    if (isset($_POST['userType'])) {
        $userType = mysqli_real_escape_string($conn, $_POST['userType']);
        // Escape the data to prevent SQL injection

        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $blood_group = mysqli_real_escape_string($conn, $_POST['donorBlood']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $con_password = mysqli_real_escape_string($conn, $_POST['con_password']);

        // Check if passwords match
        if ($password !== $con_password) {
            $errors[] = "The passwords do not match";
        }
        $con_password = mysqli_real_escape_string($conn, $_POST['con_password']);
        $con_password = mysqli_real_escape_string($conn, $_POST['con_password']);

        // Check for duplicate email
        $check_duplicate_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($check_duplicate_sql);
        if ($result && $result->num_rows > 0) {
            $errors[] = "Error: You are already registered";
        }

        // Check for valid contact number
        if (!preg_match('/^(98|97)\d{8}$/', $contact)) {
            $errors[] = "Invalid Nepali phone number format";
        }

        if (empty($errors)) {
            // Hash the password securely using password_hash
            $password = password_hash($password, PASSWORD_DEFAULT);

            $present_date = date('Y-m-d'); // Get the present date in the format 'YYYY-MM-DD'

            $stmt = $conn->prepare("INSERT INTO users (user_type, fullname, gender, age, email, contact, blood_group, password, approval_status, requested_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?)");
            $stmt->bind_param("sssssssss", $userType, $fullname, $gender, $age, $email, $contact, $blood_group, $password, $present_date);

            if ($stmt->execute()) {
                header("location: #modal?success=Successfully registered as Donor");
                exit();
            } else {
                $errors[] = "Error: " . $conn->error;
            }
        }
    } else {
        $errors[] = "User type is not set.";
    }
}

// Retain form data after submission for displaying it back to the user
$userTypeValue = htmlspecialchars($userType);
$fullnameValue = htmlspecialchars($fullname);
$genderValue = htmlspecialchars($gender);
$ageValue = htmlspecialchars($age);
$emailValue = htmlspecialchars($email);
$contactValue = htmlspecialchars($contact);
?>
