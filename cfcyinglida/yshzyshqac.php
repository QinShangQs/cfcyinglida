<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw = $_SESSION[gldw];
$yhname = $_SESSION[yhname];
$yhid = $_SESSION[yhid];
$yhln = $_SESSION[yhln];

  $yhsql = "select id from `yf` where `yfyshname`='".$yhln."'";
  $yhQuery_ID = mysql_query($yhsql);
  while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yshid=$yhRecord[0];}
//规格（1）
$gg1 = $_POST['gg1']; 
//库存数量（瓶）
$kcshl1 = $_POST['kcshl1'];
//申请数量（瓶）
$shqshl1 = $_POST['shqshl1'];

$shqzht="0";
$shqrq=date('Y-m-d');
$shqshc=$_POST['shouceshl'];
  $query="insert into `yfshqzy`(yshxm,gg1,kcshl1,shqshl1,shqzht,shqrq,yfmch,shqshc)values('$yhname','$gg1','$kcshl1','$shqshl1','$shqzht','$shqrq','$yhgldw','$shqshc')";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <a href=\"manager.php\">点击返回重试</a>";
  }
  else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=manager.php\">";
  }
?>
