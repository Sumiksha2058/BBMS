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

<div class="main-area p-4" style="background-color: #f8f9fa;">
    <div class="inner-wrapper p-4">
    <div class="container-fluid text-light">
        <div class="profile-card text-dark">
            <h2> <?php echo $userType; ?> Profile</h2>
            <div class="user-name"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $fullname; ?></div>
            <p><strong>Blood Type:</strong> <?php echo $bloodType; ?></p>
            <p><strong>Email ID:</strong><?php echo $email; ?></p>
            <button type="submit" class="btn btn-primary">Edit Profile</button>
            <button type="button" class="btn btn-danger mt-3" data-toggle="modal" data-target="#deleteModal">Delete Account</button>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete your account?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>







</body>
</html>