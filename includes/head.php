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
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-#2F3936" id="navbar">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="images/VitaCare.png" alt="Logo"></a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse containt-fluid"  id="navbarSupportedContent">
          <ul class="navbar-nav fs-5 ms-auto text-center">
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'donor.php') ? 'active' : ''; ?>" href="donor.php">Donors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'recepient.php') ? 'active' : ''; ?>" href="recepient.php">Recipient</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'appointment.php') ? 'active' : ''; ?>" href="appointment.php">Book Appointment</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'register.php') ? 'active' : ''; ?>" href="register.php">Register Here</a>
            </li>
            
            
          </ul>
        </div>
      </div>
    </nav>
    
</header>
<div id="page"></div>


 <script src="javascript/jquery.js"></script>  
<script src="javascript/activeHover.js"></script>
<script src="fontawesome/js/all.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>