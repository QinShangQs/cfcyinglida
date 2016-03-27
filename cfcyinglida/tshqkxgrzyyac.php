<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//患者id
$hzhid=$_POST['id'];
//当前入组医院id
$jzhzhdysh=$_POST['jzhzhdysh'];
//变更入组医院id
$JiezhenYishengId=$_POST['JiezhenYishengId'];
//echo $tshgn." ".$ggbt." ".$ggnr." ".$ggrq." ".$ggzht." ".$fqr;
//变更医院、医生
$yysql = "select yymch,zhdysh from `yyyshdq` where `id`='".$JiezhenYishengId."'";
$yyQuery_ID = mysql_query($yysql);
while($yyRecord = mysql_fetch_array($yyQuery_ID)){
  $bgyy=$yyRecord[0];
  $bgyyysh=$yyRecord[1];
}
//操作人
$shhr=$_SESSION[yhname];
//操作事项
$shhyj='变更入组医院';
//日期
$datenow = date('Y-m-d');


$query="UPDATE `hzh` SET `rzyy`='$JiezhenYishengId' WHERE `id` ='$hzhid'";
$result=mysql_query($query);
if(!$result)
{
  echo mysql_error();
  echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}
else{
      $shhejlquery="insert into `shhejl`(hzhid,shhr,shhyj,shhrq,bzh)values('$hzhid','$shhr','$shhyj','$datenow','特殊情况变更入组医院:".$bgyy." ".$bgyyysh."')";
      $shhejlresult=mysql_query($shhejlquery);
      if(!$shhejlresult)
      {
      echo mysql_error();
      echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
      }
      else{}
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=".$hzhid."\">";
}    



?>