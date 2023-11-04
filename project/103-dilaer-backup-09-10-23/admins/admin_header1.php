<style>
#pcont{
	width:100% !important;
}
</style>
<?php
# admin_header.php - VICIDIAL administration header
#
# Copyright (C) 2014  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
# 

# CHANGES
# 90310-0709 - First Build
# 90508-0542 - Added Call Menu option, changed script to use long PHP tags
# 90514-0605 - Added audio prompt selection functions
# 90530-1206 - Changed List Mix to allow for 40 mixes and a default populate option
# 90531-2339 - Added Dynamic options for Call Menu
# 90612-0852 - Changed relative links
# 90635-0943 - Added javascript for dynamic menus in In-Groups
# 90627-0548 - Added no-agent-no-queue options
# 90628-1016 - Added Text-to-speech options
# 90830-2213 - Added Music On Hold options
# 90904-1534 - Added launch_moh_chooser
# 90916-2334 - Added Voicemail options
# 91223-1030 - Added VIDPROMPT options for in-group routing in Call Menus
# 100311-2210 - Added callcard_enabled Admin element
# 100428-1039 - Added custom fields display
# 100507-1339 - Added copy carrier submenu
# 100616-2350 - Added VIDPROMPT call menu options
# 100728-0904 - Changed Lead Loader link to the new 3rd gen lead loader
# 100802-2127 - Changed Admin to point to links page instead of Phones listings
# 100831-2255 - Added password strength checking function
# 100914-1311 - Removed other links for reports-only users
# 101022-1323 - Added IGU_selectall function
# 101107-1133 - Added auto-refresh code
# 110215-1720 - Added the Add a new lead link
# 110322-1228 - Added user ID logged in as next to Logout link
# 110624-1439 - Added Screen Labels sub-section to Admin
# 110831-2048 - Added AC-CID to campaign submenu
# 110922-1707 - Added RA-EXTEN to campaign submenu
# 111015-2305 - Added Contacts menu to Admin
# 111106-0939 - Changes for user group restrictions
# 111116-0208 - Added ALT and ADDR3 in-group handle methods
# 120402-2134 - Changed lead loader link to fourth gen
# 121116-1412 - Added QC functionality
# 121123-0911 - Added Call Times Holidays Inbound functionality
# 121214-2238 - Added email menus
# 130221-1830 - Added Level 8 disable add option
# 130610-1040 - Finalized changing of all ereg instances to preg
# 130615-2314 - Changed Reports only and QC only headers
# 130824-2324 - Changed to mysqli PHP functions
# 140126-1022 - Added VMAIL_NO_INST option
#

