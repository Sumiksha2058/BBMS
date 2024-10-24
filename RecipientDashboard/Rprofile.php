<?php
include 'includes/config.php';
include 'functions/update_profile.php';
// session_start();

if (!isset($_SESSION['email'])) {
    header("location: .../VitaCare/Rprofile.php");
    exit();
}

$email = $_SESSION['email'];

// Using prepared statements to fetch user information
$stmt = $conn->prepare("
    SELECT u.*, bg.blood_group 
    FROM users u
    LEFT JOIN blood_groups bg ON u.blood_group_id = bg.blood_group_id
    WHERE u.email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();
$stmt->close();
?>
<?php include 'index.php'; ?>

<main id="main_container">
    <div class="page-container">
        <div class="profile-content">
            <h4 class="fw-bold text-dark">User Profile</h4>
            <hr>

            <!-- Personal Information Section -->
            <div class="mb-4">
                <h5 class="fw-bold text-dark">
                    <i class="fas fa-user icon"></i> Personal Information 
                    <button id="editPersonalBtn" class="btn btn-sm btn-link edit-buttons">Edit</button>
                    <button id="cancelPersonalBtn" class="btn btn-sm btn-link cancel-buttons" style="display: none;">Cancel</button>
                </h5>
                <hr>

                <div id="viewPersonalInfo" class="text-dark">
                    <p><strong><i class="fas fa-id-card icon"></i> Full Name:</strong> <span id="viewFullName"><?php echo htmlspecialchars($user['fullname']); ?></span></p>
                    <p><strong><i class="fas fa-envelope icon"></i> Email:</strong> <span id="viewEmail"><?php echo htmlspecialchars($user['email']); ?></span></p>
                    <p><strong><i class="fas fa-phone icon"></i> Phone Number:</strong> <span id="viewPhoneNumber"><?php echo htmlspecialchars($user['contact']); ?></span></p>
                </div>

                <form id="editPersonalForm" style="display: none;" class="text-dark">
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
                    <div id="personalNotification" class="notification alert alert-success" role="alert" style="display: none;">Changes saved successfully!</div>
                </form>
            </div>

            <!-- Health Information Section -->
            <div class="mb-4">
                <h5 class="fw-bold text-dark">
                    <i class="fas fa-heart icon"></i> Health Information 
                    <button id="editHealthBtn" class="btn btn-sm btn-link edit-buttons">Edit</button>
                    <button id="cancelHealthBtn" class="btn btn-sm btn-link cancel-buttons" style="display: none;">Cancel</button>
                </h5>
                <hr>

                <div id="viewHealthInfo" class="text-dark">
                    <p><strong><i class="fas fa-tint icon"></i> Blood Group:</strong> <span id="viewBloodGroup"><?php echo htmlspecialchars($user['blood_group']); ?></span></p>
                </div>

                <form id="editHealthForm" class="text-dark" style="display: none;">
                    <div class="mb-3">
                        <label for="bloodGroup" class="form-label text-dark">Blood Group</label>
                        <select class="form-select" id="bloodGroup" required>
                            <!-- Example of blood groups; replace with dynamic options as necessary -->
                            <option value="1" <?php if ($user['blood_group'] == 'A+') echo 'selected'; ?>>A+</option>
                            <option value="2" <?php if ($user['blood_group'] == 'A-') echo 'selected'; ?>>A-</option>
                            <option value="3" <?php if ($user['blood_group'] == 'B+') echo 'selected'; ?>>B+</option>
                            <option value="4" <?php if ($user['blood_group'] == 'B-') echo 'selected'; ?>>B-</option>
                            <option value="5" <?php if ($user['blood_group'] == 'O+') echo 'selected'; ?>>O+</option>
                            <option value="6" <?php if ($user['blood_group'] == 'O-') echo 'selected'; ?>>O-</option>
                            <option value="7" <?php if ($user['blood_group'] == 'AB+') echo 'selected'; ?>>AB+</option>
                            <option value="8" <?php if ($user['blood_group'] == 'AB-') echo 'selected'; ?>>AB-</option>
                        </select>
                    </div>
                    <button id="saveHealthBtn" class="btn btn-primary">Save</button>
                    <div id="healthNotification" class="notification alert alert-success" role="alert" style="display: none;">Changes saved successfully!</div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- AJAX Script to handle form submissions -->
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
        saveUserInfo();
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
        saveUserInfo(); // Call the same function for both personal and health updates
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
    function saveUserInfo() {
    const fullName = document.getElementById('fullName').value;
    const email = document.getElementById('userEmail').value; // Ensure you use the correct ID
    const phoneNumber = document.getElementById('phoneNumber').value;
    const bloodGroup = document.getElementById('bloodGroup').value; // Make sure this is correct

    // AJAX call to save user information
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_profile.php", true); // Adjust path as necessary
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Update the UI with the new data
                document.getElementById('viewFullName').textContent = fullName;
                document.getElementById('viewEmail').textContent = email;
                document.getElementById('viewPhoneNumber').textContent = phoneNumber;
                document.getElementById('viewBloodGroup').textContent = response.blood_group;
                showNotification('personalNotification');
                showNotification('healthNotification');
                toggleEditSection('viewPersonalInfo', 'editPersonalForm', 'editPersonalBtn', 'cancelPersonalBtn', true);
                toggleEditSection('viewHealthInfo', 'editHealthForm', 'editHealthBtn', 'cancelHealthBtn', true);
            } else {
                alert("Error saving data: " + response.message);
            }
        } else {
            alert("Error: " + xhr.status);
        }
    };

    xhr.send("fullname=" + encodeURIComponent(fullName) + "&contact=" + encodeURIComponent(phoneNumber) + "&blood_group_id=" + encodeURIComponent(bloodGroup));
}


    function showNotification(notificationId) {
        const notification = document.getElementById(notificationId);
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000); // Hide notification after 3 seconds
    }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<?php
