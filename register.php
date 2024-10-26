<?php
include 'function/UserRegister.php';
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

<!-- Container for Form and Image -->
<div class="container shadow-lg bg-none w-80 my-3 rounded" id="image">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 d-flex justify-content-center">
            <img src="images/signupbg.jpg" class="img-fluid rounded" alt="Signup Background">
        </div>

        <!-- Form Section -->
        <div class="col-md-6 p-4">
            <h4 class="text-left mt-3 fs-auto">Register to save lives!!!</h4>
            <hr>
            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="alert alert-success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <form method="post" action="register.php" id="registrationForm" class="needs-validation" novalidate>

                <!-- User Type -->
                <div class="row mb-3">
                <div class="col-md-4">
                    <label for="userType" class="form-label">User Type:</label>
                    <select name="userType" class="form-select" required>
                        <option value="donor" <?php echo ($userTypeValue === 'donor') ? 'selected' : ''; ?>>Donor</option>
                        <option value="recipient" <?php echo ($userTypeValue === 'recipient') ? 'selected' : ''; ?>>Recipient</option>
                    </select>
                </div>

                <!-- Row 1: Full Name and Age -->
                
                    <div class="col-md-4">
                        <label for="fullName" class="form-label fs-auto">Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullName" value="<?php echo htmlspecialchars($fullnameValue); ?>" placeholder="Enter your full name" required>
                    </div>

                    <div class="col-md-4">
                        <label for="age" class="form-label fs-auto">Age</label>
                        <input type="number" class="form-control" name="age" id="age" value="<?php echo htmlspecialchars($ageValue); ?>" placeholder="Enter Your Age" required>
                    </div>
                </div>

                <!-- Gender -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Male" name="gender" id="genderMale" <?php echo ($genderValue === 'Male') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="genderMale">Male</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Female" name="gender" id="genderFemale" <?php echo ($genderValue === 'Female') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="genderFemale">Female</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="Other" name="gender" id="genderOther" <?php echo ($genderValue === 'Other') ? 'checked' : ''; ?> required>
                            <label class="form-check-label" for="genderOther">Other</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="bloodGroup" class="form-label fs-auto">Blood Group</label>
                        <select class="form-select" name="donorBlood" id="bloodGroup" required>
                            <option selected>Select blood group</option>
                            <option value="O+" <?php echo ($blood_group === 'O+') ? 'selected' : ''; ?>>O+</option>
                            <option value="O-" <?php echo ($blood_group === 'O-') ? 'selected' : ''; ?>>O-</option>
                            <option value="A+" <?php echo ($blood_group === 'A+') ? 'selected' : ''; ?>>A+</option>
                            <option value="A-" <?php echo ($blood_group === 'A-') ? 'selected' : ''; ?>>A-</option>
                            <option value="B+" <?php echo ($blood_group === 'B+') ? 'selected' : ''; ?>>B+</option>
                            <option value="B-" <?php echo ($blood_group === 'B-') ? 'selected' : ''; ?>>B-</option>
                            <option value="AB+" <?php echo ($blood_group === 'AB+') ? 'selected' : ''; ?>>AB+</option>
                            <option value="AB-" <?php echo ($blood_group === 'AB-') ? 'selected' : ''; ?>>AB-</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label fs-auto">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($emailValue); ?>" placeholder="Enter your email" required>
                    </div>
                </div>


                <!-- Row 3: Contact and Password -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="contact" class="form-label fs-auto">Contact</label>
                        <input type="number" class="form-control" name="contact" id="contact" value="<?php echo htmlspecialchars($contactValue); ?>" placeholder="Enter your contact number" required>
                    </div>

                    <div class="col-md-6">
                        <label for="address" class="form-label fs-auto">Address</label>
                        <input type="text" class="form-control" name="address" id="address" value="<?php echo htmlspecialchars($addressValue); ?>" placeholder="Enter your address" required>
                    </div>
                </div>
                <!-- New Password -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label fs-auto">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                <!-- Confirm Password -->
                <div class="col-md-6">
                    <label for="confirmPassword" class="form-label fs-auto">Confirm Password</label>
                    <input type="password" class="form-control" name="con_password" id="confirmPassword" placeholder="Re-enter Password" required>
                </div>
                </div>

                <!-- Login Link -->
                <div class="text-center mb-3 w-100">
                    <span>Already registered? <a href="login.php"><span>Login Here</span></a></span>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-right ">
                    <button type="submit" name="submitForm" class="btn btn-primary fs-auto me-2">Register</button>
                    <button type="reset" class="btn btn-secondary fs-auto">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include 'includes/footer.php';
?>

<!-- Include JS files -->
<script src="javascript/passport_hide_show.js"></script>
<script src="javascript/validation.js"></script>
<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
