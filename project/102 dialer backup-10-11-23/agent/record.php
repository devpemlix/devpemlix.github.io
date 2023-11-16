<?php
$con  = mysqli_connect("localhost","root","","graph");
 if (!$con) {
     # code...
    echo "Problem in database connection! Contact administrator!" . mysqli_error();
 }else{
         $sql ="SELECT * FROM conferences";
         $result = mysqli_query($con,$sql);
         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $productname[]  = $row['server_ip']  ;
            $sales[] = $row['conf_exten'];
        }
 
 }
?>