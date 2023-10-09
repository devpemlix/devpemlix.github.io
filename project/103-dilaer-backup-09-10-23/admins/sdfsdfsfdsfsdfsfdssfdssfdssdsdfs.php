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
echo "hiii";
// query to get data from database
//$result = mysql_query("SELECT * FROM vicidial_list where list_id in ('30124','30122','612182','612181','7520','7521','7517','7518','30127','30125','108','451','1151','7519','7522','7516','7558','7555','7556','7552','7551','6661','1153','30123','9991','853','252019','312019','95219','952192','952193','952194','952191','8514','13513','13517','13516','8511','13514','13515','121219','1134','3120191','884','886','888','887','889','4510','4511','4512','4513','4514','4515','4516','4517','4518','4519','4520','881','882','883','8810','6662','215191','952195','215196','215195','854','859','857','852','8513','8814','8815','8816','1133','8817','8512','30121','215198','30126','244191','1132','215193','1462019','8821','8811','244193','244194','1212019','1352019','1152','122019','999','952196','885','1296','548','8818','8819','8820')");
$result = mysql_query("SELECT * FROM vicidial_list where list_id in ('952196','952192','95219','952194','952191','952193','952195','889','888','884','885','886','887','8810','9991','8815','8816','8812','8821','8813','8818','8819','8820','999','4510','4511','4512','4513','4514','4515','4516','4517','4518','4519','4520','13513','13514','13515','13516','13517','1462019','30125','1131','1132','1133','1134','1151','1152','1153','30124','108')");
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