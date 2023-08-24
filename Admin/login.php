<?php

include 'functions\vc_register.php';
//filtering donor inpurs
function input_filter($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['login'])) {
    $a_email = input_filter($_POST['Loginemail']);
    $password = input_filter($_POST['Loginpassword']);

    //escaping special symbols used in SQL statement
    $a_email = mysqli_real_escape_string($conn, $a_email);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash the password before comparing it in the query
    $password = md5($password);

    //query templates
    $sql_admin =  "SELECT admin_id, a_email FROM vc_admin WHERE a_email = '$a_email' AND a_password = '$password'";
    // Prepare the statements
    $admin_result = mysqli_query($conn, $sql_admin);
   
    if ($admin_result && mysqli_num_rows($admin_result) == 1) {
        session_start();
        $_SESSION['a_email'] = $a_email;
        header("Location: index.php");
        exit();
    } else {      
        header("location: login.php?error=Invalid Email or Password");
        exit();
    }
} 
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

    <!-- main containin starts from here -->
    <div class="container  d-flex justify-content-center">
        <div class="row px-6 my-2 text-dark bg-light shadow w-50 md-w-100 mb-5 bg-body rounded-3" id="login_wrapper">
            <div class="col py-2 shadow ">
                <h1 class="text-center">Admin Login</h1>

            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-3 row needs-validation"  novalidate>
            <?php if (isset($_GET['error'])) { ?>
                                <p class="alert alert-danger ">  <?php echo $_GET['error']; ?></p>
                            <?php } ?>
                <div class="sm-6 mb-3">
                    <label for="LoginEmail1" class="form-label">Email address</label>
                    <div class="form-group">
                        <input type="email" class="form-control" name="Loginemail" id="LoginEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="sm-6 mb-3">
                    <label for="LoginPassword" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="Loginpassword" id="LoginPassword">
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
                    <p>Don't have an account? <a href="register.php">Register Now</a></p>
                </div>
                <div class=" mb-3 text-center ">
                    <div class=" form-group ">
                        <button type="submit" name="login" class="btn btn-dark mb-3 w-100">Login</button>
                        
                    </div>
                </div>               
            </form>           
        </div>
    </div>
  

    <script src="javascript/jquery.js"></script>
    <script src="javascript/passport_hide_show.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="javascript/validation.js"></script>
</body>
</html>
