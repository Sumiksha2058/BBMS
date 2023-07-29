<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGOUT</title>
    <link rel="stylesheet" href="style/logout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>
    <div class="container items-center text-light bg-dark w-25 rounded mt-4 pt-3">
    <div class="col text-center">
        <h3>Are you sure?</h3>
    </div>
    <div class="cols-2 d-flex justify-content-center">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <button class="px-4 pt-2 text-center" type="submit" name="logout">Log out</button>
        <button class="px-4 pt-2 text-center"type="reset">Cancel</button>
        </form>
    </div>
    </div>



    <?php 
    if(isset($_POST['logout'])){
        session_destroy();
        header("location: ../VitaCare/login.php");
    }
    ?>
</body>
</html>