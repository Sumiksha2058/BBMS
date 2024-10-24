<?php
ob_end_flush();
error_reporting(E_ALL);
ini_set('display_errors', 1);

<<<<<<< HEAD
// Database connection details
=======
// Include your database connection code here
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
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
<<<<<<< HEAD
$address = "";
=======
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
$blood_group = "";

if (isset($_POST['submitForm'])) {
    if (isset($_POST['userType'])) {
<<<<<<< HEAD
        // Escape the data to prevent SQL injection
        $userType = mysqli_real_escape_string($conn, $_POST['userType']);
=======
        $userType = mysqli_real_escape_string($conn, $_POST['userType']);

        // Escape the data to prevent SQL injection
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
<<<<<<< HEAD
        $address = mysqli_real_escape_string($conn, $_POST['address']);
=======
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
        $blood_group = mysqli_real_escape_string($conn, $_POST['donorBlood']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $con_password = mysqli_real_escape_string($conn, $_POST['con_password']);

        // Check if passwords match
        if ($password != $con_password) {
            array_push($errors, "The passwords do not match");
        }

<<<<<<< HEAD
        // Validate phone number format for Nepal
        if (!preg_match('/^(98|97)\d{8}$/', $contact)) {
            array_push($errors, "Invalid phone number format");
        }

        // Check for duplicate email
        $check_duplicate_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_duplicate_sql);

        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Error: Account already exists!");
        } else {
            // Hash the password securely
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            if ($userType === 'donor' || $userType === 'recipient') {
                // Insert user data into the database
                $present_date = date('Y-m-d'); // Format date as 'YYYY-MM-DD'
                $insert_sql = "INSERT INTO users (user_type, fullname, gender, age, email, contact, address, blood_group, password, approval_status, requested_date)
                VALUES ('$userType', '$fullname', '$gender', '$age', '$email', '$contact', '$address', '$blood_group', '$hashed_password', 'pending', '$present_date')";

                // Execute the insert query if there are no errors
                if (count($errors) == 0) {
=======
        // Check for duplicate email
        $check_duplicate_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check_duplicate_sql);
        if (!preg_match('/^(98|97)\d{8}$/', $contact)) {
            array_push($errors, "Invalid phone number format");
        }
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Error: Account already exit!");
        } else {
            // Hash the password (you may want to use a more secure hashing method)
           $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if ($userType === 'donor' || $userType === 'recipient') {
                // Proceed with the INSERT query
                $present_date = date('Y-m-d'); // Get the present date in the format 'YYYY-MM-DD'
                $insert_sql = "INSERT INTO users (user_type, fullname, gender, age, email, contact, blood_group, password, approval_status, requested_date)
                VALUES ('$userType', '$fullname', '$gender', '$age', '$email', '$contact', '$blood_group', '$password', 'pending', '$present_date')";
  
                if (count($errors) == 0) {
                    // Execute the query
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
                    if (mysqli_query($conn, $insert_sql)) {
                        header("location: register.php?success=Successfully registered as $userType");
                        exit();
                    } else {
                        array_push($errors, "Error: " . mysqli_error($conn));
                    }
                }
<<<<<<< HEAD
            } else {
                array_push($errors, "Invalid user type selected.");
            }
        }
    } else {
        // Handle case where 'userType' is not set
        array_push($errors, "User type is not set.");
    }
}

// Display errors if they exist
if (!is_null($errors) && count($errors) > 0) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}

=======
            }
        }
    } else {
        // Handle the case where 'userType' is not set
        array_push($errors, "User type is not set.");
    }
}
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
// Retain form data after submission for displaying it back to the user
$userTypeValue = htmlspecialchars($userType);
$fullnameValue = htmlspecialchars($fullname);
$genderValue = htmlspecialchars($gender);
$ageValue = htmlspecialchars($age);
$emailValue = htmlspecialchars($email);
$contactValue = htmlspecialchars($contact);
<<<<<<< HEAD
$addressValue = htmlspecialchars($address);

=======
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
?>
