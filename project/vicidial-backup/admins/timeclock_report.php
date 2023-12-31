<link href="css/style.css" rel="stylesheet" />
<link href="js/bootstrap/dist/css/bootstrap.css" rel="stylesheet"/>
<link href='fonts/font-awesome-4.2.0/css/font-awesome.css' rel='stylesheet'/>
<link href='fonts/font-awesome-4.2.0/css/font-awesome.min.css' rel='stylesheet'/>
<?php 
# timeclock_report.php
# 
# Copyright (C) 2014  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# CHANGES
#
# 80529-0055 - First build
# 80617-1416 - Fixed totals tally bug
# 80707-0754 - Fixed groups bug, changed formatting
# 90310-2059 - Added admin header
# 90508-0644 - Changed to PHP long tags
# 100214-1421 - Sort menu alphabetically
# 100216-0042 - Added popup date selector
# 100712-1324 - Added system setting slave server option
# 100802-2347 - Added User Group Allowed Reports option validation
# 100914-1326 - Added lookup for user_level 7 users to set to reports only which will remove other admin links
# 110703-1830 - Added download option
# 111104-1314 - Added user_group restrictions for selecting in-groups
# 120224-0910 - Added HTML display option with bar graphs
# 130414-0150 - Added report logging
# 130610-0942 - Finalized changing of all ereg instances to preg
# 130616-1026 - Added filtering of input to prevent SQL injection attacks and new user auth
# 130901-0839 - Changed to mysqli PHP functions
# 140108-0720 - Added webserver and hostname to report logging
# 140328-0005 - Converted division calculations to use MathZDC function
# 141114-0028 - Finalized adding QXZ translation to all admin files
# 141230-0948 - Added code for on-the-fly language translations display
#

$startMS = microtime();

require("dbconnect_mysqli.php");
require("functions.php");

##### Pull values from posted form variables #####
$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["query_date"]))				{$query_date=$_GET["query_date"];}
	elseif (isset($_POST["query_date"]))	{$query_date=$_POST["query_date"];}
if (isset($_GET["end_date"]))				{$end_date=$_GET["end_date"];}
	elseif (isset($_POST["end_date"]))		{$end_date=$_POST["end_date"];}
if (isset($_GET["user_group"]))				{$user_group=$_GET["user_group"];}
	elseif (isset($_POST["user_group"]))	{$user_group=$_POST["user_group"];}
if (isset($_GET["shift"]))				{$shift=$_GET["shift"];}
	elseif (isset($_POST["shift"]))		{$shift=$_POST["shift"];}
if (isset($_GET["order"]))				{$order=$_GET["order"];}
	elseif (isset($_POST["order"]))		{$order=$_POST["order"];}
if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))		{$user=$_POST["user"];}
if (isset($_GET["DB"]))					{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["submit"]))				{$submit=$_GET["submit"];}
	elseif (isset($_POST["submit"]))	{$submit=$_POST["submit"];}
if (isset($_GET["SUBMIT"]))				{$SUBMIT=$_GET["SUBMIT"];}
	elseif (isset($_POST["SUBMIT"]))	{$SUBMIT=$_POST["SUBMIT"];}
if (isset($_GET["file_download"]))			{$file_download=$_GET["file_download"];}
	elseif (isset($_POST["file_download"]))	{$file_download=$_POST["file_download"];}
if (isset($_GET["report_display_type"]))			{$report_display_type=$_GET["report_display_type"];}
	elseif (isset($_POST["report_display_type"]))	{$report_display_type=$_POST["report_display_type"];}

if (strlen($shift)<2) {$shift='ALL';}
if (strlen($order)<2) {$order='hours_down';}

$report_name = 'User Timeclock Report';
$db_source = 'M';

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,outbound_autodial_active,slave_db_server,reports_use_slave_db,webroot_writable,enable_languages,language_method FROM system_settings;";
$rslt=mysql_to_mysqli($stmt, $link);
if ($DB) {$MAIN.="$stmt\n";}
$qm_conf_ct = mysqli_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$non_latin =					$row[0];
	$SSoutbound_autodial_active =	$row[1];
	$slave_db_server =				$row[2];
	$reports_use_slave_db =			$row[3];
	$webroot_writable =				$row[4];
	$SSenable_languages =			$row[5];
	$SSlanguage_method =			$row[6];
	}
##### END SETTINGS LOOKUP #####
###########################################

$STARTtime = date("U");
$TODAY = date("Y-m-d");

