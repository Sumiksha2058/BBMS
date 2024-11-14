<?php
include 'includes/config.php';
session_start();
include 'functions/setting.php';
if (!isset($_SESSION['email'])) {
    header("location: .../VitaCare/Rprofile.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user information using a prepared statement
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();
$stmt->close();

$message = '';

// Check if the password change form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        $message = "Passwords do not match.";
    } elseif (strlen($newPassword) < 6) {
        $message = "Password must be at least 6 characters long.";
    } else {
        // Call the changePassword function
        $result = changePassword($email, $oldPassword, $newPassword);
        $message = $result['message'];
    }
}

// Check if the deactivate account form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deactivateAccount'])) {
    $reason = $_POST['reason'];
    
    // Call the deactivateAccount function
    $deactivateResult = deactivateAccount($email, $reason);
    $message = $deactivateResult['message'];

    if ($deactivateResult['status'] === 'success') {
        // Logout and redirect to a different page if account is successfully deactivated
        session_destroy();
        header("location: ../BBMS/.php");
        exit();
    }
}
?>

<?php include 'index.php'; ?>

<div class="accordion" id="settingsAccordion">
    <!-- Password Change Section -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Change Password
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#settingsAccordion">
            <div class="accordion-body">
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="oldPassword" class="form-label">Old Password</label>
                            <input type="password" class="form-control" name="oldPassword" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="newPassword" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirmPassword" required>
                        </div>
                    </div>
                    <div class="error"><?php echo $message; ?></div>
                    <button type="submit" class="btn btn-primary btn-custom mt-3" name="changePassword">Change Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Deactivate Account Section -->
    <div class="accordion-item mt-1">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Deactivate Your Account
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#settingsAccordion">
            <div class="accordion-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for Deactivation</label>
                        <input type="text" class="form-control" name="reason" required>
                    </div>
                    <button type="submit" class="btn btn-danger btn-custom" name="deactivateAccount">Deactivate Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
