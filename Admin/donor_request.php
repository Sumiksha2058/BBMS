<?php
include 'includes/config.php';
$query = "SELECT dr.*,d_id, don.fullname, don.age, don.contact,don.email, dr.request_date
FROM donation_requests AS dr
JOIN donor AS don ON dr.email = don.email";
$result = mysqli_query($conn, $query); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCAdmin/</title>
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
                        <h1 class="fs-4">List of Donor's</h1>
                    </div>
                    <?php
                    if(mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-hover">';
                        echo '<thead>';
                        echo '<tr class="text-light" style="background-color: #000077;">';
                        echo '<th scope="col">User ID</th>';
                        echo '<th scope="col">Full name</th>';
                        echo '<th scope="col">Age</th>';
                        echo '<th scope="col">Contact</th>';
                        echo '<th scope="col">Email</th>';
                        echo '<th scope="col">Reciving Date</th>';
                        echo '<th scope="col">Action</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while($request_data = mysqli_fetch_assoc($result)) {
                            echo "<tr class='p-2'>";
                            echo "<td>".$request_data['d_id']."</td>";
                            echo "<td>".$request_data['fullname']."</td>";
                            echo "<td>".$request_data['age']."</td>";
                            echo "<td>".$request_data['contact']."</td>";
                            echo "<td>".$request_data['email']."</td>";
                            echo "<td>".$request_data['request_date']."</td>";
                            echo "<td>";
                            if ($request_data['approval_status'] == 'pending') {
                                echo "<a class='bg-success text-light fs-5 p-2 px-3 ms-2 rounded' href='functions/approve.php?approve_donor=" . $request_data['email'] . "'>Approve</a>";
                                echo "<a class='bg-danger text-light fs-5 p-2 px-3 ms-2 rounded' href='functions/reject.php?rejected_donor=" . $request_data['email'] . "'>Reject</a>";
                            } else {
                                echo "Processed";
                            }
                           
                            echo "</tr>";
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo "<h3 class='text-center mt-5'>No Data Found</h3>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>