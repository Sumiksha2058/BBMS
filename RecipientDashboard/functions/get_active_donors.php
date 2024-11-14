<?php
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
?>