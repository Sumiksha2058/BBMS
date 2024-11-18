<?php
// Initialize variables to avoid undefined variable warnings
$userTypeValue = isset($_POST['userType']) ? $_POST['userType'] : '';
$fullName = '';
$age = '';
$gender = '';
$bloodGroup = '';
$email = '';
$contact = '';
$address = '';
$password = '';
$confirmPassword = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userTypeValue = $_POST['userType'] ?? '';
    $fullName = $_POST['fullName'] ?? '';
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $bloodGroup = $_POST['bloodGroup'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $address = $_POST['address'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Basic validation
    if (empty($fullName) || empty($age) || empty($gender) || empty($bloodGroup) || empty($email) ||
        empty($contact) || empty($address) || empty($password) || empty($confirmPassword)) {
        echo "<p style='color: red;'>All fields are required.</p>";
    } elseif ($password !== $confirmPassword) {
        echo "<p style='color: red;'>Passwords do not match.</p>";
    } else {
        // Save to the database (example, modify as needed)
        echo "<p style='color: green;'>Registration successful!</p>";
        // Here, you would include code to save the data to your database
    }
}
?>
<?php
include 'function\UserRegister.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="VitaCare.ico" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>
<body>

<?php include 'includes/head.php'; ?>

<div class="container shadow-lg bg-none w-80 my-3 rounded" id="image">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 d-flex justify-content-center">
            <img src="images/signupbg.jpg" class="img-fluid rounded" alt="Signup Background">
        </div>

        <!-- Form Section -->
        <div class="col-md-6 p-4">
            <h4 class="text-left mt-3 fs-auto">Register to save lives!!!</h4>
            <hr>

            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="alert alert-success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <form method="post" action="register.php" id="registrationForm" class="needs-validation" novalidate>
    <!-- User Type -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="userType" class="form-label">User Type:</label>
            <select name="userType" class="form-select" required>
                <option value="donor" <?php echo ($userTypeValue === 'donor') ? 'selected' : ''; ?>>Donor</option>
                <option value="recipient" <?php echo ($userTypeValue === 'recipient') ? 'selected' : ''; ?>>Recipient</option>
            </select>
        </div>

        <!-- Full Name -->
        <div class="col-md-4">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" name="fullname" class="form-control" id="fullName" value="<?php echo $fullnameValue; ?>" placeholder="Enter your full name" required>
        </div>

        <!-- Age -->
        <div class="col-md-4">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" name="age" id="age" value="<?php echo $ageValue; ?>" placeholder="Enter your age" required>
        </div>
    </div>

    <!-- Gender -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Gender</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="Male" name="gender" id="genderMale" <?php echo ($genderValue === 'Male') ? 'checked' : ''; ?> required>
                <label class="form-check-label" for="genderMale">Male</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="Female" name="gender" id="genderFemale" <?php echo ($genderValue === 'Female') ? 'checked' : ''; ?> required>
                <label class="form-check-label" for="genderFemale">Female</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="Other" name="gender" id="genderOther" <?php echo ($genderValue === 'Other') ? 'checked' : ''; ?> required>
                <label class="form-check-label" for="genderOther">Other</label>
            </div>
        </div>

        <!-- Blood Group -->
        <div class="col-md-4">
            <label for="bloodGroup" class="form-label">Blood Group</label>
            <select class="form-select" name="donorBlood" id="bloodGroup" required>
                <option value="O+" <?php echo ($blood_group_value === 'O+') ? 'selected' : ''; ?>>O+</option>
                <option value="O-" <?php echo ($blood_group_value === 'O-') ? 'selected' : ''; ?>>O-</option>
                <option value="A+" <?php echo ($blood_group_value === 'A+') ? 'selected' : ''; ?>>A+</option>
                <option value="A-" <?php echo ($blood_group_value === 'A-') ? 'selected' : ''; ?>>A-</option>
                <option value="B+" <?php echo ($blood_group_value === 'B+') ? 'selected' : ''; ?>>B+</option>
                <option value="B-" <?php echo ($blood_group_value === 'B-') ? 'selected' : ''; ?>>B-</option>
                <option value="AB+" <?php echo ($blood_group_value === 'AB+') ? 'selected' : ''; ?>>AB+</option>
                <option value="AB-" <?php echo ($blood_group_value === 'AB-') ? 'selected' : ''; ?>>AB-</option>
            </select>
        </div>

        <!-- Email -->
        <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo $emailValue; ?>" placeholder="Enter your email" required>
        </div>
    </div>

    <!-- Contact and Address -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="contact" class="form-label">Contact</label>
            <input type="number" class="form-control" name="contact" id="contact" value="<?php echo $contactValue; ?>" placeholder="Enter your contact number" required>
        </div>

        <div class="col-md-6">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="address" value="<?php echo $addressValue; ?>" placeholder="Enter your address" required>
        </div>
    </div>

    <!-- Password Fields -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
        </div>
        <div class="col-md-6">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="con_password" id="confirmPassword" placeholder="Confirm your password" required>
        </div>
    </div>

    <!-- Submit and Reset Buttons -->
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" name="submitForm" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </div>
</form>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Include JS files -->
<script src="javascript/passport_hide_show.js"></script>
<script src="javascript/validation.js"></script>
<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
