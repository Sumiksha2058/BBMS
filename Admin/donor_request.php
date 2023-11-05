
<?php
include 'includes/config.php';
include 'functions/add_donor.php';

// Initialize the $errors array
$errors = [];

// Provide initial values for variables
$userTypeValue = '';
$fullnameValue = '';
$ageValue = '';
$emailValue = '';
$contactValue = '';

// Create the SQL query to fetch data
$query = "SELECT * FROM users WHERE user_type = 'donor' AND approval_status = 'pending'";

// Execute the query
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCAdmin</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="includes/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

<?php 
// Include the admin header
include ('../Admin/includes/head.php');
?>

<?php 
// Include the admin dashboard
include ('includes/a_dashboard.php');
?>

<main id="main_container">
    <div class="main-area p-4">
        <div class="inner-wrapper p-4">
            <div class="container overflow-hidden">
                <div class="title text-dark">
                    <h1 class="fs-4">List of Donors</h1>
                    <hr>
                    <!-- Button trigger modal -->
                    <div class="mb-2">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-plus me-2"></i>Add Donor
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <?php
            if (count($errors) > 0) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="alert alert-success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
           
           

        

            <form method="post" action="" id="registrationForm" class="row needs-validation" novalidate>
                <div class="col-md-8 w-100">
                    <label for="userType" class="form-label">Select User Type:</label>
                    <select name="userType" class="form-select" value="<?php echo $userTypeValue; ?>">
                        <option value="donor">Donor</option>
                        <option value="recipient">Recipient</option>
                    </select>
                </div>
                <!-- Donor/Recipient common fields -->
                <div class="col-md-8 w-100">
                    <label for="fullName" class="form-label fs-auto">Full Name</label>
                    <input type="text" name="fullname" class="form-control" id="fullName" value="<?php echo $fullnameValue; ?>" placeholder="Enter your full name" required>
                </div>

                <div class="col-md-8 w-100">
                    <label class="form-label">Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Male" name="gender" id="gender" required>
                        <label class="form-check-label" for="gender">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Female" name="gender" id="genderFemale" required>
                        <label class="form-check-label" for="genderFemale">Female</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Other" name="gender" id="genderOther" required>
                        <label class="form-check-label" for="genderOther">Other</label>
                    </div>
                </div>

                <div class="col-md-8 w-100">
                    <label for="age" class="form-label fs-auto">Age</label>
                    <input type="number" class="form-control" name="age" id="age" value="<?php echo $ageValue; ?>"  placeholder="Enter Your Age" required>
                </div>

                <div class="col-md-8 w-100">
                    <label for="email" class="form-label fs-auto">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $emailValue; ?>"  placeholder="Enter your email" required>
                </div>

                <div class="col-md-8 w-100">
                    <label for="contact" class="form-label fs-auto">Contact</label>
                    <input type="text" class="form-control" name="contact" id="contact"  value="<?php echo $contactValue; ?>" placeholder="Enter your contact number" required>
                </div>

                <div class="col-md-8 w-100">
                    <label for="bloodGroup" class="form-label fs-auto">Blood Group</label>
                    <select class="form-select" name="donorBlood"  id="bloodGroup" required>
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

                <div class="col-md-8 w-100">
                    <label for="password" class="form-label fs-auto">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
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
                            <p class="text-danger"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-8 w-100 mb-3">
                    <label for="confirmPassword" class="form-label fs-auto">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="con_password" id="confirmPassword" placeholder="Re-enter Password" required>
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <a href="#" class="text-dark" id="click-eye">
                                    <i class="fa fa-eye color-dark" id="icon" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 text-center w-100 mb-4">
                    <span>Already registered? <a href="login.php"><span>Login Here</span></a></span>
                </div>
                
                <div class="col-md-8 w-100">
                <button type="submit" name="submitForm" class="btn btn-primary fs-auto">Register</button>
                <button type="reset" class="btn btn-primary fs-auto">Cancel</button>
                </div>
            </form>
                        </div>
                        
                        </div>
                    </div>
                    </div>
                    <?php

if (mysqli_num_rows($result) > 0) {
    echo '<table class="table table-hover">';
    echo '<thead>';
    echo '<tr class="text-light" style="background-color: #000077;">';
    echo '<th scope="col">Request ID</th>';
    echo '<th scope="col">Full Name</th>';
    echo '<th scope="col">Age</th>';
    echo '<th scope="col">Contact</th>';
    echo '<th scope="col">Email</th>';
    echo '<th scope="col">Request Date</th>';
    echo '<th scope="col">Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='p-2'>";
        echo "<td>" . $row['user_id'] . "</td>"; // Updated to 'd_id'
        echo "<td>" . $row['fullname'] . "</td>";
        echo "<td>" . $row['age'] . "</td>";
        echo "<td>" . $row['contact'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['requested_date'] . "</td>"; // Updated to 'requested_date'
        echo "<td>";
        echo "<a class='bg-success text-light fs-5 p-2 px-3 ms-2 rounded' href='functions/approve.php?approve_donor=" . $row['user_id'] . "&email=" . $row['email'] . "'>Accept</a>";
        echo "<a class='bg-danger text-light fs-5 p-2 px-3 ms-2 rounded' href='functions/reject.php?rejected_donor=" . $row['user_id'] . "'>Reject</a>";


        echo "</td>";
        echo "</tr>";
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo "<h3 class='text-center mt-5'>No Pending Donation Requests Found</h3>";
}
?>

                </div>
            </div>
        </div>
    </div>
</main>

<script src="fontawesome/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>
