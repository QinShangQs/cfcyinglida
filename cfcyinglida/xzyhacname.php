<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');


$yfyshname=$_GET['name'];
if($yfyshname!="")
{
  $sql = "select id from `manager` where `names`='".$yfyshname."'";

  $Query_ID = mysql_query($sql);
  if($Record = mysql_fetch_array($Query_ID)){
  echo "用户名".$yfyshname."已存在<input type=\"hidden\" name=\"yhnameture\" value=\"0\" />";
  }else{
  echo "用户名".$yfyshname."可用<input type=\"hidden\" name=\"yhnameture\" value=\"1\" />";
  }
}
else {echo "用户名不可用<input type=\"hidden\" name=\"yhnameture\" value=\"0\" />";} 
?>