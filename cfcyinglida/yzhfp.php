<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$haoma = $_GET['fphm'];    //发票号码
$hzhxm = $_GET['xm'];        //患者姓名
$sql = "select * from `hrfpdj` where `fph` = '$haoma' and `yhxx` = '$hzhxm' and `zht` = '1'";
$query = mysql_query($sql);
$num = mysql_num_rows($query);
if($num){
  echo "<span style=\"color:green; \">有效</span>";
}else{
  echo "<span style=\"color:red; \">无效</span>";
}
?>