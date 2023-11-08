
<?php
session_start();
session_regenerate_id(true);

if(!isset($_SESSION['email'])){
    header("location: .../VitaCare/login.php");  
}
include 'includes/config.php';
// Get the email of the logged-in donor from the session

$email = $_SESSION['email'];
// Fetch donor information from the database
$sql = "SELECT fullname,gender, contact, email, blood_group FROM users WHERE email = '$email';";;
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $fullname = $row['fullname'];
    $Gender = $row['gender'];
    $contact = $row['contact'];
    $email = $row['email'];
 
} else {
    // Handle the case when donor information is not found in the database
    $fullname = "N/A";
    $Gender = "N/A";
    $contact = "N/A";
    $email = "N/A";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viwport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://font/RecipientDashboard/Rprofile.phps.googleapis.com">
    <script src="javascript/jquery.js"></script>

    
</head>
<body>
<div class="col col-md-4 float-end" id="searchResults"></div>
<?php 
include ('../RecipientDashboard/includes/head.php');
include ('../RecipientDashboard/includes/r_dashboard.php'); 
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