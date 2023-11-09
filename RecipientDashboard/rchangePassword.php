<?php
  session_start();
include "includes/config.php";

if(isset($_SESSION['recp_email'])){
    if(isset($_POST['changePass'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $oldpass = validate($_POST['oldpass']);
    $npass = validate($_POST['npass']);
    $cpass = validate($_POST['cpass']);

    if(empty($oldpass)){
        header("location: rchangePassword.php?error=Please enter Old Password");
        exit();
    }else if (empty($npass)) {
        header("location: rchangePassword.php?error=Please enter new password");
        exit();
    } else if ($npass !== $cpass) {
        header("location: rchangePassword.php?error=Passwords do not match");
        exit();
    }else {
        $npass = md5($npass);
        $oldpass = md5($oldpass);
        $email = $_SESSION['recp_email'];

        $sql = "SELECT recp_password FROM recipient WHERE recp_email = '{$email}' AND recp_password ='{$oldpass}' ";
        $result = mysqli_query($conn, $sql);

        $sql_2 = "UPDATE recipient SET recp_password = ? WHERE recp_email = ?";
         $stmt = mysqli_prepare($conn, $sql_2);

         if ($stmt) {
             mysqli_stmt_bind_param($stmt, "ss", $npass, $email);
             mysqli_stmt_execute($stmt);
             header("location: rchangePassword.php?success=Password is successfully changed");
             exit();
         } else {
             header("location:rchangePassword.php?error=Failed to update password");
             exit();
         }
     }
    }
}

?>  


<!DOCTYPE htm../RecipientDashboard/l>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
<div class="col col-md-4 float-end" id="searchResults"></div>

<?php 
include ('../RecipientDashboard/includes/head.php');
include ('../RecipientDashboard/includes/r_dashboard.php'); 
?>  

<main id="main_container">
<div class="main-area P-4">
    <div class="inner-wrapper px-4">
        <div class="container-fluid text-light mt-5 rounded d-flex justify-content-center">

        <div class="row bg-light shadow-lg w-50 rounded text-dark p-3 items-center mb-3">
           <h1>Change Password</h1> 
           <hr>
           <?php if (isset($_GET['error'])) { ?>
                <p class="alert alert-danger ">  <?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="alert alert-success "><?php echo $_GET['success']; ?></p>
            <?php } ?>
           <form action="rchangePassword.php" method="post" class="row needs-validation " novalidate>
           
            <div class="mb-3">
                <h4><label for="InputOldpassword" class="form-label">Old password</label></h4>
                <input type="password" name="oldpass" class="form-control" id="InputOldpassword" aria-describedby="emailHelp">
                <div id="passportHelp" class="form-text text-light">
                    We'll never share your email with anyone else.
                </div>
            </div>
            <div class="mb-3">
                <h4><label for="NewInputPassword1" class="form-label">New Password</label></h4>
                <input type="password" name="npass" class="form-control " id="NewInputPassword1">
            </div>

            <div class="mb-3">
                <h4><label for="ConformInputPassword1" class="form-label">Confirm Password</label></h4>
                <div class="input-group">
                <input type="password" name="cpass" class="form-control " id="ConformInputPassword1">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <a href="#" class="text-dark" id="click-eye">
                            <i class="fa fa-eye color-dark" id="icon" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                </div>
            </div>

           
                <button type="submit" name="changePass" class="btn btn-dark">Submit</button>
            
        </form>
    
         </div>
        </div>
    </div>
    </div>

</main>

<script src="javascript/activeHover.js"></script>
<script src="javascript\passport_hide_show.js"></script>
<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>