//Name : Ruchita Patel
//Date : 13-april-2017
//Change : For download all reports
if((!isset($_REQUEST['file_download'])) || $_REQUEST['file_download']==0) {
$ADMIN='admin.php';

		$stmt="SELECT version,install_date,use_non_latin,webroot_writable,enable_queuemetrics_logging,queuemetrics_server_ip,queuemetrics_dbname,queuemetrics_login,queuemetrics_pass,queuemetrics_url,queuemetrics_log_id,queuemetrics_eq_prepend,vicidial_agent_disable,allow_sipsak_messages,admin_home_url,enable_agc_xfer_log,db_schema_version,auto_user_add_value,timeclock_end_of_day,timeclock_last_reset_date,vdc_header_date_format,vdc_customer_date_format,vdc_header_phone_format,vdc_agent_api_active,qc_last_pull_time,enable_vtiger_integration,vtiger_server_ip,vtiger_dbname,vtiger_login,vtiger_pass,vtiger_url,qc_features_active,outbound_autodial_active,outbound_calls_per_second,enable_tts_integration,agentonly_callback_campaign_lock,sounds_central_control_active,sounds_web_server,sounds_web_directory,active_voicemail_server,auto_dial_limit,user_territories_active,allow_custom_dialplan,db_schema_update_date,enable_second_webform,default_webphone,default_external_server_ip,webphone_url,enable_agc_dispo_log,custom_dialplan_entry,queuemetrics_loginout,callcard_enabled,queuemetrics_callstatus,default_codecs,admin_web_directory,label_title,label_first_name,label_middle_initial,label_last_name,label_address1,label_address2,label_address3,label_city,label_state,label_province,label_postal_code,label_vendor_lead_code,label_gender,label_phone_number,label_phone_code,label_alt_phone,label_security_phrase,label_email,label_comments,custom_fields_enabled,slave_db_server,reports_use_slave_db,webphone_systemkey,first_login_trigger,default_phone_registration_password,default_phone_login_password,default_server_password,admin_modify_refresh,nocache_admin,generate_cross_server_exten,queuemetrics_addmember_enabled,queuemetrics_dispo_pause,label_hide_field_logs,queuemetrics_pe_phone_append,test_campaign_calls,agents_calls_reset,default_voicemail_timezone,default_local_gmt,noanswer_log,alt_log_server_ip,alt_log_dbname,alt_log_login,alt_log_pass,tables_use_alt_log_db,did_agent_log,campaign_cid_areacodes_enabled,pllb_grouping_limit,did_ra_extensions_enabled,expanded_list_stats,contacts_enabled,call_menu_qualify_enabled,admin_list_counts,allow_voicemail_greeting,svn_revision,queuemetrics_socket,queuemetrics_socket_url,enhanced_disconnect_logging,allow_emails,level_8_disable_add,pass_hash_enabled,pass_key,pass_cost,disable_auto_dial,queuemetrics_record_hold,country_code_list_stats,reload_timestamp,queuemetrics_pause_type,frozen_server_call_clear,callback_time_24hour,allow_chats,chat_url,chat_timeout,enable_languages,language_method,meetme_enter_login_filename,meetme_enter_leave3way_filename,enable_did_entry_list_id,enable_third_webform from system_settings;";
		$rslt=mysql_to_mysqli($stmt, $link);
		$row=mysqli_fetch_row($rslt);
		$version =						$row[0];
		$install_date =					$row[1];
		$use_non_latin =				$row[2];
		$webroot_writable =				$row[3];
		$enable_queuemetrics_logging =	$row[4];
		$queuemetrics_server_ip =		$row[5];
		$queuemetrics_dbname =			$row[6];
		$queuemetrics_login =			$row[7];
		$queuemetrics_pass =			$row[8];
		$queuemetrics_url =				$row[9];
		$queuemetrics_log_id =			$row[10];
		$queuemetrics_eq_prepend =		$row[11];
		$vicidial_agent_disable =		$row[12];
		$allow_sipsak_messages =		$row[13];
		$admin_home_url =				$row[14];
		$enable_agc_xfer_log =			$row[15];
		$db_schema_version =			$row[16];
		$auto_user_add_value =			$row[17];
		$timeclock_end_of_day =			$row[18];
		$timeclock_last_reset_date =	$row[19];
		$vdc_header_date_format =		$row[20];
		$vdc_customer_date_format =		$row[21];
		$vdc_header_phone_format =		$row[22];
		$vdc_agent_api_active =			$row[23];
		$qc_last_pull_time = 			$row[24];
		$enable_vtiger_integration = 	$row[25];
		$vtiger_server_ip = 			$row[26];
		$vtiger_dbname = 				$row[27];
		$vtiger_login = 				$row[28];
		$vtiger_pass = 					$row[29];
		$vtiger_url = 					$row[30];
		$qc_features_active =			$row[31];
		$outbound_autodial_active =		$row[32];
		$outbound_calls_per_second =	$row[33];
		$enable_tts_integration =		$row[34];
		$agentonly_callback_campaign_lock = $row[35];
		$sounds_central_control_active = $row[36];
		$sounds_web_server =			$row[37];
		$sounds_web_directory =			$row[38];
		$active_voicemail_server =		$row[39];
		$auto_dial_limit =				$row[40];
		$user_territories_active =		$row[41];
		$allow_custom_dialplan =		$row[42];
		$db_schema_update_date =		$row[43];
		$enable_second_webform =		$row[44];
		$default_webphone =				$row[45];
		$default_external_server_ip =	$row[46];
		$webphone_url =					$row[47];
		$enable_agc_dispo_log =			$row[48];
		$custom_dialplan_entry =		$row[49];
		$queuemetrics_loginout =		$row[50];
		$callcard_enabled =				$row[51];
		$queuemetrics_callstatus =		$row[52];
		$default_codecs =				$row[53];
		$admin_web_directory =			$row[54];
		$label_title =					$row[55];
		$label_first_name =				$row[56];
		$label_middle_initial =			$row[57];
		$label_last_name =				$row[58];
		$label_address1 =				$row[59];
		$label_address2 =				$row[60];
		$label_address3 =				$row[61];
		$label_city =					$row[62];
		$label_state =					$row[63];
		$label_province =				$row[64];
		$label_postal_code =			$row[65];
		$label_vendor_lead_code =		$row[66];
		$label_gender =					$row[67];
		$label_phone_number =			$row[68];
		$label_phone_code =				$row[69];
		$label_alt_phone =				$row[70];
		$label_security_phrase =		$row[71];
		$label_email =					$row[72];
		$label_comments =				$row[73];
		$custom_fields_enabled =		$row[74];
		$slave_db_server =				$row[75];
		$reports_use_slave_db =			$row[76];
		$webphone_systemkey =			$row[77];
		$first_login_trigger =			$row[78];
		$default_phone_registration_password =	$row[79];
		$default_phone_login_password =	$row[80];
		$default_server_password =		$row[81];
		$admin_modify_refresh =			$row[82];
		$nocache_admin =				$row[83];
		$generate_cross_server_exten =	$row[84];
		$queuemetrics_addmember_enabled =	$row[85];
		$queuemetrics_dispo_pause =		$row[86];
		$label_hide_field_logs = 		$row[87];
		$queuemetrics_pe_phone_append = $row[88];
		$test_campaign_calls =			$row[89];
		$agents_calls_reset =			$row[90];
		$default_voicemail_timezone =	$row[91];
		$default_local_gmt =			$row[92];
		$noanswer_log =					$row[93];
		$alt_log_server_ip =			$row[94];
		$alt_log_dbname =				$row[95];
		$alt_log_login =				$row[96];
		$alt_log_pass =					$row[97];
		$tables_use_alt_log_db =		$row[98];
		$did_agent_log =				$row[99];
		$campaign_cid_areacodes_enabled = $row[100];
		$pllb_grouping_limit =			$row[101];
		$did_ra_extensions_enabled =	$row[102];
		$expanded_list_stats =			$row[103];
		$contacts_enabled =				$row[104];
		$call_menu_qualify_enabled =	$row[105];
		$admin_list_counts =			$row[106];
		$allow_voicemail_greeting =		$row[107];
		$svn_revision =					$row[108];
		$queuemetrics_socket =			$row[109];
		$queuemetrics_socket_url =		$row[110];
		$enhanced_disconnect_logging =	$row[111];
		$allow_emails =					$row[112];
		$level_8_disable_add =			$row[113];
		$pass_hash_enabled =			$row[114];
		$pass_key =						$row[115];
		$pass_cost =					$row[116];
		$disable_auto_dial =			$row[117];
		$queuemetrics_record_hold =		$row[118];
		$country_code_list_stats =		$row[119];
		$reload_timestamp =				$row[120];
		$queuemetrics_pause_type =		$row[121];
		$frozen_server_call_clear =		$row[122];
		$callback_time_24hour =			$row[123];
		$allow_chats =					$row[124];
		$chat_url =						$row[125];
		$chat_timeout =					$row[126];
		$enable_languages =				$row[127];
		$language_method =				$row[128];
		$meetme_enter_login_filename =	$row[129];
		$meetme_enter_leave3way_filename =	$row[130];
		$enable_did_entry_list_id =		$row[131];
		$enable_third_webform =			$row[132];
		
	$stmt = "SELECT use_non_latin,auto_dial_limit,user_territories_active,allow_custom_dialplan,callcard_enabled,admin_modify_refresh,nocache_admin,webroot_writable,allow_emails,contacts_enabled FROM system_settings;";
$rslt=mysql_to_mysqli($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysqli_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$non_latin =					$row[0];
	$SSauto_dial_limit =			$row[1];
	$SSuser_territories_active =	$row[2];
	$SSallow_custom_dialplan =		$row[3];
	$SScallcard_enabled =			$row[4];
	$SSadmin_modify_refresh =		$row[5];
	$SSnocache_admin =				$row[6];
	$SSwebroot_writable =			$row[7];
	$SSemail_enabled =				$row[8];
	$SScontacts_enabled =			$row[9];
	}

######################### SMALL HTML HEADER BEGIN #######################################
if($short_header)
	{
	$stmt = "SELECT use_non_latin,auto_dial_limit,user_territories_active,allow_custom_dialplan,callcard_enabled,admin_modify_refresh,nocache_admin,webroot_writable,allow_emails,contacts_enabled FROM system_settings;";
$rslt=mysql_to_mysqli($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysqli_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$non_latin =					$row[0];
	$SSauto_dial_limit =			$row[1];
	$SSuser_territories_active =	$row[2];
	$SSallow_custom_dialplan =		$row[3];
	$SScallcard_enabled =			$row[4];
	$SSadmin_modify_refresh =		$row[5];
	$SSnocache_admin =				$row[6];
	$SSwebroot_writable =			$row[7];
	$SSemail_enabled =				$row[8];
	$SScontacts_enabled =			$row[9];
	}
	
$stmt="SELECT admin_home_url,enable_tts_integration,callcard_enabled,custom_fields_enabled,allow_emails,level_8_disable_add from system_settings;";
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$admin_home_url_LU =		$row[0];
$SSenable_tts_integration = $row[1];
$SScallcard_enabled =		$row[2];
$SScustom_fields_enabled =	$row[3];
$SSemail_enabled =			$row[4];
$SSlevel_8_disable_add =	$row[5];

	?>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">


<!-- <div id='cl-wrapper' class="sb-collapsed"> -->
        <div id='cl-wrapper' class="sb-collapsed">
	<div class='col-md-12'>
        <div class='col-md-2'>
               <div class='sidebar-logo'>
                  <div class='logo' >
                        <A HREF="./admin.php"><IMG SRC="images/logo.png" WIDTH=160 HEIGHT=40 BORDER=0 ALT="System logo"></A>
                  </div>
               </div>
        </div>
        <div class='col-md-10'>
        <div id="head-nav" class="navbar navbar-default">
     <div class="container-fluid">
      <div class="navbar-collapse">
        <ul class="nav navbar-nav navbar-right user-nav">
          <li class="dropdown profile_menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="./images/profile_pic.png" /><span><?php echo $PHP_AUTH_USER ?></span> <b class="caret"></b></a>
            <ul class="dropdown-menu">
            
			<li><A HREF="/agent/timeclock.php?referrer=admin"> <?php echo _QXZ("Timeclock");?></a></li>
              <li><a href="<?php echo "admin.php"; ?>?force_logout=1"><?php echo _QXZ("Sign Out");?></a></li>

            </ul>
          </li>
        
        </ul>
        
        
        <ul class='nav navbar-nav not-nav navbar-right'>
        
	<?php 
// 	if ( ($reports_only_user < 1) and ($qc_only_user < 1) )
// 		{
	?>


	  <li class="button dropdown">
            <a href="welcome.php"><i class="fa fa-home"></i></a>
            
            </li>
           
<!--Name:sangani jagruti
Date:2014-11-12
Purpose:show top menu-->

<!--name:ruchita,date:13-dec,change:add user territories menu in top menu-->
           <li class="button dropdown">
              <a href="<?php echo "admin.php"; ?>?ADD=0A"  <?php if(strlen($users_hh)>1){ echo "class='active'";}?>><i class="fa fa-user"></i></a>
                 <ul class="dropdown-menu messages" style="margin-top:0px;">
                 
                   <li>
			<a href="<?php echo "admin.php"; ?>?ADD=0A"><?php echo _QXZ("Show Users");?></a>
		   </li>
		   
	           <li>
	                <?php if ($add_copy_disabled < 1) { ?>
	                <a href="<?php echo "admin.php"; ?>?ADD=1"><?php echo _QXZ("Add A New User");?> </a>
	           </li>
                   <li>
	            	<a href="<?php echo "admin.php"; ?>?ADD=1A"><?php echo _QXZ("Copy User");?> </a>
	           </li>
                   <li>
	            	<?php } ?>
	            	<a href="<?php echo "admin.php"; ?>?ADD=550"><?php echo _QXZ("Search For A User");?> </a>
	           </li>
		   <li>
		      	<a href="./user_stats.php?user=<?php echo $user ?>"><?php echo _QXZ("User Stats");?> </a>
		   </li>
                   <li>
	           	<a href="./user_status.php?user=<?php echo $user ?>"><?php echo _QXZ("User Status");?> </a>
	           </li>
                   <li>
	            	<a href="./AST_agent_time_sheet.php?agent=<?php echo $user ?>"><?php echo _QXZ("Time Sheet");?> </a> 
                   </li>

		  <li>
	            	<a href="./user_territories.php?agent=<?php echo $user ?>"><?php echo _QXZ("User Territories");?> </a> 
                   </li>
               </ul>
           </li> 
           <li class="button dropdown">
              <a href="<?php echo "admin.php"; ?>?ADD=10" <?php if(strlen($campaigns_hh)>1){ echo "class='active'";}?>><i class="fa fa-table"></i></a>
                   <ul class="dropdown-menu messages" style="margin-top:0px;">
                     
                       <?php  if ($sh=='basic') {$sh='list';}
			if ($sh=='detail') {$sh='list';}
			if ($sh=='dialstat') {$sh='list';}

			if ($sh=='list') {$list_sh="bgcolor=\"$subcamp_color\""; $list_fc="$subcamp_font";}
				else {$list_sh=''; $list_fc='BLACK';}
			if ($sh=='status') {$status_sh="bgcolor=\"$subcamp_color\""; $status_fc="$subcamp_font";}
				else {$status_sh=''; $status_fc='BLACK';}
			if ($sh=='hotkey') {$hotkey_sh="bgcolor=\"$subcamp_color\""; $hotkey_fc="$subcamp_font";}
				else {$hotkey_sh=''; $hotkey_fc='BLACK';}
			if ($sh=='recycle') {$recycle_sh="bgcolor=\"$subcamp_color\""; $recycle_fc="$subcamp_font";}
				else {$recycle_sh=''; $recycle_fc='BLACK';}
			if ($sh=='autoalt') {$autoalt_sh="bgcolor=\"$subcamp_color\""; $autoalt_fc="$subcamp_font";}
				else {$autoalt_sh=''; $autoalt_fc='BLACK';}
			if ($sh=='pause') {$pause_sh="bgcolor=\"$subcamp_color\""; $pause_fc="$subcamp_font";}
				else {$pause_sh=''; $pause_fc='BLACK';}
			if ($sh=='listmix') {$listmix_sh="bgcolor=\"$subcamp_color\""; $listmix_fc="$subcamp_font";}
				else {$listmix_sh=''; $listmix_fc='BLACK';}
			if ($sh=='preset') {$preset_sh="bgcolor=\"$subcamp_color\""; $preset_fc="$subcamp_font";}
				else {$preset_sh=''; $preset_fc='BLACK';}
			if ($sh=='accid') {$accid_sh="bgcolor=\"$subcamp_color\""; $accid_fc="$subcamp_font";}
				else {$accid_sh=''; $accid_fc='BLACK';}
		       ?>
		
		     	<li  <?php echo $list_sh ?>> 
                     	  	<a href="<?php echo "admin.php"; ?>?ADD=10"><?php echo _QXZ("Campaigns Main");?></a>
                   	</li>
		
			<li  <?php echo $status_sh ?>> 
                        	<a href="<?php echo "admin.php"; ?>?ADD=32"><?php echo _QXZ("Statuses");?></a>
                    </li>
	
		    <li <?php echo $hotkey_sh ?>> 
                          <a href="<?php echo "admin.php"; ?>?ADD=33"><?php echo _QXZ("HotKeys");?></a>
                    </li>
		<?php
		//if ($SSoutbound_autodial_active > 0)
			//{
			?>
			
			<li  <?php echo $recycle_sh ?>> 
                            <a href="<?php echo "admin.php"; ?>?ADD=35"><?php echo _QXZ("Lead Recycle");?></a>
                        </li>
			
                        
			<li  <?php echo $autoalt_sh ?>> 
                            <a href="<?php echo "admin.php"; ?>?ADD=36"><?php echo _QXZ("Auto-Alt Dial");?></a>
                        </li>
			
			<li <?php echo $listmix_sh ?>> 
                             <a href="<?php echo "admin.php"; ?>?ADD=39"><?php echo _QXZ("List Mix");?></a></li>
			<?php
			//}
		?>
		
			<li ALIGN=LEFT <?php echo $pause_sh ?>>  <a href="<?php echo "admin.php"; ?>?ADD=37"><?php echo _QXZ("Pause Codes");?></a></li>
		
			<li ALIGN=LEFT <?php echo $preset_sh ?>> <a href="<?php echo "admin.php"; ?>?ADD=301"><?php echo _QXZ("Presets");?></a></li>
		<?php
		//if ($SScampaign_cid_areacodes_enabled > 0)
			//{
			?>
			
			<li  <?php echo $accid_sh ?>> <a href="<?php echo "admin.php"; ?>?ADD=302"><?php echo _QXZ("AC-CID");?></a></li>
			<?php
			//}
//		 }

	    ?>
                   </ul>  
          </li>
           
           <li class="button dropdown">
                 <a href="<?php echo "admin.php"; ?>?ADD=100" <?php if(strlen($lists_hh)>1){ echo "class='active'";}?>><i class="fa fa-list-alt"></i></a>
                     <ul class="dropdown-menu messages" style="margin-top:0px;">
                      
                      	<?php    if ($LOGdelete_from_dnc > 0) {$DNClink = 'Add-Delete DNC Number';}
			else {$DNClink = 'Add DNC Number';}
			?>
			<li><li ALIGN=LEFT> 
			<a href="<?php echo "admin.php"; ?>?ADD=100"> <?php echo _QXZ("Show Lists");?> </a>
			</li><li><li ALIGN=LEFT> 
			<?php if ($add_copy_disabled < 1) { ?>
			<a href="<?php echo "admin.php"; ?>?ADD=111"> <?php echo _QXZ("Add A New List");?> </a>
			</li><li><li ALIGN=LEFT> 
			<?php } ?>
			<a href="admin_search_lead.php"> <?php echo _QXZ("Search For A Lead");?> </a>
			</li>
			<li> 
			<a href="admin_modify_lead.php"><?php echo _QXZ("Add A New Lead");?> </a>
			</li>
                        <li>
			<a href="<?php echo "admin.php"; ?>?ADD=121"> <?php echo $DNClink ?> </a>
			</li>
			<li> 
			<a href="admin_listloader_fourth_gen.php"> <?php echo _QXZ("Load New Leads");?> </a>
			<?php
			if ($SScustom_fields_enabled > 0)
				{
				?>
				</li><li>
				<a href="./admin_lists_custom.php"> <?php echo _QXZ("List Custom Fields");?> </a>
				</li><li> 
				<a href="./admin_lists_custom.php?action=COPY_FIELDS_FORM"> <?php echo _QXZ("Copy Custom Fields");?> </a>
				<?php
				}
			?>
			</li>
                 </ul>
          </li>
           <li class="button dropdown">
           		<a href="<?php echo "admin.php"; ?>?ADD=1000000" <?php if(strlen($scripts_hh)>1){ echo "class='active'";}?>><i class="fa fa-file-o"></i></a>
                           <ul class="dropdown-menu messages" style="margin-top:0px;">
                            
                               <li>  
					<a href="<?php echo "admin.php"; ?>?ADD=1000000"> <?php echo _QXZ("Show Scripts");?> </a>
					</li>
					<li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo "admin.php"; ?>?ADD=1111111"> <?php echo _QXZ("Add A New Script");?> </a>
					<?php } ?>
			      </li>
                          </ul>
          </li>
           <li class="button dropdown">
              <a href="<?php echo "admin.php"; ?>?ADD=10000000" <?php if(strlen($filters_hh)>1){ echo "class='active'";}?>><i class="fa fa-filter"></i></a>
                <ul class="dropdown-menu messages" style="margin-top:0px;">
                            
                              
				<li>  
				<a href="<?php echo "admin.php"; ?>?ADD=10000000"><?php echo _QXZ("Show Filters");?> </a>
				</li>
				<li>  
				<?php if ($add_copy_disabled < 1) { ?>
				<a href="<?php echo "admin.php"; ?>?ADD=11111111"> <?php echo _QXZ("Add A New Filter");?> </a>
				<?php } ?>
				</li>
		</ul>          
          </li>
           <li class="button dropdown">
            <a href="<?php echo "admin.php"; ?>?ADD=1000" <?php if(strlen($ingroups_hh)>1){ echo "class='active'";}?>><i class="fa fa-file-o"></i></a>
                   <ul class="dropdown-menu messages" style="margin-top:0px;">
                             
				<?php	         if ($LOGdelete_from_dnc > 0) {$FPGlink = 'Add-Delete FPG Number';}
					else {$FPGlink = 'Add FPG Number';}
					?>
					<li> 
					<a href="<?php echo "admin.php"; ?>?ADD=1000"> <?php echo _QXZ("Show In-Groups");?> </a>
					</li>
					<li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo "admin.php"; ?>?ADD=1111"> <?php echo _QXZ("Add A New In-Group");?> </a>
					</li><li> 
					<a href="<?php echo "admin.php"; ?>?ADD=1211"> <?php echo _QXZ("Copy In-Group");?> </a>
					<?php } ?>
					
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

					<?php
					if ($SSemail_enabled>0) 
						{
					?>
					<li>
					<a href="<?php echo "admin.php"; ?>?ADD=1800"> <?php echo _QXZ("Show Email Groups");?> </a>
					</li><li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo "admin.php"; ?>?ADD=1811"> <?php echo _QXZ(" Add New Email Group");?> </a>
					</li><li> 
					<a href="<?php echo "admin.php"; ?>?ADD=1911"> <?php echo _QXZ("Copy Email Group");?> </a>
					<?php } ?>
					<?php
					if ($SSchat_enabled>0) 
						{
					?>
					<li>
					<a href="<?php echo "admin.php"; ?>?ADD=1900"> <?php echo _QXZ("Show Chat Groups");?> </a>
					</li><li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo "admin.php"; ?>?ADD=18111"> <?php echo _QXZ(" Add New Chat Group");?> </a>
					</li><li> 
					<a href="<?php echo "admin.php"; ?>?ADD=19111"> <?php echo _QXZ("Copy Chat Group");?> </a>
					<?php }} ?>
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

					<?php
						}
					?>
					</li><li> 
						<a href="<?php echo "admin.php"; ?>?ADD=1300"> <?php echo _QXZ("Show DIDs");?> </a>
						</li><li>  
						<?php if ($add_copy_disabled < 1) { ?>
						<a href="<?php echo "admin.php"; ?>?ADD=1311"> <?php echo _QXZ("Add A New DID");?> </a>
						</li><li>  
						<a href="<?php echo "admin.php"; ?>?ADD=1411"> <?php echo _QXZ("Copy DID");?> </a>
						<?php
							}
						if ($SSdid_ra_extensions_enabled > 0)
							{
							?>
							</li><li> 
							<a href="<?php echo "admin.php"; ?>?ADD=1320"><?php echo _QXZ("RA Extensions");?></a>
							<?php
							}
						?>
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

						</li><li> 
						<a href="<?php echo "admin.php"; ?>?ADD=1500"> <?php echo _QXZ("Show Call Menus");?> </a>
						</li><li > 
						<?php if ($add_copy_disabled < 1) { ?>
						<a href="<?php echo "admin.php"; ?>?ADD=1511"> <?php echo _QXZ("Add A New Call Menu");?> </a>
						</li><li>  
						<a href="<?php echo "admin.php"; ?>?ADD=1611"> <?php echo _QXZ("Copy Call Menu");?> </a>
						<?php } ?>
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

						</li><li> 
					<a href="<?php echo "admin.php"; ?>?ADD=1700"> <?php echo _QXZ("Filter Phone Groups");?> </a>
					</li><li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo "admin.php"; ?>?ADD=1711"> <?php echo _QXZ("Add Filter Phone Group");?> </a>
					</li><li> 
					<?php } ?>
					<a href="<?php echo "admin.php"; ?>?ADD=171"><?php echo $FPGlink ?> </a>
					</li>
                  </ul> 
          </li>
           <li class="button dropdown">
            <a href="<?php echo "admin.php"; ?>?ADD=100000" <?php if(strlen($usergroups_hh)>1){ echo "class='active'";}?>><i class="fa fa-users"></i></a>
                  <ul class="dropdown-menu messages" style="margin-top:0px;">
                             
                             <li>  
				<a href="<?php echo "admin.php"; ?>?ADD=100000"> <?php echo _QXZ("Show User Groups");?> </a>
				</li><li> 
				<?php if ($add_copy_disabled < 1) { ?>
				<a href="<?php echo "admin.php"; ?>?ADD=111111"> <?php echo _QXZ("Add A New User Group");?> </a>
				</li><li> 
				<?php } ?>
				<a href="group_hourly_stats.php"> <?php echo _QXZ("Group Hourly Report");?> </a>
				</li><li> 
				<a href="user_group_bulk_change.php"> <?php echo _QXZ("Bulk Group Change");?> </a>
				</li>
                 </ul>
          </li>
           <li class="button dropdown">
            <a href="<?php echo "admin.php"; ?>?ADD=10000" <?php if(strlen($remoteagent_hh)>1){ echo "class='active'";}?>><i class="fa fa-user"></i></a>
                    <ul class="dropdown-menu messages" style="margin-top:0px;">
                             
                             <li>  
				<a href="<?php echo "admin.php"; ?>?ADD=10000"> <?php echo _QXZ("Show Remote Agents");?> </a>
				</li><li> 
				<?php if ($add_copy_disabled < 1) { ?>
				<a href="<?php echo "admin.php"; ?>?ADD=11111"> <?php echo _QXZ("Add New Remote Agents");?> </a>
				</li><li> 
				<?php } ?>
				<a href="<?php echo "admin.php"; ?>?ADD=12000"> <?php echo _QXZ("Show Extension Groups");?> </a>
				</li><li>
				<?php if ($add_copy_disabled < 1) { ?>
				<a href="<?php echo "admin.php"; ?>?ADD=12111"> <?php echo _QXZ("Add Extension Group");?> </a>
				<?php } ?>
				</li> 
                   </ul>  
          </li>
           <li class="button dropdown">
            <a href="<?php echo "admin.php"; ?>?ADD=999998" <?php if(strlen($admin_hh)>1){ echo "class='active'";}?>><i class="fa fa-user"></i></a>
                 <ul class="dropdown-menu messages" style="margin-top:0px;">
                            
                             <?php if ($sh=='times') {$times_sh="bgcolor=\"$times_color\""; $times_fc="$times_font";}
				else {$times_sh=''; $times_fc='BLACK';}
			if ($sh=='shifts') {$shifts_sh="bgcolor=\"$shifts_color\""; $shifts_fc="$shifts_font";}
				else {$shifts_sh=''; $shifts_fc='BLACK';}
			if ($sh=='templates') {$templates_sh="bgcolor=\"$templates_color\""; $templates_fc="$templates_font";}
				else {$templates_sh=''; $templates_fc='BLACK';}
			if ($sh=='carriers') {$carriers_sh="bgcolor=\"$carriers_color\""; $carriers_fc="$carriers_font";}
				else {$carriers_sh=''; $carriers_fc='BLACK';}
			if ($sh=='phones') {$phones_sh="bgcolor=\"$server_color\""; $phones_fc="$phones_font";}
				else {$phones_sh=''; $phones_fc='BLACK';}
			if ($sh=='server') {$server_sh="bgcolor=\"$server_color\""; $server_fc="$server_font";}
				else {$server_sh=''; $server_fc='BLACK';}
			if ($sh=='conference') {$conference_sh="bgcolor=\"$server_color\""; $conference_fc="$server_font";}
				else {$conference_sh=''; $conference_fc='BLACK';}
			if ($sh=='settings') {$settings_sh="bgcolor=\"$settings_color\""; $settings_fc="$settings_font";}
				else {$settings_sh=''; $settings_fc='BLACK';}
			if ($sh=='label') {$label_sh="bgcolor=\"$label_color\""; $label_fc="$label_font";}
				else {$label_sh=''; $label_fc='BLACK';}
			if ($sh=='status') {$status_sh="bgcolor=\"$status_color\""; $status_fc="$status_font";}
				else {$status_sh=''; $status_fc='BLACK';}
			if ($sh=='audio') {$audio_sh="bgcolor=\"$audio_color\""; $audio_fc="$audio_font";}
				else {$audio_sh=''; $audio_fc='BLACK';}
			if ($sh=='moh') {$moh_sh="bgcolor=\"$moh_color\""; $moh_fc="$moh_font";}
				else {$moh_sh=''; $moh_fc='BLACK';}
			if ($sh=='vm') {$vm_sh="bgcolor=\"$vm_color\""; $vm_fc="$vm_font";}
				else {$vm_sh=''; $vm_fc='BLACK';}
			if ($sh=='tts') {$tts_sh="bgcolor=\"$tts_color\""; $tts_fc="$tts_font";}
				else {$tts_sh=''; $tts_fc='BLACK';}
			if ($sh=='cc') {$cc_sh="bgcolor=\"$cc_color\""; $cc_fc="$cc_font";}
				else {$cc_sh=''; $cc_fc='BLACK';}
			if ($sh=='cts') {$cts_sh="bgcolor=\"$cts_color\""; $cts_fc="$cc_font";}
				else {$cts_sh=''; $cts_fc='BLACK';}
			if ($sh=='emails') {$emails_sh="bgcolor=\"$subcamp_color\""; $emails_fc="$subcamp_font";}
				else {$emails_sh=''; $emails_fc='BLACK';}


		?>
		
		<li <?php echo $times_sh ?> COLSPAN=2> 
		<a href="<?php echo "admin.php"; ?>?ADD=100000000"> <?php echo _QXZ("Call Times");?> </a>
		</li>
		<li ALIGN=LEFT <?php echo $shifts_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=130000000"> <?php echo _QXZ("Shifts");?> </a>
		</li><li ALIGN=LEFT <?php echo $phones_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=10000000000"> <?php echo _QXZ("Phones");?> </a>
		</li><li <?php echo $templates_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=130000000000"> <?php echo _QXZ("Templates");?> </a>
		</li><li ALIGN=LEFT <?php echo $carriers_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=140000000000"> <?php echo _QXZ("Carriers");?> </a>
		</li><li ALIGN=LEFT <?php echo $server_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=100000000000"> <?php echo _QXZ("Servers");?> </a>
		</li><li ALIGN=LEFT <?php echo $conference_sh ?>>  
		<a href="<?php echo "admin.php"; ?>?ADD=1000000000000"> <?php echo _QXZ("Conferences");?> </a>
		</li><li ALIGN=LEFT <?php echo $settings_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=311111111111111"> <?php echo _QXZ("System Settings");?> </a>
		</li><li ALIGN=LEFT <?php echo $label_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=180000000000"> <?php echo _QXZ("Screen Labels");?> </a>
		</li><li ALIGN=LEFT <?php echo $status_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=321111111111111"> <?php echo _QXZ("System Statuses");?> </a>
		</li>
		
		<!-- dipal -->
		<li ALIGN=LEFT <?php echo $status_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=193000000000"> <?php echo _QXZ("Status Groups");?> </a>
		</li>		
		<!----->
		
		<li ALIGN=LEFT <?php echo $vm_sh ?>>
		<a href="<?php echo "admin.php"; ?>?ADD=170000000000"> <?php echo _QXZ("Voicemail");?> </a>
		</li>
                 <li ALIGN=LEFT <?php echo $audio_sh ?>>
                        <a href="audio_store.php"> <?php echo _QXZ("Audio Store");?> </a>
                        </li>
                        <li ALIGN=LEFT <?php echo $moh_sh ?>>
                        <a href="<?php echo "admin.php"; ?>?ADD=160000000000"> <?php echo _QXZ("Music On Hold");?> </a>
                        </li>
			<?php 
		//	if ($SSenable_languages > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $languages_sh ?>> 
			<a href="admin_languages.php?ADD=163000000000"><?php echo _QXZ("Languages"); ?> </a>
			</li>
			
			<?php }?>
		<?php
		if ($SSemail_enabled > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $emails_sh ?>>  
			<a href="admin_email_accounts.php"> <?php echo _QXZ("Email Accounts");?> </a>
			</li>
		<?php }
		if ($SSenable_tts_integration > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $tts_sh ?>> 
			<a href="<?php echo "admin.php"; ?>?ADD=150000000000"> <?php echo _QXZ("Text To Speech");?> </a>
			</li>

		<?php }
		if ($SScallcard_enabled > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $cc_sh ?>>  
			<a href="callcard_admin.php"> <?php echo _QXZ("CallCard Admin");?> </a>
			</li>

		<?php }
		if ($SScontacts_enabled > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $cts_sh ?>> 
			<a href="<?php echo "admin.php"; ?>?ADD=190000000000"> <?php echo _QXZ("Contacts");?> </a>
			</li>

		<?php }?>
		
		<!-- dipal -->
		<li ALIGN=LEFT <?php echo $status_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=192000000000"> <?php echo _QXZ("Settings Containers");?> </a>
		</li>		
		<!----->
                           
                </ul> 
          </li>
       
	<?php 
