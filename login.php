<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'function/UserRegister.php';

// Define the input_filter function
function input_filter($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['login'])) {
    // Check if the database connection is properly configured
    $conn = mysqli_connect("localhost", "root", "", "vitacare_db");
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $userType = input_filter($_POST['userType']); // Get the selected user type
    $email = input_filter($_POST['Loginemail']);
    $password = input_filter($_POST['Loginpassword']);

    // Escape special characters to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);

    // Hash the password before comparing it in the query
    $password = md5($password);

    // Query template
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND user_type = '$userType'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    // Check if a single row was returned
    if (mysqli_num_rows($result) == 1) {
        // Login successful
        session_start();
        $_SESSION['user_type'] = $userType;
        $_SESSION['email'] = $email;

        // Redirect based on user type
        if ($userType === 'donor') {
            header("Location: DonationDashboard/Dprofile.php");
            exit();
        } elseif ($userType === 'recipient') {
            header("Location: RecipientDashboard/Rprofile.php");
            exit();
        }
    } else {
        // Login failed
        $error_message = "Invalid Email or Password";
    }

    // Close the database connection
    mysqli_close($conn);
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
    <!-- this is heading section -->
    <?php
    include 'includes/head.php';
    ?>
    
    <!-- main container starts from here -->
    <div class="container d-flex justify-content-center mt-4">
        <div class="row px-6 my-2 text-dark bg-light w-50 md-w-100 shadow p-3 mb-5 bg-body rounded-3" id="login_wrapper">
            <div class="col mt-3 ">
                <h1 class="text-center">Login</h1>
            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="mt-3 row needs-validation"  novalidate>
            <?php if (isset($_GET['error'])) { ?>
                                <p class="alert alert-danger ">  <?php echo $_GET['error']; ?></p>
                            <?php } ?>
                <div class="mb-3">
                    <label for="userType" class="form-label">User Type</label>
                    <select class="form-select" id="userType" name="userType">
                        <option value="donor">Donor</option>
                        <option value="recipient">Recipient</option>
                    </select>
                </div>

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
                    <span>Don't have an account? <a href="register.php">Register Now</a></span>
                </div>
                <div class="mb-3 text-right">
                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-primary mb-3">Login</button>
                        <button type="reset" class="btn btn-primary mb-3">Cancel</button>
                    </div>
                </div>
                
            </form>
            
        </div>
    </div>
  


    <!-- footer starts here -->
    <?php
    include 'includes/footer.php';
    ?>

    <script src="javascript/jquery.js"></script>
    <script src="javascript/passport_hide_show.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="javascript/validation.js"></script>
</body>
</html>
