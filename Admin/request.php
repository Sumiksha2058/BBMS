<?php
include 'includes/config.php';

$query = "SELECT appo_id, appo_name, appo_email, appo_phone, appo_date, appo_time FROM vc_appointment; ";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: ".mysqli_error($conn)); 
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
    <link rel="stylesheet" href="includes/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

<?php 
         include ('../Admin/includes/head.php');
    ?>

<?php 
        include ('includes/a_dashboard.php');
    ?>

<main id="main_container">

<div class="main-area p-4">
    <div class="inner-wrapper p-4">
     
        <div class="container overflow-hidden">
        <div class="title text-dark">
        <h1 class="fs-4">Appointment Request</h1>
      </div>

      <table class="table table-hover-Info">
  <thead>
    <tr class="text-light " style="background-color: #000077; ">
      <th scope="col">User ID</th>
      <th scope="col">Full name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
   
    </tr>
  </thead>
  <tbody>
  <tbody>
  <?php
while($user_data = mysqli_fetch_array($result)){
  while ($user_data = mysqli_fetch_array($result)) {
    echo "<tr class='p-2'>";
    echo "<td>".$user_data['appo_id']."</td>";
    echo "<td>".$user_data['appo_name']."</td>";
    echo "<td>".$user_data['appo_email']."</td>";
    echo "<td>".$user_data['appo_phone']."</td>";
    echo "<td>".$user_data['appo_date']."</td>";
    echo "<td>".$user_data['appo_time']."</td>";
    echo "</tr>";
}
}
?>
  </tbody>
</table>
        </div>
    </div> 
</div>

</main>



<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>