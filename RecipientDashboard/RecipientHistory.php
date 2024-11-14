<?php
include 'includes/config.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("location: ../VitaCare/login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user information
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email); // 's' means string type for the parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No user found.");
}

$user = $result->fetch_assoc();
$user_id = $user['user_id']; // Get user ID for fetching appointments
$stmt->close();

// Fetch accepted notifications from the active donor table
$stmt = $conn->prepare("SELECT ad.*, u.* FROM active_donor_table AS ad JOIN vitacare_db.users AS u ON ad.user_id = u.user_id WHERE u.user_type = 'recipient' && ad.request_status = 'accept'");

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

if (!$stmt->execute()) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

$result = $stmt->get_result();

// Fetch total notifications from the active donor table
$stmt = $conn->prepare("SELECT ad.*, u.* FROM active_donor_table AS ad JOIN vitacare_db.users AS u ON ad.user_id = u.user_id WHERE u.user_type = 'recipient'");
$stmt->execute();
$totalResult = $stmt->get_result();

include 'functions/serachDonor.php';
?>

<?php include 'index.php'; ?>

<main id="main_container" class="container my-4">
    <div class="page-container">
        <div class="appointment-container my-2">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mb-4 text-dark">Accepted Notification</h4>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="functions/serachDonor.php" class="d-flex" onsubmit="searchDonor(event)">
                        <input class="form-control me-2 bg-light" type="search" id="searchInput" placeholder="Search Donor" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>

            <div id="donorResults"></div>

            <hr class="divider text-dark">

            <table class="table table-striped table-hover">
                <thead>
                    <tr class="text-dark" style="background-color: #D6B2B2;">
                        <th>Recipient Name</th>
                        <th>Date</th>
                        <th>Blood Group</th>
                    </tr>
                </thead>
                <tbody id="acceptedNotifications">
                    <?php
                    if ($result->num_rows > 0) {
                        $donors = [];
                        while ($notification = $result->fetch_assoc()) {
                            $donors[] = $notification;
                        }

                        // Sort donors array by donor name (ascending order)
                        usort($donors, function($a, $b) {
                            return strcmp(strtolower($a['donor_name']), strtolower($b['donor_name']));
                        });

                        // Display sorted notifications
                        foreach ($donors as $notification) {
                            echo "<tr class='text-dark'>
                                    <td class='text-dark'>" . htmlspecialchars($notification['donor_name']) . "</td>
                                    <td class='text-dark'>" . htmlspecialchars($notification['needed_time']) . "</td>
                                    <td class='text-dark'>" . htmlspecialchars($notification['blood_group']) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr class='text-dark'><td colspan='3'>No notifications available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <h4 class="mb-4 text-dark">Total Notification</h4>
            <hr class="divider text-dark">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="text-dark" style="background-color: #D6B2B2;">
                        <th>Recipient Name</th>
                        <th>Date</th>
                        <th>Blood Group</th>
                    </tr>
                </thead>
                <tbody id="totalNotifications">
                    <?php
                    if ($totalResult->num_rows > 0) {
                        $totalDonors = [];
                        while ($notification = $totalResult->fetch_assoc()) {
                            $totalDonors[] = $notification;
                        }

                        // Sort donors array by donor name (ascending order)
                        usort($totalDonors, function($a, $b) {
                            return strcmp(strtolower($a['donor_name']), strtolower($b['donor_name']));
                        });

                        // Display sorted notifications
                        foreach ($totalDonors as $notification) {
                            echo "<tr class='text-dark'>
                                    <td class='text-dark'>" . htmlspecialchars($notification['donor_name']) . "</td>
                                    <td class='text-dark'>" . htmlspecialchars($notification['needed_time']) . "</td>
                                    <td class='text-dark'>" . htmlspecialchars($notification['blood_group']) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr class='text-dark'><td colspan='3'>No notifications available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
// JavaScript to handle donor search with binary search
function searchDonor(event) {
    event.preventDefault();
    
    // Get the search input
    let searchInput = document.getElementById("searchInput").value.toLowerCase();
    
    // Fetch all notification tables (for simplicity, search will be done on both tables)
    let acceptedTable = document.getElementById("acceptedNotifications");
    let totalTable = document.getElementById("totalNotifications");

    // Get all rows in the accepted notifications table
    let acceptedRows = Array.from(acceptedTable.getElementsByTagName("tr"));
    let totalRows = Array.from(totalTable.getElementsByTagName("tr"));

    // Function to perform binary search
    function binarySearch(rows, target) {
        let left = 0;
        let right = rows.length - 1;
        while (left <= right) {
            let mid = Math.floor((left + right) / 2);
            let rowName = rows[mid].cells[0].textContent.toLowerCase();
            if (rowName === target) {
                return mid;
            } else if (rowName < target) {
                left = mid + 1;
            } else {
                right = mid - 1;
            }
        }
        return -1; // Not found
    }

    // Perform binary search on accepted rows and total rows
    function filterRows(rows) {
        const index = binarySearch(rows, searchInput);
        if (index !== -1) {
            rows[index].style.display = ""; // Show the row if found
        } else {
            rows.forEach(row => row.style.display = "none"); // Hide all if no match
        }
    }

    // Filter rows in both tables
    filterRows(acceptedRows);
    filterRows(totalRows);
}
</script>

<?php
$stmt->close();
$conn->close();
?>
