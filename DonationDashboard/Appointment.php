<?php
include 'includes/config.php'; // Ensure $conn is initialized here (mysqli)
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user information
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email); // 's' means string type for the parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();
$user_id = $user['user_id']; // Get user ID for fetching appointments
$stmt->close();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all expected keys are present in $_POST
    if (isset($_POST['name'], $_POST['phone'], $_POST['bloodType'], $_POST['date'], $_POST['time'])) {
        // Sanitize and assign values
        $name = $_POST['name']; 
        $phone = $_POST['phone']; 
        $bloodType = $_POST['bloodType']; 
        $date = $_POST['date']; 
        $time = $_POST['time']; 

        // Prepare your SQL statement
        $sql = "INSERT INTO vc_appointment (appo_name, appo_email, appo_phone, appo_bloodtype, appo_date, appo_time) VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Bind parameters
        $stmt->bind_param("ssssss", $name, $email, $phone, $bloodType, $date, $time);

        // Execute statement
        if (!$stmt->execute()) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }

        // Close statement
        $stmt->close();
    } else {
        // Handle missing form inputs
        die("Please fill in all required fields.");
    }
}
?>

<?php include 'indexONE.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Your Appointment Details</h2>
    
    <?php
    // Fetch recipient requests
    $recipientRequests = $conn->query("SELECT ad.*, u.* FROM active_donor_table AS ad JOIN vitacare_db.users AS u ON ad.user_id = u.user_id WHERE u.user_type = 'recipient'"); // Adjust table name as needed
    if ($recipientRequests && $recipientRequests->num_rows > 0) {
        while ($row = $recipientRequests->fetch_assoc()) {
            echo "<div>";
            echo "<p>Recipient Name: " . htmlspecialchars($row['fullname']) . "</p>";
            echo "<p>Contact: " . htmlspecialchars($row['contact']) . "</p>";
            echo "<p>Requested Blood Type: " . htmlspecialchars($row['blood_group']) . "</p>";
            echo "<p>Needed Time: " . htmlspecialchars($row['needed_time']) . "</p>";
            echo "<p>Appointment Date: " . htmlspecialchars($row['requested_date']) . "</p>";
            echo "<form action='update_request_status.php' method='POST'>";
            echo "<input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['id']) . "' />";
            echo "<button type='submit' name='action' value='accept'>Accept</button>";
            echo "<button type='submit' name='action' value='reject'>Reject</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "No pending requests.";
    }
    ?>
</div>
