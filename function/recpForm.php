

<?php
    $recp_fullname = "";
    $recp_gender = "";
    $recp_age = "";
    $recp_email = "";
    $recp_contact = "";
    $recp_recp_reqblood = "";
    $recp_medicalReport = "";

    $errors = array();

    include "includes/config.php";
        
if (isset($_POST['recp_register'])){ 

    // Escape the data to prevent SQL injection
    $recp_fullname = mysqli_real_escape_string($conn, $_POST['recp_fullname']);
    $recp_gender = mysqli_real_escape_string($conn, $_POST['recp_gender']);
    $recp_age = mysqli_real_escape_string($conn, $_POST['recp_age']);
    $recp_email = mysqli_real_escape_string($conn, $_POST['recp_email']);
    $recp_contact = mysqli_real_escape_string($conn, $_POST['recp_contact']);
    $recp_recp_reqblood = mysqli_real_escape_string($conn, $_POST['recp_recp_reqblood']);
    $recp_medicalReport = mysqli_real_escape_string($conn, $_POST['recp_medicalReport']);
    $recp_password = mysqli_real_escape_string($conn, $_POST['recp_password']);
    $recp_cpassword = mysqli_real_escape_string($conn, $_POST['recp_cpassword']);

    $uppercase = preg_match('@[A-Z]@',$recp_password);
    $lowercase = preg_match('@[a-z]@',$recp_password);
    $number = preg_match('@[0-9]@',$recp_password);
    $specialChar = preg_match('@[^\w]@',$recp_password); 
    
    $contactNo =preg_match('/^[0-9]{10}+$/',$recp_contact);
  
     // Check if phone number is correct
     if (!$contactNo) {
        array_push($errors1, "Invalid contact number");
    }

      // Check if password validates 
      if  (!$uppercase || !$lowercase || !$number || !$specialChar) {
        array_push($errors1, "Passporshould be: <br/> 
        <li>at least 8 characer</li>
        <li>at least one uppercase</li>
        <li>at least one number</li>
        <li>at least one special character</li>
        ");
    }
    // Check if passwords match
    if ($recp_password != $recp_cpassword) {
        array_push($errors, "The passwords do not match");
    }

    // Create the SQL query
    if(count($errors) == 0){ 
        $recp_password = md5($recp_password);        
    $sql1 = "INSERT INTO recipient (recp_fullname, recp_gender, recp_age, recp_email, recp_contact, recp_recp_reqblood, recp_medicalReport, recp_password)
            VALUES ('$recp_fullname', '$recp_gender', '$recp_age', '$recp_email', '$recp_contact', '$recp_recp_reqblood', '$recp_medicalReport', '$recp_password')";
    mysqli_query($conn, $sql1);

}
    
}

?> 