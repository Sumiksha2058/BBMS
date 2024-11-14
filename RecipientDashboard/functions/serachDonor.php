<?php
include 'includes/config.php';

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    // Search for donors whose name matches the search term (case-insensitive)
    $stmt = $conn->prepare("SELECT * FROM active_donor_table WHERE donor_name LIKE ? ORDER BY donor_name ASC");
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
