<?php
include 'function/Login.php';
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
    <script src="javascript/page.js"></script>
    <style>
        #navbar {
            background-color: #b97272 !important;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="images/VitaCare.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav fs-5 ms-auto text-center">
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" aria-current="page" href="index.php">
                <i class="fas fa-home"></i> Home
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'appointment.php') ? 'active' : ''; ?>" href="appointment.php">
                <i class="fas fa-calendar-check"></i> Book Appointment
              </a>
            </li>

            <li class="nav-item">
    <button class="btn btn-light border-none" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
        <i class="fas fa-user"></i> Receive Blood
    </button>
</li>

       
          </ul>
        </div>
      </div>
    </nav>
</header>
<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="needs-validation" novalidate>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="alert alert-danger"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="userType" class="form-label">User Type</label>
                        <select class="form-select" id="userType" name="userType" required>
                            <option value="" disabled selected>Select User Type</option>
                            <option value="donor">Donor</option>
                            <option value="recipient">Recipient</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="LoginEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="Loginemail" id="LoginEmail1" required>
                    </div>
                    <div class="mb-3">
                        <label for="LoginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="Loginpassword" id="LoginPassword" required>
                    </div>
                    <div class="mb-3 text-center">
                        <span>Don't have an account? <a href="register.php">Register Now</a></span>
                    </div>
                    <div class="mb-3 text-right">
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="page"></div>

<script src="javascript/jquery.js"></script>  
<script src="javascript/activeHover.js"></script>
<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
