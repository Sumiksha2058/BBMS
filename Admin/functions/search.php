<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vitacare_db';

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['search'])) {
    $searchValue = $_POST['search'];

    // Prepare the search query with a placeholder for the user input
    $searchQuery = "SELECT fullname, blood_group, contact, email FROM users WHERE approval_status = 'approved' AND blood_group LIKE ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($searchQuery);

    if (!$stmt) {
        die("Error in query preparation: " . $conn->error);
    }

    // Bind the parameter
    $searchParam = "%" . $searchValue . "%";
    $stmt->bind_param("s", $searchParam);

    // Execute the statement
    $stmt->execute();

    if (!$stmt) {
        die("Error in query execution: " . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();

    // Check if there are any rows
    if ($result->num_rows > 0) {
        // Process the search results and return the data
        $response = "<table class='table table-striped'>";
        $response .= "<tr><th>Name</th><th>Blood Type</th><th>Contact</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $response .= "<tr><td>" . $row['fullname'] . "</td><td>" . $row['blood_group'] . "</td><td>" . $row['contact'] . "</td><td>" . $row['email'] . "</td></tr>";
        }
        $response .= "</table>";
        echo $response;
    } else {
        // No data found
        echo "<p>No data found for the given search criteria.</p>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
