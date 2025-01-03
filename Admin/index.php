<<<<<<< HEAD
  <?php
  session_start();
  session_regenerate_id(true);

  if (!isset($_SESSION['a_email'])) {
      header("location: Admin/login.php");
      exit();
  }
  include("includes/config.php");
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
      <script src="javascript/jquery.js"></script>
  </head>
  <body>

  <?php 
          include ('../Admin/includes/head.php');
      ?>

  <?php 
          include ('includes/a_dashboard.php');
      ?>

  <main id="main_container">
    
  <div class="col col-md-4 float-end " id="searchResults"></div>
  <div class="main-area p-4">
      <div class="inner-wrapper p-4">
      
          <div class="container overflow-hidden">
    
    <div class="row gy-5  text-light" id="small_container" >
      
      <div class="col-4 " >
        <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
        <?php
        $dashbard_user_query = "(SELECT user_type, user_id, fullname, email FROM users)";
        
        $dashbard_user_result = mysqli_query($conn, $dashbard_user_query);

        if($total_user = mysqli_num_rows($dashbard_user_result)){
          echo '<div class="text-center">
          <h4>'.$total_user.'</h4>
      </div>';

        }else{
          echo '<div class="text-center pb-1 fs-5">
          <h2>No data</h4>
      </div>';
        }
        ?>
        <div class=" float-end "><span>Total Users</span></div> 

      
      </div>
      </div>
      <div class="col-4 " >
        <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
        <?php 
        $dashbard_donationRequest_query = "SELECT * FROM users WHERE user_type='donor' AND approval_status='approved'";
        $dashbard_donationRequest_result = mysqli_query($conn, $dashbard_donationRequest_query);
        if($total_donationRequest = mysqli_num_rows($dashbard_donationRequest_result)){
          echo '<div class="text-center">
          <h4>'.$total_donationRequest.'</h4>
      </div>';

        }else{
          echo '<div class="text-center">
          <h4>No data</h4>
      </div>';
        }
        ?>
        <div class="float-end fs-6"><span>Total Donor Requests</span></div>  

        
      </div>
      </div>
    
      <div class="col-4 " >
        <div class="shadow-sm p-5 border  rounded"style="background-color:#000077;">  
          
        <div class="text-center  pb-1 fs-5 ">Total Blood Request</div> 
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
        <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
        <div class="text-center pb-1 fs-5 ">Total <br> Unit of Blood</div>  
        <div class="float-end">
        <?php 
        $dashbard_Unit_query = "SELECT SUM(blood_units_donated) AS total_donated FROM donors";
        $dashbard_unit_result = mysqli_query($conn, $dashbard_Unit_query);
        $row = mysqli_fetch_assoc( $dashbard_unit_result);
        $totalUnit = $row["total_donated"];
        if( $total_unit=  $dashbard_unit_result){
          echo '<div class="float-end ">
          <span>'.$totalUnit.'</span>
          </div>';

        }else{
          echo '<div class="float-end ">
          <span>No data</span>
      </div>';
        }
        ?>
      </div>

      
        
      </div>
      </div>
      
      <div class="col-4 " >
        <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
        <div class="text-center pb-1 fs-5 ">Available Blood Groups</div>  
        <div class="float-end">
        <?php 
        $dashbard_AvailabletBlood_query = "SELECT count( distinct blood_group) as total  FROM `users`  where approval_status = 'approved' and user_type = 'donor'";
        $dashbard_AvailabletBlood_result = mysqli_query($conn, $dashbard_AvailabletBlood_query);
        $row = mysqli_fetch_assoc( $dashbard_AvailabletBlood_result);
        $total = $row["total"];
        if( $total_AvailabletBlood=  $dashbard_AvailabletBlood_result){
          echo '<div class="float-end ">
          <span>'.$total.'</span>
          </div>';

        }else{
          echo '<div class="float-end ">
          <span>No data</span>
      </div>';
        }
        ?>
      </div>

      </div>
      </div>
      
      <div class="col-4 " >
        <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
        <div class="text-center pb-1 fs-5  ">Total <br> Appointments</div>  
        <?php
        $dashbard_appo_query = "SELECT appo_id, appo_name, appo_email, appo_phone, appo_bloodtype, appo_date,appo_time FROM vc_appointment; ";

        $dashbard_appo_result = mysqli_query($conn, $dashbard_appo_query);

        if($total_appo = mysqli_num_rows($dashbard_appo_result)){
          echo '<div class="float-end ">
          <span>'.$total_appo.'</span>
      </div>';

        }else{
          echo '<div class="float-end ">
          <span>No data</span>
      </div>';
        }
        ?>
      
      </div>
      </div>
      
    </div>
  </div>
  </div>
      
  </div>

  </main>
  <script src="javascript/searchHandler.js"></script>
  <script src="javascript/activeHover.js"></script>
  <script src="fontawesome/js/all.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
      <script src="javascript/search.js"></script>
  </body>
  </html>
