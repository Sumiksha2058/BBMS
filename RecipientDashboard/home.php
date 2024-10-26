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

$submissionMessage = ""; // Variable to hold submission message

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize the form inputs
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
        $submissionMessage = "Blood request submitted successfully."; // Set success message
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
$submissionMessage = ""; // Variable to hold submission message

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize the form inputs
    $donor_name = mysqli_real_escape_string($conn, $_POST['donor_name']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $recipient_name = mysqli_real_escape_string($conn, $_POST['recipient_name']);

    // Validate form fields
    if (empty($bloodType) || empty($message)) {
        echo "All fields are required!";
        exit();
    }

    // Prepare the SQL statement to insert into blood_requests table
    $stmt = $conn->prepare("INSERT INTO `active_donor_table` (
  `user_id`,
  `donor_name`,
  `contact_number`,
  `blood_group`,
  `message`,
  `recipient_name`
) VALUES (?, ?, ?,?,?,? 
);
");
    $stmt->bind_param("isssss", $user['user_id'], $donor_name, $contact_number,$blood_group,$message,$recipient_name);

    // Execute the statement
    if ($stmt->execute()) {
        $submissionMessage = "Blood request to active donor submitted successfully."; // Set success message
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}


// Fetch all active blood requests with approved status
$query = "
   SELECT r.request_id, r.requested_blood_group, r.message, r.created_at, u.fullname 
   FROM blood_requests AS r
   JOIN users AS u ON r.user_id = u.user_id
";

$bloodRequests = $conn->query($query);
$allRequests = [];

// Check for blood requests
if ($bloodRequests->num_rows > 0) {
    while ($request = $bloodRequests->fetch_assoc()) {
        // Include all blood requests without calculating distance
        $allRequests[] = [
            'name' => $request['fullname'],
            'requested_blood_group' => $request['requested_blood_group'],
            'message' => $request['message'],
            'created_at' => $request['created_at'],
        ];
    }
}

// Close the database connection
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

        .active-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: green;
            border-radius: 50%;
            margin-right: 10px;
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
    </style>
</head>
<body>
<?php include('index.php'); ?>    

<div class="main-container">
    <h2>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h2>
    
    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#requestModal">Create Blood Request</button>
    
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
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="posts mt-4">
        <?php if (count($allRequests) > 0): ?>
            <?php foreach ($allRequests as $request): ?>
                <div class="mb-4">
                    <div class="card" style="background-color: #d6b2b2;">
                        <div class="card-body">
                            <h5 class="card-title text-dark"><?php echo htmlspecialchars($request['requested_blood_group']); ?> Blood Needed</h5>
                            <p class="card-text text-dark"><?php echo htmlspecialchars($request['message']); ?></p>
                            <p class="text-dark">Posted by: <?php echo htmlspecialchars($request['name']); ?></p>
                            <p class="text-dark">Posted on: <?php echo date('F d, Y', strtotime($request['created_at'])); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted text-dark">No blood donation requests available from nearby donors yet.</p>
        <?php endif; ?>
    </div>
</div>

<div class="sidebar">
    <h4>Active Donors</h4>
    <ul class="list-group">
        <?php
        // To store unique active donor names
        $uniqueDonors = [];
        
        // Loop through all requests and collect unique donor names
        foreach ($allRequests as $request) {
            $donorName = htmlspecialchars($request['name']);
            if (!in_array($donorName, $uniqueDonors)) {
                $uniqueDonors[] = $donorName; // Add to unique donors
                echo "<li class='list-group-item' onclick='requestBlood(\"$donorName\")'>
                      <span class='active-dot'></span>$donorName</li>";
            }
        }

        // If no unique donors, display a message
        if (count($uniqueDonors) === 0) {
            echo "<li class='list-group-item'>No active donors available.</li>";
        }
        ?>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    // Function to request blood from the selected donor
    function requestBlood(donorName) {
        alert(`Requesting blood from ${donorName}.`);
    }

    // Show alert if the blood request was submitted successfully
    <?php if (!empty($submissionMessage)): ?>
        alert("<?php echo addslashes($submissionMessage); ?>");
    <?php endif; ?>

    // Function to set the default message when the modal opens
    $('#requestModal').on('show.bs.modal', function () {
        var message = "I’m undergoing a critical procedure and require B+ blood. Donations can be made at the hospital's donation center. Contact 9818455889 for more information.";
        $('#message').val(message); // Set the message in the textarea
    });
</script>
</body>
</html>
