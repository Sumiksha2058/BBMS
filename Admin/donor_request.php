
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
                    <h1 class="fs-4">List of Donors Request</h1>
                    <hr>
                    <!-- Button trigger modal -->
                    <div class="mb-2 float-end">
                        <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-plus me-2"></i>Add Donor
                        </button> -->
                        <a href="../register.php"><button class="btn btn-success" ><i class="fa fa-plus" aria-hidden="true"></i> Add Donor</button></a>
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
