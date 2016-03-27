<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//患者id
$hzhid=$_POST['id'];
//变更捐助数量
$zyshl=$_POST['zyshl'];
//echo $tshgn." ".$ggbt." ".$ggnr." ".$ggrq." ".$ggzht." ".$fqr;

$query="UPDATE `hzh` SET `jzhshl`='$zyshl' WHERE `id` ='$hzhid'";
$result=mysql_query($query);
if(!$result)
{
  echo mysql_error();
  echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}
else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=".$hzhid."\">";
}    



?>