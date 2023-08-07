<?php
include 'functions/vc_register.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="VitaCare.ico" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>
<body class="bg-light">
    <!-- this is heading section -->
 
    
    <!-- main container starts from here -->
    <div class="container d-flex justify-content-center">
        <div class="row px-6 my-2 text-dark bg-light w-75 md-w-100 shadow p-3 mb-5 bg-body rounded-3" id="login_wrapper">
            <div class="col mt-3 ">
                <h1 class="text-center">Admin Registration Form</h1>
            </div>
            <form method="POST" action="register.php" class="mt-3 row needs-validation"  novalidate>
            <?php if (isset($_GET['error'])) { ?>
                <p class="alert alert-danger ">  <?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                                <p class="alert alert-success ">  <?php echo $_GET['success']; ?></p>
            <?php } ?>

                <div class="sm-6 mb-3">
                    <label for="vcfullname" class="form-label">Fullname</label>
                    <div class="form-group">
                        <input type="email" class="form-control" name="vcfullname" id="vcfullname" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="sm-6 mb-3">
                    <label for="vcaddress" class="form-label">Address</label>
                    <div class="form-group">
                        <input type="email" class="form-control" name="vcaddress" id="vcaddress" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="sm-6 mb-3">
                    <label for="vcemail" class="form-label">Email address</label>
                    <div class="form-group">
                        <input type="email" class="form-control" name="vcemail" id="vcemail" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="sm-6 mb-3">
                    <label for="vcpassword" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="vcpassword" id="vcpassword">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a href="#" class="text-dark" id="click-eye">
                                    <i class="fa fa-eye color-dark" id="icon" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sm-6 mb-3">
                    <label for="vc_conpassword" class="form-label">Comform Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="vc_conpassword" id="vc_conpassword">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a href="#" class="text-dark" id="click-eye">
                                    <i class="fa fa-eye color-dark" id="icon" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-center">
                    <span>Already have an account? <a href="register.php"> Login Now</a></span>
                </div>
                <div class="mb-3 text-right">
                    <div class="form-group  float-end">
                        <button type="submit" name="vcRegister" class="btn btn-primary mb-3">Register</button>
                        <button type="reset" class="btn btn-primary mb-3">Cancel</button>
                    </div>
                </div>
                
            </form>
            
        </div>
    </div>
  
<!-- Rest of your HTML code remains the same -->

    <!-- footer starts here -->
    <!-- <?php
    include 'includes/footer.php';
    ?> -->

   
    <script src="javascript/passport_hide_show.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="javascript/validation.js"></script> -->
</body>
</html>
