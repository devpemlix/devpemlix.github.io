<meta charset="utf-8">   
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />   
<meta name="apple-mobile-web-app-capable" content="yes" />     
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">

<!-- Bootstrap core CSS -->
	<link href="js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="fonts/font-awesome-4/css/font-awesome.min.css">
	<link href="css/style.css" rel="stylesheet" />	
<?php
# welcome.php - VICIDIAL welcome page
# 
# Copyright (C) 2008  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#

echo "<title>Contact Center Welcome</title>\n";
echo "</head>\n";
echo "<BODY BGCOLOR=WHITE MARGINHEIGHT=0 MARGINWIDTH=0 class='texture'>\n";
echo "<div id='cl-wrapper' class='login-container'><div class='middle-login'><div class='block-flat'><div class='header'><h3 class='text-center'>
    <!--<img class='logo-img'  alt='logo' src='images/logo_white.png'></img>-->
</h3></div><div>";
echo '<form class="form-horizontal" style="margin-bottom: 0px !important;">';
echo '<div class="content"><h4 class="title">
     Welcome
</h4><div class="form-group"><div class="col-md-11" style="padding-bottom: 15px;">';
echo "<a href=\"../agent/vicidial.php\" class='custom_a_link'>Agent Login</a></div> \n";
echo '<div class="col-md-11"  style="padding-bottom: 15px;">';
echo "<a href=\"../agent/timeclock.php?referrer=welcome\" class='custom_a_link'> Timeclock</a></div>\n";
echo '<div class="col-md-11"  style="padding-bottom: 15px;">';
echo "<a href=\"../admins/admin.php\" class='custom_a_link'>Administration</a></div>\n";
echo "</div></div></FORM>\n\n";
echo '</div></div></div></div>';
echo "</body>\n\n";
echo "</html>\n\n";

?>
