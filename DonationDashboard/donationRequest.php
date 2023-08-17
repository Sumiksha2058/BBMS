
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body >

    <?php include 'includes/head.php'; ?>

    <?php include 'includes/d_dashboard.php'; ?>

    <main id="main_container">

        <div class="main-area p-4 ">
            <div class="inner-wrapper  p-4">
                <div class="container-fluid text-light">

                    <div class="row bg-light w-50 rounded text-dark p-3 items-center">
                        <h1 class="mb-3 ">Donation Request</h1>

                        <form action="Dchangepassword.php" method="post" class="row needs-validation " novalidate>
                            <div class="">
                            <?php if (isset($_GET['error'])) { ?>
                                <p class="alert alert-danger ">  <?php echo $_GET['error']; ?></p>
                            <?php } ?>

                            <?php if (isset($_GET['success'])) { ?>
                                <p class="alert alert-success ">  <?php echo $_GET['success']; ?></p>
                            <?php } ?>
                            </div>
                            <div class="mb-3">
                                <h4><label for="fullname" class="form-label">Full Name</label></h4>
                                <input type="text" name="fullname" class="form-control" id="fullname" aria-describedby="nameHelp">
                                
                            </div>
                            <div class="mb-3">
                                <h4><label for="contact" class="form-label">Contact</label></h4>
                                <input type="text" name="contact" class="form-control" id="contact" aria-describedby="contact">
                                
                            </div>
                            <div class="mb-3">
                                <h4><label for="bloodgroup" class="form-label">Blood group</label></h4>
                                <input type="text" name="bloodgroup" class="form-control " id="bloodgroup">
                            </div>

                            <div class="mb-3">
                                <h4><label for="quantity" class="form-label">Donation Quantity(ml)</label></h4>
                                <input type="text" name="quantity" class="form-control " id="quantity">
                            </div>
                            <button type="submit" name="request_d" class="btn btn-dark">Submit</button>
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>

    </main>
    <script src="javascript/validation.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>

</html>
