 <!-- main container starts from here --> 
    <div class="container-fluid ">
            <div class="row gx-6 ">
                <div class="col" id="dashbord">

                    <div class="col shadow-lg mb-3 rounded sticky-sm-top text-center" style="background-color: #000077;">
                        <h1 class="fs-4 text-light">

                       <i class="fa fa-dashboard d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                data-bs-placement="right" title="Tooltip on right" aria-hidden="true"></i>
                            <span class="ms-2  d-noneoverflow-scroll d-md-inline fs-2 title">Dashboard</span>
                        </h1>
                        
                        <!-- <hr class="dropdown-divider"> -->
                    </div>
                    
                    <div class="col md-text-center">
                        <ul class="nav nav-tabs fs-5 flex-column" role="tablist">

                            <li class="nav-item mb-2">
                                <a href="index.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>  text-light" id="nav-link" da000077toptopta-bs-toggle="tooltip">
                                    <i class="fa fa-user-circle d-inline d-xl-none d-md-none text-center"
                                        aria-hidden="false"></i>
                                    <strong class="ms-2 text-center d-none d-md-inline md-text-center">Home</strong>
                                </a>
                            </li>
                        
                            <li class="nav-item mb-2">
                                <a href="user.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'user.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-clipboard d-inline d-xl-none d-md-none text-center"
                                        data-bs-toggle="tooltip" data-bs-placement="right" title="Donation Record"
                                        aria-hidden="false"></i>
                                    <strong class="ms-2 d-overflow-scrollnone d-md-inline">Users</strong>
                                </a>
                            </li>

                            <li class="nav-item mb-2">
                                <a href="donor_list.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'donor_list.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                   <i class="fa fa-certificate d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Request blood" aria-hidden="false"></i>
<<<<<<< HEAD
                                    <strong class="ms-2 d-none d-md-inline">
                                    Donor</strong>
=======
                                    <strong class="m(!$stmt) {
        die("Error in query preparation: " . $conn->error);s-2 d-none d-md-inline">Donor</strong>
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
                                </a>
                            </li>

                            <li class="nav-item mb-2">
                                <a href="recipient_list.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'recipient_list.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-certificate d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Request blood" aria-hidden="false"></i>
                                    <strong class="ms-2 d-none d-md-inline">Recipient</strong>
                                </a>
                            </li>

                            <li class="nav-item mb-2">
                                <a href="recivers_request.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'recivers_request.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-certificate d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Request blood" aria-hidden="false"></i>
                                    <strong class="ms-2 d-none d-md-inline">Recipient Request</strong>
                                </a>
                            </li>

                            <li class="nav-item mb-2">
                                <a href="donor_request.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'donor_request.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-certificate d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Request blood" aria-hidden="false"></i>
                                    <strong class="ms-2 d-none d-md-inline">Donor Request</strong>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="inventory.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'inventory.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-key d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Change Password" aria-hidden="false"></i>
                                    <strong class="ms-2 d-none d-md-inline">Inventory</strong>
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="appointment.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'appointment.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-key d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Change Password" aria-hidden="false"></i>
                                    <strong class="ms-2 d-none d-md-inline">Appointment</strong >
                                </a>
                            </li>  
                        </ul>
                    </div>
                </div>
            </div>
        </div>
