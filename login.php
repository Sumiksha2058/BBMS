<<<<<<< HEAD
<!-- <?php
=======
<?php
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
ini_set('display_errors', '1');
error_reporting(E_ALL);

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

    // Query template
    $sql = "SELECT * FROM users WHERE email = '$email' AND user_type = '$userType'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }

    // Check if a single row was returned
    if (mysqli_num_rows($result) == 1) {
        // Fetch user data
        $row = mysqli_fetch_assoc($result);

        // Verify the password using password_verify
        if (password_verify($password, $row['password'])) {
            // Login successful
            session_start();
            $_SESSION['user_type'] = $userType;
            $_SESSION['email'] = $email;
        
            // Redirect based on user type
            if ($userType === 'donor') {
                header("Location: DonationDashboard/Dprofile.php");
                exit();
            } 
            if ($userType === 'recipient') {
                header("Location: RecipientDashboard/Rprofile.php");
                exit();
            }
        } 
    }

    // Login failed
    $error_message = "Invalid Email or Password";

    // Pass the error message as a query parameter
<<<<<<< HEAD
    header("Location: index.php?error=" . urlencode($error_message));
=======
    header("Location: login.php?error=" . urlencode($error_message));
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
    exit();

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
<<<<<<< HEAD
    <?php include 'includes/head.php'; ?>
    
    <main>
        <div class="container" id="main_wrapper">
            <div class="row py-3 justify-content-center">
                <div class="col-md-8">
                    <div id="carouselCaptions" class="carousel slide fixed-carousel" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/donate1.png" class="d-block w-100" alt="Slide 1" style="object-fit: cover;">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Donate Blood, Save Lives</h5>
                                    <p>Your blood donation can be the difference between life and death for someone in need. Join the cause and give the gift of life.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="images/donate2.png" class="d-block w-100" alt="Slide 2" style="object-fit: cover;">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Join Us Today</h5>
                                    <p>Every drop counts! Contribute to your community and help those in need.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="images/donate3.png" class="d-block w-100" alt="Slide 3" style="object-fit: cover;">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Make a Difference</h5>
                                    <p>Your contribution can save lives. Be a hero and donate blood today!</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="col-md-12 pt-4 text-center">
                        <button class="btn btn-light border-none" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <img src="images/donateBlood Button.png" alt="donationButton" style="max-width: 100%; height: auto;">
                        </button>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 mt-5 ">
                <div class="col-md-12">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut aspernatur debitis neque consequuntur vitae impedit, accusantium mollitia in odio. Est, nihil.</p>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 mt-5">
                <div class="col-md">
                    <img class="img-fluid pb-4" id="tube" src="images/AboutUsImg.png" alt="Blood Tube">
                </div>
                
                <div class="col-md">
                    <div class="table-responsive" style="max-height: 100%; overflow-y: auto;">
                        <table class="table table-bordered table-striped rounded" id="scrollableTable">
                            <thead class="table divder">
                                <tr>
                                    <th scope="col"><h4>News Feed</h4></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td> Emily Johnson is undergoing a critical procedure and requires AB-positive blood. Donations can be made at the hospital's donation center. Contact (234) 567-8901 for more information.</td></tr>
                                <!-- Other news items -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

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
                            <label for="LoginPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="Loginpassword" id="LoginPassword1" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
=======
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
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
