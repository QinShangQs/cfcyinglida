<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yyid=$_GET['yyid'];
$yysql = "select yyzhdyf from `yyyshdq` where `id`='".$yyid."'";
$yyQuery_ID = mysql_query($yysql);
while($yyRecord = mysql_fetch_array($yyQuery_ID)){
   $yfmch=$yyRecord[0];
}
if($yfmch!="")
{
  /*if($r=="1"){
    echo trim($yfid);
  }
  if($r=="2"){
    $lyyfnamesql = "select yfsheng,yfmch,yfzhdysh,yfdh from `yf` where `id`='".$yfid."'";
    $lyyfnameQuery_ID = mysql_query($lyyfnamesql);
    while($lyyfnameRecord = mysql_fetch_array($lyyfnameQuery_ID)){
      echo $lyyfnameRecord[0]." ".$lyyfnameRecord[1]." ".$lyyfnameRecord[2]." ".$lyyfnameRecord[3];
    }
    
  }*/echo $yfmch;
}
?>