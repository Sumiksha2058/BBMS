<aside id="sidebar" class="js-sidebar" style="background-color: #D6B2B2; position: fixed; top: 0; left: 0; height: 100%; width: 250px;">
    <!-- Content For Sidebar -->
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="#">VitaCare</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-header text-dark">
                Donor Dashboard
            </li>
            <li class="sidebar-item">
                <a href="index.php" class="sidebar-link text-dark">
                    <i class="fa-solid fa-home pe-2"></i>
                    Home
                </a>
            </li>
            <li class="sidebar-item">
                <a href="Dprofile.php" class="sidebar-link text-dark">
                    <i class="fa-solid fa-user pe-2"></i>
                    Profile
                </a>
            </li>
            <li class="sidebar-item">
                <a href="Appointment.php" class="sidebar-link text-dark d-flex align-items-center" onclick="hideNotification()">
                    <i class="fa-solid fa-calendar-check pe-2"></i>
                    Appointment
                    <!-- Notification bubble -->
                    <span id="notification-bubble" class="badge bg-danger ms-2">New</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="DonationHistory.php" class="sidebar-link text-dark d-flex align-items-center" onclick="hideNotification()">
                    <i class="fa-solid fa-clock-rotate-left pe-2"></i>
                    Donation History
                </a>
            </li>
            <li class="sidebar-header divider">
                <hr>
            </li>
            <li class="sidebar-item">
                <a href="Setting.php" class="sidebar-link text-dark">
                    <i class="fa-solid fa-gear pe-2"></i>
                    Setting
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- CSS for notification bubble -->
<style>
    .badge {
        font-size: 0.75rem;
        padding: 0.25em 0.5em;
        border-radius: 0.75rem;
    }
</style>

<!-- JavaScript to hide notification bubble -->
<script>
    function hideNotification() {
        document.getElementById("notification-bubble").style.display = "none";
        sessionStorage.setItem("appointmentVisited", "true");  // Store in session storage
    }

    // Check if "appointmentVisited" is set to hide the bubble on page load
    window.onload = function() {
        if (sessionStorage.getItem("appointmentVisited") === "true") {
            document.getElementById("notification-bubble").style.display = "none";
        }
    }
</script>
