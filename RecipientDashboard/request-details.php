<?php
include 'includes/config.php'; // Include database configuration file
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch the specific blood request based on the request_id
$requestId = isset($_GET['request_id']) ? intval($_GET['request_id']) : 0;

$stmt = $conn->prepare("SELECT blood_requests.*, users.fullname FROM blood_requests 
                        JOIN users ON blood_requests.user_id = users.user_id 
                        WHERE blood_requests.request_id = ?");
$stmt->bind_param("i", $requestId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No request found.");
}

$request = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Request Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Blood Request Details</h2>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($request['requested_blood_group']); ?> Blood Needed</h5>
                <p class="card-text"><?php echo htmlspecialchars($request['message']); ?></p>
                <p class="text-muted">Requested by: <?php echo htmlspecialchars($request['fullname']); ?></p>
                <p class="text-muted">Posted on: <?php echo date('F d, Y', strtotime($request['created_at'])); ?></p>
            </div>
        </div>

        <!-- Donation Form -->
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Offer Your Donation</h5>
                <form method="POST" action="process_donation.php">
                    <div class="mb-3">
                        <label for="donorContact" class="form-label">Your Contact Number</label>
                        <input type="text" name="donorContact" id="donorContact" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="donorMessage" class="form-label">Your Message</label>
                        <textarea name="donorMessage" id="donorMessage" class="form-control" rows="3" required></textarea>
                    </div>

                    <input type="hidden" name="request_id" value="<?php echo $request['request_id']; ?>">
                    <button type="submit" class="btn btn-primary">Submit Donation Offer</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
