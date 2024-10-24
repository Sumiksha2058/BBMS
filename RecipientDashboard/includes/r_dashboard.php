<<<<<<< HEAD
<aside id="sidebar" class="js-sidebar fixed" style="background-color: #D6B2B2; ">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">VitaCare</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Recipient Dashboard
                    </li>
                    <li class="sidebar-item">
                        <a href="home.php" class="sidebar-link">
                            <i class="fa-solid fa-home pe-2"></i>
                            Home
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="Rprofile.php" class="sidebar-link">
                            <i class="fa-solid fa-user pe-2"></i>
                            Profile
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="RequestStatus.php" class="sidebar-link">
                        <i class="fas fa-calendar-check"></i>
                            Request Status
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="Rprofile.php" class="sidebar-link">
                        <i class="fas fa-history"></i>
                            Recipient History
                        </a>
                    </li>


                    <li class="sidebar-header divider">
                        --------------------------------
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-share-nodes pe-2"></i>
                            Setting
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1"
                                    data-bs-toggle="collapse" aria-expanded="false">Level 1</a>
                                <ul id="level-1" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
=======

    <!-- main container starts from here -->
    
    <div class="container-fluid">
            <div class="row gx-6">
                <div class="col" id="dashbord">

                    <div class="col mb-4 text-center">
                        <h1 class="fs-4 text-light">
                            <i class="fa fa-dashboard d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                data-bs-placement="right" title="Tooltip on right" aria-hidden="true"></i>
                            <span class="ms-2  d-none d-md-inline ">Recipient Dashboard</span>
                        </h1>
                    </div>
                    <div class="col md-text-center">
                        <ul class="nav nav-tabs fs-5 flex-column" role="tablist">

                            <li class="nav-item mb-4">
                                <a href="Rprofile.php" class="nav-link  <?php echo (basename($_SERVER['PHP_SELF']) == 'Rprofile.php') ? 'active' : ''; ?>  text-light" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-user-circle d-inline d-xl-none d-md-none text-center"
                                        aria-hidden="false"></i>
                                    <span class="ms-2 text-center d-none d-md-inline md-text-center">Profile</span>
                                </a>
                            </li>

                            <li class="nav-item mb-4">
                                <a href="requestBlood.php" class="nav-link  <?php echo (basename($_SERVER['PHP_SELF']) == 'requestBlood.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-clipboard d-inline d-xl-none d-md-none text-center"
                                        data-bs-toggle="tooltip" data-bs-placement="right" title="Donation Record"
                                        aria-hidden="false"></i>
                                    <span class="ms-2 d-none d-md-inline">Blood Request</span>
                                </a>
                            </li>

                            <li class="nav-item mb-4">
                                <a href="bloodStatus.php" class="nav-link  <?php echo (basename($_SERVER['PHP_SELF']) == 'bloodStatus.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-certificate d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Request blood" aria-hidden="false"></i>
                                    <span class="ms-2 d-none d-md-inline">Request Status</span>
                                </a>
                            </li>

                            <li class="nav-item mb-4">
                                <a href="../RecipientDashboard/rchangePassword.php" class="nav-link  <?php echo (basename($_SERVER['PHP_SELF']) == 'rchangePassword.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-key d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Change Password" aria-hidden="false"></i>
                                    <span class="ms-2 d-none d-md-inline">Change Password</span>
                                </a>
                            </li>

                            <li class="nav-item mb-4">
                            <a href="Rlogout.php" class="nav-link  <?php echo (basename($_SERVER['PHP_SELF']) == 'Rlogout.php') ? 'active' : ''; ?>  text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                            <i class="fa fa- d-inline d-xl-none d-md-none" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout" aria-hidden="false"></i>   
                            <span class="ms-2 d-none d-md-inline">logout</span>      
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
       
<!-- Button trigger modal -->


    <!-- dashbord end -->
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
