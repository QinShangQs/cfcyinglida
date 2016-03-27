<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
$xpapqx=5;//设置协管员可以查看的页面
include('newdb.php');
//id
$id=$_POST['id'];
//批准患者资料夹数量
$pzhhzhzlj=$_POST['pzhhzhzlj'];
//批准患者资料夹版本
$zljbb=$_POST['zljbb'];
//批准申请表数量
$pzhshqb=$_POST['pzhshqb'];
//批准申请表版本
$shqbbb=$_POST['shqbbb'];
//验证批准开始
if($pzhhzhzlj>0&&$zljbb==""){echo "没有选择版本日期！<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";exit();}
if($pzhshqb>0&&$shqbbb==""){echo "没有选择版本日期！<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";exit();}
if($pzhshqb<=0&&$pzhhzhzlj<=0){echo "没有填写批准数量！<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";exit();}

$zljrksql="select SUM(clshl) from `cfchzhcl` where `cllx`='1'  and `clbb`='$zljbb' ";
//echo $sql;
$zljrkQuery_ID = mysql_query($zljrksql);
while($zljrkRecord = mysql_fetch_array($zljrkQuery_ID)){
    $zljrk=$zljrkRecord[0];
}
$shqbrksql="select SUM(clshl) from `cfchzhcl` where `cllx`='2' and `clbb`='$shqbbb' ";
//echo $sql;
$shqbrkQuery_ID = mysql_query($shqbrksql);
while($shqbrkRecord = mysql_fetch_array($shqbrkQuery_ID)){
  $shqbrk=$shqbrkRecord[0];
}

$zljchksql="select SUM(pzhhzhzlj) from `xgyyshxmclshq` where `zjlbb`='$zljbb' ";
//echo $sql;
$zljchkQuery_ID = mysql_query($zljchksql);
while($zljchkRecord = mysql_fetch_array($zljchkQuery_ID)){
    $zljchk=$zljchkRecord[0];
}
$shqbchksql="select SUM(pzhshqb) from `xgyyshxmclshq` where `shqbbb`='$shqbbb' ";
//echo $sql;
$shqbchkQuery_ID = mysql_query($shqbchksql);
while($shqbchkRecord = mysql_fetch_array($shqbchkQuery_ID)){
  $shqbchk=$shqbchkRecord[0];
}
if(($zljrk-$zljchk-$pzhhzhzlj)<0){echo "库存不足<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";exit();}
if(($shqbrk-$shqbchk-$pzhshqb)<0){echo "库存不足<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";exit();}

//验证批准结束
//运单号
$ydh=$_POST['ydh'];
//备注
$bzh=$_POST['bzh'];
$czr=$_SESSION[yhname];
$jchrq=date('Y-m-d');

  $query="UPDATE `xgyyshxmclshq` SET `jchrq`='$jchrq' ,`ydh`='$ydh',`czr`='$czr',`bzh`='$bzh',`zljbb`='$zljbb',`shqbbb`='$shqbbb',`pzhhzhzlj`='$pzhhzhzlj',`pzhshqb`='$pzhshqb' WHERE `id` = '$id'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=xgyxmzlshq.php\">";
  }
?>
