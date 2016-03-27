<?php
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$string='';
$shmch = $_GET['shmch'];
$sql = "select * from `yyyshdq` where `sheng` = '$shmch'";
$query = mysql_query($sql);
while($Record = mysql_fetch_array($query)){
  $arr[] = $Record[24];//echo $Record[24];
}
$arr2 = array_flip(array_flip($arr));
$string.="<option value=\"\">-请选择-</option>";
for($i=0;$i<count($arr);$i++){
  if($arr2[$i]!=''){
  
    $string.="<option value=\"".$arr2[$i]."\"> ".$arr2[$i]."</option>";
    
  }
}
echo $string;
?>