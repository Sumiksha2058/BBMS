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


<?php include 'index.php'; ?>
<main id="main_container" class="container my-4">
    <div class="page-container">
    <div class="appointment-container my-2">
                <h4 class="fw-bold text-dark">Appointment Requests</h4>
                <hr>
                <?php if (!empty($appointments)): ?>
                    <div class="row">
                        <?php foreach ($appointments as $appointment): ?>
                            <div class="col-md-12">
                                <div class="card mb-4 text-dark" id="appointment-card-<?php echo htmlspecialchars($appointment['donor_name']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title text-teal">Donor Name: <?php echo htmlspecialchars($appointment['donor_name']); ?></h5>
                                        <h6 class="card-text"><strong>Contact Number:</strong> <?php echo htmlspecialchars($appointment['contact_number']); ?></h6>
                                        <p class="card-text"><strong>Date:</strong> <?php echo date("F j, Y", strtotime($appointment['created_at'])); ?></p>
                                        <p class="card-text"><strong>Time:</strong> <?php echo date("g:i A", strtotime($appointment['needed_time'])); ?></p>
                                        <p class="card-text"><strong>Request Status:</strong> 
                                            <span class="text-orange"   ><?php echo htmlspecialchars($appointment['request_status']); ?></span>
                                        </p>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <a href="tel:<?php echo htmlspecialchars($appointment['contact_number']); ?>" class="card-link text-muted">Call Donor</a>
                                        <i class="bi bi-telephone float-end"></i>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No appointments available.</p>
                <?php endif; ?>
            </div>

    </div>
</main>

<?php
$stmt->close();
$conn->close();
?>
