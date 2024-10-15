<?php
include 'includes/config.php';
include 'functions/add_donor.php';

$query = "SELECT u.user_id, u.email, u.blood_group, u.requested_date, u.* 
          FROM donors d 
          JOIN users u ON d.user_id = u.user_id
          WHERE u.approval_status = 'approved' AND u.user_type = 'donor'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
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
            <div class="title text-dark">
                <h1 class="fs-4">List of Donors</h1>
                <hr>
            </div>
            <?php
            if(mysqli_num_rows($result) > 0) {
                echo "<table class='table table-hover'>";
                echo "<thead>";
                echo "<tr class='text-light' style='background-color: #000077;'>";
                echo "<th scope='col'>ID</th>";
                echo "<th scope='col'>Email</th>";
                echo "<th scope='col'>Blood Type</th>";
                echo "<th scope='col'>Storage Date</th>";
                echo "<th scope='col'>Expiry Date</th>";
                // Add more table headers for the user data if needed
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while($request_data = mysqli_fetch_array($result)) {
                    echo "<tr class='p-2'>";
                    echo "<td>".$request_data['user_id']."</td>";
                    echo "<td>".$request_data['email']."</td>";
                    echo "<td>".$request_data['blood_group']."</td>";
                    echo "<td>".$request_data['bloodStorage_date']."</td>";
                    echo "<td>".$request_data['bloodExpiry_date']."</td>";
                    // Add more table cells for the user data if needed
                    echo "</tr>";
                }
            } else {
                echo "<h3 class='text-center mt-5'>No Data Found</h3>";
            }
            ?>
        </tbody>
    </table>     
</div> 
</div>
</main>
<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>