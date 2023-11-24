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
        <div class="col-md-12 my-5 py-2 bg-dark text-light text-center">EMPLOYE DATA UPDATE  </div>

        <form class="row g-3 needs-validation" novalidate action="" method="POST">
        <div class="col-md-4 position-relative">
            <label for="validationTooltip01" class="form-label">First name</label>
            <input type="text" class="form-control" id="validationTooltip01" value="<?php echo $_GET['fname'] ?>" name="fname" required>
            <div class="valid-tooltip">
            Looks good!
            </div>
        </div>
        <div class="col-md-4 position-relative">
            <label for="validationTooltip02" class="form-label">Last name</label>
            <input type="text" class="form-control" id="validationTooltip02" value="<?php echo $_GET['lname'] ?>" name="lname" required>
            <div class="valid-tooltip">
            Looks good!
            </div>
        </div>
        <div class="col-md-4 position-relative">
            <label for="validationTooltipUsername" class="form-label">Username</label>
            <div class="input-group has-validation">
            <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
            <input type="text" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" value="<?php echo $_GET['username'] ?>"  name="username" required>
            <div class="invalid-tooltip">
                Please choose a unique and valid username.
            </div>
            </div>
        </div>
        <div class="col-md-6 position-relative">
            <label for="validationTooltip03" class="form-label">City</label>
            <input type="text" class="form-control" id="validationTooltip03" name="city" value="<?php echo $_GET['city'] ?>" required>
            <div class="invalid-tooltip">
            Please provide a valid city.
            </div>
        </div>
        
        <div class="col-md-6 position-relative">
            <label for="validationTooltip05" class="form-label">Zip</label>
            <input type="text" class="form-control" id="validationTooltip05" name="zipcode" value="<?php echo $_GET['zipcode'] ?>" required>
            <div class="invalid-tooltip">
            Please provide a valid zip.
            </div>
        </div>
        <div class="col-12"> 
            <button class="btn btn-primary" type="submit" name="submit">Update</button>
        </div>
        </form>
  
    </div>

    <?php

    $id = $_GET["id"];
    

    if(isset($_POST['submit'])){

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $city = $_POST['city'];
        $zipcode = $_POST['zipcode'];


        $sql = "UPDATE `employe_data` SET `fname`='$fname',`lname`='$lname',`user_name`='$username',`city`='$city',`zipcode`='$zipcode' WHERE user_id=$id ";
        $result = mysqli_query($conn,$sql);
        if($result){
           header("location:table_data.php");
        }



        
    }
    
    ?>
</body>
</html>