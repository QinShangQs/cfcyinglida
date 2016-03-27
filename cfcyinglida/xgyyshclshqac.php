<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
$xpapqx=5;//设置协管员可以查看的页面
include('newdb.php');
//医生id
$yshid=$_POST['yshid'];
//患者资料夹
$zlj = $_POST['zlj']; 
//申请表
$shqb = $_POST['shqb'];
$shqr=$_SESSION[yhname];
$shqrq=date('Y-m-d');

  $query="insert into `xgyyshxmclshq`(`yshid`,`hzhzlj`,`shqb`,`shqrq`,`shqr`)values('$yshid','$zlj','$shqb','$shqrq','$shqr')";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <a href=\"xgyzhdyyysh.php\">点击返回重试</a>";
  }
  else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=xgyzhdyyysh.php\">";
  }
?>
