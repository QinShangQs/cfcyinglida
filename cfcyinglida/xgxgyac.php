<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$xgyid = $_POST['xgyid'];
//用户名
$names = $_POST['UserName'];
//关联单位
$gldw = $_POST['gldw'];
$yhnameture = $_POST['yhnameture'];
//$yhnameture=1;
if($yhnameture!=""&&$yhnameture!="0")
{
  //名称
  $yhyl1 = $_POST['Xingming'];
  //联系电话
  $phones = $_POST['Shouji'];
  //是否启用  1启用 2未启用
  $yhzht = $_POST['IsApproved'];
  if($yhzht!="1"){$yhzht="0";}
  if($names!="")
  {
    $query="update `manager` set `names`='$names',`yhyl1`='$yhyl1',`gldw`='$gldw',`phones`='$phones',`yhzht`='$yhzht' where `id`='$xgyid'";
    //$query="insert into `manager`(names,yhyl1,gldw,phones,yhzht,`yhyl2`)values('$names','$yhyl1','$gldw','$phones','$yhzht','5')";
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败 <a href=\"xgygl.php\">点击返回重试</a>";
    }
    else{
    echo "成功！<br/>";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=xgygl.php\">";
    }
  }
}else { echo "错误! <a href=\"xgygl.php\">点击返回重试</a>";}
?>