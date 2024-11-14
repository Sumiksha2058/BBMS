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
// Fetch user information
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email); // 's' means string type for the parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}


$user = $result->fetch_assoc();
$stmt->close();

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
        $submissionMessage = "Blood request submitted successfully."; // Set success message
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Retrieve and sanitize the form inputs for active donor request
    $donor_name = mysqli_real_escape_string($conn, $_POST['donor_name']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $recipient_name = mysqli_real_escape_string($conn, $_POST['recipient_name']);

    // Check if needed_time is set in POST; if not, set to NULL or a default value
    $needed_time = isset($_POST['needed_time']) ? mysqli_real_escape_string($conn, $_POST['needed_time']) : null; // Use null if not set

    // Validate form fields
    if (empty($donor_name) || empty($contact_number) || empty($blood_group) || empty($message) || empty($recipient_name)) {
        echo "All fields are required!";
        exit();
    }

    // Set default values for created_at and request_status
    $created_at = date('Y-m-d H:i:s'); // Default to the current timestamp
    $request_status = 'pending'; // Default request status

    // Prepare the SQL statement to insert into active_donor_table
    $stmt = $conn->prepare("INSERT INTO active_donor_table (user_id, donor_name, contact_number, blood_group, message, created_at, needed_time, request_status, recipient_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("issssssss", 
        $user['user_id'],  // user_id (int)
        $donor_name,      // donor_name (string)
        $contact_number,  // contact_number (string)
        $blood_group,     // blood_group (string)
        $message,         // message (string)
        $created_at,      // created_at (timestamp)
        $needed_time,     // needed_time (time or string), can be NULL
        $request_status,  // request_status (string)
        $recipient_name   // recipient_name (string)
    );

    // Execute the statement
    if ($stmt->execute()) {
        $submissionMessage = "Blood request to active donor submitted successfully."; // Set success message
    } else {
        echo "Error: " . $stmt->error; // Output error message
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

// Check for blood requests
if ($bloodRequests->num_rows > 0) {
    while ($request = $bloodRequests->fetch_assoc()) {
        $allRequests[] = [
            'name' => $request['fullname'],
            'requested_blood_group' => $request['requested_blood_group'],
            'message' => $request['message'],
            'created_at' => $request['created_at'],
        ];
    }
}

// Check if latitude and longitude are provided
$donors = [];

if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
    // Get latitude and longitude from POST request
    $userLat = $_POST['latitude'];
    $userLon = $_POST['longitude'];

    // SQL query to get active donors from the database
    $query = "
        SELECT user_id, fullname, latitude, longitude 
        FROM users 
        WHERE user_type = 'donor' 
        AND status = 1;
    ";

    $result = $conn->query($query);

    if ($result === false) {
        echo json_encode(['error' => 'Database query failed']);
        exit;
    }

    // Loop through the donors and calculate the distance
    while ($donor = $result->fetch_assoc()) {
        // Get the donor's latitude and longitude
        $donorLat = $donor['latitude'];
        $donorLon = $donor['longitude'];

        // Calculate the distance between the user and the donor using the haversine formula
        $distance = haversineDistance($userLat, $userLon, $donorLat, $donorLon);

        // Check if the donor is within 10 km radius
        if ($distance <= 10) {
            // Add donor info with the calculated distance
            $donors[] = [
                'fullname' => $donor['fullname'],
                'latitude' => $donorLat,
                'longitude' => $donorLon,
                'distance' => number_format($distance, 2)
            ];
        }
    }
}
 else {
    echo json_encode(['error' => 'Latitude and longitude not provided']);
}

// Function to calculate the distance using the Haversine formula
function haversineDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371; // Radius of the Earth in kilometers

    // Convert degrees to radians
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    // Apply Haversine formula
    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    // Calculate the distance
    $distance = $earthRadius * $c;

    return $distance;
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
<div class="col-md-6">
    <form method="GET" action="functions/serachDonor.php" class="d-flex" onsubmit="searchDonor(event)">
        <input class="form-control me-2 bg-light" type="search" id="searchInput" placeholder="Search Donor" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>
    
   
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

    <!-- Active Donor Request Modal -->
    <div class="modal fade" id="donorRequestModal" tabindex="-1" aria-labelledby="donorRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="donorRequestModalLabel">Active Donor Request Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="donorRequestForm" method="POST" action="">
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
                        <div class="mb-3 mt-2">
                            <label for="recipient_name" class="form-label">Recipient Name:</label>
                            <input type="text" id="recipient_name" name="recipient_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="needed_time" class="form-label">Needed Time:</label>
                            <input type="time" id="needed_time" name="needed_time" class="form-control">
                        </div>

                        <div class="mb-3 mt-2">
                            <label for="message" class="form-label">Message:</label>
                            <textarea id="message" name="message" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit Request</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sidebar">
    <h4>Active Donors</h4>
    <ul class="list-group text-dark">
    <?php
        if (!empty($donors)) {
            echo "<ul>";
            foreach ($donors as $donor) {
               
                echo "<li class='list-group-item active-donor'>" . htmlspecialchars($donor['fullname']) . " / " . $donor['distance'] . " km</li>";

            //    echo "<p class 'text-dark'>"; 
                
            //     echo htmlspecialchars($donor_name['fullname']);
                
            //    echo "</p>";
            }
            echo "</ul>";
        } else {
            echo "<p>No active donors found within 10 km.</p>";
        }
        ?>
    </ul>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// JavaScript to handle donor search with binary search
function searchDonor(event) {
    event.preventDefault();
    
    // Get the search input
    let searchInput = document.getElementById("searchInput").value.toLowerCase();
    
    // Fetch all notification tables (for simplicity, search will be done on both tables)
    let acceptedTable = document.getElementById("acceptedNotifications");
    let totalTable = document.getElementById("totalNotifications");

    // Get all rows in the accepted notifications table
    let acceptedRows = Array.from(acceptedTable.getElementsByTagName("tr"));
    let totalRows = Array.from(totalTable.getElementsByTagName("tr"));

    // Function to perform binary search
    function binarySearch(rows, target) {
        let left = 0;
        let right = rows.length - 1;
        while (left <= right) {
            let mid = Math.floor((left + right) / 2);
            let rowName = rows[mid].cells[0].textContent.toLowerCase();
            if (rowName === target) {
                return mid;
            } else if (rowName < target) {
                left = mid + 1;
            } else {
                right = mid - 1;
            }
        }
        return -1; // Not found
    }

    // Perform binary search on accepted rows and total rows
    function filterRows(rows) {
        const index = binarySearch(rows, searchInput);
        if (index !== -1) {
            rows[index].style.display = ""; // Show the row if found
        } else {
            rows.forEach(row => row.style.display = "none"); // Hide all if no match
        }
    }

    // Filter rows in both tables
    filterRows(acceptedRows);
    filterRows(totalRows);
}


    $(document).ready(function() {
        // Handle click event for active donor names
        $('.active-donor').click(function() {
            // Get donor name from data attribute
            var donorName = $(this).data('donor-name');
            
            // Populate the recipient name field (optional)
            $('#recipient_name').val(donorName);
            
            // Show the donor request modal
            $('#donorRequestModal').modal('show');
        });
    });

    document.getElementById('blood_group').addEventListener('change', function() {
        let bloodType = this.value;
        if (bloodType) {
            // auto-generated message 
            document.getElementById('message').value = `Urgent! We are in need of ${bloodType} blood for a patient at local hospital who requires an immediate transfusion. ` +
                                                       `If you or someone you know has this blood type, your support could make a life-saving difference. ` +
                                                       `Please reach out as soon as possible. Thank you for your kindness and generosity.`;
        } else {
            document.getElementById('message').value = ""; // Clear if no blood type selected
        }
    });

    // Get user's current location using geolocation
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        const userLat = position.coords.latitude;
        const userLon = position.coords.longitude;

        // Send the coordinates to PHP via AJAX for processing
        $.ajax({
            url: 'get_active_donors.php', // Update this with the actual script that handles the AJAX request
            method: 'POST',
            data: {
                latitude: userLat,
                longitude: userLon
            },
            success: function(response) {
                var donors = JSON.parse(response);
                displayDonors(donors);
            },
            error: function(xhr, status, error) {
                console.log("Error in sending geolocation to server:", error);
            }
        });
    }, function(error) {
        console.log("Error getting location: " + error.message);
    });
} else {
    console.log("Geolocation is not supported by this browser.");
}
</script>

</body>
</html>

