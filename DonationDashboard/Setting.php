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

// Database connection
function dbConnect() {
    $host = 'localhost';
    $db = 'vitacare_db';
    $user = 'root';
    $pass = '';
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    
    try {
        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// Function to change password
function changePassword($email, $oldPassword, $newPassword) {
    $pdo = dbConnect();

    // Fetch the user by email
    $stmt = $pdo->prepare("SELECT password FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // Check if user exists
    if (!$user) {
        return ['status' => 'error', 'message' => 'User not found'];
    }

    // Verify old password
    if (!password_verify($oldPassword, $user['password'])) {
        return ['status' => 'error', 'message' => 'Old password is incorrect'];
    }

    // Hash the new password
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $updateStmt = $pdo->prepare("UPDATE users SET password = :newPassword WHERE email = :email");
    $updateStmt->execute([
        'newPassword' => $hashedNewPassword,
        'email' => $email
    ]);

    return ['status' => 'success', 'message' => 'Password changed successfully'];
}
?>
<?php
include 'indexONE.php';
?>

<div class="accordion" id="settingsAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Change Password
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#settingsAccordion">
          <div class="accordion-body">
            <form id="changePasswordForm">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="oldPassword" class="form-label">Old Password</label>
                  <input type="password" class="form-control" id="oldPassword" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="newPassword" class="form-label">New Password</label>
                  <input type="password" class="form-control" id="newPassword" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="confirmPassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="confirmPassword" required>
                </div>
              </div>
              <div id="error" class="error"></div>
              <button type="submit" class="btn btn-primary btn-custom mt-3">Change Password</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Deactivate Account Accordion -->
      <div class="accordion-item mt-3">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Deactivate Your Account
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#settingsAccordion">
          <div class="accordion-body">
            <form id="deactivateForm">
              <div class="mb-3">
                <label for="reason" class="form-label">Reason for Deactivation</label>
                <input type="text" class="form-control" id="reason" required>
              </div>
              <button type="submit" class="btn btn-danger btn-custom">Deactivate Account</button>
            </form>
          </div>
        </div>
      </div>
    </div>

     <!-- Bootstrap 5 JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // JavaScript for form handling and validation
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const email = document.getElementById('email').value;
      const oldPassword = document.getElementById('oldPassword').value;
      const newPassword = document.getElementById('newPassword').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      const errorDiv = document.getElementById('error');

      // Validation
      if (newPassword !== confirmPassword) {
        errorDiv.textContent = "Passwords do not match.";
        return;
      }

      if (newPassword.length < 6) {
        errorDiv.textContent = "Password must be at least 6 characters long.";
        return;
      }

      errorDiv.textContent = "";

      // Send data to PHP (or backend) via AJAX
      console.log("Submitting password change form:", { email, oldPassword, newPassword });
    });

    document.getElementById('deactivateForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const reason = document.getElementById('reason').value;
      console.log("Deactivating account with reason:", reason);
    });
  </script>