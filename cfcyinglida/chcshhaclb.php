<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $hzhid = $_GET['id'];

if (!empty($_POST)) {
    $json = $_POST;
    $clbl = $json['clbl'];
    $clid = $json['clid'];
    $clrq = $json['clrq'];
    $clyxbl = $json['clyxbl'];
    $clyxid = $json['clyxid'];
    $clyxrq = $json['clyxrq'];
    if($clid)
    {
      $clquery="UPDATE `clshhnr` SET `shfshd` = '$clbl' , `shdrq` = '$clrq'   WHERE  `mchid` ='$clid' and `hzhid` ='$hzhid'";
      //echo $clquery;
      $clresult=mysql_query($clquery);
      if(!$clresult)
      {
        echo mysql_error();
        echo "修改失败 <a href=\"shqgl.php\">点击返回重试</a>";
      }
      else{
        
      }
    }
    if($clyxid)
    {
      $clquery="UPDATE `clshhnr` SET `shfyx` = '$clyxbl' , `shhrq` = '$clyxrq'   WHERE  `mchid` ='$clyxid' and `hzhid` ='$hzhid'";
      //echo $zhxquery;
      $clresult=mysql_query($clquery);
      if(!$clresult)
      {
        echo mysql_error();
        echo "修改失败 <a href=\"shqgl.php\">点击返回重试</a>";
      }
      else{
        
      }
    }
}
?>