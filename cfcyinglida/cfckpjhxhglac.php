<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id = $_GET['id'];
$xhrq = date('Y-m-d');
$czr = $_SESSION[yhid];
  
  $query="UPDATE `gdkphsh` SET `xhrq`='$xhrq' ,`czr`='$czr',`zht`='0' WHERE `id` = '$id'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
    $query="UPDATE `zyff` SET `kpzht`='4' WHERE `kpdbpc`='$id'"; //1 药房，2 cfc，3 国大,4 销毁
    $result=mysql_query($query);
    //echo $query;
    if(!$result)
    { 
      echo mysql_error();
      echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }else{
    //echo $query;
      echo "成功 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }  
  }
?>