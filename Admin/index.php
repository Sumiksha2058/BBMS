<?php
include 'includes/config.php';
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
  <div class="row gy-5  text-light" id="small_container" >
    <div class="col-4 " >
      <div class="shadow-lg p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Total Users</div> 
      <?php
      $dashbard_user_query = "(SELECT 'recipient' AS user_type, recp_id AS user_id, recp_fullname AS user_name, recp_email AS user_email FROM recipient)
      UNION
      (SELECT 'donor' AS user_type, d_id AS user_id, fullname AS name, email AS user_email FROM donor)";

      $dashbard_user_result = mysqli_query($conn, $dashbard_user_query);

      if($total_user = mysqli_num_rows($dashbard_user_result)){
        echo '<div class="float-end ">
        <span>'.$total_user.'</span>
     </div>';

      }else{
        echo '<div class="float-end ">
        <span>No data</span>
     </div>';
      }
      ?>
    
    </div>
    </div>
    <div class="col-4 " >
      <div class="shadow-lg p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Total Donor Requests</div>  
      <?php 
      $dashbard_donationRequest_query = "SELECT * FROM donation_requests";
      $dashbard_donationRequest_result = mysqli_query($conn, $dashbard_donationRequest_query);
      if($total_donationRequest = mysqli_num_rows($dashbard_donationRequest_result)){
        echo '<div class="float-end ">
        <span>'.$total_donationRequest.'</span>
     </div>';

      }else{
        echo '<div class="float-end ">
        <span>No data</span>
     </div>';
      }
      ?>
      
    </div>
    </div>
   
    <div class="col-4 " >
      <div class="shadow-lg p-5 border  rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Total Blood Request</div> 
      <?php 
      $dashbard_requestBlood_query = "SELECT * FROM blood_requests";
      $dashbard_requestBlood_result = mysqli_query($conn, $dashbard_requestBlood_query);
      if($total_requestBlood = mysqli_num_rows($dashbard_requestBlood_result)){
        echo '<div class="float-end ">
        <span>'.$total_requestBlood.'</span>
     </div>';

      }else{
        echo '<div class="float-end ">
        <span>No data</span>
     </div>';
      }
      ?>
      
    </div>
    </div>

    <div class="col-4 " >
      <div class="shadow-lg p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Total Quantity of Blood</div>  
      <div class="float-end ">
       <span>4</span>
    </div>
    </div>
    </div>
    
    <div class="col-4 " >
      <div class="shadow-lg p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Available Blood Groups</div>  
      <div class="float-end ">
       <span>4</span>
    </div>
    </div>
    </div>
    
    <div class="col-4 " >
      <div class="shadow-lg p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5  ">Total Appointments</div>  
      <div class="float-end ">
       <span>4</span>
    </div>
    </div>
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