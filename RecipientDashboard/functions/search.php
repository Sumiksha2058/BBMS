<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'vitacare_db';

try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_POST['search'])) {
    $searchValue = '%' . $_POST['search'] . '%';

    $searchQuery = "SELECT fullname, blood_group FROM users WHERE approval_status = 'approved' AND blood_group LIKE :searchValue";

    try {
        $stmt = $conn->prepare($searchQuery);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            $response = "<table class='table table-striped'>";
            $response .= "<tr><th>Name</th><th>Blood Type</th></tr>";
            foreach ($result as $row) {
                $response .= "<tr><td>{$row['fullname']}</td><td>{$row['blood_group']}</td><td>{$row['contact']}</td><td>{$row['email']}</td></tr>";
            }
            $response .= "</table>";
            echo $response;
        } else {
            echo "<p>No data found for the given search criteria.</p>";
        }

    } catch (PDOException $e) {
        die("Error in query execution: " . $e->getMessage());
    }
}

?>