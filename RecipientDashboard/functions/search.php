<?php
// include 'includes/config.php';

$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vitacare_db';

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn === false){
    die("Copnnection failed: ".$conn->connect_error);
}

if (isset($_POST['search'])) {
    $searchValue = $_POST['search'];

    // Perform the search query based on the search value
    $searchQuery = "SELECT fullname, blood_group, contact, email FROM users WHERE approval_status = 'approved' AND fullname LIKE '%$searchValue%'";
    $result = mysqli_query($conn, $searchQuery);

    // Process the search results and return the data
    $response = "<table class='table table-striped'>";
    $response .= "<tr><th>Name</th><th>Blood Type</th><th>Contact</th><th>Email</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $response .= "<tr><td>" . $row['fullname'] . "</td><td>" . $row['blood_group'] . "</td><td>" . $row['contact'] . "</td><td>" . $row['email'] . "</td></tr>";
    }
    $response .= "</table>";
    echo $response;
}
?>
