<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$shqid=$_POST['id'];
//批号1
$ph1=$_POST['ph1'];
//批号1
if($ph1==""){$ph1="0";}
//运单号
$ydh=$_POST['ydh'];

//规格
$gg = $_POST['gg'];

$pfshl1=$_POST['pfshl1'];

$fyrq=date('Y-m-d');

$fyr=$_SESSION[yhid];

$kfrksql = "select SUM(bjshl) from `kfrk` where `gg`='$gg'";

$kfrkQuery_ID = mysql_query($kfrksql);
while($kfrkRecord = mysql_fetch_array($kfrkQuery_ID)){
$rkzsh1=$kfrkRecord[0];
}
$kfchksql = "select SUM(pfshl1) from `yfshqzy` where `shqzht`>='2'";
$kfchkQuery_ID = mysql_query($kfchksql);
while($kfchkRecord = mysql_fetch_array($kfchkQuery_ID)){
$chkzsh1=$kfchkRecord[0];
}
if(($rkzsh1-$chkzsh1)>$pfshl1||$pfshl1==0)
{
    $query="UPDATE `yfshqzy` SET `shqzht`='2',`fyrq`='$fyrq',`ph1`='$ph1',`ydh`='$ydh',`fyr`='$fyr'  WHERE `id` ='$shqid'";
    //echo $query;
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=kfcfcfyzhl.php\">";
    }
}else{
      echo "失败 库房库存数量不足 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}
?>

