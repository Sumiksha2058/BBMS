<?php
// Set response header to JSON
header('Content-Type: application/json');

// Check if latitude and longitude are sent via POST
if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $latitude = floatval($_POST['latitude']);
    $longitude = floatval($_POST['longitude']);

    // Include database configuration
    include 'includes/config.php';

    // SQL query to find active donors sorted by proximity, join with users to get the username
    $sql = "SELECT ad.*, u.username,
                   (6371 * acos(cos(radians(?)) * cos(radians(ad.latitude)) 
                   * cos(radians(ad.longitude) - radians(?)) 
                   + sin(radians(?)) * sin(radians(ad.latitude)))) AS distance
            FROM active_donor_table ad
            JOIN users u ON ad.user_id = u.id
            HAVING distance <= 10
            ORDER BY distance ASC";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ddd", $latitude, $longitude, $latitude);
    $stmt->execute();
    $result = $stmt->get_result();

    $donors = [];
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }

    // Close connections
    $stmt->close();
    $conn->close();

    // Return the list of donors as JSON
    echo json_encode(['status' => 'success', 'donors' => $donors]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
}
?>
