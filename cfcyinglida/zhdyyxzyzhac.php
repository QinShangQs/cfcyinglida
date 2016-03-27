<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');


$zhdysh=$_GET['zhdysh'];
$yymch=$_GET['yymch'];

  $sql = "select id from `yyyshdq` where `zhdysh`='".$zhdysh."' and  `yymch`='".$yymch."'";

  $Query_ID = mysql_query($sql);
  if($Record = mysql_fetch_array($Query_ID)){
  echo "医生".$zhdysh."已存在于".$yymch;
  }else{
  //echo "aa";  
  }
?>