// 		} 
// 	else 
// 		{ 
		?>
		
		<?php
// 		if ($reports_only_user > 0)
// 			{
			?>
			    <li class="button dropdown">
			      <a href="<?php echo "admin.php"; ?>?ADD=999999" class='active'><i class="fa fa-bar-chart-o"></i></a>
			    </li> 
			<?php
// 			}
// 		else
// 			{
// 			include 'qc/QC_header_include02.php';
// 			}
// 	}
	?>
	</ul>
	  
        <div class='font-adj'>
		<?php echo date("l F j, Y G:i:s A") ?>
	</div>	
	 </div><!--/.nav-collapse animate-collapse -->
        </div></div></div></div>
	<?php
	}
######################### SMALL HTML HEADER END #######################################


######################### FULL HTML HEADER BEGIN #######################################
else
{
if ($hh=='users') 
	{$users_hh="bgcolor =\"$users_color\""; $users_fc="$users_font"; $users_bold="$header_selected_bold";}
	else {$users_hh=''; $users_fc='WHITE'; $users_bold="$header_nonselected_bold";}
if ($hh=='campaigns') 
	{$campaigns_hh="bgcolor=\"$campaigns_color\""; $campaigns_fc="$campaigns_font"; $campaigns_bold="$header_selected_bold";}
	else {$campaigns_hh=''; $campaigns_fc='WHITE'; $campaigns_bold="$header_nonselected_bold";}
/*if ($SSoutbound_autodial_active > 0)
	{*/
	if ($hh=='lists') 
		{$lists_hh="bgcolor=\"$lists_color\""; $lists_fc="$lists_font"; $lists_bold="$header_selected_bold";}
		else {$lists_hh=''; $lists_fc='WHITE'; $lists_bold="$header_nonselected_bold";}
//	}
if ($hh=='ingroups') 
	{$ingroups_hh="bgcolor=\"$ingroups_color\""; $ingroups_fc="$ingroups_font"; $ingroups_bold="$header_selected_bold";}
	else {$ingroups_hh=''; $ingroups_fc='WHITE'; $ingroups_bold="$header_nonselected_bold";}
if ($hh=='remoteagent') 
	{$remoteagent_hh="bgcolor=\"$remoteagent_color\""; $remoteagent_fc="$remoteagent_font"; $remoteagent_bold="$header_selected_bold";}
	else {$remoteagent_hh=''; $remoteagent_fc='WHITE'; $remoteagent_bold="$header_nonselected_bold";}

if ($hh=='avataraudio') 
	{$avataraudio_hh="bgcolor=\"$avataraudio_color\""; $avataraudio_fc="$avataraudio_font"; $avataraudio_bold="$header_selected_bold";}
	else {$avataraudio_hh=''; $avataraudio_fc='WHITE'; $avataraudio_bold="$header_nonselected_bold";}

if ($hh=='usergroups') 
	{$usergroups_hh="bgcolor=\"$usergroups_color\""; $usergroups_fc="$usergroups_font"; $usergroups_bold="$header_selected_bold";}
	else {$usergroups_hh=''; $usergroups_fc='WHITE'; $usergroups_bold="$header_nonselected_bold";}
if ($hh=='scripts') 
	{$scripts_hh="bgcolor=\"$scripts_color\""; $scripts_fc="$scripts_font"; $scripts_bold="$header_selected_bold";}
	else {$scripts_hh=''; $scripts_fc='WHITE'; $scripts_bold="$header_nonselected_bold";}
if ($SSoutbound_autodial_active > 0)
	{
	if ($hh=='filters') 
		{$filters_hh="bgcolor=\"$filters_color\""; $filters_fc="$filters_font"; $filters_bold="$header_selected_bold";}
		else {$filters_hh=''; $filters_fc='WHITE'; $filters_bold="$header_nonselected_bold";}
	}
if ($hh=='admin') 
	{$admin_hh="bgcolor=\"$admin_color\""; $admin_fc="$admin_font"; $admin_bold="$header_selected_bold";}
	else {$admin_hh=''; $admin_fc='WHITE'; $admin_bold="$header_nonselected_bold";}
if ($hh=='reports') 
	{$reports_hh="bgcolor=\"$reports_color\""; $reports_fc="$reports_font"; $reports_bold="$header_selected_bold";}
	else {$reports_hh=''; $reports_fc='WHITE'; $reports_bold="$header_nonselected_bold";}
include('qc/QC_header_include01.php');

echo "</title>\n";
echo "<script language=\"Javascript\">\n";
echo "var field_name = '';\n";
echo "var user = '$PHP_AUTH_USER';\n";
echo "var pass = '$PHP_AUTH_PW';\n";
echo "var epoch = '" . date("U") . "';\n";

if ($TCedit_javascript > 0)
	{
	 ?>

	function run_submit()
		{
		calculate_hours();
		var go_submit = document.getElementById("go_submit");
		if (go_submit.disabled == false)
			{
			document.edit_log.submit();
			}
		}

	// Calculate login time
	function calculate_hours() 
		{
		var now_epoch = '<?php echo $StarTtimE ?>';
		var i=0;
		var total_percent=0;
		var SPANlogin_time = document.getElementById("LOGINlogin_time");
		var LI_date = document.getElementById("LOGINbegin_date");
		var LO_date = document.getElementById("LOGOUTbegin_date");
		var LI_datetime = LI_date.value;
		var LO_datetime = LO_date.value;
		var LI_datetime_array=LI_datetime.split(" ");
		var LI_date_array=LI_datetime_array[0].split("-");
		var LI_time_array=LI_datetime_array[1].split(":");
		var LO_datetime_array=LO_datetime.split(" ");
		var LO_date_array=LO_datetime_array[0].split("-");
		var LO_time_array=LO_datetime_array[1].split(":");

		// Calculate milliseconds since 1970 for each date string and find diff
		var LI_sec = ( ( (LI_time_array[2] * 1) * 1000) );
		var LI_min = ( ( ( (LI_time_array[1] * 1) * 1000) * 60 ) );
		var LI_hour = ( ( ( (LI_time_array[0] * 1) * 1000) * 3600 ) );
		var LI_date_epoch = Date.parse(LI_date_array[0] + '/' + LI_date_array[1] + '/' + LI_date_array[2]);
		var LI_epoch = (LI_date_epoch + LI_sec + LI_min + LI_hour);
		var LO_sec = ( ( (LO_time_array[2] * 1) * 1000) );
		var LO_min = ( ( ( (LO_time_array[1] * 1) * 1000) * 60 ) );
		var LO_hour = ( ( ( (LO_time_array[0] * 1) * 1000) * 3600 ) );
		var LO_date_epoch = Date.parse(LO_date_array[0] + '/' + LO_date_array[1] + '/' + LO_date_array[2]);
		var LO_epoch = (LO_date_epoch + LO_sec + LO_min + LO_hour);
		var temp_LI_epoch = (LI_epoch / 1000 );
		var temp_LO_epoch = (LO_epoch / 1000 );
		var epoch_diff = ( (LO_epoch - LI_epoch) / 1000 );
		var temp_diff = epoch_diff;

		document.getElementById("login_time").innerHTML = "ERROR, Please check date fields";

		var go_submit = document.getElementById("go_submit");
		go_submit.disabled = true;
		// length is a positive number and no more than 24 hours, datetime is earlier than right now
		if ( (epoch_diff < 86401) && (epoch_diff > 0) && (temp_LI_epoch < now_epoch) && (temp_LO_epoch < now_epoch) )
			{
			go_submit.disabled = false;

			hours = Math.floor(temp_diff / (60 * 60)); 
			temp_diff -= hours * (60 * 60);

			mins = Math.floor(temp_diff / 60); 
			temp_diff -= mins * 60;

			secs = Math.floor(temp_diff); 
			temp_diff -= secs;

			document.getElementById("login_time").innerHTML = hours + ":" + mins;

			var form_LI_epoch = document.getElementById("LOGINepoch");
			var form_LO_epoch = document.getElementById("LOGOUTepoch");
			form_LI_epoch.value = (LI_epoch / 1000);
			form_LO_epoch.value = (LO_epoch / 1000);
			}
		}



	<?php
	}
######################
# ADD=31 or 34 and SUB=29 for list mixes
######################
if ( ( ($ADD==34) or ($ADD==31) or ($ADD==49) ) and ($SUB==29) and ($LOGmodify_campaigns==1) and ( (preg_match("/$campaign_id/i", $LOGallowed_campaigns)) or (preg_match("/ALL\-CAMPAIGNS/i",$LOGallowed_campaigns)) ) ) 
	{

	?>
	// List Mix status add and remove
	function mod_mix_status(stage,vcl_id,entry) 
		{
		if (stage=="ALL")
			{
			var count=0;
			var ROnew_statuses = document.getElementById("ROstatus_X_" + vcl_id);

			while (count < entry)
				{
				var old_statuses = document.getElementById("status_" + count + "_" + vcl_id);
				var ROold_statuses = document.getElementById("ROstatus_" + count + "_" + vcl_id);

				old_statuses.value = ROnew_statuses.value;
				ROold_statuses.value = ROnew_statuses.value;
				count++;
				}
			}
		else
			{
			if (stage=="EMPTY")
				{
				var count=0;
				var ROnew_statuses = document.getElementById("ROstatus_X_" + vcl_id);

				while (count < entry)
					{
					var old_statuses = document.getElementById("status_" + count + "_" + vcl_id);
					var ROold_statuses = document.getElementById("ROstatus_" + count + "_" + vcl_id);
					
					if (ROold_statuses.value.length < 3)
						{
						old_statuses.value = ROnew_statuses.value;
						ROold_statuses.value = ROnew_statuses.value;
						}
					count++;
					}
				}

			else
				{
				var mod_status = document.getElementById("dial_status_" + entry + "_" + vcl_id);
				if (mod_status.value.length < 1)
					{
					alert("You must select a status first");
					}
				else
					{
					var old_statuses = document.getElementById("status_" + entry + "_" + vcl_id);
					var ROold_statuses = document.getElementById("ROstatus_" + entry + "_" + vcl_id);
					var MODstatus = new RegExp(" " + mod_status.value + " ","g");
					if (stage=="ADD")
						{
						if (old_statuses.value.match(MODstatus))
							{
							alert("The status " + mod_status.value + " is already present");
							}
						else
							{
							var new_statuses = " " + mod_status.value + "" + old_statuses.value;
							old_statuses.value = new_statuses;
							ROold_statuses.value = new_statuses;
							mod_status.value = "";
							}
						}
					if (stage=="REMOVE")
						{
						var MODstatus = new RegExp(" " + mod_status.value + " ","g");
						old_statuses.value = old_statuses.value.replace(MODstatus, " ");
						ROold_statuses.value = ROold_statuses.value.replace(MODstatus, " ");
						}
					}
				}
			}
		}

	// List Mix percent difference calculation and warning message
	function mod_mix_percent(vcl_id,entries) 
		{
		var i=0;
		var total_percent=0;
		var percent_diff='';
		while(i < entries)
			{
			var mod_percent_field = document.getElementById("percentage_" + i + "_" + vcl_id);
			temp_percent = mod_percent_field.value * 1;
			total_percent = (total_percent + temp_percent);
			i++;
			}

		var mod_diff_percent = document.getElementById("PCT_DIFF_" + vcl_id);
		percent_diff = (total_percent - 100);
		if (percent_diff > 0)
			{
			percent_diff = '+' + percent_diff;
			}
		var mix_list_submit = document.getElementById("submit_" + vcl_id);
		if ( (percent_diff > 0) || (percent_diff < 0) )
			{
			mix_list_submit.disabled = true;
			document.getElementById("ERROR_" + vcl_id).innerHTML = "<font color=red><B>The Difference % must be 0</B></font>";
			}
		else
			{
			mix_list_submit.disabled = false;
			document.getElementById("ERROR_" + vcl_id).innerHTML = "";
			}

		mod_diff_percent.value = percent_diff;
		}

	function submit_mix(vcl_id,entries) 
		{
		var h=1;
		var j=1;
		var list_mix_container='';
		var mod_list_mix_container_field = document.getElementById("list_mix_container_" + vcl_id);
		while(h < 41)
			{
			var i=0;
			while(i < entries)
				{
				var mod_list_id_field = document.getElementById("list_id_" + i + "_" + vcl_id);
				var mod_priority_field = document.getElementById("priority_" + i + "_" + vcl_id);
				var mod_percent_field = document.getElementById("percentage_" + i + "_" + vcl_id);
				var mod_statuses_field = document.getElementById("status_" + i + "_" + vcl_id);
				if (mod_priority_field.value==h)
					{
					list_mix_container = list_mix_container + mod_list_id_field.value + "|" + j + "|" + mod_percent_field.value + "|" + mod_statuses_field.value + "|:";
					j++;
					}
				i++;
				}
			h++;
			}
		mod_list_mix_container_field.value = list_mix_container;
		var form_to_submit = document.getElementById("" + vcl_id);
		form_to_submit.submit();
		}
	<?php
	}
	?>
	var weak = new Image();
	weak.src = "images/weak.png";
	var medium = new Image();
	medium.src = "images/medium.png";
	var strong = new Image();
	strong.src = "images/strong.png";

	function pwdChanged(pwd_field_str, pwd_img_str) 
		{
		var pwd_field = document.getElementById(pwd_field_str);
		var pwd_img = document.getElementById(pwd_img_str);

		var strong_regex = new RegExp( "^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])", "g" );
		var medium_regex = new RegExp( "^(?=.{6,})(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9]))).*$", "g" );

		if (strong_regex.test(pwd_field.value) ) 
			{
			if (pwd_img.src != strong.src)
				{pwd_img.src = strong.src;}
			} 
		else if (medium_regex.test( pwd_field.value) ) 
			{
			if (pwd_img.src != medium.src) 
				{pwd_img.src = medium.src;}
			}
		else 
			{
			if (pwd_img.src != weak.src) 
				{pwd_img.src = weak.src;}
			}
		}

	function openNewWindow(url) 
		{
		window.open (url,"",'width=620,height=300,scrollbars=yes,menubar=yes,address=yes');
		}
	function scriptInsertField() 
		{
		openField = '--A--';
		closeField = '--B--';
		var textBox = document.scriptForm.script_text;
		var scriptIndex = document.getElementById("selectedField").selectedIndex;
		var insValue =  document.getElementById('selectedField').options[scriptIndex].value;
		if (document.selection) 
			{
			//IE
			textBox = document.scriptForm.script_text;
			insValue = document.scriptForm.selectedField.options[document.scriptForm.selectedField.selectedIndex].text;
			textBox.focus();
			sel = document.selection.createRange();
			sel.text = openField + insValue + closeField;
			} 
		else if (textBox.selectionStart || textBox.selectionStart == 0) 
			{
			//Mozilla
			var startPos = textBox.selectionStart;
			var endPos = textBox.selectionEnd;
			textBox.value = textBox.value.substring(0, startPos)
			+ openField + insValue + closeField
			+ textBox.value.substring(endPos, textBox.value.length);
			}
		else 
			{
			textBox.value += openField + insValue + closeField;
			}
		}

	<?php

#### Javascript for auto-generate of user ID Button
if ( ($SSadmin_modify_refresh > 1) and (preg_match("/^3|^4/",$ADD)) )
	{
	?>
	var ar_seconds=<?php echo "$SSadmin_modify_refresh;"; ?>

	function modify_refresh_display()
		{
		if (ar_seconds > 0)
			{
			ar_seconds = (ar_seconds - 1);
			document.getElementById("refresh_countdown").innerHTML = "<font color=black> screen refresh in: " + ar_seconds + " seconds</font>";
			setTimeout("modify_refresh_display()",1000);
			}
		}

	<?php
	}

#### Javascript for auto-generate of user ID Button
if ( ($ADD==1) or ($ADD=="1A") )
	{
	?>

	function user_auto()
		{
		var user_toggle = document.getElementById("user_toggle");
		var user_field = document.getElementById("user");
		if (user_toggle.value < 1)
			{
			user_field.value = 'AUTOGENERATEZZZ';
			user_field.disabled = true;
			user_toggle.value = 1;
			}
		else
			{
			user_field.value = '';
			user_field.disabled = false;
			user_toggle.value = 0;
			}
		}

	function user_submit()
		{
		var user_field = document.getElementById("user");
		user_field.disabled = false;
		document.userform.submit();
		}

	<?php
	}

#### Javascript for auto-generate of user ID Button
else
	{
	?>
	function launch_chooser(fieldname,stage,vposition)
		{
		var audiolistURL = "./non_agent_api.php";
		var audiolistQuery = "source=admin&function=sounds_list&user=" + user + "&pass=" + pass + "&format=selectframe&stage=" + stage + "&comments=" + fieldname;
		var Iframe_content = '<IFRAME SRC="' + audiolistURL + '?' + audiolistQuery + '"  style="width:740;height:440;background-color:#e8e8e8;" scrolling="NO" frameborder="0" allowtransparency="true" id="audio_chooser_frame' + epoch + '" name="audio_chooser_frame" width="740" height="460" STYLE="z-index:2"> </IFRAME>';

		document.getElementById("audio_chooser_span").style.position = "absolute";
		document.getElementById("audio_chooser_span").style.left = "220px";
		document.getElementById("audio_chooser_span").style.top = vposition + "px";
		document.getElementById("audio_chooser_span").style.visibility = 'visible';
		document.getElementById("audio_chooser_span").innerHTML = Iframe_content;
		}

	function launch_moh_chooser(fieldname,stage,vposition)
		{
		var audiolistURL = "./non_agent_api.php";
		var audiolistQuery = "source=admin&function=moh_list&user=" + user + "&pass=" + pass + "&format=selectframe&stage=" + stage + "&comments=" + fieldname;
		var Iframe_content = '<IFRAME SRC="' + audiolistURL + '?' + audiolistQuery + '"  style="width:740;height:440;background-color:#e8e8e8;" scrolling="NO" frameborder="0" allowtransparency="true" id="audio_chooser_frame' + epoch + '" name="audio_chooser_frame" width="740" height="460" STYLE="z-index:2"> </IFRAME>';

		document.getElementById("audio_chooser_span").style.position = "absolute";
		document.getElementById("audio_chooser_span").style.left = "220px";
		document.getElementById("audio_chooser_span").style.top = vposition + "px";
		document.getElementById("audio_chooser_span").style.visibility = 'visible';
		document.getElementById("audio_chooser_span").innerHTML = Iframe_content;
		}

	function launch_vm_chooser(fieldname,stage,vposition)
		{
		var audiolistURL = "./non_agent_api.php";
		var audiolistQuery = "source=admin&function=vm_list&user=" + user + "&pass=" + pass + "&format=selectframe&stage=" + stage + "&comments=" + fieldname;
		var Iframe_content = '<IFRAME SRC="' + audiolistURL + '?' + audiolistQuery + '"  style="width:740;height:440;background-color:#e8e8e8;" scrolling="NO" frameborder="0" allowtransparency="true" id="audio_chooser_frame' + epoch + '" name="audio_chooser_frame" width="740" height="460" STYLE="z-index:2"> </IFRAME>';

		document.getElementById("audio_chooser_span").style.position = "absolute";
		document.getElementById("audio_chooser_span").style.left = "220px";
		document.getElementById("audio_chooser_span").style.top = vposition + "px";
		document.getElementById("audio_chooser_span").style.visibility = 'visible';
		document.getElementById("audio_chooser_span").innerHTML = Iframe_content;
		}

	function close_chooser()
		{
		document.getElementById("audio_chooser_span").style.visibility = 'hidden';
		document.getElementById("audio_chooser_span").innerHTML = '';
		}


	function user_submit()
		{
		var user_field = document.getElementById("user");
		user_field.disabled = false;
		document.userform.submit();
		}

	<?php
	}

### Javascript for shift end-time calculation and display
if ( ($ADD==131111111) or ($ADD==331111111) or ($ADD==431111111) )
	{
	?>
	function shift_time()
		{
			
			
		var start_time = document.getElementById("shift_start_time");
		var end_time = document.getElementById("shift_end_time");
		var length = document.getElementById("shift_length");

		var st_value = start_time.value;
		var et_value = end_time.value;
		while (st_value.length < 4) {st_value = "0" + st_value;}
		while (et_value.length < 4) {et_value = "0" + et_value;}
		var st_hour=st_value.substring(0,2);
		var st_min=st_value.substring(2,4);
		var et_hour=et_value.substring(0,2);
		var et_min=et_value.substring(2,4);
		if (st_hour > 23) {st_hour = 23;}
		if (et_hour > 23) {et_hour = 23;}
		if (st_min > 59) {st_min = 59;}
		if (et_min > 59) {et_min = 59;}
		start_time.value = st_hour + "" + st_min;
		end_time.value = et_hour + "" + et_min;

		var start_time_hour=start_time.value.substring(0,2);
		var start_time_min=start_time.value.substring(2,4);
		var end_time_hour=end_time.value.substring(0,2);
		var end_time_min=end_time.value.substring(2,4);
		start_time_hour=(start_time_hour * 1);
		start_time_min=(start_time_min * 1);
		end_time_hour=(end_time_hour * 1);
		end_time_min=(end_time_min * 1);

		if (start_time.value == end_time.value)
			{
			var shift_length = '24:00';
			}
		else
			{
			if ( (start_time_hour > end_time_hour) || ( (start_time_hour == end_time_hour) && (start_time_min > end_time_min) ) )
				{
				var shift_hour = ( (24 - start_time_hour) + end_time_hour);
				var shift_minute = ( (60 - start_time_min) + end_time_min);
				if (shift_minute >= 60) 
					{
					shift_minute = (shift_minute - 60);
					}
				else
					{
					shift_hour = (shift_hour - 1);
					}
				}
			else
				{
				var shift_hour = (end_time_hour - start_time_hour);
				var shift_minute = (end_time_min - start_time_min);
				}
			if (shift_minute < 0) 
				{
				shift_minute = (shift_minute + 60);
				shift_hour = (shift_hour - 1);
				}

			if (shift_hour < 10) {shift_hour = '0' + shift_hour}
			if (shift_minute < 10) {shift_minute = '0' + shift_minute}
			var shift_length = shift_hour + ':' + shift_minute;
			}
	//	alert(start_time_hour + '|' + start_time_min + '|' + end_time_hour + '|' + end_time_min + '|--|' + shift_hour + ':' + shift_minute + '|' + shift_length + '|');

		length.value = shift_length;
		}

	<?php
	}




### Javascript for shift end-time calculation and display
if ( ($ADD==3111) or ($ADD==4111) or ($ADD==5111) or ($ADD==3811) or ($ADD==4811) or ($ADD==5811) )
	{
	?>
	function IGU_selectall(temp_count,temp_fields)
		{
		var fields_array=temp_fields.split('|');
		var inc=0;
		while (temp_count >= inc)
			{
			if (fields_array[inc].length > 0)
				{
				document.getElementById(fields_array[inc]).checked=true;
			//	document.admin_form.fields_array[inc].checked=true;
				}
			inc++;
			}
		}

	<?php
	}


$stmt="SELECT menu_id,menu_name from vicidial_call_menu $whereLOGadmin_viewable_groupsSQL order by menu_id limit 10000;";
$rslt=mysql_to_mysqli($stmt, $link);
$menus_to_print = mysqli_num_rows($rslt);
$call_menu_list='';
$i=0;
while ($i < $menus_to_print)
	{
	$row=mysqli_fetch_row($rslt);
	$call_menu_list .= "<option value=\"$row[0]\">$row[0] - $row[1]</option>";
	$i++;
	}

### select list contents generation for dynamic route displays in call menu and in-group screens
if ( ($ADD==3511) or ($ADD==2511) or ($ADD==2611) or ($ADD==4511) or ($ADD==5511) or ($ADD==3111) or ($ADD==2111) or ($ADD==2011) or ($ADD==4111) or ($ADD==5111) )
	{
	$stmt="SELECT did_pattern,did_description,did_route from vicidial_inbound_dids where did_active='Y' $LOGadmin_viewable_groupsSQL order by did_pattern;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$dids_to_print = mysqli_num_rows($rslt);
	$did_list='';
	$i=0;
	while ($i < $dids_to_print)
		{
		$row=mysqli_fetch_row($rslt);
		$did_list .= "<option value=\"$row[0]\">$row[0] - $row[1] - $row[2]</option>";
		$i++;
		}

	$stmt="SELECT group_id,group_name from vicidial_inbound_groups where active='Y' and group_id NOT LIKE \"AGENTDIRECT%\" $LOGadmin_viewable_groupsSQL order by group_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$ingroups_to_print = mysqli_num_rows($rslt);
	$ingroup_list='';
	$i=0;
	while ($i < $ingroups_to_print)
		{
		$row=mysqli_fetch_row($rslt);
		$ingroup_list .= "<option value=\"$row[0]\">$row[0] - $row[1]</option>";
		$i++;
		}

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns where active='Y' $LOGallowed_campaignsSQL order by campaign_id;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$IGcampaigns_to_print = mysqli_num_rows($rslt);
	$IGcampaign_id_list='';
	$i=0;
	while ($i < $IGcampaigns_to_print)
		{
		$row=mysqli_fetch_row($rslt);
		$IGcampaign_id_list .= "<option value=\"$row[0]\">$row[0] - $row[1]</option>";
		$i++;
		}

	$IGhandle_method_list = '<option>CID</option><option>CIDLOOKUP</option><option>CIDLOOKUPRL</option><option>CIDLOOKUPRC</option><option>CIDLOOKUPALT</option><option>CIDLOOKUPRLALT</option><option>CIDLOOKUPRCALT</option><option>CIDLOOKUPADDR3</option><option>CIDLOOKUPRLADDR3</option><option>CIDLOOKUPRCADDR3</option><option>CIDLOOKUPALTADDR3</option><option>CIDLOOKUPRLALTADDR3</option><option>CIDLOOKUPRCALTADDR3</option><option>ANI</option><option>ANILOOKUP</option><option>ANILOOKUPRL</option><option>VIDPROMPT</option><option>VIDPROMPTLOOKUP</option><option>VIDPROMPTLOOKUPRL</option><option>VIDPROMPTLOOKUPRC</option><option>CLOSER</option><option>3DIGITID</option><option>4DIGITID</option><option>5DIGITID</option><option>10DIGITID</option>';

	$IGsearch_method_list = '<option value="LB">LB - Load Balanced</option><option value="LO">LO - Load Balanced Overflow</option><option value="SO">SO - Server Only</option>';

	$stmt="SELECT login,server_ip,extension,dialplan_number from phones where active='Y' $LOGadmin_viewable_groupsSQL order by login,server_ip;";
	$rslt=mysql_to_mysqli($stmt, $link);
	$phones_to_print = mysqli_num_rows($rslt);
	$phone_list='';
	$i=0;
	while ($i < $phones_to_print)
		{
		$row=mysqli_fetch_row($rslt);
		$phone_list .= "<option value=\"$row[0]\">$row[0] - $row[1] - $row[2] - $row[3]</option>";
		$i++;
		}
	}

# dynamic options for options in call_menu screen
if ( ($ADD==3511) or ($ADD==2511) or ($ADD==2611) or ($ADD==4511) or ($ADD==5511) )
	{

	?>
	function call_menu_option(option,route,value,value_context,chooser_height)
		{
		var call_menu_list = '<?php echo $call_menu_list ?>';
		var ingroup_list = '<?php echo $ingroup_list ?>';
		var IGcampaign_id_list = '<?php echo $IGcampaign_id_list ?>';
		var IGhandle_method_list = '<?php echo $IGhandle_method_list ?>';
		var IGsearch_method_list = '<?php echo $IGsearch_method_list ?>';
		var did_list = '<?php echo $did_list ?>';
		var phone_list = '<?php echo $phone_list ?>';
		var selected_value = '';
		var selected_context = '';
		var new_content = '';

		var select_list = document.getElementById("option_route_" + option);
		var selected_route = select_list.value;
		var span_to_update = document.getElementById("option_value_value_context_" + option);
		
		if (selected_route=='CALLMENU')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value='';}
			new_content = '<br><div style="margin-top:30px"><span class="col-lg-1" name=option_route_link_' + option + ' id=option_route_link_' + option + "><a href=\"./admin.php?ADD=3511&menu_id=" + value + "\">Call Menu: </a></span><div class='col-lg-3'><select class='form-control' size=1 name=option_route_value_" + option + " id=option_route_value_" + option + " onChange=\"call_menu_link('" + option + "','CALLMENU');\">" + call_menu_list + "\n" + selected_value + '</select></div></div>';
			}
		if (selected_route=='INGROUP')
			{
			if (value_context.length < 10)
				{value_context = 'CID,LB,998,TESTCAMP,1,,,,';}
			var value_context_split =		value_context.split(",");
			var IGhandle_method =			value_context_split[0];
			var IGsearch_method =			value_context_split[1];
			var IGlist_id =					value_context_split[2];
			var IGcampaign_id =				value_context_split[3];
			var IGphone_code =				value_context_split[4];
			var IGvid_enter_filename =		value_context_split[5];
			var IGvid_id_number_filename =	value_context_split[6];
			var IGvid_confirm_filename =	value_context_split[7];
			var IGvid_validate_digits =		value_context_split[8];

			if (route == selected_route)
				{
				selected_value = '<option SELECTED>' + value + '</option>';
				}

			new_content = '<input type=hidden name=option_route_value_context_' + option + ' id=option_route_value_context_' + option + ' value="' + selected_value + '">';
			new_content = new_content + '<BR><div class="col-lg-12" style="text-align:left;"><span class="col-lg-2" name=option_route_link_' + option + 'id=option_route_link_' + option + '>';
			new_content = new_content + '<BR><BR><a href="admin.php?ADD=3111&group_id=' + value + '">In-Group:</a> </span>';
			new_content = new_content + '<BR><BR><div class="col-lg-3"><select class="form-control" size=1 name=option_route_value_' + option + ' id=option_route_value_' + option + ' onChange="call_menu_link("' + option + '","INGROUP");">';
			new_content = new_content + '' + ingroup_list + "\n" + selected_value + '</select></div>';
			
			new_content = new_content + '<div class="col-lg-2"> Handle Method:</div> <div class="col-lg-3"><select class="form-control" size=1 name=IGhandle_method_' + option + ' id=IGhandle_method_' + option + '>';
			new_content = new_content + '' + IGhandle_method_list + "\n" + '<option SELECTED>' + IGhandle_method + '</select></div>';			
			new_content = new_content + '<div class="col-lg-1"><a href="javascript:openNewWindow(\'admin.php?ADD=99999#vicidial_call_menu-ingroup_settings\')"><IMG SRC="help.gif" WIDTH=20 HEIGHT=20 BORDER=0 ALT="HELP" ALIGN=TOP></a></div></div>';
			
			new_content = new_content + '<BR><BR><div class="col-lg-12" style="text-align:left;"><div class="col-lg-2">Search Method:</div> <div class="col-lg-3"><select class="form-control" size=1 name=IGsearch_method_' + option + ' id=IGsearch_method_' + option + '>';
			new_content = new_content + '' + IGsearch_method_list + "\n" + '<option SELECTED>' + IGsearch_method + '</select></div>';
			
			new_content = new_content + '<BR><div class="col-lg-2">List ID:</div><div class="col-lg-3"><input class="form-control" type=text size=5 maxlength=14 name=IGlist_id_' + option + ' id=IGlist_id_' + option + ' value="' + IGlist_id + '"></div></div>';
			
			new_content = new_content + '<BR><div class="col-lg-12" style="text-align:left;"><div class="col-lg-2">Campaign ID:</div><div class="col-lg-3"> <select class="form-control" size=1 name=IGcampaign_id_' + option + ' id=IGcampaign_id_' + option + '>';
			new_content = new_content + '' + IGcampaign_id_list + "\n" + '<option SELECTED>' + IGcampaign_id + '</select></div>';
			
			new_content = new_content + '<BR><div class="col-lg-2">Phone Code:</div><div class="col-lg-3"><input class="form-control" type=text size=5 maxlength=14 name=IGphone_code_' + option + ' id=IGphone_code_' + option + ' value="' + IGphone_code + '"></div></div>';
			
			new_content = new_content + "<BR><BR><div class='col-lg-12' style='text-align:left;'><div class='col-lg-2'>VID Enter Filename:</div><div class='col-lg-3'><input class='form-control' type=text name=IGvid_enter_filename_" + option + " id=IGvid_enter_filename_" + option + " size=40 maxlength=255 value=\"" + IGvid_enter_filename + "\"></div><div class='col-lg-2'><a href=\"javascript:launch_chooser('IGvid_enter_filename_" + option + "','date'," + chooser_height + ");\">audio chooser</a></div></div>";
			
			new_content = new_content + "<BR><BR><div class='col-lg-12' style='text-align:left;'><div class='col-lg-2'>VID ID Number Filename:</div><div class='col-lg-3'><input class='form-control' type=text name=IGvid_id_number_filename_" + option + " id=IGvid_id_number_filename_" + option + " size=40 maxlength=255 value=\"" + IGvid_id_number_filename + "\"></div><div class='col-lg-2'><a href=\"javascript:launch_chooser('IGvid_id_number_filename_" + option + "','date'," + chooser_height + ");\">audio chooser</a></div></div>";
			
			new_content = new_content + "<BR><BR><div class='col-lg-12' style='text-align:left;'><div class='col-lg-2'>VID Confirm Filename:</div><div class='col-lg-3'><input class='form-control' type=text name=IGvid_confirm_filename_" + option + " id=IGvid_confirm_filename_" + option + " size=40 maxlength=255 value=\"" + IGvid_confirm_filename + "\"></div><div class='col-lg-2'><a href=\"javascript:launch_chooser('IGvid_confirm_filename_" + option + "','date'," + chooser_height + ");\">audio chooser</a></div></div>";
			
			new_content = new_content + '<BR><BR><div class="col-lg-12" style="text-align:left;"><div class="col-lg-2">VID Digits:</div><div class="col-lg-3"><input class="form-control" type=text size=3 maxlength=3 name=IGvid_validate_digits_' + option + ' id=IGvid_validate_digits_' + option + ' value="' + IGvid_validate_digits + '"></div></div>';
			}
		if (selected_route=='DID')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value='';}
			new_content = '<br><div style="margin-top:30px"><span class="col-lg-1" name=option_route_link_' + option + ' id=option_route_link_' + option + '><a href="admin.php?ADD=3311&did_pattern=' + value + '">DID:</a> </span><div class="col-lg-3"><select class="form-control" size=1 name=option_route_value_' + option + ' id=option_route_value_' + option + " onChange=\"call_menu_link('" + option + "','DID');\">" + did_list + "\n" + selected_value + '</select></div></div>';
			}
		if (selected_route=='HANGUP')
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value='vm-goodbye';}
			new_content = "<br><div style='margin-top:30px'><div class='col-lg-1'>Audio File:</div><div class='col-lg-3'><input class='form-control' type=text name=option_route_value_" + option + " id=option_route_value_" + option + " size=40 maxlength=255 value=\"" + selected_value + "\"></div><div class='col-lg-2'><a href=\"javascript:launch_chooser('option_route_value_" + option + "','date'," + chooser_height + ");\">audio chooser</a></div></div>";
			}
		if (selected_route=='EXTENSION')
			{
			if (route == selected_route)
				{
				selected_value = value;
				selected_context = value_context;
				}
			else
				{value='8304';}
			new_content = "<br><div style='margin-top:30px'><div class='col-lg-1'>Extension:</div><div class='col-lg-3'><input class='form-control' type=text name=option_route_value_" + option + " id=option_route_value_" + option + " size=20 maxlength=255 value=\"" + selected_value + "\"></div> &nbsp; <div class='col-lg-1'>Context:</div><div class='col-lg-3'><input class='form-control' type=text name=option_route_value_context_" + option + " id=option_route_value_context_" + option + " size=20 maxlength=255 value=\"" + selected_context + "\"></div></div>";
			}
		if (selected_route=='PHONE')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value='';}
			new_content = '<br><div style="margin-top:30px"><div class="col-lg-1">Phone:</div><div class="col-lg-4"><select class="form-control" size=1 name=option_route_value_' + option + ' id=option_route_value_' + option + '>' + phone_list + "\n" + selected_value + '</select></div></div>';
			}
		if ( (selected_route=='VOICEMAIL') || (selected_route=='VMAIL_NO_INST') )
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value='';}
			new_content = "<br><div style='margin-top:30px'><div class='col-lg-1'>Voicemail Box:</div><div class='col-lg-3'><input class='form-control' type=text name=option_route_value_" + option + " id=option_route_value_" + option + " size=12 maxlength=10 value=\"" + selected_value + "\"></div><div class='col-lg-2'><a href=\"javascript:launch_vm_chooser('option_route_value_" + option + "','date'," + chooser_height + ");\">voicemail chooser</a></div></div>";
			}
		if (selected_route=='AGI')
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value='';}
			new_content = "<br><div style='margin-top:30px'><div class='col-lg-1'>AGI:</div><div class='col-lg-3'><input class='form-control' type=text name=option_route_value_" + option + " id=option_route_value_" + option + " size=80 maxlength=255 value=\"" + selected_value + "\"></div></div>";
			}

		if (new_content.length < 1)
			{new_content = selected_route}

		span_to_update.innerHTML = new_content;
		}

	function call_menu_link(option,route)
		{
		var selected_value = '';
		var new_content = '';

		var select_list = document.getElementById("option_route_value_" + option);
		var selected_value = select_list.value;
		var span_to_update = document.getElementById("option_route_link_" + option);

		if (route=='CALLMENU')
			{
			new_content = "<a href=\"admin.php?ADD=3511&menu_id=" + selected_value + "\">Call Menu:</a>";
			}
		if (route=='INGROUP')
			{
			new_content = "<a href=\"admin.php?ADD=3111&group_id=" + selected_value + "\">In-Group:</a>";
			}
		if (route=='DID')
			{
			new_content = "<a href=\"admin.php?ADD=3311&did_pattern=" + selected_value + "\">DID:</a>";
			}

		if (new_content.length < 1)
			{new_content = selected_route}

		span_to_update.innerHTML = new_content;
		}

	<?php
	}

