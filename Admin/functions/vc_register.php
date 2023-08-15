<?php 
    // Getting  donor data
    $fullname = "";
    $address = "";
    $email = "";
    $password = "";

    $errors = array();

    //    database connection
    include 'includes/config.php';

        // for donors
        if (isset($_POST['vcRegister'])){ 

        // Escape the data to prevent SQL injection
        $fullname = mysqli_real_escape_string($conn, $_POST['vcfullname']);
        
       
        $address = mysqli_real_escape_string($conn, $_POST['vcaddress']);
        $email = mysqli_real_escape_string($conn, $_POST['vcemail']);
        $password = mysqli_real_escape_string($conn, $_POST['vcpassword']);
        $con_password = mysqli_real_escape_string($conn, $_POST['vc_conpassword']);

        $uppercase = preg_match('@[A-Z]@',$password);
        $lowercase = preg_match('@[a-z]@',$password);
        $number = preg_match('@[0-9]@',$password);
        $specialChar = preg_match('@[^\w]@',$password); 
        
       
        

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
        $sql = "INSERT INTO vc_admin (a_fullname, a_address, a_email, a_password)
                VALUES ('$fullname', '$address', '$email', '$password')";
        mysqli_query($conn, $sql);  
        
        header("location: register.php?success=Sucessfully created donor account");
            exit();
}
        
}


?>
