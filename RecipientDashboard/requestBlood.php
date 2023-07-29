<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>

<?php 
        include 'C:\xampp\htdocs\VitaCare\RecipientDashboard\includes\head.php';
    ?>



<?php 
        include 'C:\xampp\htdocs\VitaCare\RecipientDashboard\includes\r_dashboard.php';
    ?>

<main id="main_container">

<div class="main-area p-4">
    <div class="inner-wrapper p-4">
        <div class="container-fluid text-light">

        <div class="row bg-light w-50 rounded text-dark p-3 items-center mb-3">
           <h1>Request Blood</h1> 


           <form>
  <div class="mb-3">
   <h4> <label for="InputBloodType" class="form-label">Blood Type</label></h4>
    <input type="email" class="form-control" id="InputBloodType" aria-describedby="InputBloodHelp">
    
  </div>
  <div class="mb-3">
   <h4> <label for="quantity" class="form-label">Quantity</label></h4>
    <input type="text" class="form-control" id="quantity">
  </div>

  <div class="mb-3">
    <h4><label for="urgencey" class="form-label">Urgencey</label></h4>
    <input type="text" class="form-control " id="urgencey">
  </div>

  <div class="mb-3">
    <h4><label for="message" class="form-label">Message</label></h4>
    <textarea class="form-control mb-4" placeholder="Your message" name="message"required></textarea>
  </div>


  <button type="submit" class="btn btn-dark">Submit</button>
</form>
</div>
</div>
        </div>
    </div>
</div>

</main>



<script src="fontawesome/js/all.min.js"></script>
<script src="javascript/min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>