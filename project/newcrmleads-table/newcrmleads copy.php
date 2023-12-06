<?php
require("dbconnect_mysqli.php");
require("functions.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!---------------------------CSS START----------------------->
    <style>
        *{
            margin:0px;
            padding:0px;
            box-sizing: border-box;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        .header{
            height:12vh;
            padding:0 35px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            color:white;
            background-color:#38D0F2;
        }
        .header-text-box{
            height:100%;
            display:flex;
            align-items:center;
            justify-content:flex-start;

        }
        
       /* .countdown{
            position:absolute;
            right:20px;
            width:120px;
            height:55px;
            display:flex;
            align-items:center;
            justify-content:center;
        }*/
        .search-refresh-box{
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .refresh-btn,
        .search-btn{
            margin:0px 8px;
            padding:7px 13px;
            border:none;
            border-radius:5px;
        }
        .refresh-btn:hover{
            color:white;
            background-color:#042940;
        }
        .search-btn:hover{
            color:white;
            background-color:#042940;

        }
        .search-refresh-box input[type="search"],
        .search-refresh-box select{
            font-size:14px;
            width:250px;
            padding:8px 10px;
            margin:0px  5px 0px 5px;
            border-radius:5px;
            border:none;
        }
        
        .show-btn{
            border:none;
            border-radius:5px;
            padding:5px 5px;
            color:white;
            background-color:#F06060;
        }
        .hide-btn{
            border:none;
            border-radius:5px;
            margin:0 10px;
            padding:5px 5px;
            color:white;
            background-color:#F2AE30;
        }
        .show-btn:hover{
            background-color:#13678A;
        }
        .hide-btn:hover{
            background-color:#13678A;
        }

        table {
            width:100%;
            border-collapse: collapse; 
            font-family: sans-serif; 
        }

       /* table, th, td {
            border: 1px solid black;
        }*/
        table tr th{
            font-size:16px;
        }
        th, td {
        
            padding: 2px 5px;
            text-align: left;
        }
      
       
        .custom-data-table thead tr{
            background-color:#042940;
        }
        .custom-data-table thead tr th{
            padding:12px 8px;
            font-size:12px;
            color:white;
            border-left: 1px solid white;

        }
        .custom-data-table tbody tr{
            background-color:#F2F2F2;
            border-bottom:1px solid gray;
        }
        .custom-data-table tbody tr td{
            padding:5px 8px;
            font-size:12px;
        }
        .sub-table td{
            background-color:#DEEFE7;
        }
        .sub-table tr:last-child{
            border-bottom:none;


        }

        

        
        

    </style>
    <!---------------------------CSS END----------------------->
</head>
<body>
    <?php
    $PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
    $PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
    $PHP_SELF=$_SERVER['PHP_SELF'];


    $stmt = "SELECT use_non_latin,admin_web_directory,custom_fields_enabled,webroot_writable,enable_languages,language_method FROM system_settings;";
    $rslt=mysql_to_mysqli($stmt, $link);
    if ($DB) {echo "$stmt\n";}
    $qm_conf_ct = mysqli_num_rows($rslt);
    if ($qm_conf_ct > 0)
        {
        $row=mysqli_fetch_row($rslt);
        $non_latin =				$row[0];
        $admin_web_directory =		$row[1];
        $custom_fields_enabled =	$row[2];
        $webroot_writable =			$row[3];
        $SSenable_languages =		$row[4];
        $SSlanguage_method =		$row[5];
        }
    ##### END SETTINGS LOOKUP #####
    ###########################################

    if ($non_latin < 1)
        {
        $PHP_AUTH_USER = preg_replace('/[^-_0-9a-zA-Z]/', '', $PHP_AUTH_USER);
        $PHP_AUTH_PW = preg_replace('/[^-_0-9a-zA-Z]/', '', $PHP_AUTH_PW);
        }
    else
        {
        $PHP_AUTH_PW = preg_replace("/'|\"|\\\\|;/","",$PHP_AUTH_PW);
        $PHP_AUTH_USER = preg_replace("/'|\"|\\\\|;/","",$PHP_AUTH_USER);
        }
    $list_id_override = preg_replace('/[^0-9]/','',$list_id_override);

    $STARTtime = date("U");
    $TODAY = date("Y-m-d");
    $NOW_TIME = date("Y-m-d H:i:s");
    $FILE_datetime = $STARTtime;
    $date = date("r");
    $ip = getenv("REMOTE_ADDR");
    $browser = getenv("HTTP_USER_AGENT");

    $stmt="SELECT selected_language from vicidial_users where user='$PHP_AUTH_USER';";
    if ($DB) {echo "|$stmt|\n";}
    $rslt=mysql_to_mysqli($stmt, $link);
    $sl_ct = mysqli_num_rows($rslt);
    if ($sl_ct > 0)
        {
        $row=mysqli_fetch_row($rslt);
        $VUselected_language =		$row[0];
        }


    $auth=0;
    $auth_message = user_authorization($PHP_AUTH_USER,$PHP_AUTH_PW,'',1);
    if ($auth_message == 'GOOD')
        {$auth=1;}

    if ($auth < 1)
        {
        $VDdisplayMESSAGE = _QXZ("Login incorrect, please try again");
        if ($auth_message == 'LOCK')
            {
            $VDdisplayMESSAGE = _QXZ("Too many login attempts, try again in 15 minutes");
            Header ("Content-type: text/html; charset=utf-8");
            echo "$VDdisplayMESSAGE: |$PHP_AUTH_USER|$auth_message|\n";
            exit;
            }
        Header("WWW-Authenticate: Basic realm=\"CONTACT-CENTER-ADMIN\"");
        Header("HTTP/1.0 401 Unauthorized");
        echo "$VDdisplayMESSAGE: |$PHP_AUTH_USER|$PHP_AUTH_PW|$auth_message|\n";
        exit;
        }
 
    
    ?>

 
       
    <div class="header">
        <div class="header-text-box">
             <h1 class="header-text">Custom Field Data</h1>
        </div>
        
        <div class="search-refresh-box">
            <form action="" method="post">
                <select class="select-header" name="select_header">
                    <option value="" selected>Choose The Header</option>
                    <option value="customer_name">Customer Name</option>
                    <option value="DOB">D.O.B</option>
                    <option value="EMAIL_ADDRESS">Email Address</option>
                    <option value="SMS">SMS</option>
                    <option value="INSURANCE_START_DATE">Insurance Start Date</option>
                    <option value="VEHICLE_TYPE">Vehicle Type</option>
                    <option value="VEHICLE_MODEL">Vehicle Model</option>
                    <option value="REGISTRATION_NUMBER">Registration Number</option>
                    <option value="YEAR_OF_MANUFACTURE">Year Of Manufacture</option>
                  

                </select>
                <input  type="search" name="custom_lead_search" id="" placeholder=" Searching Data">
                <input class="search-btn" type="submit" name ="submit_search" value="Search">

            </form>
            
            <div class="countdown"><button class="refresh-btn">Refresh</button></div>
        </div>
    </div>
    
    <div class="table-container">
         
        <table class="custom-data-table">
            <thead>
                <tr>
                    <th style="width:9%">Lead Id</th>
                    <th style="width:9%">Phone Number</th>
                    <th style="width:9%">Quotozone</th>
                    <th style="width:9%">User Contact Pref</th>
                    <th style="width:9%">Telephone</th>
                    <th style="width:9%">Sms</th>
                    <th style="width:9%">Vehicle Type</th>
                    <th style="width:9%">Regist Num</th>
                    <th style="width:9%">Vehicle Make</th>
                    <th style="width:15%">Other Info</th>
                   
                    
    
                </tr>
            </thead>
            <tbody>
                <?php
                
                if((isset($_POST["submit_search"])) && (!empty($_POST["custom_lead_search"])) && (!empty($_POST["select_header"])) ){
                    $select_header      = $_POST["select_header"];
                   
                    $custom_lead_search = $_POST["custom_lead_search"];
                    $sql = "SELECT * FROM custom_10001 WHERE  `$select_header`  LIKE '%$custom_lead_search%';";
                    $result = mysqli_query($link,$sql);

                }
                
                else{
                    $sql = "SELECT *,phone_number FROM custom_10001 left join vicidial_list on custom_10001.lead_id=vicidial_list.lead_id order by custom_10001.lead_id desc;";
                    $result = mysqli_query($link,$sql);
                    
                }
                while($row = mysqli_fetch_assoc($result))
                {
                    $lead_id                   = $row["lead_id"];
                    $phone_number              = $row["phone_number"];
                    $quotozone                 = $row["QUOTOZONE"];
                    $user_contact_preferences  = $row["USER_CONTACT_PREFERENCES"];
                    $telephone                 = $row["TELEPHONE"];
                    $sms                       = $row["SMS"];
                    $vehicle_type              = $row["VEHICLE_TYPE"];
                    $registration_number       = $row["REGISTRATION_NUMBER"];
                    $vehicle_make              = $row["VEHICLE_MAKE"];
                    $vehicle_model             = $row["VEHICLE_MODEL"];
                    $year_of_manufacture       = $row["YEAR_OF_MANUFACTURE"];
                    $engine_size_type          = $row["ENGINE_SIZE_TYPE"];
                    $vehicle_driver            = $row["VEHICLE_DRIVER"];
                    $estimated_vehicle_value   = $row["ESTIMATED_VEHICLE_VALUE"];
                    $estimated_equipment_value = $row["ESTIMATED_EQUIPMENT_VALUE"];
                    $vehicle_stored_loc        = $row["VEHICLE_STORED_LOC"];
                    $email_address             = $row["EMAIL_ADDRESS"];
                    $dob                       = $row["DOB"];
                    $insurance_start_date      = $row["INSURANCE_START_DATE"];
                    $quote_reference           = $row["QUOTE_REFERENCE"];
                    $product_list              = $row["product_list "];
                    $customer_name             = $row["customer_name"];
                    $use_of_trailer            = $row["use_of_trailer"];
                    $trailer_permanently_sited = $row["trailer_permanently_sited"];
                    $public_liability          = $row["public_liability_cover"];
                    $wheels_tow_remove         = $row["wheels_tow_remove"];

                ?>
                <tr>
                    <td> <?php echo $lead_id ?></td>
                    <td> <a href="../agent/login.php?tel_num=<?php echo $phone_number ?>"> <?php echo $phone_number ?></a></td>
                    <td> <?php echo $quotozone ?></td>
                    <td> <?php echo $user_contact_preferences ?></td>
                    <td> <?php echo $telephone ?></td>
                    <td> <?php echo $sms ?></td>
                    <td> <?php echo $vehicle_type ?></td>
                    <td> <?php echo $registration_number ?></td>
                    <td> <?php echo $vehicle_make ?></td>
                    <td><button class="show-btn">Show All</button><button class="hide-btn">Show Less</button></td>
                    
                </tr>
                <tr class="hide-row" style="display:none;">
                    <td colspan="10" style="padding:10px;" >
                        <table class="sub-table" >
                            <tr>
                                <td >Vehicle model</td>
                                <td><?php echo $vehicle_model ?></td>
                                <td>YearOf Manufacture</td>
                                <td><?php echo $year_of_manufacture ?></td>
                                <td>Engine Size Type</td>
                                <td><?php echo $engine_size_type ?></td>
                                <td>Vehicle Driver</td>
                                <td><?php echo $vehicle_driver  ?></td>

                            </tr>
                            <tr>
                                <td>Estimated Vehicle Value</td>
                                <td><?php echo $estimated_vehicle_value ?></td>
                                <td>Estimated Equipment Value</td>
                                <td><?php echo $estimated_equipment_value ?></td>
                                <td>Vehicle Stored  Loc</td>
                                <td><?php echo $vehicle_stored_loc ?></td>
                                <td>Email Address</td>
                                <td><?php echo $email_address ?></td>
                            </tr>
                            <tr>
                                <td>Dob</td>
                                <td><?php echo $dob ?></td>
                                <td>Insurance Start Date</td>
                                <td><?php echo $insurance_start_date  ?></td>
                                <td>Quote Reference</td>
                                <td><?php echo $quote_reference ?></td>
                                <td>Product List</td>
                                <td><?php echo $product_list ?></td>
                            </tr>
                            <tr>
                                <td>Customer Name</td>
                                <td><?php echo $customer_name ?></td>
                                <td>Use Of Trailer</td>
                                <td><?php echo $use_of_trailer ?></td>
                                <td>Trailer Permanently Sited</td>
                                <td><?php echo $trailer_permanently_sited ?></td>
                                <td>Public Liability</td>
                                <td><?php echo $public_liability  ?></td>
                            </tr>
                        </table>
                    </td>
                   
                    

                </tr>
                
                
                
                <?php
                }
            
                ?>             
            </tbody>
        </table> 
    </div>
    
    <!--------------------------JAVASCRIPT START-------------------------------->

    <script>
        let refresh_btn = document.querySelector(".refresh-btn");
        
        refresh_btn.addEventListener("click",()=>{
                location.reload(true);
        })



        let popup_row = document.querySelectorAll(".hide-row");
        let show_btn = document.querySelectorAll(".show-btn");
        let hide_btn = document.querySelectorAll(".hide-btn");

        
        

        for(let i=0;i<show_btn.length;i++){


            show_btn[i].addEventListener("click",()=>{
            popup_row[i].style.display = "";
            })


            hide_btn[i].addEventListener("click",()=>{
            popup_row[i].style.display = "none";
            })






        }

           
    </script>
    <!--------------------------JAVASCRIPT END-------------------------------->
</body>
</html>