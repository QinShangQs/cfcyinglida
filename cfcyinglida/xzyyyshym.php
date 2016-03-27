<?php
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$string='';
$shimch = $_GET['shimch'];
$sql = "select * from `yyyshdq` where `shi` = '$shimch'";
$string.="<option value=\"\">-请选择-</option>";
$query = mysql_query($sql);
while($Record = mysql_fetch_array($query)){
   $string.= "<option value=\"".$Record[0]."\"> ".$Record[3]." ".$Record[6]."( ".$Record[9]." ".$Record[12]." ".$Record[15].")</option>";
}
echo $string;
?>