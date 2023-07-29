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
        include ('C:\xampp\htdocs\VitaCare\includes\head.php');
    ?>


<?php 
        include ('includes/d_dashboard.php');
    ?>

<main id="main_container">

<div class="main-area p-4">
    <div class="inner-wrapper p-4 ">
        <div class="container-fluid text-light">
            <div class="row">
                <div class="col">
           <h1>Donation Record</h1>
           </div>

           <table class="table rounded table-dark table-hover ">
           <thead>
    <tr >
     
      <th scope="col">Date</th>
      <th scope="col">Donation Type</th>
      <th scope="col">Amount(ML)</th>
    </tr>
  </thead>
  <tbody>
  <tr >
     
     <th scope="col">2023/01/4</th>
     <th scope="col">All Type</th>
     <th scope="col">150</th>
   </tr>
   <tr >
     
     <th scope="col">2023/02/15</th>
     <th scope="col">Platelets</th>
     <th scope="col">100</th>
   </tr>
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