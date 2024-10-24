<?php
<<<<<<< HEAD
include 'includes/config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("location: .../VitaCare/Rprofile.php");
    exit();
}

$email = $_SESSION['email'];

// Using prepared statements to fetch user information
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();
$stmt->close();

include 'functions/update_profile.php'
?>
<?php
include 'indexONE.php';
?>

    <main id="main_container">
        <div class="page-container">
            <div class="profile-content">
                <h4 class="fw-bold">User Profile</h4>
                <hr>

                <!-- Personal Information Section -->
                <div class="mb-4">
                    <h5 class="fw-bold">
                        <i class="fas fa-user icon"></i> Personal Information 
                        <button id="editPersonalBtn" class="btn btn-sm btn-link edit-buttons">Edit</button>
                        <button id="cancelPersonalBtn" class="btn btn-sm btn-link cancel-buttons" style="display: none;">Cancel</button>
                    </h5>
                    <hr>

                    <div id="viewPersonalInfo">
                        <p><strong><i class="fas fa-id-card icon"></i> Full Name:</strong> <span id="viewFullName"><?php echo htmlspecialchars($user['fullname']); ?></span></p>
                        <p><strong><i class="fas fa-envelope icon"></i> Email:</strong> <span id="viewEmail"><?php echo htmlspecialchars($user['email']); ?></span></p>
                        <p><strong><i class="fas fa-phone icon"></i> Phone Number:</strong> <span id="viewPhoneNumber"><?php echo htmlspecialchars($user['contact']); ?></span></p>
                    </div>

                    <form id="editPersonalForm" style="display: none;">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmail" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" value="<?php echo htmlspecialchars($user['contact']); ?>" required>
                        </div>
                        <button id="savePersonalBtn" class="btn btn-primary">Save</button>
                        <div id="personalNotification" class="notification alert alert-success" role="alert">Changes saved successfully!</div>
                    </form>
                </div>

                <!-- Health Information Section -->
                <div class="mb-4">
                    <h5 class="fw-bold">
                        <i class="fas fa-heart icon"></i> Health Information 
                        <button id="editHealthBtn" class="btn btn-sm btn-link edit-buttons">Edit</button>
                        <button id="cancelHealthBtn" class="btn btn-sm btn-link cancel-buttons" style="display: none;">Cancel</button>
                    </h5>
                    <hr>

                    <div id="viewHealthInfo">
                        <p><strong><i class="fas fa-tint icon"></i> Blood Group:</strong> <span id="viewBloodGroup"><?php echo htmlspecialchars($user['blood_group']); ?></span></p>
                    </div>

                    <form id="editHealthForm" style="display: none;">
                        <div class="mb-3">
                            <label for="bloodGroup" class="form-label">Blood Group</label>
                            <input type="text" class="form-control" id="bloodGroup" value="<?php echo htmlspecialchars($user['blood_group']); ?>" required>
                        </div>
                        <button id="saveHealthBtn" class="btn btn-primary">Save</button>
                        <div id="healthNotification" class="notification alert alert-success" role="alert">Changes saved successfully!</div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Personal Information toggle
        document.getElementById('editPersonalBtn').addEventListener('click', function() {
            toggleEditSection('viewPersonalInfo', 'editPersonalForm', 'editPersonalBtn', 'cancelPersonalBtn');
        });
        document.getElementById('cancelPersonalBtn').addEventListener('click', function() {
            toggleEditSection('viewPersonalInfo', 'editPersonalForm', 'editPersonalBtn', 'cancelPersonalBtn', true);
        });
        document.getElementById('savePersonalBtn').addEventListener('click', function(event) {
            event.preventDefault();
            savePersonalInfo();
            toggleEditSection('viewPersonalInfo', 'editPersonalForm', 'editPersonalBtn', 'cancelPersonalBtn', true);
            showNotification('personalNotification');
        });

        // Health Information toggle
        document.getElementById('editHealthBtn').addEventListener('click', function() {
            toggleEditSection('viewHealthInfo', 'editHealthForm', 'editHealthBtn', 'cancelHealthBtn');
        });
        document.getElementById('cancelHealthBtn').addEventListener('click', function() {
            toggleEditSection('viewHealthInfo', 'editHealthForm', 'editHealthBtn', 'cancelHealthBtn', true);
        });
        document.getElementById('saveHealthBtn').addEventListener('click', function(event) {
            event.preventDefault();
            saveHealthInfo();
            toggleEditSection('viewHealthInfo', 'editHealthForm', 'editHealthBtn', 'cancelHealthBtn', true);
            showNotification('healthNotification');
        });

        function toggleEditSection(viewId, formId, editBtnId, cancelBtnId, cancel = false) {
            const viewSection = document.getElementById(viewId);
            const editForm = document.getElementById(formId);
            const editBtn = document.getElementById(editBtnId);
            const cancelBtn = document.getElementById(cancelBtnId);

            if (cancel) {
                editForm.style.display = 'none';
                viewSection.style.display = 'block';
                editBtn.style.display = 'inline';
                cancelBtn.style.display = 'none';
            } else {
                editForm.style.display = 'block';
                viewSection.style.display = 'none';
                editBtn.style.display = 'none';
                cancelBtn.style.display = 'inline';
            }
        }

        function savePersonalInfo() {
            document.getElementById('viewFullName').textContent = document.getElementById('fullName').value;
            document.getElementById('viewEmail').textContent = document.getElementById('userEmail').value;
            document.getElementById('viewPhoneNumber').textContent = document.getElementById('phoneNumber').value;
        }

        function saveHealthInfo() {
            document.getElementById('viewBloodGroup').textContent = document.getElementById('bloodGroup').value;
        }

        function showNotification(notificationId) {
            const notification = document.getElementById(notificationId);
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000); // Hide notification after 3 seconds
        }
    </script>

=======
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['email'])) {
    header("location: .../VitaCare/login.php");
    exit();
}

require '../includes/config.php';

// Get the email of the logged-in donor from the session
$email = $_SESSION['email'];

// Fetch donor information from the database
$sql = "SELECT fullname, user_type, contact, email, blood_group FROM users WHERE email = '$email';";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $fullname = $row['fullname'];
    $contact = $row['contact'];
    $email = $row['email'];
    $userType = $row['user_type'];
} else {
    // Handle the case when donor information is not found in the database
    $fullname = "N/A";
    $contact = "N/A";
    $email = "N/A";
    $userType = "N/A";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>


<body> 
<?php   
        include ('../DonationDashboard/includes/head.php');
        include ('includes/d_dashboard.php');
    ?>

    ?>
<main id="main_container">

<div class="main-area p-4" style="background-color: #f8f9fa;">
    <div class="inner-wrapper p-4">
    <div class="container-fluid text-light">
        <div class="profile-card text-dark">
            <h2> <?php echo $userType; ?> Profile</h2>
            <div class="user-name"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $fullname; ?></div>
            <p><strong>Contact:</strong> <?php echo $contact; ?></p>
            <p><strong>Email ID:</strong> <?php echo $email; ?></p>
            <!-- <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#editModal">Edit Account</button> -->
            <button type="button" class="btn btn-danger mt-3" onclick="location.href='delete.php'">Delete Account</button>

        </div>
    </div>
    </div>
</div>
</main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>







</body>
</html>
>>>>>>> 21c9f55e987de28b2f99d0a3f1763085c3cd466b
