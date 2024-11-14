<?php
include 'includes/config.php';

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    // Search for donors whose name matches the search term (case-insensitive)
    $stmt = $conn->prepare("SELECT u.fullname, u.address, br.requested_blood_group 
    FROM users AS u 
    JOIN blood_requests AS br ON u.user_id = br.user_id 
    WHERE u.user_type = 'recipient' 
    AND (u.fullname LIKE ? OR u.address LIKE ? OR br.requested_blood_group LIKE ?') 
LIMIT 25;");
    $searchTerm = "%$searchTerm%"; // Adding wildcard for partial match
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $donors = [];
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }

    echo json_encode($donors);
    exit;
}
?>
