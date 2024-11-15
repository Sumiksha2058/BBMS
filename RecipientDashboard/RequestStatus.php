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
$appointmentStmt = $conn->prepare("SELECT * FROM `active_donor_table`");
// $appointmentStmt->bind_param("i", $user_id); // Bind user_id as integer
$appointmentStmt->execute();
$appointmentResult = $appointmentStmt->get_result();

$appointments = [];
if ($appointmentResult->num_rows > 0) {
    while ($row = $appointmentResult->fetch_assoc()) {
        $appointments[] = $row;
    }
}

$appointmentStmt->close();
?>

<?php include 'index.php'; ?>
<!-- Add this CSS to style the avatar -->
<style>
    .avatar-circle {
        width: 50px;
        height: 50px;
        background-color: #007bff; /* Change this color as desired */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>

<main id="main_container" class="container my-4">
    <div class="page-container">
        <div class="appointment-container my-2">
            <h4 class="fw-bold text-dark">Request Status</h4>
            <hr>
            <?php if (!empty($appointments)): ?>
             
                    <?php foreach ($appointments as $appointment): ?>
                       
                        <div class="card  col-md-8 my-4 p-4 ">
                            <div class="donor-card d-flex align-items-center">
                            <h4 class="card-title text-teal d-flex align-items-center">
                                <!-- Avatar Circle with First Letter -->
                                <span class="avatar-circle text-white me-2">
                                    <?php echo strtoupper(substr($appointment['donor_name'], 0, 1)); ?>
                                </span>
                                
                            </h4>
                            <div class="flex-grow-1">
                                <h5 class="mb-1 fw-bold text-primary"> <?php echo htmlspecialchars($appointment['donor_name']); ?></h5>
                                <p class="card-text text-dark"><strong>Contact Number:</strong> <?php echo htmlspecialchars($appointment['contact_number']); ?></p>
                               
                            </div>
                            <p class="card-text float-end"><strong></strong> 
                                <span class="text-<?php 
                                    // Apply different colors based on the status
                                    echo ($appointment['request_status'] === 'accept') ? 'success' : 
                                            (($appointment['request_status'] === 'reject') ? 'danger' :
                                            (($appointment['request_status'] === 'pending') ? 'warning' : ''));
                                ?>">
                                    <?php echo htmlspecialchars(ucfirst($appointment['request_status'])); ?>
                                </span>
                            </p>
                            </div>
                            
                        </div>
                    <?php endforeach; ?>
                
            <?php else: ?>
                <p>No appointments available.</p>
            <?php endif; ?>
        </div>
    </div>


</main>

<?php $conn->close(); ?>
