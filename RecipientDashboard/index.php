

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        #navbar {
            background-color: #b97272 !important;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .card-title {
            font-weight: bold;
        }
        .text-teal {
            color: #17a2b8;
        }
        .text-orange {
            color: #fd7e14;
        }
    </style>
</head>

<body >
    <div class="wrapper">
<?php 
include 'includes/r_dashboard.php';
?>

        <div class="main" style="background-color: #EADDDD;">

            <?php 
            include 'includes/header.php';
            ?>

            <main class="content px-3 py-2" style="margin:5em 5.5em;">
                <div class="container-fluid">
                    <div class="row">
            <!-- <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a> -->
         
        </div>
        
    </div>
    <!-- <?php
            include 'includes/footer.php';
         ?> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
