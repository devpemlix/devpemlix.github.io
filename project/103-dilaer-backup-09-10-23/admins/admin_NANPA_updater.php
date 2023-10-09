<?php
# admin_NANPA_updater.php
# 
# Copyright (C) 2016  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# This script is designed to launch NANPA filter batch proccesses through the
# triggering process
#
# CHANGELOG:
# 130919-1503 - First build of script
# 131005-2035 - Added exclusion options
# 131019-1112 - Added help text and several small tweaks
# 160108-2300 - Changed some mysqli_query to mysql_to_mysqli for consistency
#

$version = '2.12-6';
$build = '160108-2300';
$startMS = microtime();

require("dbconnect_mysqli.php");
require("functions.php");

$server_ip=$WEBserver_ip;
$PHP_AUTH_USER=$_SERVER['PHP_AUTH_USER'];
$PHP_AUTH_PW=$_SERVER['PHP_AUTH_PW'];
$PHP_SELF=$_SERVER['PHP_SELF'];
if (isset($_GET["submit_form"]))			{$submit_form=$_GET["submit_form"];}
	elseif (isset($_POST["submit_form"]))	{$submit_form=$_POST["submit_form"];}
if (isset($_GET["delete_trigger_id"]))			{$delete_trigger_id=$_GET["delete_trigger_id"];}
	elseif (isset($_POST["delete_trigger_id"]))	{$delete_trigger_id=$_POST["delete_trigger_id"];}
if (isset($_GET["lists"]))			{$lists=$_GET["lists"];}
	elseif (isset($_POST["lists"]))	{$lists=$_POST["lists"];}
if (isset($_GET["fields_to_update"]))			{$fields_to_update=$_GET["fields_to_update"];}
	elseif (isset($_POST["fields_to_update"]))	{$fields_to_update=$_POST["fields_to_update"];}
if (isset($_GET["vl_field_update"]))			{$vl_field_update=$_GET["vl_field_update"];}
	elseif (isset($_POST["vl_field_update"]))	{$vl_field_update=$_POST["vl_field_update"];}
if (isset($_GET["vl_field_exclude"]))			{$vl_field_exclude=$_GET["vl_field_exclude"];}
	elseif (isset($_POST["vl_field_exclude"]))	{$vl_field_exclude=$_POST["vl_field_exclude"];}
if (isset($_GET["exclusion_value"]))			{$exclusion_value=$_GET["exclusion_value"];}
	elseif (isset($_POST["exclusion_value"]))	{$exclusion_value=$_POST["exclusion_value"];}
if (isset($_GET["cellphone_list_id"]))			{$cellphone_list_id=$_GET["cellphone_list_id"];}
	elseif (isset($_POST["cellphone_list_id"]))	{$cellphone_list_id=$_POST["cellphone_list_id"];}
if (isset($_GET["landline_list_id"]))			{$landline_list_id=$_GET["landline_list_id"];}
	elseif (isset($_POST["landline_list_id"]))	{$landline_list_id=$_POST["landline_list_id"];}
if (isset($_GET["invalid_list_id"]))			{$invalid_list_id=$_GET["invalid_list_id"];}
	elseif (isset($_POST["invalid_list_id"]))	{$invalid_list_id=$_POST["invalid_list_id"];}
if (isset($_GET["activation_delay"]))			{$activation_delay=$_GET["activation_delay"];}
	elseif (isset($_POST["activation_delay"]))	{$activation_delay=$_POST["activation_delay"];}
if (isset($_GET["DB"]))				{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))	{$DB=$_POST["DB"];}

$block_scheduling_while_running=0;

#############################################
##### START SYSTEM_SETTINGS LOOKUP #####
$stmt = "SELECT use_non_latin,outbound_autodial_active,slave_db_server,reports_use_slave_db,active_voicemail_server,enable_languages,language_method FROM system_settings;";
$rslt=mysql_to_mysqli($stmt, $link);
if ($DB) {$MAIN.="$stmt\n";}
$qm_conf_ct = mysqli_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$non_latin =					$row[0];
	$outbound_autodial_active =		$row[1];
	$slave_db_server =				$row[2];
	$reports_use_slave_db =			$row[3];
	$active_voicemail_server =		$row[4];
	$SSenable_languages =			$row[5];
	$SSlanguage_method =			$row[6];
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

