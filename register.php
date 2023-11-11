<?php
include 'function/UserRegister.php';
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
    <link rel="shortcut icon" href="VitaCare.ico" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>
<body>
    
<?php 
include 'includes/head.php'
?>

<div class="container shadow-lg bg-body w-50 my-3 rounded d-flex justify-content-center image" id="image">
   
<div class="row m-4 ms-3  justify-content-right">
        <div class="col-md-6 w-100 "> <!-- Define the column width -->
            <h1 class="text-center mt-3 fs-auto">Registration Form</h1>
            <hr>
            <?php
            if (count($errors) > 0) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="alert alert-success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
           
           

        

            <form method="post" action="register.php" id="registrationForm" class="row needs-validation" novalidate>
                <div class="col-md-8 w-100">
                    <label for="userType" class="form-label">Select User Type:</label>
                    <select name="userType" class="form-select" value="<?php echo $userTypeValue; ?>">
                        <option value="donor">Donor</option>
                        <option value="recipient">Recipient</option>
                    </select>
                </div>
                <!-- Donor/Recipient common fields -->
                <div class="col-md-8 w-100">
                    <label for="fullName" class="form-label fs-auto">Full Name</label>
                    <input type="text" name="fullname" class="form-control" id="fullName" value="<?php echo $fullnameValue; ?>" placeholder="Enter your full name" required>
                </div>

                <div class="col-md-8 w-100">
                    <label class="form-label">Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Male" name="gender" id="gender" required>
                        <label class="form-check-label" for="gender">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Female" name="gender" id="genderFemale" required>
                        <label class="form-check-label" for="genderFemale">Female</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Other" name="gender" id="genderOther" required>
                        <label class="form-check-label" for="genderOther">Other</label>
                    </div>
                </div>

                <div class="col-md-8 w-100">
                    <label for="age" class="form-label fs-auto">Age</label>
                    <input type="number" class="form-control" name="age" id="age" value="<?php echo $ageValue; ?>"  placeholder="Enter Your Age" required>
                </div>

                <div class="col-md-8 w-100">
                    <label for="email" class="form-label fs-auto">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $emailValue; ?>"  placeholder="Enter your email" required>
                </div>

                <div class="col-md-8 w-100">
                    <label for="contact" class="form-label fs-auto">Contact</label>
                    <input type="text" class="form-control" name="contact" id="contact"  value="<?php echo $contactValue; ?>" placeholder="Enter your contact number" required>
                </div>

                <div class="col-md-8 w-100">
                    <label for="bloodGroup" class="form-label fs-auto">Blood Group</label>
                    <select class="form-select" name="donorBlood"  id="bloodGroup" required>
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

                <div class="col-md-8 w-100">
                    <label for="password" class="form-label fs-auto">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <!-- <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a href="#" class="text-dark" id="click-eye">
                                    <i class="fa fa-eye color-dark" id="icon" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div> -->
                    </div>
                    <div id="passwordHelpBlock" class="form-text">
                        <?php if (isset($_GET['error'])) { ?>
                            <p class="text-danger"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-8 w-100 mb-3">
                    <label for="confirmPassword" class="form-label fs-auto">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="con_password" id="confirmPassword" placeholder="Re-enter Password" required>
                        <!-- <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a href="#" class="text-dark" id="click-eye">
                                    <i class="fa fa-eye color-dark" id="icon" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-md-8 text-center w-100 mb-4">
                    <span>Already registered? <a href="login.php"><span>Login Here</span></a></span>
                </div>
                
                <div class="col-md-8 w-100">
                <button type="submit" name="submitForm" class="btn btn-primary fs-auto">Register</button>
                <button type="reset" class="btn btn-primary fs-auto">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include 'includes/footer.php'
?>


<script src="javascript/passport_hide_show.js"></script>
<script src="javascript/validation.js"></script>
<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
