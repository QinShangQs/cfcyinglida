<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$hzhchzyy = $_POST['ZhuangtaiMingcheng'];
if($hzhchzyy=="其他"){$hzhchzyy=$_POST['qtshm'];}
$shqzht = "出组";
$hzhid = $_POST['id'];

$jjxxshm = htmlspecialchars($_POST['jjxxshm']);
//审核人
$shhr = $_SESSION['yhname'];

$hzhchzrq = date('Y-m-d');
    $query="UPDATE `hzh` SET `shqzht`='$shqzht',`hzhchzyy`='$hzhchzyy',`hzhchzrq`='$hzhchzrq',`jjxxshm`='$jjxxshm' WHERE `id` ='$hzhid'";
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
      $shhejlquery="insert into `shhejl`(hzhid,shhr,shhyj,shhrq,bzh)values('$hzhid','$shhr','$shqzht','$hzhchzrq','".$hzhchzyy." 出组详情:".$jjxxshm."')";
      $shhejlresult=mysql_query($shhejlquery);
      if(!$shhejlresult)
      {
      echo mysql_error();
      echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
      }
      else{}
      echo "成功！<br/>";
      echo "<a href=\"shqxq.php?id=$hzhid\">返回患者详情</a> <a href=\"blshjxz.php?id=$hzhid\">提交不良事件报告</a>";
    }

?>
