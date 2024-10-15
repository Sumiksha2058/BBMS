<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/config.php'; // Include the database connection

session_start(); // Start the session

if(!isset($_SESSION['email'])){
    header("Location: ../login.php"); 
    exit();
}

$successMessage = "";
$errorMessage = "";

if (isset($_POST["request"])) {
    $recp_email = $_SESSION['email'];
    $requestedBloodGroup = $_POST["requestedBloodGroup"];
    $urgency = $_POST["urgency"];
    $amountRequire = $_POST["amountRequire"];
    $message = $_POST["message"];
    
    $checkAvailabilitySql = "SELECT COUNT(*) FROM users WHERE user_type = 'donor' AND blood_group = ?";
    $stmt = mysqli_prepare($conn, $checkAvailabilitySql);
    mysqli_stmt_bind_param($stmt, "s", $requestedBloodGroup);
    mysqli_stmt_execute($stmt);
    $availabilityResult = mysqli_stmt_get_result($stmt);

    if ($availabilityResult) {
        $availabilityCount = mysqli_fetch_row($availabilityResult)[0];

        if ($availabilityCount > 0) {
            $insertRequestSql = "INSERT INTO blood_requests(email, requested_blood_group, urgency, amount_required, message, request_date, approval_status) 
            SELECT email, ?, ?, ?, ?, NOW(), 'pending' FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $insertRequestSql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssiss", $requestedBloodGroup, $urgency, $amountRequire, $message, $recp_email);
                if (mysqli_stmt_execute($stmt)) {
                    $successMessage = "Blood request submitted successfully.";
                } else {
                    $errorMessage = "Error: " . mysqli_error($conn);
                }
            } else {
                $errorMessage = "Error in preparing the statement: " . mysqli_error($conn);
            }
        } else {
            $errorMessage = "Blood not available for the requested blood group.";
        }
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
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
    <script src="javascript/jquery.js"></script>
</head>
<body>

<?php 
    include __DIR__ . '/../RecipientDashboard/includes/head.php';
    include __DIR__ . '/../RecipientDashboard/includes/r_dashboard.php';
?>

<main id="main_container">
    <div class="main-area p-4">
          <!-- searching container -->
          <div class="col col-md-4 float-end " id="searchResults"></div>
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

                    <h3><label for="urgency" class="form-label">Urgency:</label></h3>
                    <select class="form-select mb-3" name="urgency" id="urgency" required>
                        <option value="" selected>Select urgency</option>
                        <option value="Urgent">Urgent</option>
                        <option value="Not Urgent">Not urgent</option>
                    </select>

                    <h3><label for="amountRequire" class="form-label">Blood Unit</label></h3>
                    <input class="form-control mb-3" type="number" id="amountRequire" name="amountRequire">

                    <h3><label for="message" class="form-label">Message</label></h3>
                    <input class="form-control mb-3" type="text" id="message" name="message">

                    <button type="submit" name="request" class="btn btn-dark text-light mt-2">Request Blood</button>
                </form>
            </div>
        </div>
    </div>
    <script src="javascript/searchHandler.js"></script>
<script src="javascript/activeHover.js"></script>
<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>