### Javascript for dynamic in-group option value entries
if ( ($ADD==2811) or ($ADD==3811) or ($ADD==3111) or ($ADD==2111) or ($ADD==2011) or ($ADD==4111) or ($ADD==5111) )
	{

	?>
	function dynamic_call_action(option,route,value,chooser_height)
		{
		var call_menu_list = '<?php echo $call_menu_list ?>';
		var ingroup_list = '<?php echo $ingroup_list ?>';
		var IGcampaign_id_list = '<?php echo $IGcampaign_id_list ?>';
		var IGhandle_method_list = '<?php echo $IGhandle_method_list ?>';
		var IGsearch_method_list = '<?php echo $IGsearch_method_list ?>';
		var did_list = '<?php echo $did_list ?>';
		var selected_value = '';
		var selected_context = '';
		var new_content = '';

		var select_list = document.getElementById(option + "");
		var selected_route = select_list.value;
		var span_to_update = document.getElementById(option + "_value_span");
		
		if (selected_route=='CALLMENU')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value = '';}
			new_content = '<span name=' + option + '_value_link id=' + option + '_value_link><a href="./admin.php?ADD=3511&menu_id=' + value + '">Call Menu: </a></span><select size=1 name=' + option + '_value id=' + option + "_value onChange=\"dynamic_call_action_link('" + option + "','CALLMENU');\">" + call_menu_list + "\n" + selected_value + '</select>';
			}
		if (selected_route=='INGROUP')
			{
			if ( (route != selected_route) || (value.length < 10) )
				{value = 'SALESLINE,CID,LB,998,TESTCAMP,1,,,,';}
			var value_split = value.split(",");
			var IGgroup_id =				value_split[0];
			var IGhandle_method =			value_split[1];
			var IGsearch_method =			value_split[2];
			var IGlist_id =					value_split[3];
			var IGcampaign_id =				value_split[4];
			var IGphone_code =				value_split[5];
			var IGvid_enter_filename =		value_split[6];
			var IGvid_id_number_filename =	value_split[7];
			var IGvid_confirm_filename =	value_split[8];
			var IGvid_validate_digits =		value_split[9];

			if (route == selected_route)
				{
				selected_value = '<option SELECTED>' + IGgroup_id + '</option>';
				}

			new_content = new_content + '<span name=' + option + '_value_link id=' + option + '_value_link><a href="admin.php?ADD=3111&group_id=' + IGgroup_id + '">In-Group:</a> </span> ';
			new_content = new_content + '<select size=1 name=IGgroup_id_' + option + ' id=IGgroup_id_' + option + " onChange=\"dynamic_call_action_link('IGgroup_id_" + option + "','INGROUP');\">";
			new_content = new_content + '' + ingroup_list + "\n" + selected_value + '</select>';
			new_content = new_content + ' &nbsp; Handle Method: <select size=1 name=IGhandle_method_' + option + ' id=IGhandle_method_' + option + '>';
			new_content = new_content + '' + IGhandle_method_list + "\n" + '<option SELECTED>' + IGhandle_method + '</select>';
			new_content = new_content + '<BR>Search Method: <select size=1 name=IGsearch_method_' + option + ' id=IGsearch_method_' + option + '>';
			new_content = new_content + '' + IGsearch_method_list + "\n" + '<option SELECTED>' + IGsearch_method + '</select>';
			new_content = new_content + ' &nbsp; List ID: <input type=text size=5 maxlength=14 name=IGlist_id_' + option + ' id=IGlist_id_' + option + ' value="' + IGlist_id + '">';
			new_content = new_content + '<BR>Campaign ID: <select size=1 name=IGcampaign_id_' + option + ' id=IGcampaign_id_' + option + '>';
			new_content = new_content + '' + IGcampaign_id_list + "\n" + '<option SELECTED>' + IGcampaign_id + '</select>';
			new_content = new_content + ' &nbsp; Phone Code: <input type=text size=5 maxlength=14 name=IGphone_code_' + option + ' id=IGphone_code_' + option + ' value="' + IGphone_code + '">';
		//	new_content = new_content + "<BR> &nbsp; VID Enter Filename: <input type=text name=IGvid_enter_filename_" + option + " id=IGvid_enter_filename_" + option + " size=40 maxlength=255 value=\"" + IGvid_enter_filename + "\"> <a href=\"javascript:launch_chooser('IGvid_enter_filename_" + option + "','date'," + chooser_height + ");\">audio chooser</a>";
		//	new_content = new_content + "<BR> &nbsp; VID ID Number Filename: <input type=text name=IGvid_id_number_filename_" + option + " id=IGvid_id_number_filename_" + option + " size=40 maxlength=255 value=\"" + IGvid_id_number_filename + "\"> <a href=\"javascript:launch_chooser('IGvid_id_number_filename_" + option + "','date'," + chooser_height + ");\">audio chooser</a>";
		//	new_content = new_content + "<BR> &nbsp; VID Confirm Filename: <input type=text name=IGvid_confirm_filename_" + option + " id=IGvid_confirm_filename_" + option + " size=40 maxlength=255 value=\"" + IGvid_confirm_filename + "\"> <a href=\"javascript:launch_chooser('IGvid_confirm_filename_" + option + "','date'," + chooser_height + ");\">audio chooser</a>";
		//	new_content = new_content + ' &nbsp; VID Digits: <input type=text size=3 maxlength=3 name=IGvid_validate_digits_' + option + ' id=IGvid_validate_digits_' + option + ' value="' + IGvid_validate_digits + '">';

			}
		if (selected_route=='DID')
			{
			if (route == selected_route)
				{
				selected_value = '<option SELECTED value="' + value + '">' + value + "</option>\n";
				}
			else
				{value = '';}
			new_content = '<span name=' + option + '_value_link id=' + option + '_value_link><a href="admin.php?ADD=3311&did_pattern=' + value + '">DID:</a> </span><select size=1 name=' + option + '_value id=' + option + "_value onChange=\"dynamic_call_action_link('" + option + "','DID');\">" + did_list + "\n" + selected_value + '</select>';
			}
		if (selected_route=='MESSAGE')
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value = 'nbdy-avail-to-take-call|vm-goodbye';}
			new_content = "Audio File: <input type=text name=" + option + "_value id=" + option + "_value size=40 maxlength=255 value=\"" + value + "\"> <a href=\"javascript:launch_chooser('" + option + "_value','date'," + chooser_height + ");\">audio chooser</a>";
			}
		if (selected_route=='EXTENSION')
			{
			if ( (route != selected_route) || (value.length < 3) )
				{value = '8304,default';}
			var value_split = value.split(",");
			var EXextension =	value_split[0];
			var EXcontext =		value_split[1];

			new_content = "Extension: <input type=text name=EXextension_" + option + " id=EXextension_" + option + " size=20 maxlength=255 value=\"" + EXextension + "\"> &nbsp; Context: <input type=text name=EXcontext_" + option + " id=EXcontext_" + option + " size=20 maxlength=255 value=\"" + EXcontext + "\"> ";
			}
		if ( (selected_route=='VOICEMAIL') || (selected_route=='VMAIL_NO_INST') )
			{
			if (route == selected_route)
				{
				selected_value = value;
				}
			else
				{value = '101';}
			new_content = "Voicemail Box: <input type=text name=" + option + "_value id=" + option + "_value size=12 maxlength=10 value=\"" + value + "\"> <a href=\"javascript:launch_vm_chooser('" + option + "_value','date'," + chooser_height + ");\">voicemail chooser</a>";
			}

		if (new_content.length < 1)
			{new_content = selected_route}

		span_to_update.innerHTML = new_content;
		}

	function dynamic_call_action_link(field,route)
		{
		var selected_value = '';
		var new_content = '';

		if ( (route=='CALLMENU') || (route=='DID') )
			{var select_list = document.getElementById(field + "_value");}
		if (route=='INGROUP')
			{
			var select_list = document.getElementById(field + "");
			field = field.replace(/IGgroup_id_/, "");
			}
		var selected_value = select_list.value;
		var span_to_update = document.getElementById(field + "_value_link");

		if (route=='CALLMENU')
			{
			new_content = '<a href="admin.php?ADD=3511&menu_id=' + selected_value + '">Call Menu:</a>';
			}
		if (route=='INGROUP')
			{
			new_content = '<a href="admin.php?ADD=3111&group_id=' + selected_value + '">In-Group:</a>';
			}
		if (route=='DID')
			{
			new_content = '<a href="admin.php?ADD=3311&did_pattern=' + selected_value + '">DID:</a>';
			}

		if (new_content.length < 1)
			{new_content = selected_route}

		span_to_update.innerHTML = new_content;
		}

	<?php
	}
