<?php
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

// include 'functions/update_profile.php'
?>
<?php
include 'index.php';
?>

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
                        <div id="personalNotification" class="notification alert alert-success" role="alert">Changes saved successfully!</div>
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

                    <div id="viewHealthInfo text-dark">
                        <p><strong><i class="fas fa-tint icon"></i> Blood Group:</strong> <span id="viewBloodGroup"><?php echo htmlspecialchars($user['blood_group']); ?></span></p>
                    </div>

                    <form id="editHealthForm" class="text-dark" style="display: none;">
                        <div class="mb-3">
                            <label for="bloodGroup" class="form-label text-dark">Blood Group</label>
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

