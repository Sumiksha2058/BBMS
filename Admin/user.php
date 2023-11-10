<?php
include 'includes/config.php';

$query = "(SELECT user_type, user_id, fullname, email,contact FROM users)";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}include ('includes\head.php');
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
        include ('includes/a_dashboard.php');
    ?>

<main id="main_container">

<div class="main-area p-4">
    <div class="inner-wrapper p-4">
      <div class="title text-dark">
        <h1 class="fs-4">List of User</h1>
        <hr>
      </div>

      <table class="table table-hover">
      <?php
            if (mysqli_num_rows($result) > 0) {
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr class="text-light" style="background-color: #000077;">
                            <th scope="col">User Type</th>
                            <th scope="col">User ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Contact No.</th>
                            <th scope="col">User Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($user_data = mysqli_fetch_array($result)) {
                        echo "<tr class='p-2'>";
                        echo "<td>" . $user_data['user_type'] . "</td>";
                        echo "<td>" . $user_data['user_id'] . "</td>";
                        echo "<td>" . $user_data['fullname'] . "</td>";
                        echo "<td>" . $user_data['contact'] . "</td>";
                        echo "<td>" . $user_data['email'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<p class='text-center mt-5'>No Data Found</p>";
            }
            ?>
  
      </table>
        
    </div> 
</div>

</main>

<script src="fontawesome/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>