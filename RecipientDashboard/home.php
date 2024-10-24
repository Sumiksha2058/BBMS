<?php
include 'includes/config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch the current user's details including their latitude and longitude
$stmt = $conn->prepare("SELECT user_id, fullname, latitude, longitude FROM users WHERE email = ? AND user_type='donor'");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Check if user details were fetched successfully
if (!$user) {
    // Handle the case when the user details are not found
    echo "User details not found.";
    exit();
}

// Fetch all blood requests
$query = "
    SELECT blood_requests.*, users.fullname, users.latitude, users.longitude 
    FROM blood_requests 
    JOIN users ON blood_requests.user_id = users.user_id 
    ORDER BY blood_requests.created_at DESC";
$bloodRequests = $conn->query($query);

// Calculate distance using Haversine formula and filter only active donors
$radius = 10; // Define radius in kilometers
$activeDonors = [];

if ($bloodRequests->num_rows > 0) {
    while ($request = $bloodRequests->fetch_assoc()) {
        $donorLatitude = $request['latitude'];
        $donorLongitude = $request['longitude'];

        // Calculate distance
        $distance = haversineGreatCircleDistance($user['latitude'], $user['longitude'], $donorLatitude, $donorLongitude);

        // Check if the donor is within the specified radius
        if ($distance <= $radius) {
            $activeDonors[] = [
                'name' => $request['fullname'],
                'requested_blood_group' => $request['requested_blood_group'],
                'message' => $request['message'],
                'created_at' => $request['created_at'],
                'distance' => round($distance, 2)
            ];
        }
    }
}

// Haversine formula function
function haversineGreatCircleDistance($lat1, $lon1, $lat2, $lon2, $earthRadius = 6371)
{
    // Convert from degrees to radians
    $latFrom = deg2rad($lat1);
    $lonFrom = deg2rad($lon1);
    $latTo = deg2rad($lat2);
    $lonTo = deg2rad($lon2);

    // Haversine formula
    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $a = sin($latDelta / 2) * sin($latDelta / 2) +
         cos($latFrom) * cos($latTo) *
         sin($lonDelta / 2) * sin($lonDelta / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $earthRadius * $c; // Distance in kilometers
}
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
</head>
<body>
<?php include('index.php'); ?>    

<div class="main_container d-flex">
    <main class="main-content">
        <h2 class="my-4 text-dark">Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h2>

        <div class="posts mt-4">
            <?php if (count($activeDonors) > 0): ?>
                <?php foreach ($activeDonors as $donor): ?>
                    <div class="mb-4">
                        <div class="card" style="background-color: #d6b2b2;">
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?php echo htmlspecialchars($donor['requested_blood_group']); ?> Blood Needed</h5>
                                <p class="card-text text-dark"><?php echo htmlspecialchars($donor['message']); ?></p>
                                <p class="text-dark">Posted by: <?php echo htmlspecialchars($donor['name']); ?></p>
                                <p class="text-dark">Posted on: <?php echo date('F d, Y', strtotime($donor['created_at'])); ?></p>
                                <p class="text-dark">Distance: <?php echo $donor['distance']; ?> km</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted text-dark">No blood donation requests available from nearby donors yet.</p>
            <?php endif; ?>
        </div>
    </main>

    <div class="sidebar">
        <h4>Active Donors</h4>
        <ul class="list-group">
            <?php
            if (count($activeDonors) > 0) {
                foreach ($activeDonors as $donor) {
                    echo "<li class='list-group-item' onclick='requestBlood(\"" . htmlspecialchars($donor['name']) . "\")'>
                          <span class='active-dot'></span>" . htmlspecialchars($donor['name']) . " - " . $donor['distance'] . " km away</li>";
                }
            } else {
                echo "<li class='list-group-item'>No active donors available.</li>";
            }
            ?>
        </ul>
    </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    function requestBlood(donorName) {
        let bloodGroup = prompt("Enter the blood group required:");
        let contactNumber = prompt("Enter your contact number:");
        let neededTime = prompt("Enter the time when the blood is needed (HH:MM)");

        if (bloodGroup && contactNumber && neededTime) {
            if (confirm(`Send request to ${donorName}?`)) {
                let formData = new FormData();
                formData.append('donor_name', donorName);
                formData.append('blood_group', bloodGroup);
                formData.append('contact_number', contactNumber);
                formData.append('needed_time', neededTime);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        let response = JSON.parse(xhr.responseText);
                        alert(response.message);
                        if (response.success) {
                            window.location.reload();
                        }
                    }
                };
                xhr.send(formData);
            }
        } else {
            alert("Blood group, contact number, and needed time are required.");
        }
    }
</script>
</body>
</html>
