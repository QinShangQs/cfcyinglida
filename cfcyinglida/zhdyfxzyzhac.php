<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');


$yfyshname=$_GET['name'];

  $sql = "select id from `manager` where `names`='".$yfyshname."'";

  $Query_ID = mysql_query($sql);
  if($Record = mysql_fetch_array($Query_ID)){
  echo "用户名".$yfyshname."已存在<input type=\"hidden\" name=\"yfyshnameture\" value=\"0\" />";
  }else{
  echo "用户名".$yfyshname."可用<input type=\"hidden\" name=\"yfyshnameture\" value=\"1\" />";
  }
?>