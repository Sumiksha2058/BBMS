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
$stmt->bind_param("s", $email); // 's' means string type for the parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();
$user_id = $user['user_id']; // Get user ID for fetching appointments
$stmt->close();


// Fetch accepted notifications from the active donor table
$stmt = $conn->prepare("SELECT ad.*, u.* FROM active_donor_table AS ad JOIN vitacare_db.users AS u ON ad.user_id = u.user_id WHERE u.user_type = 'recipient' && ad.request_status = 'accept'");
// Check if the statement was prepared successfully
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

// Bind the email parameter
// $stmt->bind_param("s", $email);

// Execute the statement and check for execution errors
if (!$stmt->execute()) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

$result = $stmt->get_result();

// Fetch total notifications from the active donor table
$stmt = $conn->prepare("SELECT ad.*, u.* FROM active_donor_table AS ad JOIN vitacare_db.users AS u ON ad.user_id = u.user_id WHERE u.user_type = 'recipient'");
$stmt->execute();
$totalResult = $stmt->get_result();
?>

<?php include 'indexONE.php'; ?>
<main id="main_container" class="container my-4">
    <div class="page-container">
        <div class="appointment-container my-2">
            <h4 class="mb-4 text-dark">Accepted Notification</h4>
            <hr class="divider text-dark">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr class="text-dark" style="background-color: #D6B2B2;">
                        <th>Recipient Name</th>
                        <th>Date</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($notification = $result->fetch_assoc()) {
                            echo "<tr class='text-dark'>
                                    <td class='text-dark'>" . htmlspecialchars($notification['recipient_name']) . "</td>
                                    <td class='text-dark'>" . htmlspecialchars($notification['needed_time']) . "</td>
                                    <td class='text-dark'>" . htmlspecialchars($notification['address']) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr class='text-dark'><td colspan='3'>No notifications available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <!-- Total Notification Table -->
            <h4 class="mb-4 text-dark">Total Notification</h4>
            <hr class="divider text-dark">
            <table class="table table-striped table-hover ">
                <thead>
                    <tr class="text-dark" style="background-color: #D6B2B2;">
                        <th>Recipient Name</th>
                        <th>Date</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($totalResult->num_rows > 0) {
                        while ($notification = $totalResult->fetch_assoc()) {
                            echo "<tr class='text-dark'>
                                    <td class='text-dark'>" . htmlspecialchars($notification['recipient_name']) . "</td>
                                    <td class='text-dark'>" . htmlspecialchars($notification['needed_time']) . "</td>
                                    <td class='text-dark'>" . htmlspecialchars($notification['blood_group']) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr class='text-dark'><td colspan='3'>No notifications available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
$stmt->close();
$conn->close();
?>
