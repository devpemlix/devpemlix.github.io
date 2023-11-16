<?php
require("db_connection.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  
    <div class="container">
        <div class="header">
            <h1>CATERING INSURANCE</h1>
        </div>
        <div class="form-container">
            <form class="form" action = "#" method = "POST" >
                <select id="insurance" name="insurance_name">
                    <option value="Type of Insurance">Type of Insurance (Select)</option>
                    <option value="Catering Van Insurance">Catering Van Insurance</option>
                    <option value="Catering Trailer Insurance">Catering Trailer Insurance</option>
                    <option value="Ice Cream Van Insurance">Ice Cream Van Insurance</option>
                    <option value="Catering Liability Insurance">Catering Liability Insurance</option>
                    <option value="Restaurant Insurance">Restaurant Insurance</option>
                    <option value="Takeaway Insurance">Takeaway Insurance</option>
                    <option value="Pizza Shop Insurance">Pizza Shop Insurance</option>
                    <option value="Fish & Chip Shop Insurance">Fish & Chip Shop Insurance</option>
                    <option value="Other Catering Insurance">Other Catering Insurance</option>
                </select>
                <input type="text" name="name" id="" placeholder="Name" required>
                <input type="number" name="postcode" id="" placeholder="Postcode" required>
                <input type="number" name="telephone" id="" placeholder="Telephone">
                <input type="email" name="email" id="" placeholder="Email">
                <input type="number" name="bonus" id="" placeholder="Years No Claim Bonus ">
                <input class="submit-btn" type="submit" name="submit" value="GET QUOTE NOW">
            </form>
        </div>

    </div>
 
    <?php
   
    if(isset($_POST["submit"])){
        
        $insurance  = $_POST["insurance_name"];
        $name       = $_POST["name"];
        $postcode   = $_POST["postcode"];
        $telephone  = $_POST["telephone"];
        $email      = $_POST["email"];
        $bonus      = $_POST["bonus"];

        $sql = "INSERT INTO login_table VALUES ('$insurance','$name','$postcode','$telephone','$email','$bonus')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<meta http-equiv='refresh' content='0'>";

        }
        else{

            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    


    }

    
    ?>
    
   
    
    
    <script src="siku.js"></script>
</body>
</html>