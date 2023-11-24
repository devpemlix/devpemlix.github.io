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
    <form action="" method="post">
        <table class="table">

        
            <tr class="bg-dark text-white text-center">
                <td>USER ID</td>
                <td>FIRST NAME</td>
                <td>LAST NAME</td>
                <td>USER NAME</td>
                <td>CITY</td>
                <td>ZIP</td>
                <td>MODIFY</td>
                <td>REFRESH : 20</td>
            </tr>
            <?php
            $sql = "SELECT * FROM `employe_data`";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result))
            
            {
            ?>
             <tr class="text-center display-flex">
                <td><?php echo $row['user_id']?></td>
                <td><?php echo $row['fname']?></td>
                <td><?php echo $row['lname']?></td>
                <td><?php echo $row['user_name']?></td>
                <td><?php echo $row['city']?></td>
                <td><?php echo $row['zipcode']?></td>
                <td>
                    <button class="btn btn-primary" type="submit"><a href="update.php?id=<?php echo $row['user_id']?>&fname=<?php echo $row['fname']?>&lname=<?php echo $row['lname']?>&username=<?php echo $row['user_name']?>&city=<?php echo $row['city']?>&zipcode=<?php echo $row['zipcode']?>"  class="text-light">Update</a></button>
                    <button  class="btn btn-danger" type="submit" ><a href="delete.php?id=<?php echo $row['user_id']?>" class="text-light">Delete</a></button>
                </td>


             </tr>



            <?php
            }
            ?>



          
            
            
        
        </table>

    </form>
    
    </div>
    <script>
        let countdown = 20;

        
      /*  let page_refresh = setInterval(() => {
            if (countdown>0){
                countdown--;
            }
            else if (countdown == 0){
                location.reload(true);
            }
            else{
                clearInterval(page_refresh);
            }
            document.body.innerHTML  = countdown;
             
        },5000);*/


        
        
    
    </script>

    
</body>
</html>