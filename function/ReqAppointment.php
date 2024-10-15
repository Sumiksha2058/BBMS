<?php 
    // Getting  donor data
    $fullname = "";
    $email = "";
    $phone= "";
    $bloodtype= "";
    $date= "";
    $time= "";

    $errors = array();

    //    database connection
    include 'includes/config.php';

        // for donors
        if (isset($_POST['submitappo'])){ 

        // Escape the data to prevent SQL injection
        $fullname = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $bloodtype = mysqli_real_escape_string($conn, $_POST['bloodGroup']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $time = mysqli_real_escape_string($conn, $_POST['time']);


        // Create the SQL query
        if(count($errors) == 0){ 
            $password = md5($password);        
        $sql = "INSERT INTO vc_appointment(appo_name, appo_email, appo_phone, appo_bloodtype, appo_date, appo_time)
                VALUES ('$fullname', '$email', '$phone', '$bloodtype', '$date', '$time')";
        mysqli_query($conn, $sql);  
        
        header("location: appointment.php?success=Sucessfully Booked Appointment");
            exit();
}
        
}


?>
