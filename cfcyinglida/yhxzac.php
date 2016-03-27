<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//用户类型
$yhlx = $_POST['yhlx'];
if($yhlx==""){$yhlx='2';}
else if($yhlx=='5'){
$xgyqytmp=$_POST[xgyqy];
$xgyqy= implode(",",$xgyqytmp);
}
//用户名
$names = $_POST['UserName'];
//密码
$wpwds = $_POST['Password'];
//确认密码
$rpwds = $_POST['ConfirmPassword']; 

$yhnameture = $_POST['yhnameture'];
//$yhnameture=1;
if($yhnameture!=""&&$yhnameture!="0")
{
  if($wpwds!=$rpwds)
  {echo '<span style="color: red">弹出错误！两次密码不一样</span> <a href="yhgl.php">点击返回重试</a>';exit();}
  else {$pwds= md5($wpwds);}

  //名称
  $yhyl1 = $_POST['Xingming'];
  //联系电话
  $phones = $_POST['Shouji'];
  //是否启用  1启用 2未启用
  $yhzht = $_POST['IsApproved'];
  if($yhzht!="1"){$yhzht="0";}
  if($names!=""&&$pwds!="")
  {
    $query="insert into `manager`(names,pwds,yhyl1,phones,yhzht,`yhyl2`,`yhyl3`)values('$names','$pwds','$yhyl1','$phones','$yhzht','$yhlx','$xgyqy')";
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败 <a href=\"yhgl.php\">点击返回重试</a>";
    }
    else{
    echo "成功！<br/>";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=yhgl.php\">";
    }
  }
}else { echo "错误! <a href=\"yhgl.php\">点击返回重试</a>";}
?>