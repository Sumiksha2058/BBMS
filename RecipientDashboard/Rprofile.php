
<?php
session_start();
session_regenerate_id(true);

if(!isset($_SESSION['recp_email'])){
    header("location: .../VitaCare/login.php");  
}
include 'includes/config.php';
// Get the email of the logged-in donor from the session

$email = $_SESSION['recp_email'];
// Fetch donor information from the database
$sql = "SELECT recp_fullname,recp_gender, recp_contact, recp_email FROM recipient WHERE recp_email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $fullname = $row['recp_fullname'];
    $Gender = $row['re   Profilecp_gender'];
    $contact = $row['recp_contact'];
    $email = $row['recp_email'];
 
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
    <meta name="viboard.php');
Profileewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://font/RecipientDashboard/Rprofile.phps.googleapis.com">
    <link rel="preconnect" href="https://font/RecipientDashboard/Rprofile.phps.googleapis.com">
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
                <div class="container-fluid text-light">
                    <div class="row">
                <div class="col-12 pb-3">
                    <h1>Profile</h1>
                </div>
            </div>
            <div class="row">
               
                <div class="col-lg-9 ">
                    <h3 class="fs-2">
                   
                    <span><i class="fa fa-user" aria-hidden="true"></i> <?php echo $fullname; ?></span>
                        
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <h3 class="fs-4">Gender</h3>
                </div>
                <div class="col-lg-9">
                <h4><?php echo $Gender; ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <h3 class="fs-4">Contact No</h3>
                </div>
                <div class="col-lg-9">
                <h4><?php echo $contact; ?></h4>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-3">
                    <h3 class="fs-4">Email</h3>
                </div>
                <div class="col-lg-9">
                <h4><?php echo $email; ?></h4>
                </div>
            </div>

        </div>
    </div>
</div>

</main>

<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>