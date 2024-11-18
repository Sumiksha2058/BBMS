<?php
// Include configuration file
include 'includes/config.php';

// Initialize variables to avoid undefined warnings
$fullnameValue = '';
$ageValue = '';
$genderValue = '';
$blood_group_value = '';
$emailValue = '';
$contactValue = '';
$addressValue = '';
$latitude = '';
$longitude = '';
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitForm'])) {
    // Sanitize and validate inputs
    $fullnameValue = mysqli_real_escape_string($conn, $_POST['fullname']);
    $ageValue = mysqli_real_escape_string($conn, $_POST['age']);
    $genderValue = mysqli_real_escape_string($conn, $_POST['gender']);
    $blood_group_value = mysqli_real_escape_string($conn, $_POST['donorBlood']);
    $emailValue = mysqli_real_escape_string($conn, $_POST['email']);
    $contactValue = mysqli_real_escape_string($conn, $_POST['contact']);
    $addressValue = mysqli_real_escape_string($conn, $_POST['address']);

    // Validate form fields
    if (empty($fullnameValue) || empty($ageValue) || empty($genderValue) || empty($blood_group_value) ||
        empty($emailValue) || empty($contactValue) || empty($addressValue) || empty($_POST['password']) || empty($_POST['con_password'])) {
        $errors[] = "All fields are required.";
    }

    // Validate password
    if ($_POST['password'] !== $_POST['con_password']) {
        $errors[] = "Passwords do not match.";
    }

    // Validate contact number
    if (!preg_match("/^(98|97)\d{8}$/", $contactValue)) {
        $errors[] = "Invalid contact number format. Please enter a valid Nepalese phone number.";
    }

    // Validate email uniqueness
    $query = "SELECT * FROM users WHERE email = '$emailValue'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $errors[] = "This email address is already registered.";
    }

// Use Nominatim API to geocode address
if (empty($errors)) {
    $address = urlencode($addressValue);
    $nominatimUrl = "https://nominatim.openstreetmap.org/search?q={$address}&format=json&limit=1";

    // Set the User-Agent header
    $opts = [
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: BloodBankApp/1.0 (your-email@example.com)\r\n"
        ]
    ];
    $context = stream_context_create($opts);

    // Fetch the response with the context
    $geoResponse = file_get_contents($nominatimUrl, false, $context);

    if ($geoResponse === false) {
        $errors[] = "Unable to fetch geolocation data. Please try again.";
    } else {
        $geoData = json_decode($geoResponse, true);

        if (!empty($geoData)) {
            $latitude = $geoData[0]['lat'];
            $longitude = $geoData[0]['lon'];
        } else {
            $errors[] = "Unable to geocode the address. Please check the address format.";
        }
    }
}


    // Insert data into the database
    if (empty($errors)) {
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $insertQuery = "INSERT INTO users (fullname, age, gender, blood_group, email, contact, address, latitude, longitude, password)
                        VALUES ('$fullnameValue', '$ageValue', '$genderValue', '$blood_group_value', '$emailValue', '$contactValue', '$addressValue', '$latitude', '$longitude', '$passwordHash')";

        if (mysqli_query($conn, $insertQuery)) {
            header("Location: register.php?success=Registration successful!");
            exit();
        } else {
            $errors[] = "Error registering the user. Please try again.";
        }
    }
}
?>
