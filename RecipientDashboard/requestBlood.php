<?php

session_start(); // Start the session
include 'includes/config.php'; // Include the database connection



$recp_id = $_SESSION['recp_id']; // Retrieve recipient's ID from the session

$successMessage = "";
$errorMessage = "";

if (isset($_POST["request"])) {
    $requestedBloodGroup = $_POST["requestedBloodGroup"];

    // Check if the requested blood group is available in the donation table
    $checkAvailabilitySql = "SELECT COUNT(*) FROM donor WHERE donorBlood = '$requestedBloodGroup'";
    $availabilityResult = mysqli_query($conn, $checkAvailabilitySql);
    $availabilityCount = mysqli_fetch_row($availabilityResult)[0];

    if ($availabilityCount > 0) {

        // Debugging: Print the values of recp_id and other relevant variables
var_dump($recp_id, $requestedBloodGroup);
        // Insert the blood request into the database
        $insertRequestSql = "INSERT INTO blood_requests (recp_id, requested_blood_group, request_date)
                            VALUES ('$recp_id', '$requestedBloodGroup', NOW())";
        
        if (mysqli_query($conn, $insertRequestSql)) {
            $successMessage = "Blood request submitted successfully.";
        } else {
            $errorMessage = "Error: " . mysqli_error($conn);
        }
    } else {
        $errorMessage = "Blood not available for the requested blood group.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>

<?php 
        include ('includes\head.php');
    ?>

<?php 
        include ('includes/r_dashboard.php');
    ?>

<main id="main_container">

<div class="main-area p-4">
    <div class="inner-wrapper p-4">
        <div class="container-fluid text-light">
            <div class="row">
        <h1>Blood Request Form</h1>
</div>
        <form method="post" action="requestBlood.php?recp_id=<?php echo $recp_id; ?>">
            <?php if ($successMessage !== ""): ?>
                <div class="alert alert-success"><?php echo $successMessage; ?></div>
            <?php endif; ?>

            <?php if ($errorMessage !== ""): ?>
                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <label for="requestedBloodGroup">Select Required Blood Group:</label>
            <select class="form-select w-50" name="requestedBloodGroup" id="requestedBloodGroup" required>
                <option value="" selected>Select blood group</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>
           
            <button type="submit" name="request" class="btn btn-primary mt-2">Request Blood</button>
        </form>
    </div>
    </div>
    </div>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>
