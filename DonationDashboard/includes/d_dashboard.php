<<<<<<< HEAD
<aside id="sidebar" class="js-sidebar"style="background-color: #D6B2B2; ">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">VitaCare</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Donor Dashboard
                    </li>
                    <li class="sidebar-item">
                        <a href="index.php" class="sidebar-link">
                            <i class="fa-solid fa-home pe-2"></i>
                            Home
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="Dprofile.php" class="sidebar-link">
                            <i class="fa-solid fa-user pe-2"></i>
                            Profile
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="Appointment.php" class="sidebar-link">
                            <i class="fa-solid fa-user pe-2"></i>
                            Appointment
                        </a>
                    </li>
                    <li class="sidebar-header divider">
                        --------------------------------
                    </li>
                    <li class="sidebar-item">
                        <a href="Setting.php" class="sidebar-link">
                            <i class="fa-solid fa-gear pe-2"></i>
                            Setting
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
=======


        <div class="container-fluid">
            <div class="row  gx-6">
                <div class="col  overflow-scroll" id="dashbord">
                    <div class="col text-center shadow-lg pt-3 sticky-sm-top bg-dark rounded">
                        <h1 class="fs-4 text-light">
                            <i class="fa fa-dashboard d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                data-bs-placement="right" title="Tooltip on right" aria-hidden="true"></i>
                            <span class=" d-none d-md-inline ">Donor Dashboard</span>  
                        </h1>
 
                    <hr class="divider">
                    </div>
                    <div class="col md-text-center">
                        <ul class="nav nav-tabs fs-5 flex-column" role="tablist">

                            <li class="nav-item mb-4">
                                <a href="Dprofile.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'Dprofile.php') ? 'active' : ''; ?> text-light" data-bs-toggle="tooltip">
                                    <i class="fa fa-user-circle d-inline d-xl-none d-md-none text-center"
                                        aria-hidden="false"></i>
                                    <span class="ms-2 text-center d-none d-md-inline md-text-center">Profile</span>
                                </a>
                            </li>

                            <li class="nav-item mb-4">
                                <a href="DdonationRecord.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'DdonationRecord.php') ? 'active' : ''; ?> text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-clipboard d-inline d-xl-none d-md-none text-center"
                                        data-bs-toggle="tooltip" data-bs-placement="right" title="Donation Record"
                                        aria-hidden="false"></i>
                                    <span class="ms-2 d-none d-md-inline">Donation Record</span>
                                </a>
                            </li>

                            <!-- <li class="nav-item mb-4">
                                <a href="Dcertificate.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'certificate.php') ? 'active' : ''; ?> text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-certificate d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Certificate" aria-hidden="false"></i>
                                    <span class="ms-2 d-none d-md-inline">Certificate</span>
                                </a>
                            </li> -->

                            <li class="nav-item mb-4">
                                <a href="Dchangepassword.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'Dchangepassword.php') ? 'active' : ''; ?> text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                                    <i class="fa fa-key d-inline d-xl-none d-md-none" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Change Password" aria-hidden="false"></i>
                                    <span class="ms-2 d-none d-md-inline">Change Password</span>
                                </a>
                            </li>

                            <li class="nav-item mb-4">
                            <a href="Dlogout.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'Dlogout.php') ? 'active' : ''; ?> text-light pb-2" id="nav-link" data-bs-toggle="tooltip">
                            <i class="fa fa- d-inline d-xl-none d-md-none" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout" aria-hidden="false"></i>   
                            <span class="ms-2 d-none d-md-inline">logout</span>      
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
      
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
