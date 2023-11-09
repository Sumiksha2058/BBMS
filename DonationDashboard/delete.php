<?php
session_start();
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vitacare_db';

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn === false){
    die("Connection failed: ".$conn->connect_error);
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Delete the account from the database
    $deleteQuery = "DELETE FROM users WHERE email = '$email';";

    if (mysqli_query($conn, $deleteQuery)) {
        // If the deletion is successful, destroy the session and redirect the user to the login page
        session_destroy();
        header("location: .../VitaCare/login.php"); // Adjust the path to login.php as needed
        exit();
    } else {
        // If the deletion fails, display an error message
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // If the session email is not set, redirect the user to the login page
    header("location: .../VitaCare/login.php");// Adjust the path to login.php as needed
    exit();
}
?>
