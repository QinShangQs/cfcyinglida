<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//不良事件id
$id = $_POST['id'];
//辉瑞编码
$hrbm = $_POST['hrbm'];

  $query="UPDATE `blshj` SET `hrbm`='$hrbm' WHERE `id` = '$id'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=blshjxx.php?id=".$id."\">";
  }

?>
