<?php
include 'includes/config.php';

session_start(); // Start the session

if (!isset($_SESSION['recp_email'])) {
    header("location: .../VitaCare/Rprofile.php");  
    exit();
}

$recp_email = $_SESSION['recp_email'];

$query = "SELECT * FROM blood_requests WHERE recp_email = '$recp_email' ORDER BY request_date DESC";
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
    <div class="inner-wrapper p-4 ">
        <div class="container-fluid text-light">
            <div class="row">
                <div class="col">
           <h1>Request Status</h1>
</div>
           </div>
           <table class="table table-light table-hover">
           <thead>
            <tr >           
              <th scope="col">Requested Date</th>
              <th scope="col">Blood Type</th>
              <th scope="col">Request Amount(ml)</th>
              <th scope="col">Email</th>
              <th scope="col">Status</th>
            </tr>
            </thead>
            
            <tbody>
            <?php
            while($request_data = mysqli_fetch_array($result)){
              echo "<tr class='p-2'>";
              echo "<td>".$request_data['request_date']."</td>";
              echo "<td>".$request_data['requested_blood_group']."</td>";
              echo "<td>".$request_data['amount_required']."</td>";
              echo "<td>".$request_data['recp_email']."</td>";
              echo "<td><span class='text-danger' ?id=$request_data[recp_email]'>Pending</span></td></tr>";
            }

            ?>

            </tbody>
        
      </table>
   
</div>
</div>
</div>
          </div>
</main>

<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>


