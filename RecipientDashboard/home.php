<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the configuration file to connect to the database
include 'includes/config.php';
session_start();

// Redirect to login if session email is not set
if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

$email = $_SESSION['email'];

// Using prepared statements to fetch user information
$stmt = $conn->prepare("SELECT user_id, fullname FROM users WHERE email = ? AND user_type = 'recipient'");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows === 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();
$stmt->close();

// if (empty($user['latitude']) || empty($user['longitude'])) {
//     die("Latitude and longitude are not set for this user.");
// }


$submissionMessage = ""; // Variable to hold submission message

// Handle Blood Request Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_blood_request'])) {
    // Retrieve and sanitize the form inputs for blood request
    $bloodType = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Validate form fields
    if (empty($bloodType) || empty($message)) {
        echo "All fields are required!";
        exit();
    }

    // Prepare the SQL statement to insert into blood_requests table
    $stmt = $conn->prepare("INSERT INTO blood_requests (user_id, requested_blood_group, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user['user_id'], $bloodType, $message);

    // Execute the statement
    if ($stmt->execute()) {
        $submissionMessage = "Blood request submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all post blood requests
$query = "
    SELECT r.request_id, r.requested_blood_group, r.message, r.created_at, u.fullname 
    FROM blood_requests AS r
    JOIN users AS u ON r.user_id = u.user_id
";
$bloodRequests = $conn->query($query);
$allRequests = [];


// Handle Active Donor Request Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $donor_name = mysqli_real_escape_string($conn, $_POST['donor_name']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $recipient_name = mysqli_real_escape_string($conn, $_POST['recipient_name']);
    $needed_time = isset($_POST['needed_time']) ? mysqli_real_escape_string($conn, $_POST['needed_time']) : null;
    $created_at = date('Y-m-d H:i:s');
    $request_status = 'pending';

    // Validate form fields
    if (empty($donor_name) || empty($contact_number) || empty($blood_group) || empty($message) || empty($recipient_name)) {
        echo "All fields are required!";
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO active_donor_table (user_id, donor_name, contact_number, blood_group, message, created_at, needed_time, request_status, recipient_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $user['user_id'], $donor_name, $contact_number, $blood_group, $message, $created_at, $needed_time, $request_status, $recipient_name);

    // Execute the statement
    if ($stmt->execute()) {
        $submissionMessage = "Blood request to active donor submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Function to calculate distance between two latitude/longitude points using Haversine formula
function calculateDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371; // Radius of the Earth in kilometers

    // Convert degrees to radians
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    // Haversine formula
    $dLat = $lat2 - $lat1;
    $dLon = $lon2 - $lon1;

    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos($lat1) * cos($lat2) *
         sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earthRadius * $c; // Distance in kilometers
    return $distance;
}

// Fetch recipient latitude and longitude
$stmt = $conn->prepare("SELECT latitude, longitude FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$recipient = $result->fetch_assoc();
$recipientLatitude = $recipient['latitude'];
$recipientLongitude = $recipient['longitude'];
$stmt->close();

// Fetch active donors and calculate distance
$query = "
SELECT user_id, fullname, latitude, longitude
FROM users
WHERE latitude IS NOT NULL AND longitude IS NOT NULL AND user_type = 'donor' AND status = 1
";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$allActiveDonors = [];

if ($result->num_rows > 0) {
    while ($donor = $result->fetch_assoc()) {
        $donorLatitude = $donor['latitude'];
        $donorLongitude = $donor['longitude'];
        
        // Calculate distance only if recipient's coordinates exist
        if (isset($recipientLatitude, $recipientLongitude)) {
            $distance = calculateDistance($recipientLatitude, $recipientLongitude, $donorLatitude, $donorLongitude);
            $donor['distance'] = round($distance, 2);  // Add distance to donor
        }

        $allActiveDonors[] = $donor;
    }
}
$stmt->close();





$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/profile.css">
    <title>Dashboard</title>
    <style>
        body {
            display: flex;
            width: 100%;
            height: auto;
            overflow: hidden;
        }

        .main-container {
            flex: 1;
            overflow-y: auto;
        }

        .sidebar {
            width: 250px;
            background-color: #d6b2b2;
            position: fixed;
            padding-top: 70px !important;
            top: 0;
            bottom: 0;
            right: 0;
            padding: 20px;
            overflow-y: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                top: auto;
                right: auto;
            }

            .main-container {
                margin-right: 0;
                margin-top: 20px;
            }
        }
        button .btn{
            width: 216px !important;
            height: 71px !important;
        }
        .post_btn{
            width: 206px !important;
            height: 71px !important;
        }
    </style>
</head>
<body>
<?php include('index.php'); ?>

<div class="main-container">
    <!-- <h2>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h2> -->
    
   
    <button class="btn mt-3 w-10" style="width:50px" data-bs-toggle="modal" data-bs-target="#requestModal"> <img class="post_btn" src="images\createpostbtn.png" alt="click to add post" /></button>
 
    <!-- Blood Request Modal -->
    <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestModalLabel">Blood Request Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bloodRequestForm" method="POST" action="">
                        <div class="mb-3">
                            <label for="blood_group" class="form-label">Blood Group:</label>
                            <select id="blood_group" name="blood_group" class="form-select" required>
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="mb-3 mt-2">
                            <label for="message" class="form-label">Message:</label>
                            <textarea id="message" name="message" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="submit_blood_request" class="btn btn-primary">Submit Request</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="posts mt-4 w-50">
        <?php if (count($allRequests) > 0): ?>
            <?php foreach ($allRequests as $request): ?>
                <div class="mb-4">
                    <div class="card" style="background-color: #d6b2b2;">
                        <div class="card-body">
                            <h5 class="card-title text-dark"><?php echo htmlspecialchars($request['requested_blood_group']); ?> Blood Needed</h5>
                            <p class="card-text text-dark"><?php echo htmlspecialchars($request['message']); ?></p>
                            <p class="text-dark">Posted by: <?php echo htmlspecialchars($request['fullname']); ?></p>
                            <p class="text-dark">Posted on: <?php echo date('F d, Y', strtotime($request['created_at'])); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted text-dark">No blood donation requests available from nearby donors yet.</p>
        <?php endif; ?>
    </div>


<!-- Active Donor Request Modal -->
<div class="modal fade" id="donorRequestModal" tabindex="-1" aria-labelledby="donorRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="donorRequestModalLabel">Active Donor Request Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="donor_name" class="form-label">Donor Name:</label>
                        <input type="text" id="donor_name" name="donor_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number:</label>
                        <input type="text" id="contact_number" name="contact_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="blood_group" class="form-label">Blood Group:</label>
                        <select id="blood_group" name="blood_group" class="form-select" required>
                            <option value="">Select Blood Group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient_name" class="form-label">Recipient Name:</label>
                        <input type="text" id="recipient_name" name="recipient_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="needed_time" class="form-label">Needed Time:</label>
                        <input type="time" id="needed_time" name="needed_time" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message:</label>
                        <textarea id="message" name="message" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="sidebar">
    <h4>Active Donors</h4>
    <ul class="list-group">
        <?php foreach ($allActiveDonors as $donor): ?>
            <li class='list-group-item active-donor' data-bs-toggle='modal' data-bs-target='#donorRequestModal' 
    style='cursor: pointer;' data-donor-name='<?php echo htmlspecialchars($donor['fullname']); ?>' 
    data-donor-distance='<?php echo $donor['distance']; ?>'>
    <?php echo htmlspecialchars($donor['fullname']) . ' / ' . $donor['distance'] . ' km'; ?>
</li>
        <?php endforeach; ?>
    </ul>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // When a donor name is clicked
    $('.active-donor').click(function() {
        // Get the donor name from the clicked list item
        var donorName = $(this).data('donor-name');
        
        // Set the donor name in the modal's donor_name input field
        $('#donor_name').val(donorName);
        
        // Set the recipient name (from the session data) in the modal's recipient_name input field
        var recipientName = "<?php echo htmlspecialchars($user['fullname']); ?>";
        $('#recipient_name').val(recipientName);

        // Show the Active Donor Request Modal
        $('#donorRequestModal').modal('show');
    });
});

document.getElementById('blood_group').addEventListener('change', function() {
    let bloodType = this.value;
    let messageField = document.getElementById('message');

    if (bloodType) {
        // Auto-generated message based on selected blood group
        let message = `Urgent! We are in need of ${bloodType} blood for a patient at a local hospital who requires an immediate transfusion. If you or someone you know has this blood type, your support could make a life-saving difference. Please reach out as soon as possible. Thank you for your kindness and generosity.`;

        messageField.value = message;
    } else {
        messageField.value = ""; // Clear if no blood type selected
    }
});

</script>

</body>
</html>