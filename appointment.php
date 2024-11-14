<?php
include 'function/ReqAppointment.php';
?>
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

    
     
</head>
<body>

<!-- this is headiding section -->
  <?php
    include 'includes/head.php'
   ?>
    
    <!-- main container starts from here -->

    <div class="main_wapper">
        <div class="container">
            <div class="row">
            <div class="col col-sm-5 col-md-6  appo">
                  <h4 class="fw-bold text-dark">Book Appointment</h4>
                  <hr>
                  <!-- form of appointment -->

                  <form action="appointment.php" method="post" class="mt-3 row g-3 needs-validation" novalidate>
                  <?php
            if (count($errors) > 0):?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
       <?php endif ?>
        <?php if (isset($_GET['success'])) { ?>
                                <p class="alert alert-success ">  <?php echo $_GET['success']; ?></p>
                            <?php } ?>
                            
                    <input  type="text" class="form-control  mb-4"id="validationTooltipName" aria-describedby="validationTooltipNamePrepend" placeholder="Name" name="name" required>
                    <div class="invalid-feedback">
                        Please fill you Name
                    </div>
                   
                    <input type="email" class="form-control  mb-4" id="validationTooltipEmail" aria-describedby="validationTooltipEmail" placeholder="Email" name="email" required>
                    <div class="invalid-feedback">
                        Please fill you Email ID
                    </div>
                   
                    <input type="text" class="form-control mb-4" placeholder="Phone" name="phone"required>
                   
                    <input type="text" class="form-control mb-4" placeholder="Blood Group" name="bloodGroup" required>
                   
                    <input type="date" class="form-control mb-4" placeholder="Appointment Date" name="date" required>
                    
                    <input type="time" class="form-control  mb-3" placeholder="Appointment Time" name="time"required>
                   
        
                    <button type="submit"name="submitappo" class="btn btn-#CC6666 mt-3 appobtn">Book Appointment</button>
                  </form>

            </div>

            <div class="col-sm-5 col-md-6 mt-0 appoImg">
                <img class="img-fluid " src="images/appointment.png" alt="appoint Img">
            </div>
            </div>
        </div>
    </div>
<!-- footer starts here -->
<?php
    include 'includes/footer.php'
   ?>


<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="javascript/validation.js"></script>
</body>
</html>