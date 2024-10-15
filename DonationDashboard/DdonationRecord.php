<?php
include 'includes/config.php';

session_start(); // Start the session

if (!isset($_SESSION['email'])) {
    header("location: .../VitaCare/Rprofile.php");  
    exit();
}

$email = $_SESSION['email'];

$query = "SELECT * FROM users WHERE email = '$email' ORDER BY requested_date DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>

<?php 
        include ('./includes/head.php');
        include ('includes/d_dashboard.php');
    ?>

<main id="main_container">

<div class="main-area p-4">
    <div class="inner-wrapper p-4 ">
        <div class="container-fluid text-light">
            <div class="row">
                <div class="col">
           <h1>Donation Staus</h1>
           <hr>
           </div>

           <table class="table rounded table-hover ">
           <thead class="table-dark ">
    <tr >
    <?php
    if(mysqli_num_rows($result) > 0) {
     echo '<th scope="col">Donation Request Date</th>'; 
     echo '<th scope="col">Email</th>';
     echo '<th scope="col">Blood Type</th>';
     echo '<th scope="col">Status</th>';
   echo '</tr>';
 echo '</thead>';
 echo '<tbody>';

            while($request_data = mysqli_fetch_array($result)){
              echo "<tr class='p-2'>";
              echo "<td>".$request_data['requested_date']."</td>";
              echo "<td>".$request_data['email']."</td>";
              echo "<td>".$request_data['blood_group']."</td>";
              echo "<td>".$request_data['approval_status']."</td>";
              
            }
        }else {
            echo "<h3 class='text-center mt-5'>No Data Found</h3>";
        }
            ?>

  </tbody>

            </table>
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