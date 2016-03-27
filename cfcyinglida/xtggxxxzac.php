<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$tshgn=$_POST['tshgn'];
$ggbt=$_POST['ggbt'];
$ggnr=$_POST['ggnr'];
$ggrq=$_POST['ggrq'];
$ggzht=$_POST['ggzht'];
$fqr=$_POST['fqr'];
$mxyh = '';
if(isset($_POST['xgy'])&&$_POST['xgy']!=''){
  $mxyh.= $_POST['xgy'];
}
if(isset($_POST['yfysh'])&&$_POST['yfysh']!=''){
  if(isset($_POST['xgy'])&&$_POST['xgy']!=''){
    $mxyh.=','.$_POST['yfysh'];
  }else{
    $mxyh.=$_POST['yfysh'];
  }
}
if(isset($_POST['ysh'])&&$_POST['ysh']!=''){
  if(isset($_POST['yfysh'])&&$_POST['yfysh']!=''){
    if(isset($_POST['xgy'])&&$_POST['xgy']!=''){
      $mxyh.= ','.$_POST['ysh'];
    }else{
      $mxyh.= ','.$_POST['ysh'];
    }
   }else{
    $mxyh.=$_POST['ysh'];
   }
}
//echo $mxyh;die;
//echo $tshgn." ".$ggbt." ".$ggnr." ".$ggrq." ".$ggzht." ".$fqr;

$query="INSERT INTO `xtggxx` (`tshgn` ,`ggbt` ,`ggnr` ,`zhdqx`,`ggrq` ,`ggzht` ,`fqr` )VALUES ( '$tshgn',  '$ggbt',  '$ggnr', '$mxyh', '$ggrq',  '$ggzht',  '$fqr')";
$result=mysql_query($query);
if(!$result)
{
  echo mysql_error();
  echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}
else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=xtggxx.php\">";
}    



?>