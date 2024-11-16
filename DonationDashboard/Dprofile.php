<?php
include 'includes/config.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../VitaCare/Rprofile.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user data from the database
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Handle form submission (both personal and health info)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $phoneNumber = $_POST['contact'];
    $bloodGroupId = $_POST['blood_group_id'];

    try {
        // Update personal information
        $stmt = $conn->prepare("UPDATE users SET fullname = ?, contact = ? WHERE email = ?");
        $stmt->bind_param("sss", $fullname, $phoneNumber, $email);
        $stmt->execute();
        $stmt->close();

        // Update health information (blood group)
        $stmt = $conn->prepare("UPDATE users SET blood_group = ? WHERE email = ?");
        $stmt->bind_param("ss", $bloodGroupId, $email);
        $stmt->execute();
        $stmt->close();

        // Refresh the user data
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        // Success message
        $successMessage = "Changes saved successfully!";
    } catch (Exception $e) {
        $errorMessage = "Error saving data: " . $e->getMessage();
    }
}
?>

<?php include 'indexONE.php'; ?>

<main id="main_container">
    <div class="page-container">
        <div class="profile-content">
            <h4 class="fw-bold text-dark">User Profile</h4>
            <hr>

            <!-- Personal Information Section -->
            <div class="mb-4">
                <h5 class="fw-bold text-dark">
                    <i class="fas fa-user icon"></i> Personal Information 
                </h5>
                <hr>

                <div id="viewPersonalInfo" class="text-dark">
                    <p><strong><i class="fas fa-id-card icon"></i> Full Name:</strong> <span id="viewFullName"><?php echo htmlspecialchars($user['fullname']); ?></span></p>
                    <p><strong><i class="fas fa-envelope icon"></i> Email:</strong> <span id="viewEmail"><?php echo htmlspecialchars($user['email']); ?></span></p>
                    <p><strong><i class="fas fa-phone icon"></i> Phone Number:</strong> <span id="viewPhoneNumber"><?php echo htmlspecialchars($user['contact']); ?></span></p>
                </div>

                <!-- Personal Info Edit Form -->
                <form id="editPersonalForm" class="text-dark" method="POST">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNumber" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <?php if (isset($successMessage)) : ?>
                        <div class="notification alert alert-success" role="alert">
                            <?php echo $successMessage; ?>
                        </div>
                    <?php elseif (isset($errorMessage)) : ?>
                        <div class="notification alert alert-danger" role="alert">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Health Information Section -->
            <div class="mb-4">
                <h5 class="fw-bold text-dark">
                    <i class="fas fa-heart icon"></i> Health Information
                </h5>
                <hr>

                <div id="viewHealthInfo" class="text-dark">
                    <p><strong><i class="fas fa-tint icon"></i> Blood Group:</strong> <span id="viewBloodGroup"><?php echo htmlspecialchars($user['blood_group']); ?></span></p>
                </div>

                <!-- Health Info Edit Form -->
                <form id="editHealthForm" class="text-dark" method="POST">
                    <div class="mb-3">
                        <label for="bloodGroup" class="form-label text-dark">Blood Group</label>
                        <select class="form-select" id="bloodGroup" name="blood_group_id" required>
                            <option value="A+" <?php if ($user['blood_group'] == 'A+') echo 'selected'; ?>>A+</option>
                            <option value="A-" <?php if ($user['blood_group'] == 'A-') echo 'selected'; ?>>A-</option>
                            <option value="B+" <?php if ($user['blood_group'] == 'B+') echo 'selected'; ?>>B+</option>
                            <option value="B-" <?php if ($user['blood_group'] == 'B-') echo 'selected'; ?>>B-</option>
                            <option value="O+" <?php if ($user['blood_group'] == 'O+') echo 'selected'; ?>>O+</option>
                            <option value="O-" <?php if ($user['blood_group'] == 'O-') echo 'selected'; ?>>O-</option>
                            <option value="AB+" <?php if ($user['blood_group'] == 'AB+') echo 'selected'; ?>>AB+</option>
                            <option value="AB-" <?php if ($user['blood_group'] == 'AB-') echo 'selected'; ?>>AB-</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <?php if (isset($successMessage)) : ?>
                        <div class="notification alert alert-success" role="alert">
                            <?php echo $successMessage; ?>
                        </div>
                    <?php elseif (isset($errorMessage)) : ?>
                        <div class="notification alert alert-danger" role="alert">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</main>
