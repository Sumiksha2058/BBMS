<?php include 'function/UserRegister.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/register.css">
    <link rel="shortcut icon" href="VitaCare.ico" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="fontawesome/css/all.min.css">
 
</head>
<body>
    
<?php 
include 'includes/head.php'
?>
    
    <div class="container shadow-lg  bg-body rounded d-flex justify-content-center">
      <div class="row ${1| ,row-cols-2,row-cols-3, auto, justify-content-center,|}  w-75">
        
      
        <h1 class="text-center fs-auto">Registration Form</h1>
        <div class="shadow p-3 bg-body rounded">
        <div class="d-flex justify-content-center">
            <div id="btn"></div>
            <button type="button" class="btn toggle-btn fs-auto" data-section="donor" id="donorButton">Donor</button>
            <button type="button" class="btn toggle-btn fs-auto" data-section="recipient" id="recipientButton">Recipient</button>
        </div>
       </div>
       <?php
            // $errors = array();
        if (count($errors) > 0) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])) { ?>
                                <p class="alert alert-success ">  <?php echo $_GET['success']; ?></p>
                            <?php } ?>
        <form method="post" action="register.php" id="registrationForm"  class="row needs-validation    " novalidate >
          
        
        <!-- Dysplaying validation -->
       
     
       
  


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
     
        <form method="post" action="register.php" class="row needs-validation" novalidate >

  
       
            <!-- Recipient Form Section -->

            <div class="form-section gy-4" id="recipient">
                <div class="col md-6">
                    <label for="recipientName" class="form-label">Full Name</label>
                    <input type="text" name="recp_fullname" class="form-control" id="recipientName" placeholder="Enter your full name">
                </div>
                <div class="col md-6">
                    <label  class="form-label">Gender</label>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" value="Male" name="recp_gender" id="gender" >
                    <label class="form-check-label"  for="gender">
                        Male
                    </label>
                    </div>
                    <div class="form-
                    check">
                    <input class="form-check-input" type="radio" value="Female" name="recp_gender" id="flexRadioDisabled" >
                    <label class="form-check-label" for="flexRadioDisabled">
                        Female
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" value="Other" name="recp_gender" id="flexRadioDisabled">
                    <label class="form-check-label" for="flexRadioDisabled">
                        Other
                    </label>
                    </div>
                </div>
               
                <div class="col md-6">
                    <label for="recipientAge" class="form-label fs-auto ">Age</label>
                    <input type="number" class="form-control" name="recp_age" id="recipientAge" placeholder="Enter Your Age" required>
                </div>
                <div class="col md-6">
                    <label for="recipientEmail" class="form-label">Email</label>
                    <input type="email" name="recp_email" class="form-control" id="recipientEmail" placeholder="Enter your email">
                </div>
                <div class="col md-6">
                    <label for="recipientContact" class="form-label">Contact</label>
                    <input type="text" name="recp_contact" class="form-control" id="recipientContact" placeholder="Enter your contact number">
                </div>
                <div class="col md-6">
                    <label for="recipientBloodGroup" class="form-label">Required Blood Group</label>
                    <select class="form-select" name="recp_recp_reqblood" id="recipientBloodGroup">
                        <option class="w-75" selected >Select required blood group</option>
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
                    <label for="medicalReport" class="form-label fs-auto ">Medical Report (optional)</label>
                    <input type="file" name="recp_medicalReport" class="form-control"  id="medicalReport">
                </div>
                  <div class="col md-6">
                    <label for="RecipientPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="recp_password" id="RecipientPassword" placeholder="Password">
                    <div id="passwordHelpBlock" class="form-text">
                            <?php if (isset($_GET['error'])) { ?>
                                <p class="text-danger ">  <?php echo $_GET['error']; ?></p>
                            <?php } ?>
                        </div>
                </div>

                  <div class="col md-6">
                    <label for="RecipientConformPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="recp_cpassword" id="RecipientConformPassword" placeholder="Re-enter Password">
                   
                </div>

                  <div class="col md-6 text-center mb-3 ">
                    <span>Already registered <a href="login.php"><span>Login Here</span></a></span>
                  </div>


                  <div class="col md-6 float-end">
                   
                    <button type="submit" name="recp_register" class="btn btn-primary">Register</button>
                    <button type="reset" class="btn btn-primary">Cancel</button>
                  </div>
            </div>
        </div>
  
           
        </form>
    </div>
        

    <?php 
include 'includes/footer.php'
?>
    <script>
        const toggleBtns = document.querySelectorAll('.toggle-btn');
        const formSections = document.querySelectorAll('.form-section');

        toggleBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const sectionId = btn.getAttribute('data-section');
                toggleFormSection(sectionId);
            });
        });

        function toggleFormSection(sectionId) {
            formSections.forEach(section => {
                section.classList.remove('active');
            });

            const section = document.getElementById(sectionId);
            section.classList.add('active');
        }

        document.addEventListener("DOMContentLoaded", function() {
        var donorButton = document.getElementById("donorButton");
        var recipientButton = document.getElementById("recipientButton");
       

        donorButton.addEventListener("click", function() {

            donorButton.style.backgroundColor = "blue";
            donorButton.style.color = "#fff";
            recipientButton.style.backgroundColor = "transparent";
            recipientButton.style.color = "#000";
        });

        recipientButton.addEventListener("click", function() {
            recipientButton.style.backgroundColor = "blue";
            recipientButton.style.color = "#fff";
            donorButton.style.backgroundColor = "transparent";
            donorButton.style.color = "#000";
        });

      
    });
       
    </script>

<script src="javascript/passport_hide_show.js"></script>
<script src="javascript/validation.js"></script>

<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>