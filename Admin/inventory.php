
<?php
// Include the database configuration file
include 'includes/config.php';

// Create an SQL query to fetch the required columns from the 'users' table
$query = "SELECT u.blood_group, SUBSTRING(u.blood_group, 2) AS blood_rh_factor, d.blood_units_donated, u.email, u.contact, u.approval_status, u.requested_date, DATE_ADD(u.requested_date, INTERVAL 1 YEAR) AS expiry_date FROM users u LEFT JOIN donors d ON u.user_id = d.user_id WHERE u.user_type = 'donor' AND u.approval_status = 'approved'";

// Execute the query
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
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
        include ('../Admin/includes/head.php');
    ?>

<?php 
include ('includes/a_dashboard.php');
?>

<main id="main_container">
    <div class="main-area p-4">
        <div class="inner-wrapper p-4">
            <div class="container overflow-hidden">
                <div class="title text-dark">
                    <h1 class="fs-4">List of Blood Requests</h1>
                </div>

                <table class="table table-hover-Info">
                    <thead>
                        <tr class="text-light" style="background-color: #000077;">
                            <th scope="col">Blood Type</th>
                            <th scope="col">Rh-factor</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Expiry Date</th>
                            <th scope="col">Storage Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
    // Check if there are any records in the result set
    if (mysqli_num_rows($result) > 0) {
        // Loop through the records and display them in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['blood_group'] . '</td>';
            echo '<td>' . $row['blood_rh_factor'] . '</td>';
            echo '<td>' . $row['blood_units_donated'] . '</td>';
            echo '<td>' . $row['expiry_date'] . '</td>';
            echo '<td>' . $row['requested_date'] . '</td>';
          
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="7">No users found.</td></tr>';
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script src="fontawesome/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>
