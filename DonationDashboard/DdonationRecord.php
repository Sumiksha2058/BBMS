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
           </div>

           <table class="table rounded table-dark table-hover ">
           <thead>
    <tr >
     
      <th scope="col">Donation Request Date</th> 
      <th scope="col">Unit</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  <?php
            while($request_data = mysqli_fetch_array($result)){
              echo "<tr class='p-2'>";
              echo "<td>".$request_data['requested_date']."</td>";
              echo "<td>".$request_data['amount_to_donate']."</td>";
              echo "<td>".$request_data['email']."</td>";
              echo "<td>".$request_data['approval_status']."</td>";
              
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