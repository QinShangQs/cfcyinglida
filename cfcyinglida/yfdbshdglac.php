<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw=$_SESSION[yhname];
$id=$_POST['hidden'];
$shdrq=date("Y-m-d");
$sql="update `yfdb` set `dbzht`='2',`dbypshdrq`='$shdrq',`fryfysh`='$yhgldw' where `id`=".$id;
$query=mysql_query($sql);
if($query){
   echo "成功！<br/>";
   echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=yfdbgl.php\">";
}else{
  echo mysql_error();
  echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}
?>