session_start();
session_regenerate_id(true);

if(!isset($_SESSION['email'])){
    header("location: .../VitaCare/login.php");  
}
include 'includes/config.php';
// Get the email of the logged-in donor from the session

$email = $_SESSION['email'];
// Fetch donor information from the database
$sql = "SELECT fullname,gender, contact, email, blood_group FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $fullname = $row['fullname'];
    $Gender = $row['gender'];
    $contact = $row['contact'];
    $bloodType = $row['blood_group'];
    $email = $row['email'];
 
} else {
    // Handle the case when donor information is not found in the database
    $fullname = "N/A";
    $Gender = "N/A";
    $contact = "N/A";
    $bloodType = "N/A";
    $email = "N/A";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viwport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/profile.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://font/RecipientDashboard/Rprofile.phps.googleapis.com">
    <script src="javascript/jquery.js"></script>

</head>
<body >


<?php 
include ('../RecipientDashboard/includes/head.php');
include ('../RecipientDashboard/includes/r_dashboard.php'); 
?>      


<main id="main_container" style="background-color: #f8f9fa;">   

<div class="main-area p-4">
    <div class="main_container">
         <!-- searching container -->
          <div class="col col-md-4 float-end " id="searchResults"></div>
    <div class="inner-wrapper p-4">
    <div class="container-fluid text-light">

        <div class="profile-card text-dark">
            <h2> <?php echo $userType; ?> Profile</h2>
            <div class="user-name"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $fullname; ?></div>
            <p><strong>Blood Type:</strong> <?php echo $bloodType; ?></p>
            <p><strong>Email ID:</strong> <?php echo $email; ?></p>
            <!-- <button type="submit" class="btn btn-primary">Edit Profile</button> -->
            <button type="button" class="btn btn-danger mt-3" onclick="location.href='delete.php'">Delete Account</button>
        </div>
    </div>
    </div>
  
    </div>
</div>
</main>
<script src="javascript/searchHandler.js"></script>
<script src="javascript/activeHover.js"></script>
<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script src="javascript/search.js"></script>
</body>
</html>