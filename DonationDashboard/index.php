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

$query = "
   SELECT r.request_id, r.requested_blood_group, r.message, r.created_at, u.fullname 
   FROM blood_requests AS r
   JOIN users AS u ON r.user_id = u.user_id
";

$bloodRequests = $conn->query($query);
$allRequests = [];

// Check for blood requests
if ($bloodRequests->num_rows > 0) {
    $allRequests = [];  // Initialize an array to store the requests

    // Fetch all requests
    while ($request = $bloodRequests->fetch_assoc()) {
        $allRequests[] = [
            'name' => $request['fullname'],
            'requested_blood_group' => $request['requested_blood_group'],
            'message' => $request['message'],
            'created_at' => $request['created_at'],
        ];
    }

    // Sort by created_at in descending order (newest first)
    usort($allRequests, function($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });
}


?>
<?php
include 'indexONE.php';
?>
<style>
     .avatar-circle {
        width: 45px;
        height: 45px;
        background-color: #007bff; /* Change this color as desired */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
     }
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-4 mt-3">
    <div class="row">
        <div class="col md-6">
            <div class="my-4 text-dark">
                 <h2>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h2>
            </div>
</div>
    <div class="col md-6">
    <div class="my-4 text-dark">
                <nav class="navbar">
                <div class="container-fluid">
                    <form class="d-flex">
                        <input class="form-control me-2 bg-light" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                </div>
                </nav>
    </div>
    </div>

</div>
            <!-- Display Blood Requests (Posts) -->
            <div class="posts mt-4 w-80">
        <?php if (count($allRequests) > 0): ?>
            <?php foreach ($allRequests as $request): ?>
                <div class="mb-4">
                    <div class="card" style="background-color: #d6b2b2;">
                        <div class="card-body" id="searchPost">

                            <div  class="d-flex align-items-center">
                            <h4 class="card-title text-teal d-flex align-items-center">
                                <span class="avatar-circle text-white me-2">
                                        <?php echo strtoupper(substr($request['name'], 0, 1)); ?>    
                                </span>
                            </h4>
                           
                                    <div class="flex-grow-1">
                                    <h5 class="mb-1 fw-bold text-primary"> <?php echo htmlspecialchars($request['name']); ?></h5>
                                    <p class="text-dark"><?php echo date('F d, Y', strtotime($request['created_at'])); ?></p>   
                                </div>
                            </div>
                            <h5 class="card-title text-dark"><?php echo htmlspecialchars($request['requested_blood_group']); ?> Blood Needed</h5>
                            <p class="card-text text-dark"><?php echo htmlspecialchars($request['message']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted text-dark">No blood donation requests available from nearby donors yet.</p>
        <?php endif; ?>
    </div>
        </main>
    </div>
                
            
                </div>
            </main> 