<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['email'])) {
    header("location: .../VitaCare/login.php");
    exit();
}

include 'includes/config.php';

// Get the email of the logged-in donor from the session
$email = $_SESSION['email'];

// Fetch donor information from the database
$sql = "SELECT fullname, user_type, contact, email, blood_group FROM users WHERE email = '$email';";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $fullname = $row['fullname'];
    $contact = $row['contact'];
    $email = $row['email'];
    $bloodType = $row['donorBlood'];
    $userType = $row['user_type'];
} else {
    // Handle the case when donor information is not found in the database
    $fullname = "N/A";
    $contact = "N/A";
    $email = "N/A";
    $bloodType = "N/A";
    $userType = "N/A";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>


<body> 
<?php 
        include ('../DonationDashboard/includes/head.php');
    ?>

<?php 
        include ('includes/d_dashboard.php');
    ?>
<main id="main_container">
<a href="functions/generate_certificate.php">Download Certificate</a>
</main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>







</body>
</html>