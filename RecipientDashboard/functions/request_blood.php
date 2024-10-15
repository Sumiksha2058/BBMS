<?php
include 'includes/config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch the current user's ID
$stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Check if the request method is POST for blood request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the donor name from the AJAX request
    $donorName = $_POST['donor_name'];

    // Validate donor name
    if (empty($donorName)) {
        echo json_encode(["success" => false, "message" => "Donor name is required."]);
        exit();
    }

    // Prepare and execute the insertion into the blood_requests table
    $stmt = $conn->prepare("INSERT INTO blood_requests (user_id, requested_blood_group, message) VALUES (?, ?, ?)");
    $bloodType = ""; // Define how to set this or retrieve it accordingly
    $message = "Request for blood from donor: " . $donorName; // Customize the message as needed

    // Check if the user ID is set
    if (!isset($user['user_id'])) {
        echo json_encode(["success" => false, "message" => "User ID not found."]);
        exit();
    }

    $stmt->bind_param("iss", $user['user_id'], $bloodType, $message);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Request sent to $donorName."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }
    
    $stmt->close();
}

// Fetch all blood requests from the database
$query = "SELECT blood_requests.*, users.fullname FROM blood_requests 
          JOIN users ON blood_requests.user_id = users.user_id 
          ORDER BY blood_requests.created_at DESC";

$bloodRequests = $conn->query($query);

// Fetch active donors from the database
$donorQuery = "SELECT fullname FROM users WHERE user_type = 'donor'";
$donors = $conn->query($donorQuery);
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
        /* Styles for posts and sidebar */
        .posts {
            max-width: 600px; /* Set a maximum width for the post container */
            margin: auto; /* Center the posts on the page */
        }
        .card {
            border: 1px solid #e0e0e0; /* Light gray border */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            margin-bottom: 20px; /* Space between cards */
        }
        .active-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%; /* Makes the dot circular */
            background-color: green; /* Green color for active status */
            display: inline-block; /* Displays the dot inline with text */
            margin-right: 10px; /* Space between the dot and text */
        }
        .sidebar {
            width: 300px; /* Fixed width for sidebar */
            background-color: #d6b2b2; /* Light gray background */
            padding: 20px; /* Padding inside the sidebar */
            overflow-y: auto; /* Enable scrolling for sidebar */
            border-left: 1px solid #e0e0e0; /* Add border for separation */
            height: calc(100vh - 56px); /* Full height minus navbar */
            position: sticky; /* Make sidebar sticky */
            top: 56px; /* Position from the top */
        }
    </style>
</head>
<body>

<?php include ('index.php'); ?>    

<div class="main_container d-flex">
    <main class="main-content">
        <div class="my-4 text-dark">
            <h2>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!
            ||<button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#createPostModal">Create Blood Donation Request</button>
        </h2>
        </div>

        <!-- Display Blood Requests (Posts) -->
        <div class="posts mt-4">
            <?php if ($bloodRequests->num_rows > 0): ?>
                <?php while ($request = $bloodRequests->fetch_assoc()): ?>
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
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-muted text-dark">No blood donation requests available yet.</p>
            <?php endif; ?>
        </div>

    </main>

    <!-- Right Sidebar -->
    <div class="sidebar">
        <h4>Active Donors</h4>
        <ul class="list-group">
            <?php
            if ($donors->num_rows > 0) {
                while ($donor = $donors->fetch_assoc()) {
                    echo "<li class='list-group-item' onclick='requestBlood(\"" . htmlspecialchars($donor['fullname']) . "\")'><span class='active-dot'></span>" . htmlspecialchars($donor['fullname']) . "</li>";
                }
            } else {
                echo "<li class='list-group-item'>No active donors available.</li>";
            }
            ?>
        </ul>
    </div>
</div>

<!-- Create Blood Donation Request Modal -->
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Create Blood Donation Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="donationRequestForm" method="post">
                    <div class="mb-3">
                        <label for="bloodType" class="form-label">Blood Type</label>
                        <select name="bloodType" class="form-select" required>
                            <option value="">Select Blood Type</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Contact Number</label>
                        <input type="text" name="contactNumber" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    function requestBlood(donorName) {
        // This will make an AJAX request to request blood from the selected donor
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true); // Sending to the same page
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                var response = JSON.parse(xhr.responseText);
                alert(response.message);
                // Optionally, you can refresh the requests or update the UI based on response
            }
        };
        xhr.send("donor_name=" + encodeURIComponent(donorName));
    }
</script>
</body>
</html>
