<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="VitaCare.ico" type="image/x-icon">
     <link rel="stylesheet" href="fontawesome/css/all.min.css">

   

</head>
<body>
  <?php
    include 'includes/head.php'
   ?>
    
    <!-- main container starts from here -->
<main class="pt-2 m-6">
<div class="container-fluid ">      
  <div class="row row-md-2 mt-5 mx-5">
    <div class="col">
        <h1 class=" fs-auto text-light">Every Contribution Counts:<br/>  Join us in Making a Difference!</h1>
        <p class=" fs-auto text-light"> Your contribution of a single blood donation can save multiple lives. Whether it's whole blood, platelets, or plasma, every donation holds the power to bring hope and healing to those facing medical challenges. Each time you donate, you are directly impacting the lives of individuals in need.</p>
        <a href="login.php"><button type="button"  class="btn btn-outline-light">Donate Now</button></a>
    </div> 
</div>
<div class="row row-md mt-5 " id="row">
    <div class="col-md text-center ">     
        <div class="shadow-sm  mb-3 rounded w-50 text-center"> <h1 class="text-light ">Join With US</h1></div>
    </div>
</div>

<!-- image gallary -->
<div class="row row-md-6 mt-2 text-center mx-5 d-flex justify-content-center" id="dgallary">
    <div class="col-md mb-3 width-auto">
        <img class="img-fluid pb-1 px-4 xl-3" src="images/b1.png" alt="">
        <img class="img-fluid pb-1 px-4 xl-3" src="images/b4.png" alt="">   
    </div>
    <div class="col-md mb-3">
        <img class="img-fluid pb-1 px-4 xl-3" src="images/b2.png" alt="">
        <img  class="img-fluid pb-1 px-4 xl-3" src="images/b5.png" alt="">      
    </div>
    <div class="col-md mb-3">
        <img class="img-fluid pb-1 px-4 xl-3" src="images/b3.png" alt="">
        <img  class="img-fluid pb-1 px-4 xl-3" src="images/b6.png" alt="">
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 mt-5 mx-5">
    
    <div class="col-md w-100 text-light">
        <h3 >Criteria to donate blood</h3>
       <ul>
        <li>You are aged between 18 and 65.</li>
        <li>weight at least 50 kg.</li>
        <li>You must be in good health at the time you donate.</li>
        <li>Cannot donate if you have a cold, flu, sore throat, cold sore, stomach bug or any other infection.</li>
        <li>You are aged between 18 and 65.</li>
        <li>You must be in good health at the time you donate.</li>
        <li>Cannot donate if you have a cold, flu, sore throat, cold sore, stomach bug or any other infection.</li>
        <li>If you have recently had a tattoo or body piercing you cannot donate for 6 months from the date of the procedure.</li>
        <li>If the body piercing was performed by a registered health professional and any inflammation has settled completely, you can donate blood after 12 hours.</li>
        <li>If you have visited the dentist for a minor procedure you must wait 24 hours before donating; for major work wait a month.</li>
        <li>You must not donate blood if you do not meet the minimum haemoglobin level for blood donation.</li>
       <p>* A test will be administered at the donation site. In many countries, a haemoglobin level of not less than 12.0 g/dl for females and not less than 13.0 g/dl for males as the threshold.</p>
        <li> You are aged between 18 and 65.</li>
        <li>Travel to areas where mosquito-borne infections are endemic, e.g. malaria, dengue and Zika virus infections, may result in a temporary deferral .
        Many countries also implemented the policy to defer blood donors with a history of travel or residence for defined cumulative exposure periods in specified countries or areas, as a measure to reduce the risk of transmitting variant Creutzfeldt-Jakob Disease (vCJD) by blood transfusion.</li>
                <li>You must not give blood:
        If you were engaged in “at risk” sexual activity in the past 12 months
        Individuals with behaviours below will be deferred permanently: 
        Have ever had a positive test for HIV (AIDS virus)
        Have ever injected recreational drugs.</li>

        <p>* In the national blood donor selection guidelines, there are more behavior eligibility criteria. Criteria could be different in different countries.</p>
        <li>Pregnancy and breastfeeding:
        Following pregnancy, the deferral period should last as many months as the duration of the pregnancy.
        It is not advisable to donate blood while breast-feeding. Following childbirth, the deferral period is at least 9 months (as for pregnancy) and until 3 months after your baby is significantly weaned (i.e. getting most of his/her nutrition from solids or bottle feeding).</li>
            </ul>



    </div>
    
</div>
</main>

<!-- footer starts here -->
<?php
    include 'includes/footer.php'
   ?>


<script src="fontawesome/js/all.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>