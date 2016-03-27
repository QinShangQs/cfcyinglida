<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  if($_SESSION[yhln]=='admin'&&$_GET[yfmch]!='')
  {
    $_SESSION[yhshf]='3';//身份
    setcookie("yhshf", '3', time()+3600);//身份
    $_SESSION[gldw]=$_GET[yfmch];//关联单位名称
    setcookie("gldw", $_GET[yfmch], time()+3600);//关联单位名称
    header("location: manager.php");
    exit();
    //echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=manager.php\">";
  }
  else if($_SESSION[yhln]=='admin'&&$_GET[shfhy]!=''){
    $_SESSION[yhshf]='10';//身份
    setcookie("yhshf", '10', time()+3600);//身份
    $_SESSION[gldw]='';//关联单位名称
    setcookie("gldw", '', time()+3600);//关联单位名称
    header("location: manager.php");
    exit();
  }
  else {echo "错误!您没有权限！ <a href=\"/\">登陆</a>";exit();}
?>

