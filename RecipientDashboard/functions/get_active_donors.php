<?php
// Include your database connection file
include_once 'includes/config.php';

// Get latitude and longitude from AJAX request
$latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
$longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';

// Check if latitude and longitude are provided
if ($latitude != '' && $longitude != '') {
    // SQL query to get active donors based on location
    // You can add more complex logic based on your database schema
    $query = "
     SELECT user_id, fullname, latitude, longitude 
        FROM users 
        WHERE user_type = 'donor' 
        AND status = 1;
    ";
    
    // Prepare the query
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
    $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch the results
    $donors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return results as JSON
    echo json_encode($donors);
} else {
    echo json_encode(['error' => 'No geolocation data provided']);
}
?>
