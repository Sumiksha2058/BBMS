<?php
include 'includes/config.php'; // Include the database connection

session_start(); // Start the session

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php"); // Redirect to login page if not logged in
    exit();
}

if (isset($_POST["submitRequest"])) {
    $email = $_SESSION['email'];

    $amountRequire = $_POST["amountRequire"];
 
    $insertRequestSql = "INSERT INTO donation_requests(email, amount_to_donate)
                        VALUES ('$email', '$amountRequire')";

    if (mysqli_query($conn, $insertRequestSql)) {
        $successMessage = "Donation request submitted successfully.";
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
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body >

    <?php include 'includes/head.php'; ?>


    <?php include 'includes/d_dashboard.php'; ?>

    <main id="main_container">

        <div class="main-area p-4 ">
            <div class="inner-wrapper  p-4">
                <div class="container-fluid text-light">

                    <div class="row bg-light w-50 rounded text-dark p-3 items-center">
                        <h3 class="mb-3 ">Donation Request</h3>
                        <hr class="divider">
                        <form method="post" action="donationRequest.php">
                      
                        <?php if (isset($successMessage)): ?>
                            <div class="alert alert-success"><?php echo $successMessage; ?></div>
                        <?php endif; ?>

                        <?php if (isset($errorMessage)): ?>
                            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                        <?php endif; ?>
                            <label for="amountRequire">Amount to donate(ml):</label>
                            <input class="form-control" type="number" name="amountRequire" required>

                            <button type="submit" name="submitRequest" class="btn text-light bg-dark mt-2">Request Donation</button>
                        </form>

                    </div>
                   
                </div>
            </div>
        </div>

    </main>
    <script src="javascript/validation.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>

</html>