$NOW_DATE = date("Y-m-d");

$stmt="SELECT selected_language from vicidial_users where user='$PHP_AUTH_USER';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$sl_ct = mysqli_num_rows($rslt);
if ($sl_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$VUselected_language =		$row[0];
	}

$user_auth=0;
$auth=0;
$reports_auth=0;
$qc_auth=0;
$auth_message = user_authorization($PHP_AUTH_USER,$PHP_AUTH_PW,'QC',1);
if ($auth_message == 'GOOD')
	{$user_auth=1;}

if ($user_auth > 0)
	{
	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and user_level > 7;";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$row=mysqli_fetch_row($rslt);
	$auth=$row[0];

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and user_level > 6 and view_reports='1';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$row=mysqli_fetch_row($rslt);
	$reports_auth=$row[0];

	$stmt="SELECT count(*) from vicidial_users where user='$PHP_AUTH_USER' and user_level > 1 and qc_enabled='1';";
	if ($DB) {echo "|$stmt|\n";}
	$rslt=mysql_to_mysqli($stmt, $link);
	$row=mysqli_fetch_row($rslt);
	$qc_auth=$row[0];

	$reports_only_user=0;
	$qc_only_user=0;
	if ( ($reports_auth > 0) and ($auth < 1) )
		{
		$ADD=999999;
		$reports_only_user=1;
		}
	if ( ($qc_auth > 0) and ($reports_auth < 1) and ($auth < 1) )
		{
		if ( ($ADD != '881') and ($ADD != '100000000000000') )
			{
            $ADD=100000000000000;
			}
		$qc_only_user=1;
		}
	if ( ($qc_auth < 1) and ($reports_auth < 1) and ($auth < 1) )
		{
		$VDdisplayMESSAGE = _QXZ("You do not have permission to be here");
		Header ("Content-type: text/html; charset=utf-8");
		echo "$VDdisplayMESSAGE: |$PHP_AUTH_USER|$auth_message|\n";
		exit;
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

if (strlen($active_voicemail_server)<7)
	{
	echo _QXZ("ERROR: Admin -> System Settings -> Active Voicemail Server is not set")."\n";
	exit;
	}

if ($delete_trigger_id) 
	{
	$delete_stmt="delete from vicidial_process_triggers where trigger_id='$delete_trigger_id'";
	$delete_rslt=mysql_to_mysqli($delete_stmt, $link);
	}

$list_ct=count($lists);
if ($submit_form=="SUBMIT" && $list_ct>0 && (strlen($vl_field_update)>0 || strlen($cellphone_list_id)>0 || strlen($landline_list_id)>0 || strlen($invalid_list_id)>0) ) 
	{
	for ($i=0; $i<$list_ct; $i++) 
		{
		if ($lists[$i]=="---ALL---") 
			{
			unset($lists);
			#$lists[0]="---ALL---";
			$i=$list_ct;

			### Added to make sure that if ALL are selected, it's all inactives.  There is nothing in the actual NANPA filtering scripts that handle it
			### but it needs to be done
			$j=0;
			$stmt="SELECT list_id from vicidial_lists where active='N' order by list_id asc";
			$rslt=mysql_to_mysqli($stmt, $link);
			while ($row=mysqli_fetch_array($rslt)) 
				{
				$lists[$j]=$row[0];
				$j++;
				}
			}
		}
	$list_ct=count($lists);

	$cellphone_list_id=preg_replace('/[^0-9]/', '', $cellphone_list_id);
	$landline_list_id=preg_replace('/[^0-9]/', '', $landline_list_id);
	$invalid_list_id=preg_replace('/[^0-9]/', '', $invalid_list_id);
	$exclusion_value=preg_replace('/[\'\"\\\\]/', '', $exclusion_value);
	$exclusion_value=preg_replace('/\s/', '\\\\\ ', $exclusion_value);
	

	$options="--user=$PHP_AUTH_USER --pass=$PHP_AUTH_PW ";
	
	$list_id_str="";
	for ($i=0; $i<$list_ct; $i++) 
		{
		$list_id_str.=$lists[$i]."--";
		}
	$list_id_str=substr($list_id_str, 0, -2);
	$options.="--list-id=$list_id_str ";
	
	if (strlen($cellphone_list_id)>0)	{$options.="--cellphone-list-id=$cellphone_list_id ";}
	if (strlen($landline_list_id)>0)	{$options.="--landline-list-id=$landline_list_id ";}
	if (strlen($invalid_list_id)>0)		{$options.="--invalid-list-id=$invalid_list_id ";}
	if (strlen($vl_field_update)>0)		{$options.="--vl-field-update=$vl_field_update ";}
	if (strlen($vl_field_exclude)>0 && strlen($exclusion_value)>0)		{$options.="--exclude-field=$vl_field_exclude --exclude-value=$exclusion_value ";}
	$options=trim($options);

	$uniqueid=date("U").".".rand(1, 9999);
	$ins_stmt="INSERT into vicidial_process_triggers (trigger_id, trigger_name, server_ip, trigger_time, trigger_run, user, trigger_lines) VALUES('NANPA_".$uniqueid."', 'NANPA updater SCREEN', '$active_voicemail_server', now()+INTERVAL $activation_delay MINUTE, '1', '$PHP_AUTH_USER', '/usr/share/astguiclient/nanpa_type_filter.pl --output-to-db $options')";
	$ins_rslt=mysql_to_mysqli($ins_stmt, $link);
	}
header ("Content-type: text/html; charset=utf-8");
if ($SSnocache_admin=='1')
	{
	header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
	header ("Pragma: no-cache");                          // HTTP/1.0
	}


$schedule_stmt="SELECT *, sec_to_time(UNIX_TIMESTAMP(trigger_time)-UNIX_TIMESTAMP(now())) as time_until_execution from vicidial_process_triggers where trigger_name='NANPA updater SCREEN' and user='$PHP_AUTH_USER' and trigger_time>=now()";
$schedule_rslt=mysql_to_mysqli($schedule_stmt, $link);

$running_stmt="SELECT output_code from vicidial_nanpa_filter_log where user='$PHP_AUTH_USER' and status!='COMPLETED' order by output_code asc";
$running_rslt=mysql_to_mysqli($running_stmt, $link);
if (mysqli_num_rows($running_rslt)>0) {
	$iframe_url="";
	while ($run_row=mysqli_fetch_array($running_rslt)) {
		$iframe_url.="&output_codes_to_display[]=".$run_row[0];
	}
}
echo "<html>\n";
echo "<head>\n";
echo "<!-- VERSION: $admin_version   BUILD: $build   ADD: $ADD   PHP_SELF: $PHP_SELF-->\n";
echo "<META NAME=\"ROBOTS\" CONTENT=\"NONE\">\n";
echo "<META NAME=\"COPYRIGHT\" CONTENT=\"&copy; 2013 ViciDial Group\">\n";
echo "<META NAME=\"AUTHOR\" CONTENT=\"ViciDial Group\">\n";
if ($SSnocache_admin=='1')
	{
	echo "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">\n";
	echo "<META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">\n";
	echo "<META HTTP-EQUIV=\"CACHE-CONTROL\" CONTENT=\"NO-CACHE\">\n";
	}
if ( ($SSadmin_modify_refresh > 1) and (preg_match("/^3/",$ADD)) )
	{
	$modify_refresh_set=1;
	if (preg_match("/^3/",$ADD)) {$modify_url = "$PHP_SELF?$QUERY_STRING";}
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"$SSadmin_modify_refresh;URL=$modify_url\">\n";
	}
       echo " <script language='JavaScript' src='calendar_db.js'></script>";
echo "<link rel='stylesheet' href='calendar.css'>";
echo "<link rel='stylesheet' href='horizontalbargraph.css'>";
echo "<link rel='stylesheet' href='verticalbargraph.css'>";
echo "	<link rel='stylesheet' href='horizontalbargraph.css'>";
echo "<link href='css/style.css' rel='stylesheet' />";
echo "<link href='js/bootstrap/dist/css/bootstrap.css' rel='stylesheet'/>";
echo "<link href='fonts/font-awesome-4.2.0/css/font-awesome.min.css' rel='stylesheet'/>";
echo "<script src='js/jquery.js'></script> ";
echo "<script src='js/jquery_j.js'></script>";
echo "<script src='js/jquery.cookie/jquery.cookie.js'></script>";
echo "<script src='js/jquery.pushmenu/js/jPushMenu.js'></script>";
echo "<script type='text/javascript' src='js/jquery.nanoscroller/jquery.nanoscroller.js'></script>";
echo "<script type='text/javascript' src='js/jquery.sparkline/jquery.sparkline.min.js'></script>";
echo "<script type='text/javascript' src='js/jquery.ui/jquery-ui.js'></script>";
echo "<script type='text/javascript' src='js/jquery.gritter/js/jquery.gritter.js'></script>";
echo "<script type='text/javascript' src='js/behaviour/core.js'></script>";
echo "<script src='js/bootstrap/dist/js/bootstrap.min.js'></script>";
echo "<script language='JavaScript' src='wz_jsgraphics.js'></script>";
echo "<script language='JavaScript' src='line.js'></script>";
        
        /*
        
     
echo "<html>\n";
echo "<head>\n";
echo "<!-- VERSION: $admin_version   BUILD: $build   ADD: $ADD   PHP_SELF: $PHP_SELF-->\n";
echo "<META NAME=\"ROBOTS\" CONTENT=\"NONE\">\n";
echo "<META NAME=\"COPYRIGHT\" CONTENT=\"&copy; 2014 ViciDial Group\">\n";
echo "<META NAME=\"AUTHOR\" CONTENT=\"ViciDial Group\">\n";
if ($SSnocache_admin=='1')
	{
	echo "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">\n";
	echo "<META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">\n";
	echo "<META HTTP-EQUIV=\"CACHE-CONTROL\" CONTENT=\"NO-CACHE\">\n";
	}
if ( ($SSadmin_modify_refresh > 1) and (preg_match("/^3/",$ADD)) )
	{
	$modify_refresh_set=1;
	if (preg_match("/^3/",$ADD)) {$modify_url = "$PHP_SELF?$QUERY_STRING";}
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"$SSadmin_modify_refresh;URL=$modify_url\">\n";
	}*/
echo "<title>"._QXZ("ADMIN NANPA UPDATER")."</title>";
?>
<script language="Javascript">
function StartRefresh() {
        rInt=window.setInterval(function() {RefreshNANPA("<?php echo $iframe_url; ?>")}, 10000);
}
function RefreshNANPA(spanURL) {
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	if (xmlhttp) {
		var nanpa_URL = "?"+spanURL;
		// alert(nanpa_URL);
		xmlhttp.open('POST', 'NANPA_running_processes.php');
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(nanpa_URL);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var ProcessSpanText = null;
				ProcessSpanText = xmlhttp.responseText;
				document.getElementById("running_processes").innerHTML = ProcessSpanText;
				delete xmlhttp;
			}
		}
	}
}
function ShowPastProcesses(limit) {
	if (!limit){var limitURL="";} else {var limitURL="&process_limit="+limit;}

	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	if (xmlhttp) {
		var nanpa_URL = "&show_history=1"+limitURL;
		// alert(nanpa_URL);
		xmlhttp.open('POST', 'NANPA_running_processes.php');
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(nanpa_URL);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var ProcessSpanText = null;
				ProcessSpanText = xmlhttp.responseText;
				document.getElementById("past_NANPA_scrubs").innerHTML = ProcessSpanText;
				delete xmlhttp;
			}
		}
	}
}
function openNewWindow(url) 
	{
	window.open (url,"",'width=620,height=300,scrollbars=yes,menubar=yes,address=yes');
	}

