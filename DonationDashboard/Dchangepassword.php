<?php
session_start();

include "includes/config.php";

if(isset($_SESSION['email'])){

    if (isset($_POST['oldpass']) && isset($_POST['npass']) && isset($_POST['cpass'])) {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $oldpass = validate($_POST['oldpass']);
        $npass = validate($_POST['npass']);
        $cpass = validate($_POST['cpass']);


        if (empty($oldpass)) {
            header("location: ..\DonationDashboard\Dchangepassword.php?error=Please enter Old Password");
            exit();
        } else if (empty($npass)) {
            header("location: ..\DonationDashboard\Dchangepassword.php?error=Please enter new password");
            exit();
        } else if ($npass !== $cpass) {
            header("location: ..\DonationDashboard\Dchangepassword.php?error=Passwords do not match");
            exit();
        } else {
           $npass = md5($npass);
           $oldpass = md5($oldpass);
           $email = $_SESSION['email'];

           $sql = "SELECT password FROM users WHERE email = '{$email}' AND password ='{$oldpass}' ";
           $result = mysqli_query($conn, $sql);

           $sql_2 = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql_2);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $npass, $email);
                mysqli_stmt_execute($stmt);
                header("location: ..\DonationDashboard\Dchangepassword.php?success=Password is successfully changed");
                exit();
            } else {
                header("location: ..\DonationDashboard\Dchangepassword.php?error=Failed to update password");
                exit();
            }
           
        }
    }

}else{
    header("location: ..\DonationDashboard\Dchangepassword.php");
            exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body >

    <?php include 'includes/head.php'; ?>

    <?php include 'includes/d_dashboard.php'; ?>

    <main id="main_container" >

        <div class="main-area p-4 " style="background-color: #f8f9fa;">
            <div class="inner-wrapper  p-4">
                <div class="container-fluid text-light">

                    <div class="row bg-light w-50 rounded text-dark p-3 items-center">
                        <h1 class="mb-3 ">Change Password</h1>

                        <form action="Dchangepassword.php" method="post" class="row needs-validation " novalidate>
                            <div class="">
                            <?php if (isset($_GET['error'])) { ?>
                                <p class="alert alert-danger ">  <?php echo $_GET['error']; ?></p>
                            <?php } ?>

                            <?php if (isset($_GET['success'])) { ?>
                                <p class="alert alert-success ">  <?php echo $_GET['success']; ?></p>
                            <?php } ?>
                            </div>
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
                                <input type="password" name="cpass" class="form-control " id="ConformInputPassword1">
                            </div>
                            <button type="submit" name="changePass" class="btn btn-dark">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="javascript/validation.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>

</html>