=======
<?php
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['a_email'])) {
    header("location: Admin/login.php");
    exit();
}
include("includes/config.php");
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
    <script src="javascript/jquery.js"></script>
</head>
<body>

<?php 
        include ('../Admin/includes/head.php');
    ?>

<?php 
        include ('includes/a_dashboard.php');
    ?>

<main id="main_container">
  
<div class="col col-md-4 float-end " id="searchResults"></div>
<div class="main-area p-4">
    <div class="inner-wrapper p-4">
    
        <div class="container overflow-hidden">
  <div class="row gy-5  text-light" id="small_container" >
    <div class="col-4 " >
      <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Total Users</div> 
      <?php
      $dashbard_user_query = "(SELECT user_type, user_id, fullname, email FROM users)";
      
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
      <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Total Donor Requests</div>  
      <?php 
      $dashbard_donationRequest_query = "SELECT * FROM users WHERE user_type='donor' AND approval_status='approved'";
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
      <div class="shadow-sm p-5 border  rounded"style="background-color:#000077;">  
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
      <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Total <br> Unit of Blood</div>  
      <div class="float-end">
      <?php 
      $dashbard_Unit_query = "SELECT SUM(blood_units_donated) AS total_donated FROM donors";
      $dashbard_unit_result = mysqli_query($conn, $dashbard_Unit_query);
      $row = mysqli_fetch_assoc( $dashbard_unit_result);
      $totalUnit = $row["total_donated"];
      if( $total_unit=  $dashbard_unit_result){
        echo '<div class="float-end ">
        <span>'.$totalUnit.'</span>
        </div>';

      }else{
        echo '<div class="float-end ">
        <span>No data</span>
     </div>';
      }
      ?>
     </div>

     
      
    </div>
    </div>
    
    <div class="col-4 " >
      <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Available Blood Groups</div>  
      <div class="float-end">
      <?php 
      $dashbard_AvailabletBlood_query = "SELECT count( distinct blood_group) as total  FROM `users`  where approval_status = 'approved' and user_type = 'donor'";
      $dashbard_AvailabletBlood_result = mysqli_query($conn, $dashbard_AvailabletBlood_query);
      $row = mysqli_fetch_assoc( $dashbard_AvailabletBlood_result);
      $total = $row["total"];
      if( $total_AvailabletBlood=  $dashbard_AvailabletBlood_result){
        echo '<div class="float-end ">
        <span>'.$total.'</span>
        </div>';

      }else{
        echo '<div class="float-end ">
        <span>No data</span>
     </div>';
      }
      ?>
     </div>

    </div>
    </div>
    
    <div class="col-4 " >
      <div class="shadow-sm p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5  ">Total <br> Appointments</div>  
      <?php
      $dashbard_appo_query = "SELECT appo_id, appo_name, appo_email, appo_phone, appo_bloodtype, appo_date,appo_time FROM vc_appointment; ";

      $dashbard_appo_result = mysqli_query($conn, $dashbard_appo_query);

      if($total_appo = mysqli_num_rows($dashbard_appo_result)){
        echo '<div class="float-end ">
        <span>'.$total_appo.'</span>
     </div>';

      }else{
        echo '<div class="float-end ">
        <span>No data</span>
     </div>';
      }
      ?>
     
    </div>
    </div>
    
  </div>
</div>
</div>
    
</div>

</main>
<script src="javascript/searchHandler.js"></script>
<script src="javascript/activeHover.js"></script>
<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