</script>
<?php
echo "</head>\n";
$ADMIN=$PHP_SELF;
$short_header=0;

$NWB = " &nbsp; <a href=\"javascript:openNewWindow('help.php";
$NWE = "')\"><IMG SRC=\"help.gif\" WIDTH=20 HEIGHT=20 BORDER=0 ALT=\"HELP\" ALIGN=TOP></A>";

echo "\n<BODY BGCOLOR=WHITE marginheight=0 marginwidth=0 leftmargin=0 topmargin=0 onLoad='RefreshNANPA(\"$iframe_url\"); StartRefresh()'>\n";

require("admin_header.php");
?>
<div id="" class="">
	<div class="cl-mcont">
	<div class="row">
	<div class="col-md-12 no-padding">
	<div class="block-flat">
		
<?php
echo "<form action='$PHP_SELF' method='get' enctype='multipart/form-data' style='margin:0px'>";
echo "&nbsp; &nbsp; <a href=\"$PHP_SELF\">"._QXZ("CLICK HERE TO REFRESH THE PAGE")."</a>\n";
?>
</div></div></div></div></div>
<div id="pcont" class="container-fluid">
	<div class="cl-mcont">
	<div class="row">
	<div class="col-md-12 no-padding">
	<div class="block-flat">
	<div class='header'><h3><?php echo _QXZ("NANPA scrub scheduler");?></h3></div>	
