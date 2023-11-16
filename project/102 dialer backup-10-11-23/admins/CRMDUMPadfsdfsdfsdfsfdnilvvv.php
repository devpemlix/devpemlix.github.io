<?php
/* vars for export */
// database record to be exported
$db_record = 'XXXXXXXXX';
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// filename for export
$csv_filename = 'db_export_'.date('Y-m-d').'.xls';
// database variables
$hostname = "172.31.9.1";
$user = "cron";
$password = "1234";
$database = "asterisk";
// Database connecten voor alle services
mysql_connect($hostname, $user, $password)
or die('Could not connect: ' . mysql_error());
					
mysql_select_db($database)
or die ('Could not select database ' . mysql_error());
// create var to be filled with export data
$csv_export = '';
// query to get data from database
$result = mysql_query("SELECT * FROM vicidial_list");
$sep = "\t"; //tabbed character
$html = "";
for ($i = 0; $i < mysql_num_fields($result); $i++) {
 $html .=  mysql_field_name($result,$i) . "\t";
}
$html .= "\n";    

    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
        $row[$j] = preg_replace("/\r\n|\n\r|\n|\r|\t/", " ", $row[$j]);
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= trim($row[$j]).$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        $html .= trim($schema_insert);
        $html .= "\n";
    }   

header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$csv_filename");  
header("Pragma: no-cache"); 
header("Expires: 0");
echo $html;
?>