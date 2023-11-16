<?php 
include("header_inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Databowl Lead Push</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <!------------------main container start--------------------->
    <div class="main-container">
        <div class="main-container-left">
            <!---  <img src="images/pemlix.gif" height="60" width="200" alt="">-->
            <button class="btn-api"><i class="fa-solid fa-square-plus"
                    style="color:#ecec0a;margin-right:8px;font-size:20px;"></i>API Panel</button>
        </div>
        <div class="main-container-right">
            <div class="main-container-right-header">
                <h1>Databowl Poststring Panel</h1>
            </div>
            <div class="table-container">
                
                <div class="table-container-left">
                    <form action="">
                        <table class="table-left">
                            <tbody>
                                <tr>
                                    <td>Select Upload Date1:</td>
                                    <td><input type="date" name="" id=""></td>
                                </tr>
                                <tr>
                                    <td>Select Upload Date2:</td>
                                    <td><input type="date" name="" id=""></td>
                                </tr>
                                <tr>
                                    <td>String Status</td>
                                    <td>
                                        <select name="" id="">
                                            <option value="">All</option>
                                            <option value="">Send</option>
                                            <option value="">Reject</option>
                                            <option value="">Pending</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Question</td>
                                    <td>
                                        <select name="" id="">
                                            <option value="">Select Question</option>
                                            <option value="">Life Insurance</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <button class="btn">Search</button>
                                        <button class="btn">Reset</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>

                <div class="table-container-right">
                    <table class="table-right">
                        <tbody>
                            <tr>
                                <td>Total No of Application Approved</td>
                                <td><strong>0</strong></td>
                            </tr>
                            <tr>
                                <td>Total No of Application Rejected</td>
                                <td><strong>0</strong></td>
                            </tr>
                            <tr>
                                <td>Total No of Application Pending</td>
                                <td><strong>0</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                
            </div>
        </div>
    </div>
    <!------------------main container end--------------------->

    
</body>
</html>