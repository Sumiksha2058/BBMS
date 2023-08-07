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
        include ('includes\head.php');
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
      <div class="float-end ">
       <span>4</span>
    </div>
    </div>
    </div>
    <div class="col-4 " >
      <div class="shadow-lg p-5 border rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Total Donor Requests</div>  
      <div class="float-end ">
       <span>4</span>
    </div>
    </div>
    </div>
   
    <div class="col-4 " >
      <div class="shadow-lg p-5 border  rounded"style="background-color:#000077;">  
      <div class="text-center pb-1 fs-5 ">Total Blood Request</div> 
      <div class="float-end ">
       <span>4</span>
    </div>
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