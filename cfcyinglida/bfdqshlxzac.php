<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$sheng=$_POST['sheng'];
$shi=$_POST['shi'];
$qu=$_POST['qu'];
$lx=$_POST['lx'];
$hj=$_POST['hj'];
$shfshx=$_POST['shfshx'];

$wjjshrq=$_POST['wjjshrq'];
$shxrq=$_POST['shxrq'];
$tyrq=$_POST['tyrq'];

$bzh=$_POST['bzh'];
//echo $sheng." ".$shi." ".$qu." ".$lx." ".$hj." ".$shl." ".$shfshx." ".$bzh;
if($shi!=""&&$shi!="地级市")
{
  $sql = "select id from `cblxdq` where `shi`='".$shi."' and `sheng` = '".$sheng."' and `lx`='$lx' and `hj`='$hj'";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    $ifbl=$Record[0];
  } /*echo $ifbl;*/
    if($ifbl!=""){
        $query="UPDATE `cblxdq` SET `sheng`='$sheng',`shi`='$shi',`qu`='$qu',`lx`='$lx',`hj`='$hj',`shfshx`='$shfshx',`bzh`='$bzh',`wjjshrq`='$wjjshrq',`shxrq`='$shxrq',`tyrq`='$tyrq' WHERE `id` ='".$Record[0]."'";
        $result=mysql_query($query);
        if(!$result)
        {
          echo mysql_error();
          echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
        }
        else{
          echo "已存在记录，已更新！";
          echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=bfdqzyshlgl.php\">";
        }

    }else{
    if($sheng=="省份"){$sheng=" ";}
    if($shi=="地级市"){$shi=" ";}
    if($qu=="市、县级市"){$qu=" ";}
      $query="INSERT INTO `cblxdq` (`sheng` ,`shi` ,`qu` ,`lx` ,`hj` ,`shfshx` ,`bzh` ,`wjjshrq` ,`shxrq` ,`tyrq` )VALUES ( '$sheng',  '$shi',  '$qu',  '$lx',  '$hj',  '$shfshx',  '$bzh',  '$wjjshrq',  '$shxrq',  '$tyrq')";
      $result=mysql_query($query);
      if(!$result)
      {
        echo mysql_error();
        echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
      }
      else{
        echo "成功！<br/>";
        echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=bfdqzyshlgl.php\">";
      }    
    }

}
?>