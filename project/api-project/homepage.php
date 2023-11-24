<?php
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body> 

<div class="container my-5">
    <div class="col-md-12 my-5 py-2 bg-dark text-light text-center">EMPLOYE DATA </div>

<form class="row g-3 needs-validation" novalidate action="" method="POST">
  <div class="col-md-4 position-relative">
    <label for="validationTooltip01" class="form-label">First name</label>
    <input type="text" class="form-control" id="validationTooltip01" value="" name="fname" required>
    <div class="valid-tooltip">
      Looks good!
    </div>
  </div>
  <div class="col-md-4 position-relative">
    <label for="validationTooltip02" class="form-label">Last name</label>
    <input type="text" class="form-control" id="validationTooltip02" value="" name="lname" required>
    <div class="valid-tooltip">
      Looks good!
    </div>
  </div>
  <div class="col-md-4 position-relative">
    <label for="validationTooltipUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
      <input type="text" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend"  name="username" required>
      <div class="invalid-tooltip">
        Please choose a unique and valid username.
      </div>
    </div>
  </div>
  <div class="col-md-6 position-relative">
    <label for="validationTooltip03" class="form-label">City</label>
    <input type="text" class="form-control" id="validationTooltip03" name="city" required>
    <div class="invalid-tooltip">
      Please provide a valid city.
    </div>
  </div>
  
  <div class="col-md-6 position-relative">
    <label for="validationTooltip05" class="form-label">Zip</label>
    <input type="text" class="form-control" id="validationTooltip05" name="zipcode" required>
    <div class="invalid-tooltip">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-12"> 
    <input class="btn btn-primary" type="submit" value="submit" name="submit"> 
  </div>
  </form>

</div>

<?php
if(isset($_POST['submit'])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user_name = $_POST['username'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];


    

    if(empty($fname) || empty($lname) || empty($user_name) || empty($city) || empty($zipcode)){
        echo "<script>alert('please fill all the fil')</script>";
    }
    else{
        $sql = "INSERT INTO `employe_data`(`fname`, `lname`, `user_name`, `city`, `zipcode`) VALUES ('$fname','$lname','$user_name','$city','$zipcode')";
        $result = mysqli_query($conn,$sql);
        if($result){
           echo "<script>alert('submit successfully')</script>";
        }

    }


}





?>

    
  
   
 
    
   
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>