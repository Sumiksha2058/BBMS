<?php
include 'includes/config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

$email = $_SESSION['email'];

// Using prepared statements to fetch user information
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}
$user = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $bloodType = mysqli_real_escape_string($conn, $_POST['bloodType']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Validate fields
    if (empty($bloodType) || empty($message)) {
        echo "<script>alert('All fields are required!');</script>";
    } else {
        // Insert data into the database using a prepared statement
        $stmt = $conn->prepare("INSERT INTO blood_requests (user_id, requested_blood_group, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user['user_id'], $bloodType, $message);

        if ($stmt->execute()) {
            echo "<script>alert('Your blood donation request has been posted successfully.');</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }
}

// Fetch all blood requests from the database
$query = "SELECT blood_requests.*, users.fullname FROM blood_requests 
          JOIN users ON blood_requests.user_id = users.user_id 
          ORDER BY blood_requests.created_at DESC";

$bloodRequests = $conn->query($query);
?>
<?php
include 'indexONE.php';
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-4 mt-3">
        <div class="my-4 text-dark">
                <h2>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!
            </h2>
            </div>
            <!-- Display Blood Requests (Posts) -->
            <div class="posts mt-4">
                <?php if ($bloodRequests->num_rows > 0): ?>
                    <?php while ($request = $bloodRequests->fetch_assoc()): ?>
                        <div class="mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($request['requested_blood_group']); ?> Blood Needed</h5>
                                    <p class="card-text"><?php echo htmlspecialchars($request['message']); ?></p>
                                    <p class="text-muted">Posted by: <?php echo htmlspecialchars($request['fullname']); ?></p>
                                    <p class="text-muted">Posted on: <?php echo date('F d, Y', strtotime($request['created_at'])); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-muted">No blood donation requests available yet.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
                
            
                </div>
            </main> 