if ( (!isset($query_date)) or (strlen($query_date) < 10) ) {$query_date = $TODAY;}
if ( (!isset($end_date)) or (strlen($end_date) < 10) ) {$end_date = $TODAY;}

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
$query_date = preg_replace("/'|\"|\\\\|;/","",$query_date);
$end_date = preg_replace("/'|\"|\\\\|;/","",$end_date);
$user_group = preg_replace("/'|\"|\\\\|;/","",$user_group);
$shift = preg_replace("/'|\"|\\\\|;/","",$shift);
$order = preg_replace("/'|\"|\\\\|;/","",$order);
$user = preg_replace("/'|\"|\\\\|;/","",$user);
$file_download = preg_replace("/'|\"|\\\\|;/","",$file_download);
$report_display_type = preg_replace("/'|\"|\\\\|;/","",$report_display_type);

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
$reports_auth=0;
$admin_auth=0;
$auth_message = user_authorization($PHP_AUTH_USER,$PHP_AUTH_PW,'REPORTS',1);
if ($auth_message == 'GOOD')
	{$auth=1;}

if ($auth > 0)
	{
	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and user_level > 7 and view_reports='1';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$row=mysqli_fetch_row($rslt);
	$admin_auth=$row[0];

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and user_level > 6 and view_reports='1';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$row=mysqli_fetch_row($rslt);
	$reports_auth=$row[0];

	if ($reports_auth < 1)
		{
		$VDdisplayMESSAGE = _QXZ("You are not allowed to view reports");
		Header ("Content-type: text/html; charset=utf-8");
		echo "$VDdisplayMESSAGE: |$PHP_AUTH_USER|$auth_message|\n";
		exit;
		}
	if ( ($reports_auth > 0) and ($admin_auth < 1) )
		{
		$ADD=999999;
		$reports_only_user=1;
		}
	}
else
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

##### BEGIN log visit to the vicidial_report_log table #####
$LOGip = getenv("REMOTE_ADDR");
$LOGbrowser = getenv("HTTP_USER_AGENT");
$LOGscript_name = getenv("SCRIPT_NAME");
$LOGserver_name = getenv("SERVER_NAME");
$LOGserver_port = getenv("SERVER_PORT");
$LOGrequest_uri = getenv("REQUEST_URI");
$LOGhttp_referer = getenv("HTTP_REFERER");
if (preg_match("/443/i",$LOGserver_port)) {$HTTPprotocol = 'https://';}
  else {$HTTPprotocol = 'http://';}
if (($LOGserver_port == '80') or ($LOGserver_port == '443') ) {$LOGserver_port='';}
else {$LOGserver_port = ":$LOGserver_port";}
$LOGfull_url = "$HTTPprotocol$LOGserver_name$LOGserver_port$LOGrequest_uri";

$LOGhostname = php_uname('n');
if (strlen($LOGhostname)<1) {$LOGhostname='X';}
if (strlen($LOGserver_name)<1) {$LOGserver_name='X';}

$stmt="SELECT webserver_id FROM vicidial_webservers where webserver='$LOGserver_name' and hostname='$LOGhostname' LIMIT 1;";
$rslt=mysql_to_mysqli($stmt, $link);
if ($DB) {echo "$stmt\n";}
$webserver_id_ct = mysqli_num_rows($rslt);
if ($webserver_id_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$webserver_id = $row[0];
	}
