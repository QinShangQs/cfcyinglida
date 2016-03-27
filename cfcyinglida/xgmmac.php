<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//用户名
$yhid = $_POST['yhid'];
//密码
$wpwds = $_POST['Password'];
//确认密码
$rpwds = $_POST['ConfirmPassword'];
if($wpwds!=$rpwds)
{echo '<span style="color: red">弹出错误！两次密码不一样</span> <a href="yhgl.php">点击返回重试</a>';exit();}
else {$pwds= md5($wpwds);}

if($yhid!=""&&$pwds!="")
{

  $query="UPDATE `manager` SET `pwds` = '$pwds' WHERE  `id` = '$yhid'";
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
}
?>