<?php

echo "<table class='no-border' align=left width='770' cellpadding=0 cellspacing=0 bgcolor=#D9E6FE style='margin-top:0px;'>";

if (mysqli_num_rows($schedule_rslt)>0 || (mysqli_num_rows($running_rslt)>0)) {

	if (mysqli_num_rows($schedule_rslt)>0) {
		echo "<tr ><td class='no-border'>";
                echo "<div  class='sb-collapsed' style='position:relative;'>";
		echo "<table  width='770' cellpadding=5 cellspacing=0>";
		echo "<tr><th colspan='5'><b>"._QXZ("Your scheduled NANPA scrubs")."</b></th></tr>";
		echo "<tr>";
		echo "<td align='left'  width='150'><FONT FACE=\"\"  SIZE=2><b>"._QXZ("Date/time")."</b></th>";
		echo "<td align='left'  width='300'><FONT FACE=\"\"  SIZE=2><b>"._QXZ("Lists")."</b></th>";
		echo "<td align='left'  width='100'><FONT FACE=\"\"  SIZE=2><b>"._QXZ("Update field")."</b></th>";
		echo "<td align='left'  width='150'><FONT FACE=\"\"  SIZE=2><b>"._QXZ("Conversion lists")."</b></th>";
		echo "<td align='left'  width='70'><FONT FACE=\"\"  SIZE=2>&nbsp;</th>";
		echo "</tr>";
		while ($row=mysqli_fetch_array($schedule_rslt)) {
			$trigger_array=explode(" ", $row["trigger_lines"]);
			$lists="";
			$vl_update_field="";
			$conversion_lists="";
			for ($q=1; $q<count($trigger_array); $q++) {
				if (preg_match('/--list-id=/', $trigger_array[$q]))
					{
					$data_in=explode("--list-id=", $trigger_array[$q]);
					$lists=trim($data_in[1]);
					$lists=preg_replace('/---/', "", $lists);
					$lists=preg_replace('/--/', ", ", $lists);
					}
				if (preg_match('/--vl-field-update=/', $trigger_array[$q]))
					{
					$data_in=explode("--vl-field-update=", $trigger_array[$q]);
					$vl_update_field=trim($data_in[1]);
					}
				if (preg_match('/--cellphone-list-id=/', $trigger_array[$q]))
					{
					$data_in=explode("--cellphone-list-id=", $trigger_array[$q]);
					$cellphone_list_id=trim($data_in[1]);
					$conversion_lists.="Cellphone list: $cellphone_list_id<BR>";
					}
				if (preg_match('/--landline-list-id=/', $trigger_array[$q]))
					{
					$data_in=explode("--landline-list-id=", $trigger_array[$q]);
					$landline_list_id=trim($data_in[1]);
					$conversion_lists.="Landline list: $landline_list_id<BR>";
					}
				if (preg_match('/--invalid-list-id=/', $trigger_array[$q]))
					{
					$data_in=explode("--invalid-list-id=", $trigger_array[$q]);
					$invalid_list_id=trim($data_in[1]);
					$conversion_lists.="Invalid list: $invalid_list_id<BR>";
					}
			}
			if (strlen($vl_update_field)==0) {$vl_update_field="**NONE**";}
			if (strlen($conversion_lists)==0) {$conversion_lists="**NONE**";}
			echo "<tr>";
			echo "<td align='left'><FONT FACE=\"\" COLOR=BLACK SIZE=2>$row[trigger_time]</font><BR><FONT FACE=\"\" size='1' color='red'>($row[time_until_execution] "._QXZ("until run time").")</font></td>";
			echo "<td align='left'><FONT FACE=\"\" COLOR=BLACK SIZE=2>$lists</font></td>";
			echo "<td align='left'><FONT FACE=\"\" COLOR=BLACK SIZE=2>$vl_update_field</font></td>";
			echo "<td align='left'><FONT FACE=\"\" COLOR=BLACK SIZE=2>$conversion_lists</font></td>";
			echo "<td align='center'><FONT FACE=\"\" size='1'><a class='btn btn-bdr-pink' href='$PHP_SELF?delete_trigger_id=$row[trigger_id]'>"._QXZ("DELETE")."</a></font></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</td></tr>";
	}

	if (mysqli_num_rows($running_rslt)>0) {
		echo "<tr><td>";
		$iframe_url="NANPA_running_processes.php?";
		while ($run_row=mysqli_fetch_array($running_rslt)) {
			$iframe_url.="output_codes_to_display[]=".$run_row[0];
		}
		#echo "<HR><iframe src='$iframe_url' style='width:100%;background-color:transparent;' scrolling='auto' frameborder='0' allowtransparency='true' width='100%'></iframe>";
		echo "<table  width='770' cellpadding=0 cellspacing=0><tr><td>";
		echo "<span id='running_processes' name='running_processes'>";
		echo "</span>";
		echo "</td></tr></table>";

		echo "</td></tr>";
	}
}

############################################

if ( ( (mysqli_num_rows($schedule_rslt)>0) or (mysqli_num_rows($running_rslt)>0) ) and ($block_scheduling_while_running==1) ) 
	{$do_nothing=1;} 
else 
	{

	echo "<tr><td class='no-border'>";

	echo "<table class='block-flat' width='770' cellpadding=5 cellspacing=0>";
	//echo "<tr><th colspan='3'><div class='header'><h3>"._QXZ("NANPA scrub scheduler")."</h3></div></th></tr>";
	echo "<tr>";
	echo "<td align='left' valign='top' class='no-border'><br/><FONT FACE=\"\" COLOR=BLACK SIZE=2>"._QXZ("Inactive lists").":<BR/>\n";

	$stmt="SELECT list_id, list_name from vicidial_lists where active='N' order by list_id asc";
	$rslt=mysql_to_mysqli($stmt, $link);
	echo "<select class='form-control' name='lists[]' multiple size='5'>\n";
	echo "<option value='---ALL---'>---"._QXZ("ALL LISTS")."---</option>\n";
	while ($row=mysqli_fetch_array($rslt)) 
		{
		echo "<option value='$row[0]'>$row[0] - $row[1]</option>\n";
		}

	echo "</select><br/></font>";
	echo "<FONT FACE=\"\" COLOR=BLACK SIZE=2>"._QXZ("Time until activation").":<BR/>\n";
	echo "<select  class='form-control'  name='activation_delay'>\n";
	echo "<option value='1'>1 "._QXZ("mins")."</option>\n";
	echo "<option SELECTED value='5'>5 "._QXZ("mins")."</option>\n";
	echo "<option value='10'>10 "._QXZ("mins")."</option>\n";
	echo "<option value='15'>15 "._QXZ("mins")."</option>\n";
	echo "<option value='20'>20 "._QXZ("mins")."</option>\n";
	echo "<option value='30'>30 "._QXZ("mins")."</option>\n";
	echo "<option value='45'>45 "._QXZ("mins")."</option>\n";
	echo "<option value='60'>1 "._QXZ("hour")."</option>\n";
	echo "<option value='120'>2 "._QXZ("hours")."</option>\n";
	echo "<option value='180'>3 "._QXZ("hours")."</option>\n";
	echo "<option value='240'>4 "._QXZ("hours")."</option>\n";
	echo "<option value='480'>8 "._QXZ("hours")."</option>\n";
	echo "</select></font>";
	echo "</td>";
	echo "<td align='left' valign='top' class='no-border'><br/><FONT FACE=\"\" COLOR=BLACK SIZE=2>"._QXZ("Field to update (optional)").":<BR/>\n";
	echo "<select  class='form-control' name='vl_field_update'>\n";
	$stmt="SELECT * from vicidial_list limit 1";
	$rslt=mysql_to_mysqli($stmt, $link);
	echo "<option value=''>---"._QXZ("NONE")."---</option>\n";
	while ($fieldinfo=mysqli_fetch_field($rslt)) 
		{
		$fieldname=$fieldinfo->name;
		if (!preg_match("/lead_id|list_id|status|gmt_offset_now|entry_date|modify_date|gender|entry_list_id|date_of_birth|called_since_last_reset|called_count/",$fieldname))
			{
			echo "<option value='$fieldname'>$fieldname</option>\n";
			}
		}
	echo "</select><br/></font><FONT FACE=\"\" COLOR=BLACK SIZE=2>"._QXZ("Exclusion field (optional)").":<BR/>\n";
	echo "<select  class='form-control'  name='vl_field_exclude'>\n";
	$stmt="SELECT * from vicidial_list limit 1";
	$rslt=mysql_to_mysqli($stmt, $link);
	echo "<option value=''>---"._QXZ("NONE")."---</option>\n";
	while ($fieldinfo=mysqli_fetch_field($rslt)) 
		{
		$fieldname=$fieldinfo->name;
		echo "<option value='$fieldname'>$fieldname</option>\n";
		}
	echo "</select><BR/>"._QXZ("Exclusion value").":<BR/><input  class='form-control'  type='text' name='exclusion_value' size='20' maxlength='50'></font></td>";

	echo "<td align='left' valign='top' colspan='2' class='no-border'><FONT FACE=\"\" COLOR=BLACK SIZE=2>"._QXZ("List conversions (optional)").":</font><br/>\n";

	echo "<FONT FACE=\"\" COLOR=BLACK SIZE=2>"._QXZ("Cellphone").":</font><input  class='form-control'  type='text' name='cellphone_list_id' size='5' maxlength='10'><br/>";
	
	

//	echo "<td align='left' valign='top' rowspan='2' class='no-border'>";



	echo "<FONT FACE=\"\" COLOR=BLACK SIZE=2>"._QXZ("Landline").":</font><input  class='form-control'  type='text' name='landline_list_id' size='5' maxlength='10'><br/>";
	echo "<FONT FACE=\"\" COLOR=BLACK SIZE=2>"._QXZ("Invalid").":</font><input  class='form-control'  type='text' name='invalid_list_id' size='5' maxlength='10'></td></tr>";
	echo "";
	echo "<tr align='center'><td align='center' colspan='3' class='no-border'><input type='submit' value='"._QXZ("SUBMIT")."' name='submit_form' class='btn btn-bdr-sucess'></td></tr>";
	echo "</table>";

	echo "</td></tr>";
	}
echo "<tr><td>";
echo "<table width='770' cellpadding=0 cellspacing=0 >";
echo "<tr><td align='center'>";
echo "<span id='past_NANPA_scrubs'><a name='past_scrubs' href='#past_scrubs' onClick='ShowPastProcesses(10)'>"._QXZ("View past scrubs")." &nbsp; <!--$NWB#nanpa-log$NWE--></span>";
echo "</td></tr>";
echo "</table>";
echo "</td></tr>";

echo "</table>";
echo "</form>";
echo "</body>";
echo "</html>";
?>
