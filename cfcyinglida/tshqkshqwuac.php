<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$hzhid=$_POST['id'];
$qk=$_POST['qk'];
$shqzht=$_POST['shqzht'];
//echo $tshgn." ".$ggbt." ".$ggnr." ".$ggrq." ".$ggzht." ".$fqr;
if($qk=="2"&&$shqzht=="1"){$shqzht=2;}
$query="INSERT INTO `tshzhtzyfywu` (`hzhid` ,`shqzht`)VALUES ( '$hzhid',  '$shqzht')";
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