echo "</script>\n";

##### BEGIN - bar chart CSS style #####
?>

<style type="text/css">
<!--
.auraltext
	{
	position: absolute;
	font-size: 0;
	left: -1000px;
	}
.chart_td
	{background-image: url(images/gridline58.gif); background-repeat: repeat-x; background-position: left top; border-left: 1px solid #e5e5e5; border-right: 1px solid #e5e5e5; padding:0; border-bottom: 1px solid #e5e5e5; background-color:transparent;}

-->
</style>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

<?php
##### END - bar chart CSS style #####

echo "</head>\n";
if ( ($SSadmin_modify_refresh > 1) and (preg_match("/^3|^4/",$ADD)) )
	{
	echo "<BODY class='cbp-spmenu-push' BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0 onLoad=\"modify_refresh_display();\">\n";
        echo "<div id='cl-wrapper' class='sb-collapsed' >";  
	}
else
	{
	echo "<BODY class='cbp-spmenu-push' BGCOLOR=white marginheight=0 marginwidth=0 leftmargin=0 topmargin=0>\n";
        echo "<div id='cl-wrapper' class='sb-collapsed' >";  
	}
	
echo "<!-- INTERNATIONALIZATION-LINKS-PLACEHOLDER-VICIDIAL -->\n";



$stmt="SELECT admin_home_url,enable_tts_integration,callcard_enabled,custom_fields_enabled,allow_emails,level_8_disable_add,allow_chats,enable_languages from system_settings;";
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$admin_home_url_LU =		$row[0];
$SSenable_tts_integration = $row[1];
$SScallcard_enabled =		$row[2];
$SScustom_fields_enabled =	$row[3];
$SSemail_enabled =			$row[4];
$SSlevel_8_disable_add =	$row[5];
$SSchat_enabled =			$row[6];
$SSenable_languages =		$row[7];


?>

<div class="col-md-12">
<div class="col-md-2">
 <div class="sidebar-logo">
            <div class="logo">
                <A HREF="./admin.php"><IMG style="margin-top:10px;" SRC="images/logo.png" WIDTH=160 HEIGHT=40 BORDER=0 ALT="System logo"></A>
            </div>
          </div>
</div>
<div class="col-md-10">
          
<div id="head-nav" class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-collapse">
        <ul class="nav navbar-nav navbar-right user-nav">
          <li class="dropdown profile_menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="./images/profile_pic.png" /><span><?php echo $PHP_AUTH_USER ?></span> <b class="caret"></b></a>
            <ul class="dropdown-menu">
			  <li><A HREF="<?php echo $ADMIN ?>?ADD=999989 "> <?php echo _QXZ("Change language");?></a></li>
				
              <li><A HREF="../agc/timeclock.php?referrer=admin"> <?php echo _QXZ("Timeclock");?></a></li>
              <li><a href="<?php echo "manager_chat_interface.php"; ?>"><?php echo _QXZ("Chat");?></a></li>
              
              <li><a href="<?php echo $ADMIN ?>?force_logout=1"><?php echo _QXZ("Sign Out");?></a></li>

            </ul>
          </li>
        </ul>	
		
        <!--<ul class="nav navbar-nav not-nav navbar-right">  --
	  <li class="button dropdown">
            <a href="welcome.php"><i class="fa fa-home"></i></a>
            
            </li>
           <?$selected_menu=0;?>
           <li class="button dropdown ">
              <a href="<?php echo $ADMIN ?>?ADD=0A"  <?php if(strlen($users_hh)>1){ $selected_menu=1;echo "class='active'";}?>><i class="fa fa-user"></i></a>
                 <ul class="dropdown-menu messages " style="margin-top:0px;">
                 
                   <li>
			<a  href="<?php echo $ADMIN ?>?ADD=0A"><?php echo _QXZ("Show Users");?></a>
		   </li>
	           <li>
	                <?php if ($add_copy_disabled < 1) { ?>
	                <a href="<?php echo $ADMIN ?>?ADD=1"><?php echo _QXZ("Add A New User");?> </a>
	           </li>
                   <li>
	            	<a href="<?php echo $ADMIN ?>?ADD=1A"><?php echo _QXZ("Copy User");?> </a>
	           </li>
                   <li>
	            	<?php } ?>
	            	<a href="<?php echo $ADMIN ?>?ADD=550"><?php echo _QXZ("Search For A User");?> </a>
	           </li>
		   <li>
		      	<a href="./user_stats.php?user=<?php echo $user ?>"><?php echo _QXZ("User Stats");?> </a>
		   </li>
                   <li>
	           	<a href="./user_status.php?user=<?php echo $user ?>"><?php echo _QXZ("User Status");?> </a>
	           </li>
                   <li>
	            	<a href="./AST_agent_time_sheet.php?agent=<?php echo $user ?>"><?php echo _QXZ("Time Sheet");?> </a> 
                   </li>
		   <li>
	 		 <a href="./user_territories.php?agent=<?php echo $user ?>"><?php echo _QXZ("User Territories");?> </a> 
		   </li>
               </ul>
           </li> 
           <li class="button dropdown">
              <a href="<?php echo $ADMIN ?>?ADD=10" <?php if(strlen($campaigns_hh)>1){$selected_menu=1; echo "class='active'";}?>><i class="fa fa-table"></i></a>
                   <ul class="dropdown-menu messages" style="margin-top:0px;">
                     
                       <?php  if ($sh=='basic') {$sh='list';}
			if ($sh=='detail') {$sh='list';}
			if ($sh=='dialstat') {$sh='list';}

			if ($sh=='list') {$list_sh="bgcolor=\"$subcamp_color\""; $list_fc="$subcamp_font";}
				else {$list_sh=''; $list_fc='BLACK';}
			if ($sh=='status') {$status_sh="bgcolor=\"$subcamp_color\""; $status_fc="$subcamp_font";}
				else {$status_sh=''; $status_fc='BLACK';}
			if ($sh=='hotkey') {$hotkey_sh="bgcolor=\"$subcamp_color\""; $hotkey_fc="$subcamp_font";}
				else {$hotkey_sh=''; $hotkey_fc='BLACK';}
			if ($sh=='recycle') {$recycle_sh="bgcolor=\"$subcamp_color\""; $recycle_fc="$subcamp_font";}
				else {$recycle_sh=''; $recycle_fc='BLACK';}
			if ($sh=='autoalt') {$autoalt_sh="bgcolor=\"$subcamp_color\""; $autoalt_fc="$subcamp_font";}
				else {$autoalt_sh=''; $autoalt_fc='BLACK';}
			if ($sh=='pause') {$pause_sh="bgcolor=\"$subcamp_color\""; $pause_fc="$subcamp_font";}
				else {$pause_sh=''; $pause_fc='BLACK';}
			if ($sh=='listmix') {$listmix_sh="bgcolor=\"$subcamp_color\""; $listmix_fc="$subcamp_font";}
				else {$listmix_sh=''; $listmix_fc='BLACK';}
			if ($sh=='preset') {$preset_sh="bgcolor=\"$subcamp_color\""; $preset_fc="$subcamp_font";}
				else {$preset_sh=''; $preset_fc='BLACK';}
			if ($sh=='accid') {$accid_sh="bgcolor=\"$subcamp_color\""; $accid_fc="$subcamp_font";}
				else {$accid_sh=''; $accid_fc='BLACK';}
		       ?>
		
		     	<li  <?php echo $list_sh ?>> 
                     	  	<a href="<?php echo $ADMIN ?>?ADD=10"><?php echo _QXZ("Campaigns Main");?></a>
                   	</li>
		
			<li  <?php echo $status_sh ?>> 
                        	<a href="<?php echo $ADMIN ?>?ADD=32"><?php echo _QXZ("Statuses");?></a>
                    </li>
	
		    <li <?php echo $hotkey_sh ?>> 
                          <a href="<?php echo $ADMIN ?>?ADD=33"><?php echo _QXZ("HotKeys");?></a>
                    </li>
		<?php
		if ($SSoutbound_autodial_active > 0)
			{
			?>
			
			<li  <?php echo $recycle_sh ?>> 
                            <a href="<?php echo $ADMIN ?>?ADD=35"><?php echo _QXZ("Lead Recycle");?></a>
                        </li>
			
                        
			<li  <?php echo $autoalt_sh ?>> 
                            <a href="<?php echo $ADMIN ?>?ADD=36"><?php echo _QXZ("Auto-Alt Dial");?></a>
                        </li>
			
			<li <?php echo $listmix_sh ?>> 
                             <a href="<?php echo $ADMIN ?>?ADD=39"><?php echo _QXZ("List Mix");?></a></li>
			<?php
			}
		?>
		
			<li ALIGN=LEFT <?php echo $pause_sh ?>>  <a href="<?php echo $ADMIN ?>?ADD=37"><?php echo _QXZ("Pause Codes");?></a></li>
		
			<li ALIGN=LEFT <?php echo $preset_sh ?>> <a href="<?php echo $ADMIN ?>?ADD=301"><?php echo _QXZ("Presets");?></a></li>
		<?php
		if ($SScampaign_cid_areacodes_enabled > 0)
			{
			?>
			
			<li  <?php echo $accid_sh ?>> <a href="<?php echo $ADMIN ?>?ADD=302"><?php echo _QXZ("AC-CID");?></a></li>
			<?php
			}
//		 }

	    ?>
                   </ul>  
          </li>
           
           <li class="button dropdown">
                 <a href="<?php echo $ADMIN ?>?ADD=100" <?php if(strlen($lists_hh)>1){$selected_menu=1; echo "class='active'";}?>><i class="fa fa-list-alt"></i></a>
                     <ul class="dropdown-menu messages" style="margin-top:0px;">
                      
                      	<?php    if ($LOGdelete_from_dnc > 0) {$DNClink = 'Add-Delete DNC Number';}
			else {$DNClink = 'Add DNC Number';}
			?>
			<li><li ALIGN=LEFT> 
			<a href="<?php echo $ADMIN ?>?ADD=100"> <?php echo _QXZ("Show Lists");?> </a>
			</li><li><li ALIGN=LEFT> 
			<?php if ($add_copy_disabled < 1) { ?>
			<a href="<?php echo $ADMIN ?>?ADD=111"> <?php echo _QXZ("Add A New List");?> </a>
			</li><li><li ALIGN=LEFT> 
			<?php } ?>
			<a href="admin_search_lead.php"> <?php echo _QXZ("Search For A Lead");?> </a>
			</li>
			<li> 
			<a href="admin_modify_lead.php"><?php echo _QXZ("Add A New Lead");?> </a>
			</li>
                        <li>
			<a href="<?php echo $ADMIN ?>?ADD=121"> <?php echo $DNClink ?> </a>
			</li>
			<li> 
			<a href="./admin_listloader_fourth_gen.php"> <?php echo _QXZ("Load New Leads");?> </a>
			<?php
			if ($SScustom_fields_enabled > 0)
				{
				?>
				</li><li>
				<a href="./admin_lists_custom.php"> <?php echo _QXZ("List Custom Fields");?> </a>
				</li><li> 
				<a href="./admin_lists_custom.php?action=COPY_FIELDS_FORM"> <?php echo _QXZ("Copy Custom Fields");?> </a>
				<?php
				}
			?>
			</li>
                 </ul>
          </li>
           <li class="button dropdown">
           		<a href="<?php echo $ADMIN ?>?ADD=1000000" <?php if(strlen($scripts_hh)>1){$selected_menu=1; echo "class='active'";}?>><i class="fa fa-file-o"></i></a>
                           <ul class="dropdown-menu messages" style="margin-top:0px;">
                            
                               <li>  
					<a href="<?php echo $ADMIN ?>?ADD=1000000"> <?php echo _QXZ("Show Scripts");?> </a>
					</li>
					<li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo $ADMIN ?>?ADD=1111111"> <?php echo _QXZ("Add A New Script");?> </a>
					<?php } ?>
			      </li>
                          </ul>
          </li>
           <li class="button dropdown">
              <a href="<?php echo $ADMIN ?>?ADD=10000000" <?php if(strlen($filters_hh)>1){ $selected_menu=1;echo "class='active'";}?>><i class="fa fa-filter"></i></a>
                <ul class="dropdown-menu messages" style="margin-top:0px;">
                            
                              
				<li>  
				<a href="<?php echo $ADMIN ?>?ADD=10000000"><?php echo _QXZ("Show Filters");?> </a>
				</li>
				<li>  
				<?php if ($add_copy_disabled < 1) { ?>
				<a href="<?php echo $ADMIN ?>?ADD=11111111"> <?php echo _QXZ("Add A New Filter");?> </a>
				<?php } ?>
				</li>
		</ul>          
          </li>
           <li class="button dropdown">
            <a href="<?php echo $ADMIN ?>?ADD=1000" <?php if(strlen($ingroups_hh)>1){ $selected_menu=1;echo "class='active'";}?>><i class="fa fa-file-o"></i></a>
                   <ul class="dropdown-menu messages" style="margin-top:0px;">
                             
				<?php	         if ($LOGdelete_from_dnc > 0) {$FPGlink = 'Add-Delete FPG Number';}
					else {$FPGlink = 'Add FPG Number';}
					?>
					<li> 
					<a href="<?php echo $ADMIN ?>?ADD=1000"> <?php echo _QXZ("Show In-Groups");?> </a>
					</li>
					<li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo $ADMIN ?>?ADD=1111"> <?php echo _QXZ("Add A New In-Group");?> </a>
					</li><li> 
					<a href="<?php echo $ADMIN ?>?ADD=1211"> <?php echo _QXZ("Copy In-Group");?> </a>
					<?php } ?>

