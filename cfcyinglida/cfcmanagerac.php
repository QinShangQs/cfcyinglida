<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_POST[id];
$purviews=$_POST[purviews];
//print_r($purviews);
/*print_r($purviews);
echo "</br>____________________</br>".$purviews;*/

$chchshj = implode(",",$purviews);
//echo $chchshj;die;
str_replace("admin_AllowAll","",$chchshj,$i);
if($i>0){$chchshj="admin_AllowAll";}
  $query="UPDATE `manager` SET `yhyl3`='$chchshj'  WHERE `id` = '".$id."'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
    //echo $query;
    //if($i>0){echo "有admin_AllowAll权限";}else{echo "无admin_AllowAll权限";}
      //echo "成功 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
      //echo "成功 <input type=\"button\"  onclick=\"javascript:{location.href='cfcyhgl.php'}\" value=\"返回\" class=\"lgSub\" />";
    echo "成功 <META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=cfcyhgl.php\">";
  }
?>

