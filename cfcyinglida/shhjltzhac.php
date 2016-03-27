<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id = $_POST['id'];

//停止申请
$jujue = $_POST['jujue'];
$qtshm = $_POST['qtshm'];
if($jujue=="其他"){$jujue=$qtshm; }
$jjxxshm = htmlspecialchars($_POST['jjxxshm']);

//审核人
$shhr = $_SESSION['yhname'];

$datenow = date('Y-m-d');

  
$query="UPDATE `hzh` SET `shqzht`='停止申请',`tzhrq`='$datenow',`shhyj`='$jujue',`dbrzshxshj`='',`zhshrzshj`='',`shhxcl`='0',`jjxxshm`='$jjxxshm' WHERE `id` ='$id'";

    $shhyj = "停止申请";

    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
    $bzh1=$jujue." 停止详情:".$jjxxshm;
$shhejlquery="insert into `shhejl`(hzhid,shhr,shhyj,shhrq,bzh)values('$id','$shhr','$shhyj','$datenow','$bzh1')";
$shhejlresult=mysql_query($shhejlquery);
if(!$shhejlresult)
{
echo mysql_error();
echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}
else{}
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$id\">";
    }
?>
