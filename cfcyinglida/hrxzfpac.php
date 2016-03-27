<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
if(isset($_POST['submit'])){
  $haoma = $_POST['haoma'];
  $yfmch = $_POST['yfmch'];
  $yhxinxi = $_POST['yhxinxi'];
  $fpriqi = $_POST['fpriqi'];
  $zt = $_POST['zhuangtai'];
  $sql = "insert into `hrfpdj` (`fph`,`yfmch`,`yhxx`,`fprq`,`zht`) values ('$haoma','$yfmch','$yhxinxi','$fpriqi','$zt')";
  $query = mysql_query($sql);
  if($query){
    echo "成功<br/>";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=hrfpgl.php\">";
  }else{
    echo mysql_error();
    //echo $tshqkquery;
    echo "数据库错误 <input type=\"button\" onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub2\" />";
  }
}
?>