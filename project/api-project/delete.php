<?php
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $id = $_GET['id'];
    $sql = "DELETE FROM `employe_data` WHERE user_id= $id";
    $result = mysqli_query($conn,$sql);
    if($result){
        header("Location: table_data.php");
    }
    ?>
    
</body>
</html>