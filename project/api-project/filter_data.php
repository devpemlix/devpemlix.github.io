
<?php
include("db.php");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        *{
            padding:0px;
            margin:0px;
            box-sizing:border-box;
        }
        body{
            height:100vh;
            width:100%;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .container{
            height:500px;
            width:600px;
            padding:30px;
            background-color:#E4F2E7;
            border:1px solid gray;
            
           

        }
        .data-table{
            width:60%;   
        }
        .data-table tr{
            height:35px;
            font-size:25px;
        }

        i{
            font-size:25px;
            margin-right:10px;
            color:#45214A;
        }
    </style>
</head>
<body>
   
    <div class="container">
        
        <table class="data-table">
            
            <?php
            $sql = "SELECT * FROM `employe_data`
            ORDER BY user_id DESC
            LIMIT 1;";
            $result = mysqli_query($conn,$sql);
            $rowcount = mysqli_num_rows($result);
            while($row = mysqli_fetch_assoc($result))
            {
                $fname     = $row['fname'];
                $lname     = $row['lname'];
                $user_name = $row['user_name'];
                $city      = $row['city'];
                $zipcode   = $row['zipcode'];

            ?>
            <tr>
                <td><i class="fa-solid fa-user"></i></td>
                <td>First Name :</td>
                <td><?php echo $fname ?></td>   
            </tr>
            <tr>
                <td><i class="fa-solid fa-user"></i></td>
                <td>Last Name :</td>
                <td><?php echo $lname ?></td>   
            </tr>
            <tr>
                <td><i class="fa-solid fa-user"></i></td>
                <td>User Name :</td>
                <td><?php echo $user_name ?></td>   
            </tr>
            <tr>
                <td><i class="fa-solid fa-user"></i></td>
                <td>City :</td>
                <td><?php echo $city ?></td>   
            </tr>
            <tr>
                <td><i class="fa-solid fa-user"></i></td>
                <td>Zipcode :</td>
                <td><?php echo $zipcode ?></td>   
            </tr>
            <?php
            }
            ?>

        </table>

    </div>
    <script>
   

        setInterval(() => {
            location.reload(true);
            
        }, 10000);
        
        
        
    </script>
    
</body>
</html>
