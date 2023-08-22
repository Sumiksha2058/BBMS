<?php
error_reporting(E_ALL);
include 'includes/config.php'; // Include the database connection

session_start(); // Start the session

if(!isset($_SESSION['recp_email'])){

    header("Location: ../login.php"); 
}

$successMessage = "";
$errorMessage = "";

if (isset($_POST["request"])) {
    $recp_email = $_SESSION['recp_email'];
    $requestedBloodGroup = $_POST["requestedBloodGroup"];
    $urgency = $_POST["urgency"];
    $amountRequire = $_POST["amountRequ
    The requested URL was not found on this server. The link on the referring page seems to be wrong or outdated. Please inform the author of that page about the error.
    
    If you think this is a server error, please contact the webmaster.
    Error 404
    localhost
    Apache/2.4.56 (Unix) OpenSSL/1.1.1t PHP/8.2.4 mod_perl/2.0.12 Perl/v5.34.1 ire"];
    $message = $_POST["message"];
    

    // Check if the requested blood group is available in the donation table
    $checkAvailabilitySql = "SELECT COUNT(*) FROM donor WHERE donorBlood = '$requestedBloodGroup'";
    $availabilityResult = mysqli_query($conn, $checkAvailabilitySql);
    $availabilityCount = mysqli_fetch_row($availabilityResult)['0'];

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
      include ('../RecipientDashboard/includes/head.php');
    ?>

<?php 
        include ('../RecipientDashboard/includes/r_dashboard.php');
    ?>

<main id="main_container">

<div class="main-area p-4">
    <div class="inner-wrapper p-4">
        <div class="container-fluid shadow-lg bg-light w-50 text-dark py-3 rounded">
            <div class="row  rounded text-dark p-3 items-center mb-3">
        <h3>Blood Request</h3>
        <hr class="divider">
</div>
        <form method="post" action="requestBlood.php" class="m-3">
            <?php if ($successMessage !== ""): ?>
                <div class="alert alert-success "><?php echo $successMessage; ?></div>
            <?php endif; ?>

            <?php if ($errorMessage !== ""): ?>
                <div class="alert alert-danger "><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <h3><label for="requestedBloodGroup" class="form-label">Select Required Blood Group:</label></h3>
            <select class="form-select mb-3" name="requestedBloodGroup" id="requestedBloodGroup" required>
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

            
            <h3><label for="urgency" class="form-label">Urgency:</label></h2>
            <select class=" form-select mb-3" name="urgency" id="urgency" required>
                <option selected>Select blood group</option>
                <option value="Urgent">Urgent</option>
                <option value="Not Urgent">Not urgent</option>
              
            </select>
            <h3><label for="amountRequire" class="form-label">Blood Require(ML)</label></h3>
            <input class="form-control  mb-3" type="text" id="amountRequire" name="amountRequire">

            <h3><label for="urgency" class="form-label">Message</label></h3>
            <input class="form-control  mb-3" type="text" id="message" name="message">

            
           
            <button type="submit" name="request" class="btn btn-dark text-light mt-2">Request Blood</button>
        </form>
    </div>
    </div>
    </div>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>