else
	{
	##### insert webserver entry
	$stmt="INSERT INTO vicidial_webservers (webserver,hostname) values('$LOGserver_name','$LOGhostname');";
	if ($DB) {echo "$stmt\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$affected_rows = mysqli_affected_rows($link);
	$webserver_id = mysqli_insert_id($link);
	}

$stmt="INSERT INTO vicidial_report_log set event_date=NOW(), user='$PHP_AUTH_USER', ip_address='$LOGip', report_name='$report_name', browser='$LOGbrowser', referer='$LOGhttp_referer', notes='$LOGserver_name:$LOGserver_port $LOGscript_name |$user_group[0], $query_date, $end_date, $shift, $file_download, $report_display_type|', url='$LOGfull_url', webserver='$webserver_id';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$report_log_id = mysqli_insert_id($link);
##### END log visit to the vicidial_report_log table #####

if ( (strlen($slave_db_server)>5) and (preg_match("/$report_name/",$reports_use_slave_db)) )
	{
	mysqli_close($link);
	$use_slave_server=1;
	$db_source = 'S';
	require("dbconnect_mysqli.php");
	$MAIN.="<!-- Using slave server $slave_db_server $db_source -->\n";
	}

$stmt="SELECT user_group from vicidial_users where user='$PHP_AUTH_USER';";
if ($DB) {$MAIN.="|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$LOGuser_group =			$row[0];

$stmt="SELECT allowed_campaigns,allowed_reports,admin_viewable_groups,admin_viewable_call_times from vicidial_user_groups where user_group='$LOGuser_group';";
if ($DB) {$MAIN.="|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$LOGallowed_campaigns =			$row[0];
$LOGallowed_reports =			$row[1];
$LOGadmin_viewable_groups =		$row[2];
$LOGadmin_viewable_call_times =	$row[3];

if ( (!preg_match("/$report_name/",$LOGallowed_reports)) and (!preg_match("/ALL REPORTS/",$LOGallowed_reports)) )
	{
	Header ("Content-type: text/html; charset=utf-8");
    echo _QXZ("You are not allowed to view this report").": |$PHP_AUTH_USER|$report_name|\n";
    exit;
	}

$LOGadmin_viewable_groupsSQL='';
$whereLOGadmin_viewable_groupsSQL='';
if ( (!preg_match('/\-\-ALL\-\-/i',$LOGadmin_viewable_groups)) and (strlen($LOGadmin_viewable_groups) > 3) )
	{
	$rawLOGadmin_viewable_groupsSQL = preg_replace("/ -/",'',$LOGadmin_viewable_groups);
	$rawLOGadmin_viewable_groupsSQL = preg_replace("/ /","','",$rawLOGadmin_viewable_groupsSQL);
	$LOGadmin_viewable_groupsSQL = "and user_group IN('---ALL---','$rawLOGadmin_viewable_groupsSQL')";
	$whereLOGadmin_viewable_groupsSQL = "where user_group IN('---ALL---','$rawLOGadmin_viewable_groupsSQL')";
	}

$LOGadmin_viewable_call_timesSQL='';
$whereLOGadmin_viewable_call_timesSQL='';
if ( (!preg_match('/\-\-ALL\-\-/i', $LOGadmin_viewable_call_times)) and (strlen($LOGadmin_viewable_call_times) > 3) )
	{
	$rawLOGadmin_viewable_call_timesSQL = preg_replace("/ -/",'',$LOGadmin_viewable_call_times);
	$rawLOGadmin_viewable_call_timesSQL = preg_replace("/ /","','",$rawLOGadmin_viewable_call_timesSQL);
	$LOGadmin_viewable_call_timesSQL = "and call_time_id IN('---ALL---','$rawLOGadmin_viewable_call_timesSQL')";
	$whereLOGadmin_viewable_call_timesSQL = "where call_time_id IN('---ALL---','$rawLOGadmin_viewable_call_timesSQL')";
	}

$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$STARTtime = date("U");
if (!isset($group)) {$group = '';}
if (!isset($query_date)) {$query_date = $NOW_DATE;}
if (!isset($end_date)) {$end_date = $NOW_DATE;}

$stmt="select user_group from vicidial_user_groups $whereLOGadmin_viewable_groupsSQL order by user_group;";
$rslt=mysql_to_mysqli($stmt, $link);
if ($DB) {$MAIN.="$stmt\n";}
$user_groups_to_print = mysqli_num_rows($rslt);
$i=0;
	$LISTuser_groups[$i]='---ALL---';
	$i++;
	$user_groups_to_print++;
while ($i < $user_groups_to_print)
	{
	$row=mysqli_fetch_row($rslt);
	$LISTuser_groups[$i] =$row[0];
	$i++;
	}

##### START HTML #####

$HEADER.="<HTML>\n";
$HEADER.="<HEAD>\n";
$HEADER.="<style type=\"text/css\">\n";
$HEADER.="<!--\n";
$HEADER.="	div.scroll_callback {height: 300px; width: 620px; overflow: scroll;}\n";
$HEADER.="	div.scroll_list {height: 400px; width: 140px; overflow: scroll;}\n";
$HEADER.="	div.scroll_script {height: 331px; width: 600px; background: #FFF5EC; overflow: scroll; font-size: 12px;  font-family: sans-serif;}\n";
$HEADER.="	div.text_input {overflow: auto; font-size: 10px;  font-family: sans-serif;}\n";
$HEADER.="   .body_text {font-size: 13px;  font-family: sans-serif;}\n";
$HEADER.="   .preview_text {font-size: 13px;  font-family: sans-serif; background: #CCFFCC}\n";
$HEADER.="   .preview_text_red {font-size: 13px;  font-family: sans-serif; background: #FFCCCC}\n";
$HEADER.="   .body_small {font-size: 11px;  font-family: sans-serif;}\n";
$HEADER.="   .body_tiny {font-size: 10px;  font-family: sans-serif;}\n";
$HEADER.="   .log_text {font-size: 11px;  font-family: monospace;}\n";
$HEADER.="   .log_text_red {font-size: 11px;  font-family: monospace; font-weight: bold; background: #FF3333}\n";
$HEADER.="   .sd_text {font-size: 16px;  font-family: sans-serif; font-weight: bold;}\n";
$HEADER.="   .sh_text {font-size: 14px;  font-family: sans-serif; font-weight: bold;}\n";
$HEADER.="   .sb_text {font-size: 12px;  font-family: sans-serif;}\n";
$HEADER.="   .sk_text {font-size: 11px;  font-family: sans-serif;}\n";
$HEADER.="   .skb_text {font-size: 13px;  font-family: sans-serif; font-weight: bold;}\n";
$HEADER.="   .ON_conf {font-size: 11px;  font-family: monospace; color: black; background: #FFFF99}\n";
$HEADER.="   .OFF_conf {font-size: 11px;  font-family: monospace; color: black; background: #FFCC77}\n";
$HEADER.="   .cust_form {font-family: sans-serif; font-size: 10px; overflow: auto}\n";
$HEADER.="\n";
$HEADER.="   .select_bold {font-size: 14px;  font-family: sans-serif; font-weight: bold;}\n";
$HEADER.="   .header_white {font-size: 14px;  font-family: sans-serif; font-weight: bold; color: white}\n";
$HEADER.="   .data_records {font-size: 12px;  font-family: sans-serif; color: black}\n";
$HEADER.="   .data_records_fix {font-size: 12px;  font-family: monospace; color: black}\n";
$HEADER.="   .data_records_fix_small {font-size: 9px;  font-family: monospace; color: black}\n";
$HEADER.="\n";
$HEADER.="-->\n";
$HEADER.="</style>\n";
$HEADER.="<script language=\"JavaScript\" src=\"calendar_db.js\"></script>\n";
$HEADER.="<link rel=\"stylesheet\" href=\"calendar.css\">\n";
$HEADER.="<link rel=\"stylesheet\" href=\"horizontalbargraph.css\">\n";
$HEADER.="<link href='css/style.css' rel='stylesheet' />\n";
$HEADER.="<link href='js/bootstrap/dist/css/bootstrap.css' rel='stylesheet'/>\n";

$HEADER.="<script src='js/jquery.js'></script>";
$HEADER.="    <script src='js/jquery_j.js'></script>";
$HEADER.="	<script src='js/jquery.cookie/jquery.cookie.js'></script>";
$HEADER.="  <script src='js/jquery.pushmenu/js/jPushMenu.js'></script>";
$HEADER.="	<script type='text/javascript' src='js/jquery.nanoscroller/jquery.nanoscroller.js'></script>";
$HEADER.="	<script type='text/javascript' src='js/jquery.sparkline/jquery.sparkline.min.js'></script>";
$HEADER.="  <script type='text/javascript' src='js/jquery.ui/jquery-ui.js'></script>";
$HEADER.="	<script type='text/javascript' src='js/jquery.gritter/js/jquery.gritter.js'></script>";
$HEADER.="	<script type='text/javascript' src='js/behaviour/core.js'></script>";
$HEADER.="  <script src='js/bootstrap/dist/js/bootstrap.min.js'></script>";
$HEADER.="<link href='fonts/font-awesome-4/css/font-awesome.min.css' rel='stylesheet'/>\n";
$HEADER.="<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
$HEADER.="<TITLE>\n";

$HEADER.= _QXZ("$report_name");

##### BEGIN Set variables to make header show properly #####
$ADD =					'311111';
$hh =					'usergroups';
$LOGast_admin_access =	'1';
$ADMIN =				'admin.php';
$page_width='770';
$section_width='750';
$header_font_size='3';
$subheader_font_size='2';
$subcamp_font_size='2';
$header_selected_bold='<b>';
$header_nonselected_bold='';
$usergroups_color =		'#FFFF99';
$usergroups_font =		'BLACK';
$usergroups_color =		'#E6E6E6';
$subcamp_color =	'#C6C6C6';
##### END Set variables to make header show properly #####

#require("admin_header.php");


$MAIN.='<div id="pcont" class="container-fluid">
		<div class="cl-mcont">
        <div class="row">
		<div class="col-md-12 no-padding"><div class="block-flat"><div class="header"> <h3> ';
$MAIN.= _QXZ("$report_name");
$MAIN.='</h3> </div>
		<div class="col-md-12"><div class="content">';
$user_group_ct = count($user_group);
$user_group_string='|';

$i=0;
while($i < $user_group_ct)
	{
	$user_group_string .= "$user_group[$i]|";
	$user_group_SQL .= "'$user_group[$i]',";
	$user_groupQS .= "&user_group[]=$user_group[$i]";
	$i++;
	}
if ( (preg_match('/\-\-ALL\-\-/',$user_group_string) ) or ($user_group_ct < 1) )
	{
	$user_group_SQL = "";
	}
else
	{
	$user_group_SQL = preg_replace('/,$/i', '',$user_group_SQL);
	$user_group_SQL = "and vicidial_timeclock_log.user_group IN($user_group_SQL)";
	}

if ($DB > 0)
	{
	$MAIN.="<BR>\n";
	$MAIN.="$user_group_ct|$user_group_string|$user_group_SQL\n";
	$MAIN.="<BR>\n";
	}

$MAIN.="<FORM ACTION=\"$PHP_SELF\" METHOD=GET name=vicidial_report id=vicidial_report>\n";
$MAIN.="<INPUT TYPE=HIDDEN NAME=DB VALUE=\"$DB\">";
$MAIN.="<TABLE BORDER=0 CELLSPACING=6 class='col-lg-12 spacercol-lg-12 spacercol-lg-12 spacercol-lg-12 spacercol-lg-12 spacercol-lg-12 spacercol-lg-12 spacercol-lg-12 spacercol-lg-12 spacercol-lg-12 spacercol-lg-12 spacercol-lg-12 spacer'><TR><TD class='col-lg-3 no-border size'><div class='col-lg-12'>";

$MAIN.=_QXZ("Date Range").":</div>";
$MAIN.="<div class='col-lg-12'><div class='col-lg-7 no-padding'><INPUT TYPE=TEXT NAME=query_date SIZE=10 class=form-control MAXLENGTH=10 VALUE=\"$query_date\"></div><div class='col-lg-1 no-padding'>";

$MAIN.="<script language=\"JavaScript\">\n";
$MAIN.="var o_cal = new tcal ({\n";
$MAIN.="	// form name\n";
$MAIN.="	'formname': 'vicidial_report',\n";
$MAIN.="	// input name\n";
$MAIN.="	'controlname': 'query_date'\n";
$MAIN.="});\n";
$MAIN.="o_cal.a_tpl.yearscroll = false;\n";
$MAIN.="// o_cal.a_tpl.weekstart = 1; // Monday week start\n";
$MAIN.="</script>\n";

$MAIN.="</div></div><div class='col-lg-12'><div class='col-sm-7' align='center'>"._QXZ("to")."</div> </div><div class='col-lg-12'><div class='col-lg-7 no-padding'>";
$MAIN.="<INPUT TYPE=TEXT NAME=end_date SIZE=10 class=form-control MAXLENGTH=10 VALUE=\"$end_date\"></div><div class='col-lg-1 no-padding'>";

$MAIN.="<script language=\"JavaScript\">\n";
$MAIN.="var o_cal = new tcal ({\n";
$MAIN.="	// form name\n";
$MAIN.="	'formname': 'vicidial_report',\n";
$MAIN.="	// input name\n";
$MAIN.="	'controlname': 'end_date'\n";
$MAIN.="});\n";
$MAIN.="o_cal.a_tpl.yearscroll = false;\n";
$MAIN.="// o_cal.a_tpl.weekstart = 1; // Monday week start\n";
$MAIN.="</script>\n";


$MAIN.="</div></div></TD><TD class='no-border size'>\n";
$MAIN.=_QXZ("User Groups").":<BR><CENTER>\n";
$MAIN.="<SELECT SIZE=5 class=form-control NAME=user_group[] multiple>\n";
	$o=0;
	while ($user_groups_to_print > $o)
	{
		if (preg_match("/\|$LISTuser_groups[$o]\|/",$user_group_string)) 
			{$MAIN.="<option selected value=\"$LISTuser_groups[$o]\">$LISTuser_groups[$o]</option>\n";}
		else 
			{$MAIN.="<option value=\"$LISTuser_groups[$o]\">$LISTuser_groups[$o]</option>\n";}
		$o++;
	}
$MAIN.="</SELECT>\n";


$MAIN.="</TD></TD><TD class='no-border size' valign=top>";
$MAIN.=_QXZ("Display as").":<BR>";
$MAIN.="<select name='report_display_type' class=form-control>";
if ($report_display_type) {$MAIN.="<option value='$report_display_type' selected>$report_display_type</option>";}
$MAIN.="<option value='TEXT'>"._QXZ("TEXT")."</option><option value='HTML'>"._QXZ("HTML")."</option></select>\n<BR>\n";
$MAIN.="</TD><TD class='no-border size' valign=top>\n";
$MAIN.=_QXZ("Order").":<BR>\n";
$MAIN.="<SELECT SIZE=1 NAME=order class=form-control>\n";
$MAIN.="<option selected value=\"$order\">$order</option>\n";
$MAIN.="<option value=\"\">--</option>\n";
$MAIN.="<option>"._QXZ("hours_up")."</option>\n";
$MAIN.="<option>"._QXZ("hours_down")."</option>\n";
$MAIN.="<option>"._QXZ("user_up")."</option>\n";
$MAIN.="<option>"._QXZ("user_down")."</option>\n";
$MAIN.="<option>"._QXZ("name_up")."</option>\n";
$MAIN.="<option>"._QXZ("name_down")."</option>\n";
$MAIN.="<option>"._QXZ("group_up")."</option>\n";
$MAIN.="<option>"._QXZ("group_down")."</option>\n";
$MAIN.="</SELECT>\n";
$MAIN.="<CENTER>\n";

$MAIN.="</TD><TD class='no-border size' valign=top>\n";
$MAIN.=_QXZ("User").":<BR>\n";
$MAIN.="<INPUT TYPE=text NAME=user SIZE=7 class=form-control MAXLENGTH=20 VALUE=\"$user\">\n";


$MAIN.="</TD></TD>";
$MAIN.="<TD ALIGN=CENTER class='no-border' >\n";	
$MAIN.="<a href=\"$PHP_SELF?DB=$DB$user_groupQS&query_date=$query_date&end_date=$end_date&order=$order&user=$user&SUBMIT=$SUBMIT&file_download=1\">"._QXZ("DOWNLOAD")."</a>&nbsp; | &nbsp; <a href=\"./admin.php?ADD=999999\">"._QXZ("REPORTS")."</a> </FONT>\n";
$MAIN.="</TD></TR><TR><TD class='no-border' align=center colspan=6><INPUT TYPE=SUBMIT NAME=SUBMIT  VALUE='"._QXZ("SUBMIT")."' class='btn btn-bdr-sucess'>";
$MAIN.="</TD></TR></TABLE>\n";
$MAIN.="</FORM>\n\n";

$MAIN.="<PRE class='col-lg-12 spacer'>\n";


$MAIN.=_QXZ("User Timeclock Report",44)." $NOW_TIME\n";

$CSV_text.="\""._QXZ("User Timeclock Report")." - $NOW_TIME\"\n";
$CSV_text.="\""._QXZ("Time range").": $query_date to $end_date\"\n";
$CSV_text.="\"---------- "._QXZ("USER TIMECLOCK DETAILS")." -------------\"\n";
$CSV_text.="\""._QXZ("These totals do NOT include any active sessions")."\"\n\n";


$order_SQL='';
if ($order == 'hours_up')	{$order_SQL = "order by login";}
if ($order == 'hours_down') {$order_SQL = "order by login desc";}
if ($order == 'user_up')	{$order_SQL = "order by vicidial_users.user";}
if ($order == 'user_down')	{$order_SQL = "order by vicidial_users.user desc";}
if ($order == 'name_up')	{$order_SQL = "order by full_name";}
if ($order == 'name_down')	{$order_SQL = "order by full_name desc";}
if ($order == 'group_up')	{$order_SQL = "order by vicidial_timeclock_log.user_group";}
if ($order == 'group_down')	{$order_SQL = "order by vicidial_timeclock_log.user_group desc";}

if (strlen($user) > 0)		{$user_SQL = "and vicidial_timeclock_log.user='$user'";}
else {$user_SQL='';}

$stmt="select vicidial_users.user,full_name,sum(login_sec) as login,vicidial_timeclock_log.user_group from vicidial_users,vicidial_timeclock_log where event IN('LOGIN','START') and event_date >= '$query_date 00:00:00' and event_date <= '$end_date 23:59:59' and vicidial_users.user=vicidial_timeclock_log.user $user_SQL $user_group_SQL group by vicidial_users.user,vicidial_timeclock_log.user_group $order_SQL limit 100000;";

if (!$report_display_type || $report_display_type=="TEXT") 
	{
	$MAIN.=_QXZ("Time range").": $query_date "._QXZ("to")." $end_date\n\n";
	$MAIN.="---------- "._QXZ("USER TIMECLOCK DETAILS")." -------------\n";
	$MAIN.=_QXZ("These totals do NOT include any active sessions")."\n</PRE>\n";
	$MAIN.="<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=3><TR >\n";
	$MAIN.="<TD ALIGN=CENTER>#</TD>\n";
	$MAIN.="<TD ALIGN=CENTER>&nbsp; "._QXZ("USER")." &nbsp;</TD>\n";
	$MAIN.="<TD ALIGN=CENTER>&nbsp; "._QXZ("NAME")." &nbsp;</TD>\n";
	$MAIN.="<TD ALIGN=CENTER>&nbsp; "._QXZ("GROUP")." &nbsp;</TD>\n";
	$MAIN.="<TD ALIGN=CENTER>&nbsp; "._QXZ("HOURS")." &nbsp;</TD>\n";
	$MAIN.="</TR>\n";

	$CSV_text.="\"\",\"#\",\""._QXZ("USER")."\",\""._QXZ("NAME")."\",\""._QXZ("GROUP")."\",\""._QXZ("HOURS")."\"\n";

	$rslt=mysql_to_mysqli($stmt, $link);
	if ($DB) {$MAIN.="$stmt\n";}
	$rows_to_print = mysqli_num_rows($rslt);
	$i=0;

	while ($i < $rows_to_print)
		{
		$dbHOURS=0;
		$row=mysqli_fetch_row($rslt);
		$user_id[$i] =		$row[0];
		$full_name[$i] =	$row[1];
		$login_sec[$i] =	$row[2];	$TOTlogin_sec = ($TOTlogin_sec + $row[2]);
		$u_group[$i] =		$row[3];

		if ($login_sec[$i] > 0)
			{
			$dbHOURS = MathZDC($login_sec[$i], 3600);
			$dbHOURS = round($dbHOURS, 2);
			$dbHOURS = sprintf("%01.2f", $dbHOURS);
			}
		else
			{$dbHOURS='0.00';}

		$hours[$i] =	$dbHOURS;		
		$hoursSORT[$i] =	"$dbHOURS-----$i";		

		$i++;
		}


	$j=0;
	while ($j < $rows_to_print)
		{

		$hours_split = explode("-----",$hoursSORT[$j]);
		$i = $hours_split[1];

		if (preg_match("/1$|3$|5$|7$|9$/i", $j))
			{$bgcolor='bgcolor="#ffffff"';} 
		else
			{$bgcolor='bgcolor="#ffffff"';}

		$MAIN.="<TR $bgcolor>\n";
		$MAIN.="<TD ALIGN=LEFT><FONT class=\"data_records_fix_small\">$j</TD>\n";
		$MAIN.="<TD><FONT class=\"data_records\"><A HREF=\"user_status.php?user=$user_id[$i]\">$user_id[$i]</A> </TD>\n";
		$MAIN.="<TD><FONT class=\"data_records\">$full_name[$i] </TD>\n";
		$MAIN.="<TD><FONT class=\"data_records\">$u_group[$i] </TD>\n";
		$MAIN.="<TD ALIGN=RIGHT><FONT class=\"data_records_fix\"> $hours[$i]</TD>\n";
		$MAIN.="</TR>\n";
		$CSV_text.="\"\",\"".($j+1)."\",\"$user_id[$i]\",\"$full_name[$i]\",\"$u_group[$i]\",\"$hours[$i]\"\n";

		$j++;
		}


	if ($TOTlogin_sec > 0)
		{
		$TOTdbHOURS = MathZDC($TOTlogin_sec, 3600);
		$TOTdbHOURS = round($TOTdbHOURS, 0);
		$TOTdbHOURS = sprintf("%01.0f", $TOTdbHOURS);
		}
	else
		{$TOTdbHOURS='0.00';}

	$TOThours =	$TOTdbHOURS;		



	$MAIN.="<TR >\n";
	$MAIN.="<TD ALIGN=LEFT COLSPAN=4><FONT class=\"data_records\">"._QXZ("TOTALS")."</TD>\n";
	$MAIN.="<TD ALIGN=RIGHT><FONT class=\"data_records_fix\"> $TOThours</TD>\n";
	$MAIN.="</TR>\n";
	$CSV_text.="\"\",\""._QXZ("TOTALS")."\",\"\",\"\",\"\",\"$TOThours\"\n";

	$MAIN.="</TABLE>\n";
	}
else 
	{
	######## GRAPHING #########
	$rslt=mysql_to_mysqli($stmt, $link);
	$high_ct=0; $i=0;
	while ($row=mysqli_fetch_row($rslt)) {

		if ($row[2] > 0)
			{
			$dbHOURS = MathZDC($row[2], 3600);
			$dbHOURS = round($dbHOURS, 2);
			$dbHOURS = sprintf("%01.2f", $dbHOURS);
			}
		else
			{$dbHOURS='0.00';}

		if ($dbHOURS>$high_ct) {$high_ct=$dbHOURS;}		
		$ct_ary[$i][0]="$row[1] ($row[0]) - $row[3]";
		$ct_ary[$i][1]=$dbHOURS;
		$i++;
	}
	if ($high_ct<1) {$high_ct*=10;}
	$MAIN.="</PRE>\n";
	$MAIN.="<table cellspacing=\"0\" cellpadding=\"0\" summary=\"CALL HANGUP REASON STATS\" class=\"horizontalgraph\">\n";
	$MAIN.="  <caption align=\"top\">"._QXZ("USER TIMECLOCK DETAILS")."<br /><font size='-1'>"._QXZ("Time range").": $query_date to $end_date<br/>"._QXZ("These totals do NOT include any active sessions")."</font><br /></caption>\n";
	$MAIN.="  <tr>\n";
	$MAIN.="	<th class=\"thgraph\" scope=\"col\">"._QXZ("USER")."  </th>\n";
	$MAIN.="	<th class=\"thgraph\" scope=\"col\">"._QXZ("HOURS")." </th>\n";
	$MAIN.="  </tr>\n";
	for ($i=0; $i<count($ct_ary); $i++) {
		if ($i==0) {$class=" first";} else if (($i+1)==count($ct_ary)) {$class=" last";} else {$class="";}
		$MAIN.="  <tr>\n";
		$MAIN.="	<td class=\"chart_td$class\">".$ct_ary[$i][0]."</td>\n";
		$MAIN.="	<td class=\"chart_td value$class\"><img src=\"images/bar.png\" alt=\"\" width=\"".round(MathZDC(400*$ct_ary[$i][1], $high_ct))."\" height=\"16\" />".$ct_ary[$i][1]."</td>\n";
		$MAIN.="  </tr>\n";
	}
	$MAIN.="  <tr>\n";
	$MAIN.="	<th class=\"thgraph\" scope=\"col\">"._QXZ("TOTAL HOURS").":</th>\n";
	$MAIN.="	<th class=\"thgraph\" scope=\"col\">".trim($TOThours)."</th>\n";
	$MAIN.="  </tr>\n";
	$MAIN.="</table>\n";
	$MAIN.="<PRE>\n";
	###########################
	}


$MAIN.="</CENTER>\n";
$MAIN.="</div></div></div></div></div></div></div>";
$MAIN.="</BODY></HTML>\n";

	if ($file_download>0) {
		$FILE_TIME = date("Ymd-His");
		$CSVfilename = "timeclock_report_$US$FILE_TIME.csv";
		$CSV_text=preg_replace('/^\s+/', '', $CSV_text);
		$CSV_text=preg_replace('/\n\s+,/', ',', $CSV_text);
		$CSV_text=preg_replace('/ +\"/', '"', $CSV_text);
		$CSV_text=preg_replace('/\" +/', '"', $CSV_text);
		// We'll be outputting a TXT file
		header('Content-type: application/octet-stream');

		// It will be called LIST_101_20090209-121212.txt
		header("Content-Disposition: attachment; filename=\"$CSVfilename\"");
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		ob_clean();
		flush();

		echo "$CSV_text";

	} else {
		echo $HEADER;
		require("admin_header.php");
		echo $MAIN;
	}

if ($db_source == 'S')
	{
	mysqli_close($link);
	$use_slave_server=0;
	$db_source = 'M';
	require("dbconnect_mysqli.php");
	}

$endMS = microtime();
$startMSary = explode(" ",$startMS);
$endMSary = explode(" ",$endMS);
$runS = ($endMSary[0] - $startMSary[0]);
$runM = ($endMSary[1] - $startMSary[1]);
$TOTALrun = ($runS + $runM);

$stmt="UPDATE vicidial_report_log set run_time='$TOTALrun' where report_log_id='$report_log_id';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);

exit;

?>