<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <!--<hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>


					<?php
					if ($SSemail_enabled>0) 
						{
					?>
					<li>
					<a href="<?php echo $ADMIN ?>?ADD=1800"> <?php echo _QXZ("Show Email Groups");?> </a>
					</li><li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo $ADMIN ?>?ADD=1811"> <?php echo _QXZ(" Add New Email Group");?> </a>
					</li><li> 
					<a href="<?php echo $ADMIN ?>?ADD=1911"> <?php echo _QXZ("Copy Email Group");?> </a>
					<?php } ?>
					
					
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <!--<hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

					<?php
						}
					?>
							<?php
		if ($SSchat_enabled>0) 
			{
		?>
		</li><li>
					<a href="<?php echo $ADMIN ?>?ADD=1900"> <?php echo _QXZ("Show Chat Groups");?> </a>
					</li><li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo $ADMIN ?>?ADD=18111"> <?php echo _QXZ(" Add New Chat Group");?> </a>
					</li><li> 
					<a href="<?php echo $ADMIN ?>?ADD=19111"> <?php echo _QXZ("Copy Chat Group");?> </a>
		<?php } ?>
		<hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>
		<?php
			}
		?>
					</li><li> 
						<a href="<?php echo $ADMIN ?>?ADD=1300"> <?php echo _QXZ("Show DIDs");?> </a>
						</li><li>  
						<?php if ($add_copy_disabled < 1) { ?>
						<a href="<?php echo $ADMIN ?>?ADD=1311"> <?php echo _QXZ("Add A New DID");?> </a>
						</li><li>  
						<a href="<?php echo $ADMIN ?>?ADD=1411"> <?php echo _QXZ("Copy DID");?> </a>
						<?php
							}
						if ($SSdid_ra_extensions_enabled > 0)
							{
							?>
							</li><li> 
							<a href="<?php echo $ADMIN ?>?ADD=1320"><?php echo _QXZ("RA Extensions");?></a>
							<?php
							}
						?>
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <!--<hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

						</li><li> 
						<a href="<?php echo $ADMIN ?>?ADD=1500"> <?php echo _QXZ("Show Call Menus");?> </a>
						</li><li > 
						<?php if ($add_copy_disabled < 1) { ?>
						<a href="<?php echo $ADMIN ?>?ADD=1511"> <?php echo _QXZ("Add A New Call Menu");?> </a>
						</li><li>  
						<a href="<?php echo $ADMIN ?>?ADD=1611"> <?php echo _QXZ("Copy Call Menu");?> </a>
						<?php } ?>
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <!--<hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

						</li><li> 
					<a href="<?php echo $ADMIN ?>?ADD=1700"> <?php echo _QXZ("Filter Phone Groups");?> </a>
					</li><li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo $ADMIN ?>?ADD=1711"> <?php echo _QXZ("Add Filter Phone Group");?> </a>
					</li><li> 
					<?php } ?>
					<a href="<?php echo $ADMIN ?>?ADD=171"><?php echo $FPGlink ?> </a>
					</li>
                  </ul> 
          </li>
           <li class="button dropdown">
            <a href="<?php echo $ADMIN ?>?ADD=100000" <?php if(strlen($usergroups_hh)>1){$selected_menu=1; echo "class='active'";}?>><i class="fa fa-users"></i></a>
                  <ul class="dropdown-menu messages" style="margin-top:0px;">
                             
                             <li>  
				<a href="<?php echo $ADMIN ?>?ADD=100000"> <?php echo _QXZ("Show User Groups");?> </a>
				</li><li> 
				<?php if ($add_copy_disabled < 1) { ?>
				<a href="<?php echo $ADMIN ?>?ADD=111111"> <?php echo _QXZ("Add A New User Group");?> </a>
				</li><li> 
				<?php } ?>
				<a href="group_hourly_stats.php"> <?php echo _QXZ("Group Hourly Report");?> </a>
				</li><li> 
				<a href="user_group_bulk_change.php"> <?php echo _QXZ("Bulk Group Change");?> </a>
				</li>
                 </ul>
          </li>
           <li class="button dropdown">
            <a href="<?php echo $ADMIN ?>?ADD=10000" <?php if(strlen($remoteagent_hh)>1){$selected_menu=1; echo "class='active'";}?>><i class="fa fa-user"></i></a>
                    <ul class="dropdown-menu messages" style="margin-top:0px;">
                             
                             <li>  
				<a href="<?php echo $ADMIN ?>?ADD=10000"> <?php echo _QXZ("Show Remote Agents");?> </a>
				</li><li> 
				<?php if ($add_copy_disabled < 1) { ?>
				<a href="<?php echo $ADMIN ?>?ADD=11111"> <?php echo _QXZ("Add New Remote Agents");?> </a>
				</li><li> 
				<?php } ?>
				<a href="<?php echo $ADMIN ?>?ADD=12000"> <?php echo _QXZ("Show Extension Groups");?> </a>
				</li><li>
				<?php if ($add_copy_disabled < 1) { ?>
				<a href="<?php echo $ADMIN ?>?ADD=12111"> <?php echo _QXZ("Add Extension Group");?> </a>
				<?php } ?>
				</li> 
                   </ul>  
          </li>
           <li class="button dropdown">
            <a href="<?php echo $ADMIN ?>?ADD=999998" <?php if(strlen($admin_hh)>1){$selected_menu=1; echo "class='active'";}?>><i class="fa fa-user"></i></a>
                 <ul class="dropdown-menu messages" style="margin-top:0px;">
                            
                             <?php if ($sh=='times') {$times_sh="bgcolor=\"$times_color\""; $times_fc="$times_font";}
				else {$times_sh=''; $times_fc='BLACK';}
			if ($sh=='shifts') {$shifts_sh="bgcolor=\"$shifts_color\""; $shifts_fc="$shifts_font";}
				else {$shifts_sh=''; $shifts_fc='BLACK';}
			if ($sh=='templates') {$templates_sh="bgcolor=\"$templates_color\""; $templates_fc="$templates_font";}
				else {$templates_sh=''; $templates_fc='BLACK';}
			if ($sh=='carriers') {$carriers_sh="bgcolor=\"$carriers_color\""; $carriers_fc="$carriers_font";}
				else {$carriers_sh=''; $carriers_fc='BLACK';}
			if ($sh=='phones') {$phones_sh="bgcolor=\"$server_color\""; $phones_fc="$phones_font";}
				else {$phones_sh=''; $phones_fc='BLACK';}
			if ($sh=='server') {$server_sh="bgcolor=\"$server_color\""; $server_fc="$server_font";}
				else {$server_sh=''; $server_fc='BLACK';}
			if ($sh=='conference') {$conference_sh="bgcolor=\"$server_color\""; $conference_fc="$server_font";}
				else {$conference_sh=''; $conference_fc='BLACK';}
			if ($sh=='settings') {$settings_sh="bgcolor=\"$settings_color\""; $settings_fc="$settings_font";}
				else {$settings_sh=''; $settings_fc='BLACK';}
			if ($sh=='label') {$label_sh="bgcolor=\"$label_color\""; $label_fc="$label_font";}
				else {$label_sh=''; $label_fc='BLACK';}
			if ($sh=='status') {$status_sh="bgcolor=\"$status_color\""; $status_fc="$status_font";}
				else {$status_sh=''; $status_fc='BLACK';}
			if ($sh=='audio') {$audio_sh="bgcolor=\"$audio_color\""; $audio_fc="$audio_font";}
				else {$audio_sh=''; $audio_fc='BLACK';}
			if ($sh=='moh') {$moh_sh="bgcolor=\"$moh_color\""; $moh_fc="$moh_font";}
				else {$moh_sh=''; $moh_fc='BLACK';}
			if ($sh=='vm') {$vm_sh="bgcolor=\"$vm_color\""; $vm_fc="$vm_font";}
				else {$vm_sh=''; $vm_fc='BLACK';}
			if ($sh=='tts') {$tts_sh="bgcolor=\"$tts_color\""; $tts_fc="$tts_font";}
				else {$tts_sh=''; $tts_fc='BLACK';}
			if ($sh=='cc') {$cc_sh="bgcolor=\"$cc_color\""; $cc_fc="$cc_font";}
				else {$cc_sh=''; $cc_fc='BLACK';}
			if ($sh=='cts') {$cts_sh="bgcolor=\"$cts_color\""; $cts_fc="$cc_font";}
				else {$cts_sh=''; $cts_fc='BLACK';}
			if ($sh=='emails') {$emails_sh="bgcolor=\"$subcamp_color\""; $emails_fc="$subcamp_font";}
				else {$emails_sh=''; $emails_fc='BLACK';}


		?>
		
		<li <?php echo $times_sh ?> COLSPAN=2> 
		<a href="<?php echo $ADMIN ?>?ADD=100000000"> <?php echo _QXZ("Call Times");?> </a>
		</li>
		<li ALIGN=LEFT <?php echo $shifts_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=130000000"> <?php echo _QXZ("Shifts");?> </a>
		</li><li ALIGN=LEFT <?php echo $phones_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=10000000000"> <?php echo _QXZ("Phones");?> </a>
		</li><li <?php echo $templates_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=130000000000"> <?php echo _QXZ("Templates");?> </a>
		</li><li BGCOLOR=<?php echo $admin_color ?>><li ALIGN=LEFT <?php echo $carriers_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=140000000000"> <?php echo _QXZ("Carriers");?> </a></li>
		</li><li ALIGN=LEFT <?php echo $server_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=100000000000"> <?php echo _QXZ("Servers");?> </a>
		</li><li ALIGN=LEFT <?php echo $conference_sh ?>>  
		<a href="<?php echo $ADMIN ?>?ADD=1000000000000"> <?php echo _QXZ("Conferences");?> </a>
		</li><li ALIGN=LEFT <?php echo $settings_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=311111111111111"> <?php echo _QXZ("System Settings");?> </a>
		</li><li ALIGN=LEFT <?php echo $label_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=180000000000"> <?php echo _QXZ("Screen Labels");?> </a>
		</li><li ALIGN=LEFT <?php echo $status_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=321111111111111"> <?php echo _QXZ("System Statuses");?> </a>
		</li><li ALIGN=LEFT <?php echo $vm_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=170000000000"> <?php echo _QXZ("Voicemail");?> </a>
		</li>
		<?php
		if ($SSemail_enabled > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $emails_sh ?>>  
			<a href="admin_email_accounts.php"> <?php echo _QXZ("Email Accounts");?> </a>
			</li>
		<?php }
		if ( ($sounds_central_control_active > 0) or ($SSsounds_central_control_active > 0) )
			{ ?>
			<li ALIGN=LEFT <?php echo $audio_sh ?>> 
			<a href="audio_store.php"> <?php echo _QXZ("Audio Store");?> </a>
			</li>
			<li ALIGN=LEFT <?php echo $moh_sh ?>> 
			<a href="<?php echo $ADMIN ?>?ADD=160000000000"> <?php echo _QXZ("Music On Hold");?> </a>
			</li>
					<?php 
			if ($SSenable_languages > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $languages_sh ?>> 
			<a href="admin_languages.php?ADD=163000000000"><?php echo _QXZ("Languages"); ?> </a>
			</li>
			
			<?php }?>
		<?php }
		if ($SSenable_tts_integration > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $tts_sh ?>> 
			<a href="<?php echo $ADMIN ?>?ADD=150000000000"> <?php echo _QXZ("Text To Speech");?> </a>
			</li>

		<?php }
		if ($SScallcard_enabled > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $cc_sh ?>>  
			<a href="callcard_admin.php"> <?php echo _QXZ("CallCard Admin");?> </a>
			</li>

		<?php }
		if ($SScontacts_enabled > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $cts_sh ?>> 
			<a href="<?php echo $ADMIN ?>?ADD=190000000000"> <?php echo _QXZ("Contacts");?> </a>
			</li>

		<?php }?>
                           
                </ul> 
          </li>
          <li class="button dropdown">
	
            <a href="<?php echo $ADMIN ?>?ADD=999999" <?php if(strlen($reports_hh)>1 || $selected_menu==0){ echo "class='active'";}?>><i class="fa fa-bar-chart-o"></i></a>
            
          </li> 
          				
        </ul>-->
        <span class="col-md-4 pull-right">
		<span class="pull-right spacer"><?php echo date("l F j, Y G:i:s A") ?></span>
	    </span>
      </div><!--/.nav-collapse animate-collapse -->
    </div>
  </div></div>
</div>

