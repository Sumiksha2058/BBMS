<?php
error_reporting(E_ALL);
include 'includes/config.php'; // Include the database connection

session_start(); // Start the session

if(!isset($_SESSION['recp_email'])){

    header("location: .../VitaCare/Rprofile.php");  
}

$successMessage = "";
$errorMessage = "";

if (isset($_POST["request"])) {
    $requestedBloodGroup = $_POST["requestedBloodGroup"];
    $urgency = $_POST["urgency"];
    $amountRequire = $_POST["amountRequire"];
    $message = $_POST["message"];
    $recp_email = $_SESSION['recp_email'];

    // Check if the requested blood group is available in the donation table
    $checkAvailabilitySql = "SELECT COUNT(*) FROM donor WHERE donorBlood = '$requestedBloodGroup'";
    $availabilityResult = mysqli_query($conn, $checkAvailabilitySql);
    $availabilityCount = mysqli_fetch_row($availabilityResult)[0];

    if ($availabilityCount > 0) {
        // Inserting blood request into the database
        $insertRequestSql = "INSERT INTO blood_requests(recp_email, requested_blood_group, urgency, amount_required, message, request_date)
                            VALUES ('$recp_email', '$requestedBloodGroup', '$urgency', '$amountRequire', '$message', NOW())";
        
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
        <div class="container-fluid shadow-lg bg-light w-50 text-dark py-3 rounded">
            <div class="row  rounded text-dark p-3 items-center mb-3">
        <h1>Blood Request</h1>
</div>
        <form method="post" action="requestBlood.php" class="m-3">
            <?php if ($successMessage !== ""): ?>
                <div class="alert alert-success "><?php echo $successMessage; ?></div>
            <?php endif; ?>

            <?php if ($errorMessage !== ""): ?>
                <div class="alert alert-danger "><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <label for="requestedBloodGroup" class="form-label">Select Required Blood Group:</label>
            <select class="form-select " name="requestedBloodGroup" id="requestedBloodGroup" required>
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

            
            <label for="urgency" class="form-label">Urgency:</label>
            <select class="form-control form-select " name="urgency" id="urgency" required>
                <option value="" selected>Select blood group</option>
                <option value="O+">Urgent</option>
                <option value="O-">Not urgent</option>
              
            </select>
            <label for="amountRequire" class="form-label">Blood Require(ML)</label>
            <input class="form-control " type="text" id="amountRequire" name="amountRequire">

            <label for="urgency" class="form-label">Message</label>
            <input class="form-control " type="text" id="message" name="message">

            
           
            <button type="submit" name="request" class="btn btn-primary mt-2">Request Blood</button>
        </form>
    </div>
    </div>
    </div>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>
