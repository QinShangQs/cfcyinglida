<?php
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$string='';
$yfmch = $_GET['yfmch'];
$sql = "select `yyzhdyf` from `yyyshdq` where `id` = '$yfmch'";
$query = mysql_query($sql);

while($Record = mysql_fetch_array($query)){
  $Recordarr =explode(',',$Record[0]);
}
//echo count($Recordarr);
for($i=0;$i<count($Recordarr);$i++){
  $string.= "<option value=\"".$Recordarr[$i]."\"> ".$Recordarr[$i]."</option>";
}
echo $string;
/*$yfmcharr = explode(' ',$yfmch);
$yshmch = $yfmcharr[1];
$sql = "select `yyzhdyf` from `yyyshdq` where `zhdysh` = '$yshmch'";
$query = mysql_query($sql);
$Record = mysql_fetch_array($query);
$Recordarr = explode(',',$Record[0]);
for($i=o;count($Recordarr);$i++){
  $string.= "<option value=\"".$Recordarr[$i]."\"> ".$Recordarr[$i]."</option>";
}*/
//echo $string;
?>