<div class='col-md-12'>

        <div class="cl-sidebar border">
	<div class="cl-navblock">
	<div class="menu-space">
	<div class="content">           
	<?php
	if ( ($reports_only_user < 1) and ($qc_only_user < 1) )
		{
	?>
	<!-- USERS NAVIGATION -->
<ul class='cl-vnavigation'>
	<li <?php echo $users_hh;if(strlen($users_hh)>1){ echo "class='active'";} ?>>
	      <a href="<?php echo $ADMIN ?>?ADD=0A">
		 <div class="col-xs-1"><i class="fa fa-user"></i></div>
                 <div class="col-xs-9"><span><?php echo _QXZ("Users");?></span></div>
              </a>
	
	<ul class="sub-menu">
	<?php
//Name:sangani jagruti
//Date:2014-11-05
//Purpose:Show sidebar menu
//	if (strlen($users_hh) > 1) { 
	?>
        
	<li>
	 <a href="<?php echo $ADMIN ?>?ADD=0A"><?php echo _QXZ("Show Users");?></a>
	</li>
          <li>
	  <?php if ($add_copy_disabled < 1) { ?>
	  <a href="<?php echo $ADMIN ?>?ADD=1"><?php echo _QXZ("Add A New User");?> </a>
	  </li>
          <li>
	  <a href="<?php echo $ADMIN ?>?ADD=1A"><?php echo _QXZ("Copy User");?> </a>
	</li>
        <li>
	<?php } ?>
	  <a href="<?php echo $ADMIN ?>?ADD=550"><?php echo _QXZ("Search For A User");?> </a>
	</li>
        <li>
	 <a href="./user_stats.php?user=<?php echo $user ?>"><?php echo _QXZ("User Stats");?> </a>
	</li>
        <li>
	 <a href="./user_status.php?user=<?php echo $user ?>"><?php echo _QXZ("User Status");?> </a>
	</li>
         <li>
	 <a href="./AST_agent_time_sheet.php?agent=<?php echo $user ?>"><?php echo _QXZ("Time Sheet");?> </a> </li>
	 <?php
	if ( ($SSuser_territories_active > 0) or ($user_territories_active > 0) )
		{ ?>
	
	  <a href="./user_territories.php?agent=<?php echo $user ?>"><?php echo _QXZ("User Territories");?> </a>

	<?php }?>
           
	 <?php 
//} 
          
	?>
	</ul></li> 
	<!-- CAMPAIGNS NAVIGATION -->
	<li <?php echo $campaigns_hh; if(strlen($campaigns_hh)>1){ echo "class='active'";} ?>>
                 <a href="<?php echo $ADMIN ?>?ADD=10">
		 <div class="col-xs-1"><i class="fa fa-table"></i></div>
                 <div class="col-xs-9"><span><?php echo _QXZ("Campaigns");?></span></div>
              	</a>
        <ul class="sub-menu" > 
	<?php
//	if (strlen($campaigns_hh) > 1) { 
		if ($sh=='basic') {$sh='list';}
		if ($sh=='detail') {$sh='list';}
		if ($sh=='dialstat') {$sh='list';}

		if ($sh=='list') {$list_sh="bgcolor=\"$subcamp_color\""; $list_fc="$subcamp_font";}
			else {$list_sh=''; $list_fc='BLACK';}
		if ($sh=='status') {$status_sh="bgcolor=\"$subcamp_color\""; $status_fc="$subcamp_font";}
			else {$status_sh=''; $status_fc='BLACK';}
		if ($sh=='hotkey') {$hotkey_sh="bgcolor=\"$subcamp_color\""; $hotkey_fc="$subcamp_font";}
			else {$hotkey_sh=''; $hotkey_fc='BLACK';}
		if ($sh=='recycle') {$recycle_sh="bgcolor=\"$subcamp_color\""; $recycle_fc="$subcamp_font";}
			else {$recycle_sh=''; $recycle_fc='BLACK';}
		if ($sh=='autoalt') {$autoalt_sh="bgcolor=\"$subcamp_color\""; $autoalt_fc="$subcamp_font";}
			else {$autoalt_sh=''; $autoalt_fc='BLACK';}
		if ($sh=='pause') {$pause_sh="bgcolor=\"$subcamp_color\""; $pause_fc="$subcamp_font";}
			else {$pause_sh=''; $pause_fc='BLACK';}
		if ($sh=='listmix') {$listmix_sh="bgcolor=\"$subcamp_color\""; $listmix_fc="$subcamp_font";}
			else {$listmix_sh=''; $listmix_fc='BLACK';}
		if ($sh=='preset') {$preset_sh="bgcolor=\"$subcamp_color\""; $preset_fc="$subcamp_font";}
			else {$preset_sh=''; $preset_fc='BLACK';}
		if ($sh=='accid') {$accid_sh="bgcolor=\"$subcamp_color\""; $accid_fc="$subcamp_font";}
			else {$accid_sh=''; $accid_fc='BLACK';}

		?>
		
		   <li  <?php echo $list_sh ?>> 
                       <a href="<?php echo $ADMIN ?>?ADD=10"><?php echo _QXZ("Campaigns Main");?></a>
                   </li>
		
               
		    <li  <?php echo $status_sh ?>> 
                        <a href="<?php echo $ADMIN ?>?ADD=32"><?php echo _QXZ("Statuses");?></a>
                    </li>
	
		    <li <?php echo $hotkey_sh ?>> 
                          <a href="<?php echo $ADMIN ?>?ADD=33"><?php echo _QXZ("HotKeys");?></a>
                    </li>
		<?php
		if ($SSoutbound_autodial_active > 0)
			{
			?>
			
			<li  <?php echo $recycle_sh ?>> 
                            <a href="<?php echo $ADMIN ?>?ADD=35"><?php echo _QXZ("Lead Recycle");?></a>
                        </li>
			
                        
			<li  <?php echo $autoalt_sh ?>> 
                            <a href="<?php echo $ADMIN ?>?ADD=36"><?php echo _QXZ("Auto-Alt Dial");?></a>
                        </li>
			
			<li <?php echo $listmix_sh ?>> 
                             <a href="<?php echo $ADMIN ?>?ADD=39"><?php echo _QXZ("List Mix");?></a></li>
			<?php
			}
		?>
		
		<li ALIGN=LEFT <?php echo $pause_sh ?>>  <a href="<?php echo $ADMIN ?>?ADD=37"><?php echo _QXZ("Pause Codes");?></a></li>
		
		<li ALIGN=LEFT <?php echo $preset_sh ?>> <a href="<?php echo $ADMIN ?>?ADD=301"><?php echo _QXZ("Presets");?></a></li>
		<?php
		if ($SScampaign_cid_areacodes_enabled > 0)
			{
			?>
			
			<li  <?php echo $accid_sh ?>> <a href="<?php echo $ADMIN ?>?ADD=302"><?php echo _QXZ("AC-CID");?></a></li>
			<?php
			}
//		 }

	?>
        </ul></li>
	<!-- LISTS NAVIGATION -->
	<?php
	//if ($SSoutbound_autodial_active > 0)
		//{
		?>
		<li <?php if(strlen($lists_hh)>1){ echo "class='active'";} ?>><a href="<?php echo $ADMIN ?>?ADD=100">
		 <div class="col-xs-1"><i class="fa fa-list-alt"></i></div>
                 <div class="col-xs-9"><span><?php echo _QXZ("Lists");?></span></div>
              	</a>
        	<ul class="sub-menu" >
		<?php
//		if (strlen($lists_hh) > 1) { 
			if ($LOGdelete_from_dnc > 0) {$DNClink = 'Add-Delete DNC Number';}
			else {$DNClink = 'Add DNC Number';}
			?>
			<li><li ALIGN=LEFT> 
			<a href="<?php echo $ADMIN ?>?ADD=100"> <?php echo _QXZ("Show Lists");?> </a>
			</li><li><li ALIGN=LEFT> 
			<?php if ($add_copy_disabled < 1) { ?>
			<a href="<?php echo $ADMIN ?>?ADD=111"> <?php echo _QXZ("Add A New List");?> </a>
			</li><li><li ALIGN=LEFT> 
			<?php } ?>
			<a href="admin_search_lead.php"> <?php echo _QXZ("Search For A Lead");?> </a>
			</li>
			<li> 
			<a href="admin_modify_lead.php"><?php echo _QXZ("Add A New Lead");?> </a>
			</li>
			<li>
		
			<a href="<?php echo $ADMIN ?>?ADD=121"><?php echo $DNClink ?> </a>
			</li>
			<li> 
			<a href="./admin_listloader_fourth_gen.php"> <?php echo _QXZ("Load New Leads");?> </a>
			<?php
			if ($SScustom_fields_enabled > 0)
				{
				?>
				</li><li>
				<a href="./admin_lists_custom.php"> <?php echo _QXZ("List Custom Fields");?> </a>
				</li><li> 
				<a href="./admin_lists_custom.php?action=COPY_FIELDS_FORM"> <?php echo _QXZ("Copy Custom Fields");?> </a>
				<?php
				}
			?>
			</li>
			<?php
			//}?>
                  </ul></li>
              <?php                  
	//	}
	?>
        
        <?php include 'qc/QC_header_include.php'; ?>
	<!-- SCRIPTS NAVIGATION -->
	<li <?php echo $scripts_hh;if(strlen($scripts_hh)>1){ echo "class='active'";} ?>>
	<a href="<?php echo $ADMIN ?>?ADD=1000000">
        	 <div class="col-xs-1"><i class="fa fa-file-text-o"></i></div>
                 <div class="col-xs-9"><span><?php echo _QXZ("Scripts");?></span></div>
              </a>
	
	<ul class="sub-menu">  
	
	<?php
//	if (strlen($scripts_hh) > 1) { 
		?>
		<li>  
		<a href="<?php echo $ADMIN ?>?ADD=1000000"> <?php echo _QXZ("Show Scripts");?> </a>
		</li>
		<li> 
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=1111111"> <?php echo _QXZ("Add A New Script");?> </a>
		<?php } ?>
		</li>
		<?php 
//} 
	?>
        </ul></li>
	<!-- FILTERS NAVIGATION -->
	<?php
	if ($SSoutbound_autodial_active > 0)
		{
		?>
		<li <?php echo $filters_hh;if(strlen($filters_hh)>1){ echo "class='active'";}  ?>>
                       <a href="<?php echo $ADMIN ?>?ADD=10000000">
                        
        	 		<div class="col-xs-1"><i class="fa fa-filter"></i></div>
		                <div class="col-xs-9"><span><?php echo _QXZ("Filters");?></span></div>
              	</a> 
		<ul class="sub-menu" >  
                <?php
//		if (strlen($filters_hh) > 1) { 
			?>
		<li> 
		<a href="<?php echo $ADMIN ?>?ADD=10000000"><?php echo _QXZ("Show Filters");?> </a>
		</li>
		<li>
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=11111111"> <?php echo _QXZ("Add A New Filter");?> </a>
		<?php } ?>
		</li>
		<?php// }?>
                 </ul></li>
               <?php 
		}
	?>
	<!-- INGROUPS NAVIGATION -->
	<li <?php echo $ingroups_hh;if(strlen($ingroups_hh)>1){ echo "class='active'";} ?>>
	<a href="<?php echo $ADMIN ?>?ADD=1000"> 
	 <div class="col-xs-1"><i class="fa fa-phone-square"></i></div>
                 <div class="col-xs-9"><span><?php echo _QXZ("Inbound");?></span></div>
              </a>
        <ul class="sub-menu">  
	<?php
//	if (strlen($ingroups_hh) > 1) {
		if ($LOGdelete_from_dnc > 0) {$FPGlink = 'Add-Delete FPG Number';}
		else {$FPGlink = 'Add FPG Number';}
		?>
		<li> 
		<a href="<?php echo $ADMIN ?>?ADD=1000"> <?php echo _QXZ("Show In-Groups");?> </a>
		</li>
                <li> 
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=1111"> <?php echo _QXZ("Add A New In-Group");?> </a>
		</li><li> 
		<a href="<?php echo $ADMIN ?>?ADD=1211"> <?php echo _QXZ("Copy In-Group");?> </a>
		<?php } ?>
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->
		<hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

		<?php
		if ($SSemail_enabled>0) 
			{
		?>
		<li>
		<a href="<?php echo $ADMIN ?>?ADD=1800"> <?php echo _QXZ("Show Email Groups");?> </a>
		</li><li> 
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=1811"> <?php echo _QXZ(" Add New Email Group");?> </a>
		</li><li> 
		<a href="<?php echo $ADMIN ?>?ADD=1911"> <?php echo _QXZ("Copy Email Group");?> </a>
		<?php } ?>
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

		<?php
			}
		?>
									<?php
		if ($SSchat_enabled>0) 
			{
		?>
		</li><li>
					<a href="<?php echo $ADMIN ?>?ADD=1900"> <?php echo _QXZ("Show Chat Groups");?> </a>
					</li><li> 
					<?php if ($add_copy_disabled < 1) { ?>
					<a href="<?php echo $ADMIN ?>?ADD=18111"> <?php echo _QXZ(" Add New Chat Group");?> </a>
					</li><li> 
					<a href="<?php echo $ADMIN ?>?ADD=19111"> <?php echo _QXZ("Copy Chat Group");?> </a>
		<?php } ?>
		<hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>
		<?php
			}
		?>
		</li><li> 
		<a href="<?php echo $ADMIN ?>?ADD=1300"> <?php echo _QXZ("Show DIDs");?> </a>
		</li><li>  
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=1311"> <?php echo _QXZ("Add A New DID");?> </a>
		</li><li>  
		<a href="<?php echo $ADMIN ?>?ADD=1411"> <?php echo _QXZ("Copy DID");?> </a>
		<?php
			}
		if ($SSdid_ra_extensions_enabled > 0)
			{
			?>
			</li><li> 
			<a href="<?php echo $ADMIN ?>?ADD=1320"><?php echo _QXZ("RA Extensions");?></a>
			<?php
			}
		?>
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>
		
		</li><li> 
		<a href="<?php echo $ADMIN ?>?ADD=1500"> <?php echo _QXZ("Show Call Menus");?> </a>
		</li><li > 
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=1511"> <?php echo _QXZ("Add A New Call Menu");?> </a>
		</li><li>  
		<a href="<?php echo $ADMIN ?>?ADD=1611"> <?php echo _QXZ("Copy Call Menu");?> </a>
		<?php } ?>
		
<!--Name:sangani jagruti
Date:2014-11-26
Purpose:remove space above and below unline in submenu -->

 <hr style='margin:10px 0px 10px 0px; border-width: 1px; border-style: inset;color: #ffffff; '>

		</li><li> 
		<a href="<?php echo $ADMIN ?>?ADD=1700"> <?php echo _QXZ("Filter Phone Groups");?> </a>
		</li><li> 
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=1711"> <?php echo _QXZ("Add Filter Phone Group");?> </a>
		</li><li> 
		<?php } ?>
		<a href="<?php echo $ADMIN ?>?ADD=171"><?php echo $FPGlink ?></a>
		</li>
		<?php 
//} 
		?>
              </ul></li>
	<!-- USERGROUPS NAVIGATION -->
	<li <?php echo $usergroups_hh;if(strlen($usergroups_hh)>1){ echo "class='active'";} ?>>
	<a href="<?php echo $ADMIN ?>?ADD=100000">
		<div class="col-xs-1"><i class="fa fa-users"></i></div>
                 <div class="col-xs-9"><span> <?php echo _QXZ("User Groups");?></span></div>
        </a>
        <ul class="sub-menu" style="top:577px !important;"> 
	<?php
//	if (strlen($usergroups_hh) > 1)	{ 
		?>
		<li> 
		<a href="<?php echo $ADMIN ?>?ADD=100000"> <?php echo _QXZ("Show User Groups");?> </a>
		</li><li> 
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=111111"> <?php echo _QXZ("Add A New User Group");?> </a>
		</li><li> 
		<?php } ?>
		<a href="group_hourly_stats.php"> <?php echo _QXZ("Group Hourly Report");?> </a>
		</li><li> 
		<a href="user_group_bulk_change.php"> <?php echo _QXZ("Bulk Group Change");?> </a>
		</li>
		<?php 
//} 
	?>
        </ul></li> 
	<!-- REMOTEAGENTS NAVIGATION -->
	<li <?php echo $remoteagent_hh;if(strlen($remoteagent_hh)>1){ echo "class='active'";} ?>>
	<a href="<?php echo $ADMIN ?>?ADD=10000">
               	 <div class="col-xs-1"><i class="fa fa-user"></i></div>
                 <div class="col-xs-9"><span>  <?php echo _QXZ("Remote Agents");?></span></div>
        </a>
	<ul class="sub-menu"> 
	<?php
//	if (strlen($remoteagent_hh) > 1) { 
		?>
		<li>
		<a href="<?php echo $ADMIN ?>?ADD=10000"> <?php echo _QXZ("Show Remote Agents");?> </a>
		</li><li> 
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=11111"> <?php echo _QXZ("Add New Remote Agents");?> </a>
		</li><li> 
		<?php } ?>
		<a href="<?php echo $ADMIN ?>?ADD=12000"> <?php echo _QXZ("Show Extension Groups");?> </a>
		</li><li>
		<?php if ($add_copy_disabled < 1) { ?>
		<a href="<?php echo $ADMIN ?>?ADD=12111"> <?php echo _QXZ("Add Extension Group");?> </a>
		<?php } ?>
		</li>
	<?php 
//} 
	?>
        </ul></li>

	
	<!-- ADMIN NAVIGATION -->
	<li <?php echo $admin_hh;if(strlen($admin_hh)>1){ echo "class='active'";} ?>>
	<a href="<?php echo $ADMIN ?>?ADD=999998">
                 <div class="col-xs-1"><i class="fa fa-user"></i></div>
                 <div class="col-xs-9"><span> <?php echo _QXZ("Admin");?></span></div>
         </a>
        <ul class="sub-menu">  
	<?php
