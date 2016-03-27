<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$shqzht = $_POST['ZhuangtaiMingcheng'];
$hzhid = $_POST['id'];
$chcshhrq = date('Y-m-d');
    $query="UPDATE `hzh` SET `shqzht`='$shqzht',`chcshhrq`='$chcshhrq'";
if($shqzht=="审核"){
    $query.=",`shhxcl`='1' ";
}
    $query.=" WHERE `id` ='$hzhid'";
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
?>
