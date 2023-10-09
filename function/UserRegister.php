<?php
ob_end_flush();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include your database connection code here
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vitacare_db';

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn === false) {
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
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $con_password = mysqli_real_escape_string($conn, $_POST['con_password']);

        // Check if passwords match
        if ($password != $con_password) {
            array_push($errors, "The passwords do not match");
        }

        // Check for duplicate email
        $check_duplicate_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_duplicate_sql);
        if (!preg_match('/^(98|97)\d{8}$/', $contact)) {
            array_push($errors, "Invalid Nepali phone number format");
        }
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Error: You are already login");
        } else {
            // Hash the password (you may want to use a more secure hashing method)
            $password = md5($password);

            if ($userType === 'donor' || $userType === 'recipient') {
                // Proceed with the INSERT query
                $insert_sql = "INSERT INTO users (user_type, fullname, gender, age, email, contact, blood_group, password)
                        VALUES ('$userType', '$fullname', '$gender', '$age', '$email', '$contact', '$blood_group', '$password')";

                if (count($errors) == 0) {
                    // Execute the query
                    if (mysqli_query($conn, $insert_sql)) {
                        header("location: register.php?success=Successfully registered as $userType");
                        exit();
                    } else {
                        array_push($errors, "Error: " . mysqli_error($conn));
                    }
                }
            }
        }
    } else {
        // Handle the case where 'userType' is not set
        array_push($errors, "User type is not set.");
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
