<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$shqid=$_POST['id'];
$shdrq=$_POST['shdrq'];
$phshl1=$_POST['phshl1'];
$phshl2=$_POST['phshl2'];
$ph1_1_t=$_POST['ph1_1_t'];
$ph2_1_t=$_POST['ph2_1_t'];
$ph1=$_POST['ph1_1_p'];
$ph2=$_POST['ph2_1_p'];
$phs1=$_POST['ph1_1_s'];
$phs2=$_POST['ph2_1_s'];
$ydh=$_POST['ydh'];
$jlshjch=microtime_float();
if($phshl1>"1"){
  if($ph1_1_t=="1")
  {
    for($i=2;$i<=$phshl1;$i++)
    {
    $ph1 .= ",".$_POST["ph1_".$i."_p"];
    $phs1 .= ",".$_POST["ph1_".$i."_s"];
    }
  }
}
if($phshl2>"1"){
  if($ph2_1_t=="1")
  {
    for($i=2;$i<=$phshl2;$i++)
    {
    $ph2 .= ",".$_POST["ph2_".$i."_p"];
    $phs2 .= ",".$_POST["ph2_".$i."_s"];
    }
  }
}
//echo $ph1."<br />".$phs1."<br />".$ph2."<br />".$phs2;

    $query="UPDATE `yfshqzy` SET `shqzht`='3'";
    if($ph1!=""){$query .=",`ph1` = '$ph1' ,`phshl1` = '$phs1'";}
    if($ph2!=""){$query .=",`ph2` = '$ph2' ,`phshl2` = '$phs2'";}
    if($ydh!=""){$query .=",`ydh` = '$ydh'";}
    $query .=",`shdrq` = '$shdrq',`jlshjch` = '$jlshjch'  WHERE `id` ='$shqid'";
    //echo $query;

    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=yshzyshdgl.php\">";
    }


?>
   
        