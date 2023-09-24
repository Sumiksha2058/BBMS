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
                       
                      <hr>
                   <!-- Button trigger modal -->
                   <div class="mb-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa fa-add me-2"></i>Add Donor
                    </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Register Donor</h5>
                            <button type="button" class="btn-close shadow-none btn-text-right" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- form content -->
                        <form method="post" action="donor_request.php" id="registrationForm"  class="row needs-validation" novalidate >      
                            <!-- Dysplaying validation -->
                                <div class="form-section ms-3" id="donor">
                                
                                    <div class="col md-6">
                                        <label for="donorName" class="form-label fs-auto ">Full Name</label>
                                        <input type="text" name="fullname" class="form-control"  id="donorName" placeholder="Enter your full name" required>
                                    </div>
                    
                                    <div class="col md-6">
                                        <label  class="form-label">Gender</label>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Male" name="gender" id="gender" >
                                        <label class="form-check-label"  for="gender">
                                            Male
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Female" name="gender" id="flexRadioDisabled" >
                                        <label class="form-check-label" for="flexRadioDisabled">
                                            Female
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Other" name="gender" id="flexRadioDisabled">
                                        <label class="form-check-label" for="flexRadioDisabled">
                                            Other
                                        </label>
                                        </div>
                                    </div>
                    
                                    <div class="col md-6">
                                        <label for="donoAge" class="form-label fs-auto ">Age</label>
                                        <input type="number" class="form-control" name="age" id="donoAge" placeholder="Enter Your" required>
                                    </div>
                    
                                    <div class="col md-6">
                                        <label for="donorEmail" class="form-label fs-auto">Email</label>
                                        <input type="email" class="form-control" name="email" id="donorEmail" placeholder="Enter your email" required>
                                    </div>
                                    <div class="col md-6">
                                        <label for="donorContact" class="form-label fs-auto">Contact</label>
                                        <input type="text" class="form-control" name="contact" id="donorContact" placeholder="Enter your contact number" required>
                                    </div>
                                    <div class="col md-6">
                                        <label for="donorBloodGroup" class="form-label fs-auto">Blood Group</label>
                                        <select class="form-select" name="donorBlood" id="donorBloodGroup" required>
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
                                    
                                    <div class="col md-6">
                                        <label for="DonorPassword" class="form-label fs-auto">Password</label>
                                        <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="DonorPassword" placeholder="Password" required>
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
                                                    <p class="text-danger ">  <?php echo $_GET['error']; ?></p>
                                                <?php } ?>
                                            </div>
                                            </div>   
                                    
                                    <div class="col md-6">
                                        <label for="DonorConformPassword" class="form-label fs-auto">Confirm Password</label>
                                        <div class="input-group">
                                        <input type="password" class="form-control " name="con_password" id="DonorConformPassword" placeholder="Re-enter Password" required>
                                        <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <a href="#" class="text-dark" id="click-eye">
                                                        <i class="fa fa-eye color-dark" id="icon" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            </div>
                                                </div>
                                                </div>
                                        </form>  
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="register" class="btn btn-primary">Add donor</button>
                                    </div>
                                    </div>
                                </div>  
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