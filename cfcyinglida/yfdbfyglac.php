<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw=$_SESSION[gldw];
$fyr=$_SESSION[yhname];//发运人
$id=$_POST['hidden'];
$ph=$_POST['pihao'];  //批号
$shl=$_POST['fyshl'];//数量
$ydh=$_POST['yundanhao'];//运单号
$rq=$_POST['fyrq'];//发运日期
$ypgg=$_POST['fygg'];//发运规格
$kfrkid='';
$fyidsql="select * from `kfrk` where `ph`='".$ph."'";
$fyidquery=mysql_query($fyidsql);
while($fyidRecord=mysql_fetch_array($fyidquery)){
$kfrkid.=$fyidRecord[0].',';
}
$str=substr($kfrkid,-1);
$newkfrkid=$kfrkid-$str;
//$kfrkarr=explode(',',$kfrkid);
//$uniquekfrkid=array_unique($kfrkarr);
//$kfrkstr=implode(',',$uniquekfrkid);
$shdshlsql="select SUM(`pfshl1`) from `yfshqzy` where `ph1` in ($newkfrkid) and `yfmch`='".$yhgldw."'";
$shdshlquery=mysql_query($shdshlsql);
while($shdshlRecord=mysql_fetch_array($shdshlquery)){
$yfrkzsh=$shdshlRecord[0];    //本批号入库总数
}
$bphfysql="select SUM(`fyshl`) from `zyff` where `ypph` in ($newkfrkid) and `yfmch`='".$yhgldw."'";
$bphfyquery=mysql_query($bphfysql);
while($bphfyRecord=mysql_fetch_array($bphfyquery)){
  $bphfyzsh=$bphfyRecord[0];
}
//echo $yfrkzsh;
//echo "<br>";
//echo $bphfyzsh;
$kcshl=$yfrkzsh-$bphfyzsh;   //当前本批号的药物库存
//echo $kcshl;            
$fyhkcshl=$kcshl-$shl;   //发药后的库存数
if($fyhkcshl<0||$kcshl<0){
  echo "失败 当前库存不足 <input type=\"button\" onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
  exit();
}else{
  $sql="update `yfdb` set `dbzht`='1',`dbypgg`='$ypgg',`yfshjfyshl`='$shl',`dbypfyrq`='$rq',`fcyfysh`='$fyr',`dbypydh`='$ydh',`ph`='$ph' where `id`='".$id."'";
  $query=mysql_query($sql);
  if($query){
    echo "成功！<br/>";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=yfdbgl.php\">";
  }else{
    echo mysql_error();
    echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
}
?>
