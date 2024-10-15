<?php
include 'includes/config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user information
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();
$user_id = $user['user_id']; // Get user ID for fetching appointments
$stmt->close();

// Fetch all appointments for the logged-in user based on user_id
$appointmentStmt = $conn->prepare("SELECT * FROM `active_donor_table` WHERE user_id = ?");
$appointmentStmt->bind_param("i", $user_id); // Bind user_id as integer
$appointmentStmt->execute();
$appointmentResult = $appointmentStmt->get_result();

// Check if appointments exist for the user
$appointments = [];
if ($appointmentResult->num_rows > 0) {
    while ($row = $appointmentResult->fetch_assoc()) {
        $appointments[] = $row;
    }
} else {
    die("No appointments found.");
}

$appointmentStmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipientName = $_POST['recipientName'];
    $action = $_POST['action'];

    // Determine the request status based on action
    $requestStatus = ($action === 'accept') ? 'accepted' : 'rejected';

    // Update the request_status in active_donor_table
    $updateStmt = $conn->prepare("UPDATE active_donor_table SET request_status = ? WHERE donor_name = ? AND user_id = ?");
    $updateStmt->bind_param("ssi", $requestStatus, $recipientName, $user_id);

    if ($updateStmt->execute()) {
        echo "Appointment has been " . ($action === 'accept' ? 'accepted' : 'rejected') . " successfully.";
    } else {
        echo "Error updating status.";
    }

    $updateStmt->close();
    exit; // Stop further execution after processing the POST request
}
?>

<?php
include 'index.php';
?>
<!-- Display Appointment Details -->
<main id="main_container">
    <div class="page-container">
        <div class="appointment-container my-2">
            <h2>Appointment Requests</h2>
            <?php if (!empty($appointments)): ?>
                <?php foreach ($appointments as $appointment): ?>
                    <div class="card mb-3" id="appointment-card-<?php echo htmlspecialchars($appointment['donor_name']); ?>" style="background-color: white;">
                        <div class="card-body">
                            <h5 class="card-title">Recipient Name: <?php echo htmlspecialchars($appointment['donor_name']); ?></h5>
                            <h6 class="card-text"><strong>Contact Number:</strong>  <?php echo htmlspecialchars($appointment['contact_number']); ?></h6>
                            <p class="card-text"><strong>Date:</strong> <?php echo date("F j, Y", strtotime($appointment['created_at'])); ?></p>
                            <p class="card-text"><strong>Time:</strong> <?php echo date("g:i A", strtotime($appointment['needed_time'])); ?></p>
                            <p class="card-text"><strong>Request Status:</strong> <?php echo htmlspecialchars($appointment['request_status']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No appointments available.</p>
            <?php endif; ?>
        </div>

        <div id="response-message"></div>
    </div>
</main>

<script>
// JavaScript function to handle button clicks (this is now unused)
function respondToAppointment(recipientName, action) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true); // Post to the same file
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('response-message').innerHTML = xhr.responseText;
            document.getElementById('appointment-card-' + recipientName).style.display = 'none';
        } else {
            alert("Error: " + xhr.responseText);
        }
    };
    
    // Send the request with recipient name and action (accept/reject)
    xhr.send("recipientName=" + encodeURIComponent(recipientName) + "&action=" + encodeURIComponent(action));
}
</script>

<!-- Include Bootstrap and any other necessary JS/CSS files -->
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>