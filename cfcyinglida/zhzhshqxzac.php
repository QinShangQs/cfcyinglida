<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//患者id
$hzhid = $_POST['id'];
//申请理由：
$ly = $_POST['Liyou'];
//申请日期
$shqrq = $_POST['ShenqingRiqi'];
//就诊指定医生：
$zhzhyy = $_POST['jzhzhdysh'];
//转诊意见
$zhzhyj = $_POST['ZhuanzhenYijian'];
//转诊日期
$zhzhrq = $_POST['ZhuanzhenYishengQianziRiqi'];
//接诊指定医生
$jzhyy = $_POST['JiezhenYishengId'];
//接诊意见
$jzhyj = $_POST['JiezhenYijian'];
//接诊日期
$jzhrq = $_POST['JiezhenYishengQianziRiqi'];
//项目办公室意见
$xmbgshyj = $_POST['XiangmuBangongshiYijian'];
//经办人
$jbr = $_POST['JingbanrenId'];
//经办日期：
$jbrq = $_POST['JingbanrenQianziRiqi'];
//主任签字日期
$zhrqzrq = $_POST['ZhurenQianziRiqi'];
//转诊申请状态
$zhzhzht = $_POST['ZhuangtaiMingcheng'];
//转出药房
$zhchyf = $_POST['zhchyfid'];
//转入药房
$zhryf = $_POST['lyyfid'];

  $query="insert into `zhzh`(hzhid,ly,shqrq,zhzhyy,zhzhyj,zhzhrq,jzhyy,jzhyj,jzhrq,xmbgshyj,jbr,jbrq,zhrqzrq,zhzhzht,zhchyf,zhryf)values('$hzhid','$ly','$shqrq','$zhzhyy','$zhzhyj','$zhzhrq','$jzhyy','$jzhyj','$jzhrq','$xmbgshyj','$jbr','$jbrq','$zhrqzrq','$zhzhzht','$zhchyf','$zhryf')";
  //echo $query;
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <a href=\"shqgl.php\">点击返回重试</a>";
  }
  else{
  $query="UPDATE `hzh` SET `zhzhyy`='$jzhyy',`lyyf`='$zhryf' WHERE `id` ='$hzhid'";
      $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
    
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$hzhid\">";
    }
  }



?> 