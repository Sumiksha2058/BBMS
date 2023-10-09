<?php include 'function/UserRegister.php' ?>

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
<body>
    
<?php 
include 'includes/head.php'
?>
    
    <form method="post" action="register.php" id="registrationForm"  class="row needs-validation    " novalidate >
          
        
       
    
          <div class="form-section active ms-3" id="donor">
          
              <div class="col md-6">
                  <label for="donorName" class="form-label fs-auto ">Full Name</label>
                  <input type="text" name="fullname" class="form-control"  id="donorName" placeholder="Enter your full name" required>
              </div>

              <div class="col md-6">
                  <label  class="form-label">Gender</label>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" value="Male" name="gender" id="gender" >
                  <label class="form-check-label"  for="gender">
                      Male
                  </label>
                  </div>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" value="Female" name="gender" id="flexRadioDisabled" >
                  <label class="form-check-label" for="flexRadioDisabled">
                      Female
                  </label>
                  </div>
                  <div class="form-check">
                  <input class="form-check-input" type="radio" value="Other" name="gender" id="flexRadioDisabled">
                  <label class="form-check-label" for="flexRadioDisabled">
                      Other
                  </label>
                  </div>
              </div>

              <div class="col md-6">
                  <label for="donoAge" class="form-label fs-auto ">Age</label>
                  <input type="number" class="form-control" name="age" id="donoAge" placeholder="Enter Your" required>
              </div>

              <div class="col md-6">
                  <label for="donorEmail" class="form-label fs-auto">Email</label>
                  <input type="email" class="form-control" name="email" id="donorEmail" placeholder="Enter your email" required>
              </div>
              <div class="col md-6">
                  <label for="donorContact" class="form-label fs-auto">Contact</label>
                  <input type="text" class="form-control" name="contact" id="donorContact" placeholder="Enter your contact number" required>
              </div>
              <div class="col md-6">
                  <label for="donorBloodGroup" class="form-label fs-auto">Blood Group</label>
                  <select class="form-select" name="donorBlood" id="donorBloodGroup" required>
                      <option selected>Select blood group</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                  </select>
              </div>
            
              <div class="col md-6">
                <label for="DonorPassword" class="form-label fs-auto">Password</label>
                <div class="input-group">
                <input type="password" class="form-control" name="password" id="DonorPassword" placeholder="Password" required>
                <div class="input-group-prepend">
                          <div class="input-group-text">
                              <a href="#" class="text-dark" id="click-eye">
                                  <i class="fa fa-eye color-dark" id="icon" aria-hidden="true"></i>
                              </a>
                          </div>
                          </div>
                          
                      </div>
                      <div id="passwordHelpBlock" class="form-text">
                          <?php if (isset($_GET['error'])) { ?>
                              <p class="text-danger ">  <?php echo $_GET['error']; ?></p>
                          <?php } ?>
                      </div>
                      </div>   
              
              <div class="col md-6">
                <label for="DonorConformPassword" class="form-label fs-auto">Confirm Password</label>
                <div class="input-group">
                <input type="password" class="form-control " name="con_password" id="DonorConformPassword" placeholder="Re-enter Password" required>
                <div class="input-group-prepend">
                          <div class="input-group-text">
                              <a href="#" class="text-dark" id="click-eye">
                                  <i class="fa fa-eye color-dark" id="icon" aria-hidden="true"></i>
                              </a>
                          </div>
                      </div>
                      </div>
              </div>
              <br>
              <div class="col md-6 text-center mb-3 ">
                  <span>Already registered? <a href="login.php"><span>Login Here</span></a></span>
                </div>
              <div class="col md-6 float-end">
                  <button type="submit" name="register" class="btn btn-primary fs-auto">Register</button>
                  <button type="reset" class="btn btn-primary fs-auto">Cancel</button>
                </div>

          </div>
      </form>
        

    <?php 
include 'includes/footer.php'
?>


<script src="javascript/passport_hide_show.js"></script>
<script src="javascript/validation.js"></script>
<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>