<?php
include 'includes/config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: /VitaCare/Rprofile.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user data from the database
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'indexONE.php'; ?>

    <main id="main_container">
        <div class="page-container">
            <div class="profile-content mt-4">
                <h4 class="fw-bold text-dark">User Profile</h4>
                <hr>

                <!-- Personal Information Section -->
                <div class="mb-4 text-dark">
                    <h5 class="fw-bold">Personal Information</h5>
                    <button id="editPersonalBtn" class="btn btn-sm btn-link">Edit</button>
                    <button id="cancelPersonalBtn" class="btn btn-sm btn-link" style="display: none;">Cancel</button>
                    <hr>

                    <div id="viewPersonalInfo">
                        <p><strong>Full Name:</strong> <span id="viewFullName"><?php echo htmlspecialchars($user['fullname']); ?></span></p>
                        <p><strong>Email:</strong> <span id="viewEmail"><?php echo htmlspecialchars($user['email']); ?></span></p>
                        <p><strong>Phone Number:</strong> <span id="viewPhoneNumber"><?php echo htmlspecialchars($user['contact']); ?></span></p>
                    </div>

                    <form id="editPersonalForm" style="display: none;">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        <label for="contact">Phone Number</label>
                        <input type="text" class="form-control" id="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>
                        <button type="button" id="savePersonalBtn" class="btn btn-primary mt-2" onclick="updateProfile()">Save</button>
                    </form>
                </div>

                <!-- Health Information Section -->
                <div class="mb-4 text-dark">
                    <h5 class="fw-bold">Health Information</h5>
                    <button id="editHealthBtn" class="btn btn-sm btn-link">Edit</button>
                    <button id="cancelHealthBtn" class="btn btn-sm btn-link" style="display: none;">Cancel</button>
                    <hr>

                    <div id="viewHealthInfo">
                        <p><strong>Blood Group:</strong> <span id="viewBloodGroup"><?php echo htmlspecialchars($user['blood_group']); ?></span></p>
                    </div>

                    <form id="editHealthForm" style="display: none;">
                        <label for="blood_group">Blood Group</label>
                        <input type="text" class="form-control" id="blood_group" value="<?php echo htmlspecialchars($user['blood_group']); ?>" required>
                        <button type="button" id="saveHealthBtn" class="btn btn-primary mt-2" onclick="updateProfile()">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/profile.js"></script>
</body>
</html>
