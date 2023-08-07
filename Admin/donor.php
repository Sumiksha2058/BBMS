<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaCare</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="includes/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
</head>
<body>

<?php 
        include ('includes\head.php');
    ?>

<?php 
        include ('includes/a_dashboard.php');
    ?>

<main id="main_container">

<div class="main-area p-4">
    <div class="inner-wrapper p-4">
    
        
        <div class="container overflow-hidden">
        <div class="title text-dark">
        <h1 class="fs-4">List of Donor's</h1>
        <div class="add_donor float-end pb-3">
        <button type="button" class="btn btn-success "style="background-color:#000077;"><i class="fa fa-circle-add"></i>Add Donors</button>
      
        </div>
      </div>

      <table class="table table-hover-Info">
  <thead>
    <tr class="text-light " style="background-color: #000077; ">
      <th scope="col">User ID</th>
      <th scope="col">Full name</th>
      <th scope="col">Age</th>
      <th scope="col">Contact</th>
      <th scope="col">Email</th>
      <th scope="col">Reciving Da</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>9876457598</td>
      <td>ramkumari345@gmail.com</td>
      <td>@mdo</td>
      <td >
      <button type="button" class="btn btn-danger">Delete</button>
      <button type="button" class="btn btn-success">Edit</button>
      </td>
     
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>
      <button type="button" class="btn btn-danger">Delete</button>
      <button type="button" class="btn btn-success">Edit</button>
      </td>
      
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
      <td>@twitter</td>
      <td>@twitter</td>
      <td>
      <button type="button" class="btn btn-danger">Delete</button>
      <button type="button" class="btn btn-success">Edit</button>
      </td>
    </tr>

    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
      <td>@twitter</td>
      <td>@twitter</td>
      <td>
      <button type="button" class="btn btn-danger">Delete</button>
      <button type="button" class="btn btn-success">Edit</button>
      </td>
      
    </tr>

    
  </tbody>
</table>
        </div>
    </div> 
</div>

</main>



<script src="fontawesome/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</body>
</html>