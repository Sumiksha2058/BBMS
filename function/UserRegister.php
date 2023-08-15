<?php
   
    // Getting  donor data
    $fullname = "";
    $gender = "";
    $age = "";
    $email = "";
    $contact = "";
    $donorBlood = "";


    $errors = array();


    //    database connection
        include "includes/config.php";


        // for donors
        if (isset($_POST['register'])){ 

        // Escape the data to prevent SQL injection
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $donorBlood = mysqli_real_escape_string($conn, $_POST['donorBlood']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $con_password = mysqli_real_escape_string($conn, $_POST['con_password']);

        $uppercase = preg_match('@[A-Z]@',$password);
        $lowercase = preg_match('@[a-z]@',$password);
        $number = preg_match('@[0-9]@',$password);
        $specialChar = preg_match('@[^\w]@',$password); 
        
        $contactNo =preg_match('/^[0-9]{10}+$/',$contact);
      
         // Check if phone number is correct
         if (!$contactNo) {
            array_push($errors, "Invalid contact number");
        }

          // Check if password validates 
          if  (!$uppercase || !$lowercase || !$number || !$specialChar) {
            header("location: register.php?error=Password should be: at least 8 character, one uppercase, one number and one special character");
            exit();
        }
        // Check if passwords match
        if ($password != $con_password) {
            array_push($errors, "The passwords do not match");
        }

        // Create the SQL query
        if(count($errors) == 0){ 
            $password = md5($password);        
        $sql = "INSERT INTO donor (fullname, gender, age, email, contact, donorBlood, password)
                VALUES ('$fullname', '$gender', '$age', '$email', '$contact', '$donorBlood', '$password')";
        mysqli_query($conn, $sql);  
        
        header("location: register.php?success=Sucessfully created donor account");
            exit();
}
        
}
// Get the recipient form data
$recp_fullname = "";
$recp_gender = "";
$recp_age = "";
$recp_email = "";
$recp_contact = "";
$recp_recp_reqblood = "";
$recp_medicalReport = "";

  // for recipients
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
        array_push($errors, "Invalid contact number");
    }

      // Check if password validates 
      if  (!$uppercase || !$lowercase || !$number || !$specialChar) {
        header("location: register.php?error=Passporshould be: at least 8 characer, one uppercase, one number, one special character");
        exit();
    }
    // Check if passwords match
    if ($recp_password != $recp_cpassword) {
        array_push($errors, "Passwords do not match");
    }

    // Create the SQL query
    if(count($errors) == 0){ 
        $recp_password = md5($recp_password);        
    $sql = "INSERT INTO recipient (recp_fullname, recp_gender, recp_age, recp_email, recp_contact, recp_recp_reqblood, recp_medicalReport, recp_password)
            VALUES ('$recp_fullname', '$recp_gender', '$recp_age', '$recp_email', '$recp_contact', '$recp_recp_reqblood', '$recp_medicalReport', '$recp_password')";
    mysqli_query($conn, $sql);
    header("location: register.php?success=Sucessfully created Recipient Account");
            exit();
}   
}

// for donors
?>
