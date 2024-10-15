<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="VitaCare.ico" type="image/x-icon">
     <link rel="stylesheet" href="fontawesome/css/all.min.css">

     <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Exo:ital,wght@0,500;1,700&family=Lato:wght@100&display=swap" rel="stylesheet">
     
</head>
<body>
  <?php
    include 'includes/head.php'
   ?>
    
    <!-- main container starts from here -->
<main>
    <div class="container " id="mian_wapper">
      <div class="row py-3">
        <div class="col-md-6 col-lg-6 col-xl-6 pt-1 w-100">
            <h1 class="text-light fs-auto pt-5">What is blood transfusion</h1>
            <p class="text-light "> A blood transfusion involves the intravenous transfer of blood or blood components from a donor to a recipient. It is typically done to replace blood that has been lost due to injury, surgery, or medical conditions that affect the production or functioning of blood.</p>
            <a href="login.php"><button type="button" class="btn btn-outline-light">Get Blood Now</button></a>
        </div>

        <table class="table bg-light my-4">
         <div class="col pt-4">
         <h3 class="text-light">Compatible Blood type Donors</h3>
         </div>
  <thead> 
    <tr>
      <th scope="col">Blood Type</th>
      <th scope="col">Donate Blood To</th>
      <th scope="col">Receive Blood From</th>
    </tr>
  </thead>
  <tbody>
    <tr>
  
      <td>A+</td>
      <td>A+ AB+</td>
      <td>A+ A- O+ O-</td>
    </tr>
    <tr>
     
      <td>A-</td>
      <td>A+ A- AB+ AB-</td>
      <td>A- O-</td>
    </tr>
<tr>
    <td>B+</td>
      <td>B+ AB+</td>
      <td>B+ B- O+ O-</td>
    </tr>
   
    <tr>    <td>B-</td>
      <td>B+ B- AB+ AB-</td>
      <td>B- O-</td>
    </tr>

    <tr>
    <td>O+</td>
      <td>O+ A+ B+ AB+</td>
      <td>O+ O-</td>
    </tr>

    <tr>
    <td>O-</td>
      <td>Everyone</td>
      <td>O-</td>
    </tr>

    <tr>
    <td>AB+</td>
      <td>AB+</td>
      <td>Everyone</td>
    </tr>

    <tr>
    <td>AB-</td>
      <td>AB+ AB-</td>
      <td>AB- A- B- O-</td>
    </tr>

  </tbody>
</table>
      </div>
      
    </div>
</main>

<!-- footer starts here -->
<?php
    include 'includes/footer.php'
   ?>


<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>