//	if (strlen($admin_hh) > 1) { 
		if ($sh=='times') {$times_sh="bgcolor=\"$times_color\""; $times_fc="$times_font";}
			else {$times_sh=''; $times_fc='BLACK';}
		if ($sh=='shifts') {$shifts_sh="bgcolor=\"$shifts_color\""; $shifts_fc="$shifts_font";}
			else {$shifts_sh=''; $shifts_fc='BLACK';}
		if ($sh=='templates') {$templates_sh="bgcolor=\"$templates_color\""; $templates_fc="$templates_font";}
			else {$templates_sh=''; $templates_fc='BLACK';}
		if ($sh=='carriers') {$carriers_sh="bgcolor=\"$carriers_color\""; $carriers_fc="$carriers_font";}
			else {$carriers_sh=''; $carriers_fc='BLACK';}
		if ($sh=='phones') {$phones_sh="bgcolor=\"$server_color\""; $phones_fc="$phones_font";}
			else {$phones_sh=''; $phones_fc='BLACK';}
		if ($sh=='server') {$server_sh="bgcolor=\"$server_color\""; $server_fc="$server_font";}
			else {$server_sh=''; $server_fc='BLACK';}
		if ($sh=='conference') {$conference_sh="bgcolor=\"$server_color\""; $conference_fc="$server_font";}
			else {$conference_sh=''; $conference_fc='BLACK';}
		if ($sh=='settings') {$settings_sh="bgcolor=\"$settings_color\""; $settings_fc="$settings_font";}
			else {$settings_sh=''; $settings_fc='BLACK';}
		if ($sh=='label') {$label_sh="bgcolor=\"$label_color\""; $label_fc="$label_font";}
			else {$label_sh=''; $label_fc='BLACK';}
		if ($sh=='status') {$status_sh="bgcolor=\"$status_color\""; $status_fc="$status_font";}
			else {$status_sh=''; $status_fc='BLACK';}
		if ($sh=='audio') {$audio_sh="bgcolor=\"$audio_color\""; $audio_fc="$audio_font";}
			else {$audio_sh=''; $audio_fc='BLACK';}
		if ($sh=='moh') {$moh_sh="bgcolor=\"$moh_color\""; $moh_fc="$moh_font";}
			else {$moh_sh=''; $moh_fc='BLACK';}
		if ($sh=='languages') {$languages_sh="bgcolor=\"$languages_color\""; $languages_fc="$languages_font";}
			else {$languages_sh=''; $languages_fc='BLACK';}
		if ($sh=='vm') {$vm_sh="bgcolor=\"$vm_color\""; $vm_fc="$vm_font";}
			else {$vm_sh=''; $vm_fc='BLACK';}
		if ($sh=='tts') {$tts_sh="bgcolor=\"$tts_color\""; $tts_fc="$tts_font";}
			else {$tts_sh=''; $tts_fc='BLACK';}
		if ($sh=='cc') {$cc_sh="bgcolor=\"$cc_color\""; $cc_fc="$cc_font";}
			else {$cc_sh=''; $cc_fc='BLACK';}
		if ($sh=='cts') {$cts_sh="bgcolor=\"$cts_color\""; $cts_fc="$cc_font";}
			else {$cts_sh=''; $cts_fc='BLACK';}
		if ($sh=='emails') {$emails_sh="bgcolor=\"$subcamp_color\""; $emails_fc="$subcamp_font";}
			else {$emails_sh=''; $emails_fc='BLACK';}


		?>
		
		<li <?php echo $times_sh ?> COLSPAN=2>
		<a href="<?php echo $ADMIN ?>?ADD=100000000"> <?php echo _QXZ("Call Times");?> </a>
		</li>
		<li ALIGN=LEFT <?php echo $shifts_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=130000000"> <?php echo _QXZ("Shifts");?> </a>
		</li><li ALIGN=LEFT <?php echo $phones_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=10000000000"> <?php echo _QXZ("Phones");?> </a>
		</li><li <?php echo $templates_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=130000000000"> <?php echo _QXZ("Templates");?> </a>
		</li><li BGCOLOR=<?php echo $admin_color ?>><li ALIGN=LEFT <?php echo $carriers_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=140000000000"> <?php echo _QXZ("Carriers");?> </a>
		</li><li ALIGN=LEFT <?php echo $server_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=100000000000"> <?php echo _QXZ("Servers");?> </a>
		</li><li ALIGN=LEFT <?php echo $conference_sh ?>>  
		<a href="<?php echo $ADMIN ?>?ADD=1000000000000"> <?php echo _QXZ("Conferences");?> </a>
		</li><li ALIGN=LEFT <?php echo $settings_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=311111111111111"> <?php echo _QXZ("System Settings");?> </a>
		</li><li ALIGN=LEFT <?php echo $label_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=180000000000"> <?php echo _QXZ("Screen Labels");?> </a>
		</li><li ALIGN=LEFT <?php echo $status_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=321111111111111"> <?php echo _QXZ("System Statuses");?> </a>
		</li>
		
		<!-- dipal -->
		<li ALIGN=LEFT <?php echo $vm_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=193000000000"> <?php echo _QXZ("status Groups");?> </a>
		</li>
		<!----->
		
		<li ALIGN=LEFT <?php echo $vm_sh ?>> 
		<a href="<?php echo $ADMIN ?>?ADD=170000000000"> <?php echo _QXZ("Voicemail");?> </a>
		</li>
		<?php
		if ($SSemail_enabled > 0)
		{ ?>
			<li ALIGN=LEFT <?php echo $emails_sh ?>>  
			<a href="admin_email_accounts.php"> <?php echo _QXZ("Email Accounts");?> </a>
			</li>
		<?php }
		if ( ($sounds_central_control_active > 0) or ($SSsounds_central_control_active > 0) )
			{ ?>
			<li ALIGN=LEFT <?php echo $audio_sh ?>> 
			<a href="audio_store.php"> <?php echo _QXZ("Audio Store");?> </a>
			</li>
			<li ALIGN=LEFT <?php echo $moh_sh ?>> 
			<a href="<?php echo $ADMIN ?>?ADD=160000000000"> <?php echo _QXZ("Music On Hold");?> </a>
			</li>
		
		<?php }?>
					<?php 
			if ($SSenable_languages > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $languages_sh ?>> 
			<a href="admin_languages.php?ADD=163000000000"><?php echo _QXZ("Languages"); ?> </a>
			</li>
			
			<?php }
		if ($SSenable_tts_integration > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $tts_sh ?>> 
			<a href="<?php echo $ADMIN ?>?ADD=150000000000"> <?php echo _QXZ("Text To Speech");?> </a>
			</li>

		<?php }
		if ($SScallcard_enabled > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $cc_sh ?>>  
			<a href="callcard_admin.php"> <?php echo _QXZ("CallCard Admin");?> </a>
			</li>

		<?php }
		if ($SScontacts_enabled > 0)
			{ ?>
			<li ALIGN=LEFT <?php echo $cts_sh ?>> 
			<a href="<?php echo $ADMIN ?>?ADD=190000000000"> <?php echo _QXZ("Contacts");?> </a>
			</li>

		<?php }

//			}
		?>
		
		
		<!-- dipal -->
		<li ALIGN=LEFT <?php echo $status_sh ?>> 
		<a href="<?php echo "admin.php"; ?>?ADD=192000000000"> <?php echo _QXZ("Settings Containers");?> </a>
		</li>		
		<!----->
		
		
                </ul></li>


        <!-- Quality Check Reports Navigation -->
        <li <?php echo $scripts_hh;if(strlen($scripts_hh)>1){ echo "class='active'";} ?>>
        <a href="/admins/realtime_report.php">
                 <div class="col-xs-1"><i class="fa fa-bar-chart"></i></div>
                 <div class="col-xs-9"><span><?php echo _QXZ("Live Report");?></span></div>
              </a>
        </li>



        <!-- Quality Check Reports Navigation -->
        <li <?php echo $scripts_hh;if(strlen($scripts_hh)>1){ echo "class='active'";} ?>>
        <a href="/admins/AST_agent_performance_detail.php">
                 <div class="col-xs-1"><i class="fa fa-pie-chart"></i></div>
                 <div class="col-xs-9"><span><?php echo _QXZ("Login Report");?></span></div>
              </a>
        </li>





		<!-- REPORTS NAVIGATION -->
		<li><li <?php echo $reports_hh;if(strlen($reports_hh)>1){ echo "class='active'";} ?>>
		<a href="<?php echo $ADMIN ?>?ADD=999999">
                 <div class="col-xs-1"><i class="fa fa-bar-chart"></i></div>
                 <div class="col-xs-9"><span> <?php echo _QXZ("All Reports");?></span></div>
         	</a>
<!--	        <ul class="sub-menu">   -->
		<?php
		}
	else
		{
		if ($reports_only_user > 0) {
?>
			<!-- REPORTS NAVIGATION -->
			<li><li <?php echo $reports_hh ?>>
			<a href="<?php echo $ADMIN ?>?ADD=999999"> 
                         <div class="col-xs-1"><i class="fa fa-user"></i></div>
	                 <div class="col-xs-9"><span><?php echo _QXZ("Reports");?></span></div>
         		</a>
<!--		        <ul class="sub-menu">  -->
			<?php
			}
		else
			{
			include 'qc/QC_header_include.php';
			}
		}
	?>
<!--	<li><li> &nbsp; </li></li> -->
<!--	</ul> -->
</ul></div></div></div></div>


<!-- END SIDEBAR NAVIGATION -->

<span style="position:absolute;left:300px;top:30px;z-index:1;visibility:hidden;border:1px solid #ececec;" id="audio_chooser_span">

</span>

	<div class="container-fluid" id="pcont4">
	<div>	

	<?php
	if (strlen($list_sh) > 1) { 
		?>
		
	
	<div class="">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=10"><?php echo _QXZ(" Show Campaigns");?> </a> &nbsp; &nbsp; |<?php if ($add_copy_disabled < 1) { ?>
&nbsp; &nbsp; <a href="<?php echo $ADMIN ?>?ADD=11"><?php echo _QXZ(" Add A New Campaign ");?></a> &nbsp; &nbsp; | &nbsp; &nbsp; <a href="<?php echo $ADMIN ?>?ADD=12"> <?php echo _QXZ("Copy Campaign");?> </a> &nbsp; &nbsp; |<?php } ?> &nbsp; &nbsp; <a href="./AST_timeonVDADallSUMMARY.php"><?php echo _QXZ(" Real-Time Campaigns Summary");?> </a>
</div>	
    </div>
    </div>


		<?php } 

	if (strlen($times_sh) > 1) { 
		?>

	<div class="">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=100000000"> <?php echo _QXZ("Show Call Times");?> </a> &nbsp;|<?php if ($add_copy_disabled < 1) { ?>
 <a href="<?php echo $ADMIN ?>?ADD=111111111"><?php echo _QXZ(" Add A New Call Time");?>  </a> &nbsp;|<?php } ?> <a href="<?php echo $ADMIN ?>?ADD=1000000000"> <?php echo _QXZ("Show State Call Times");?>  </a> &nbsp;|<?php if ($add_copy_disabled < 1) { ?> <a href="<?php echo $ADMIN ?>?ADD=1111111111"> <?php echo _QXZ("Add A New State Call Time");?>  </a> &nbsp;|<?php } ?> <a href="<?php echo $ADMIN ?>?ADD=1200000000"><?php echo _QXZ(" Holidays");?>  </a> &nbsp;|<?php if ($add_copy_disabled < 1) { ?> <a href="<?php echo $ADMIN ?>?ADD=1211111111"><?php echo _QXZ(" Add Holiday");?>  </a><?php } ?>
 </div>	
    </div>
    </div>
 
		<?php } 
	if (strlen($shifts_sh) > 1) { 
		?>
    
	<div class="">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=130000000"> <?php echo _QXZ("Show Shifts");?> </a> &nbsp;|<?php if ($add_copy_disabled < 1) { ?> <a href="<?php echo $ADMIN ?>?ADD=131111111"> <?php echo _QXZ("Add A New Shift");?> </a><?php } ?>
    		</div>	
    </div>
    
    </div>
		<?php } 
	if (strlen($phones_sh) > 1) { 
		?>
	<div class="">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=10000000000"> <?php echo _QXZ("Show Phones");?> </a>&nbsp;|<?php if ($add_copy_disabled < 1) { ?>&nbsp;<a href="<?php echo $ADMIN ?>?ADD=11111111111"> <?php echo _QXZ("Add A New Phone");?> </a>&nbsp;|<?php } ?>&nbsp;<a href="<?php echo $ADMIN ?>?ADD=12000000000"> <?php echo _QXZ("Phone Alias List");?> </a>&nbsp;|<?php if ($add_copy_disabled < 1) { ?>&nbsp;<a href="<?php echo $ADMIN ?>?ADD=12111111111"> <?php echo _QXZ("Add A New Phone Alias");?> </a>&nbsp;|<?php } ?>&nbsp;<a href="<?php echo $ADMIN ?>?ADD=13000000000"> <?php echo _QXZ("Group Alias List");?> </a>&nbsp;|<?php if ($add_copy_disabled < 1) { ?>&nbsp;<a href="<?php echo $ADMIN ?>?ADD=13111111111"> <?php echo _QXZ("Add A New Group Alias");?> </a><?php } ?>
    		</div>	
    </div>
    </div>
		<?php }
	if (strlen($conference_sh) > 1) { 
		?>
	
    
	<div class="">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=1000000000000"> <?php echo _QXZ("Show Conferences");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=1111111111111"> <?php echo _QXZ("Add A New Conference");?> </a> &nbsp; |<?php } ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=10000000000000"> <?php echo _QXZ("Show VICIDIAL Conferences");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=11111111111111"><?php echo _QXZ("Add A New VICIDIAL Conference");?> </a><?php } ?>
    		</div>	
    
    </div>
    </div>
		<?php }
	if ( (strlen($server_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	
	<div class="">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=100000000000"> <?php echo _QXZ("Show Servers");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=111111111111"><?php echo _QXZ(" Add A New Server");?> </a><?php } ?>
    		</div>	
    </div>
    </div>
    
	<?php }
	if ( (strlen($templates_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	<div class="">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=130000000000"><?php echo _QXZ("Show Templates");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=131111111111"> <?php echo _QXZ("Add A New Template");?> </a><?php } ?>
    		</div>	
    </div>
    </div>
    
	<?php }
	if ( (strlen($carriers_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	
	<div class="">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=140000000000"> <?php echo _QXZ("Show Carriers");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=141111111111"> <?php echo _QXZ("Add A New Carrier");?> </a> &nbsp; | &nbsp; <a href="<?php echo $ADMIN ?>?ADD=140111111111"><?php echo _QXZ("Copy A Carrier");?> </a><?php } ?>
    		</div>	
    </div>
    </div>
    
	<?php }
	if ( (strlen($emails_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	<div class="">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="admin_email_accounts.php"> <?php echo _QXZ("Show Email Accounts");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="admin_email_accounts.php?eact=ADD"><?php echo _QXZ(" Add A New Account");?> </a> &nbsp; | &nbsp; <a href="admin_email_accounts.php?eact=COPY"> <?php echo _QXZ("Copy An Account");?> </a><?php } ?>
    		</div>	
    </div>
    </div>
    
	<?php }
	if ( (strlen($tts_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	
	<div class="col-md-12">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=150000000000"> <?php echo _QXZ("Show TTS Entries");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=151111111111"><?php echo _QXZ(" Add A New TTS Entry");?> </a><?php } ?>
    		</div>	
    
    </div>
    </div>
	<?php }
	if ( (strlen($cc_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	
	<div class="col-md-12">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="callcard_admin.php"> <?php echo _QXZ("CallCard Summary");?> </a> &nbsp; | &nbsp; <a href="callcard_admin.php?action=CALLCARD_RUNS"><?php echo _QXZ(" Runs");?> </a> &nbsp; | &nbsp; <a href="callcard_admin.php?action=CALLCARD_BATCHES"><?php echo _QXZ(" Batches ");?></a> &nbsp; | &nbsp; <a href="callcard_admin.php?action=SEARCH"><?php echo _QXZ(" CallCard Search");?> </a> &nbsp; | &nbsp; <a href="callcard_report_export.php"><?php echo _QXZ("CallCard Log Export ");?></a> &nbsp; | &nbsp; <a href="callcard_admin.php?action=GENERATE"> <?php echo _QXZ("CallCard Generate New Numbers");?> </a>
    		</div>	
    </div>
    </div>
    
	<?php }
	if ( (strlen($moh_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	
	<div class="col-md-12">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=160000000000"> <?php echo _QXZ("Show MOH Entries"); ?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=161111111111"> <?php echo _QXZ("Add A New MOH Entry");?> </a><?php } ?>
    		</div>	
    </div>
    </div>
    
    
    
    
    <?php }
	//echo $languages_sh;
	//echo $admin_hh;
	if ( (strlen($languages_sh) > 1) and (strlen($admin_hh) > 1)) { 
		?>
	<div class="col-md-12">
    <div class="fd-tile detail">
    		<div class="page-head"> <a href="admin_languages.php?ADD=163000000000"><?php echo _QXZ("Show Languages"); ?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="admin_languages.php?ADD=163111111111"><?php echo _QXZ("Add A New Language"); ?></a> &nbsp; | &nbsp; <a href="admin_languages.php?ADD=163211111111"> <?php echo _QXZ("Copy A Languages Entry"); ?></a> &nbsp; | &nbsp; <a href="admin_languages.php?ADD=163311111111"> <?php echo _QXZ("Import Phrases"); ?></a> &nbsp; | &nbsp; <a href="admin_languages.php?ADD=163411111111"> <?php echo _QXZ("Export Phrases"); ?></a> &nbsp; <?php } ?>
    		</div>
    </div>
    </div>
	
	
    
    
    
	<?php 
		}
	
	if ( (strlen($vm_sh) > 1) and (strlen($admin_hh) > 1) ) { 
		?>
	
	<div class="col-md-12">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=170000000000"> <?php echo _QXZ("Show Voicemail Entries");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=171111111111"> <?php echo _QXZ("Add A New Voicemail Entry");?> </a><?php } ?>
    		</div>	
    </div>
    </div>
    
	<?php }
	if (strlen($settings_sh) > 1) { 
		?>
	
	<div class="col-md-12">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=311111111111111"> <?php echo _QXZ("System Settings");?> </a>
    		</div>	
    </div>
    
    </div>
	<?php }
	if (strlen($label_sh) > 1) { 
		?>
	<div class="col-md-12">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=180000000000"> <?php echo _QXZ("Screen Labels");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=181111111111"><?php echo _QXZ(" Add A Screen Label");?> </a><?php } ?>
    		</div>	
    </div>
    </div>
    
	<?php }
	if (strlen($cts_sh) > 1) { 
		?>
	
	<div class="col-md-12">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=190000000000"><?php echo _QXZ("Contacts");?> </a> &nbsp; |<?php if ($add_copy_disabled < 1) { ?> &nbsp; <a href="<?php echo $ADMIN ?>?ADD=191111111111"> <?php echo _QXZ("Add A Contact");?> </a><?php } ?>
    		</div>	
    </div>
    </div>
    
    
	<?php }
	if ( (strlen($status_sh) > 1) and (!preg_match('/campaign/i',$hh) ) ) { 
		?>
	
	<div class="col-md-12">
    <div class="fd-tile detail">
    		<div class="page-head"><a href="<?php echo $ADMIN ?>?ADD=321111111111111"> <?php echo _QXZ("System Statuses");?> </a> &nbsp; | &nbsp; <a href="<?php echo $ADMIN ?>?ADD=331111111111111"><?php echo _QXZ(" Status Categories");?> </a> &nbsp; | &nbsp; <a href="<?php echo $ADMIN ?>?ADD=341111111111111"><?php echo _QXZ(" QC Status Codes ");?></a>
    		</div>	
    </div>
    </div>
    
	<?php }

	if ( ($ADD=='3') or ($ADD=='3') ) { 
		?>
	
	<!--<div class="col-md-12">-->

	<div class='col-md-12'>
    <div class="fd-tile detail">
    		<div class="page-head"><a href="./user_stats.php?user=<?php echo $user ?>"><?php echo _QXZ("User Stats");?> </a> &nbsp; | &nbsp; <a href="./user_status.php?user=<?php echo $user ?>"><?php echo _QXZ("User Status");?> </a> &nbsp; | &nbsp; <a href="./AST_agent_time_sheet.php?agent=<?php echo $user ?>"><?php echo _QXZ("Time Sheet");?> </a> &nbsp; | &nbsp; <a href="./AST_agent_days_detail.php?user=<?php echo $user ?>"><?php echo _QXZ("Days Status");?> </a>
    		</div>	
    </div>
</div>
    
	<?php }
?>
    </div>
<?php
	
if (strlen($reports_hh) > 1) { 
	?>
<!--<TR ><TD ALIGN=LEFT COLSPAN=2><FONT FACE="ARIAL,HELVETICA" COLOR=BLACK SIZE=<?php echo $subheader_font_size ?>><B> &nbsp; </B></TD></TR>-->
<?php } ?>

<?php 
######################### FULL HTML HEADER END #######################################
}
if($short_header==1){
	echo "<div class='col-md-12'>";
	}

include('admin_footer.php');
//end reports download
}
?>
