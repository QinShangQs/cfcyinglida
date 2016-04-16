<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$shqid=$_POST['id'];
$pfrq=date('Y-m-d');
$pfshl1=$_POST['pfshl1'];
$pfshl2=$_POST['pfshl2'];
$pfnr=$_POST['pfnr'];
$shhr=$_SESSION[yhid];
//规格
$gg = ( trim($_POST['gg']));

//echo $shfzt;
$kfrksql = "select SUM(bjshl) from `kfrk` where `gg` like '%$gg%'";
if($shyrq!=""){$kfrksql .= " where ".$shyrq;}//添加判断条件
$kfrkQuery_ID = mysql_query($kfrksql);

while($kfrkRecord = mysql_fetch_array($kfrkQuery_ID)){
$rkzsh1=$kfrkRecord[0];
}
//$kfchksql = "select SUM(pfshl1) from `yfshqzy` where `shqzht`>='2'";
$gg1 = explode('*', $gg);

$kfchksql = "select SUM(pfshl1) from `yfshqzy` where `shqzht`>='2' and `gg1` like '$gg1[0]%'";

if($fyrq!=""){$kfchksql .= " and ".$fyrq;}//添加判断条件
$kfchkQuery_ID = mysql_query($kfchksql);
while($kfchkRecord = mysql_fetch_array($kfchkQuery_ID)){
$chkzsh1=$kfchkRecord[0];
}

if(($rkzsh1-$chkzsh1)>$pfshl1||$pfshl1==0)
{
    $query="UPDATE `yfshqzy` SET `shqzht`='1',`pfrq`='$pfrq',`pfshl1`='$pfshl1',`pfnr`='$pfnr',`shhr`='$shhr' WHERE `id` ='$shqid'";
    //echo $query;
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=cfczyshqgl.php\">";
    }

echo "发药请转到库房操作";
}else{
      echo "失败 库房库存数量不足 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}
?>