<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

//id
$yhid = $_POST['yhid'];

//是否启用  1启用 2未启用
$yhzht = $_POST['IsApproved'];
if($yhzht!="1"){$yhzht="0";}
  $query="UPDATE `manager` SET  yhzht = '$yhzht' WHERE  `id` = '$yhid'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=cfcztfyyfgl.php\">";
  }

?>   
  
