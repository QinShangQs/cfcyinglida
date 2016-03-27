<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//患者id
$id = $_POST['id'];
//该事件信息来源
$shjly = $_POST['shjly'];
//医生是否接受随访：
$shfjshhf = $_POST['shfjshhf'];
//赛可瑞用量及用法
$skrylyf = $_POST['skrylyf'];
//事件描述
$shjmsh = $_POST['shjmsh'];
//获知日期
$hzhrq = $_POST['hzhrq'];
//是否继续用药
$shfjxyy = $_POST['shfjxyy'];
//报送辉瑞日期
$bghrrq = $_POST['bghrrq'];
//CFC填表人
$cfctbr = $_POST['cfctbr'];
//cfc填表人id
$cfctbrid = $_POST['tbrid'];
//是否修改医生：
$xgysh = $_POST['xgysh'];
$xgyshid =  $_POST['xgyshid'];

  $query="UPDATE `blshj` SET `shjly`='$shjly',`shfjshhf`='$shfjshhf',`skrylyf`='$skrylyf',`shjmsh`='$shjmsh',`hzhrq`='$hzhrq',`shfjxyy`='$shfjxyy',`bghrrq`='$bghrrq',`cfctbr`='$cfctbr',`cfctbrid`='$cfctbrid' ";
  if($xgysh=='1'){$query.=",`yshid`='$xgyshid'";}
  $query.=" WHERE `id` = '$id'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=blshjxx.php?id=".$id."\">";
  }

?>
