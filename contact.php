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



</head>
<body class="bd-light">

<!-- this is headiding section -->
  <?php
    include 'includes/head.php'
   ?>
    
    <!-- main container starts from here -->

    <div class="main_wapper">
        <div class="container">
            <div class="row">
            <div class="col col-sm-5 col-md-6  appo">
                 
                  <div class="shadow mb-5 bg-body rounded">
                  <h1 class="fs-auto">Contact Us</h1>
                  </div>
                  <!-- form of appointment -->

                  <form action="#" method="post" class=" row g-2 needs-validation" novalidate>
                   
                    <input  type="text" class="form-control  mb-4"id="validationTooltipName" aria-describedby="validationTooltipNamePrepend" placeholder="Name" name="name" required>
                    <div class="invalid-feedback">
                        Please fill you Name
                    </div>
                   
                    <input type="email" class="form-control mb-4" id="validationTooltipEmail" aria-describedby="validationTooltipEmail" placeholder="Email" name="email" required>
                    <div class="invalid-feedback">
                        Please fill you Email ID
                    </div>
                   
                    <input type="text" class="form-control mb-4" placeholder="Phone" name="phone">

                    <textarea class="form-control mb-4" placeholder="Your message" name="message"required></textarea>
                    
                    
                    <button type="submit" name="send"  class="btn btn-#CC6666 mt-3 appobtn mb-4">
                    <i class="fa-brands fa-telegram"></i>
                    <span class="ms-2">Send</span>
                    </button>
                  </form>
            </div>
            <div class="col-sm-5 col-md-6 mt-0 mt-5 appoImg">
                <img class="img-fluid " src="images/contact.png" alt="appoint Img">
            </div>
            </div>
        </div>
    </div>
<!-- footer starts here -->
<?php
    include 'includes/footer.php';
   ?>

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send'])){
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['phone'];
$msg = $_POST['message'];



//Load Composer's autoloader
require '/opt/lampp/htdocs/BBMS/phpmailer/Exception.php';
require '/opt/lampp/htdocs/BBMS/phpmailer/PHPMailer.php';
require '/opt/lampp/htdocs/BBMS/phpmailer/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'npsumiksha@gmail.com';                     //SMTP username
    $mail->Password   = 'kdpr uopv jtkx zcgp ';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('npsumiksha@gmail.com', 'Contact Form');
    $mail->addAddress('neupanesumiksha@gmail.com', 'VitaCare');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Contact Form';
    $mail->Body    = "Sender Name - $name <br> Sender Email - $email <br> Sender Contact - $phone <br> Sender Message - $msg ";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>

<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="javascript/validation.js"></script>
</body>
</html>