<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

$tshgn=$_POST['tshgn'];
$ggbt=$_POST['ggbt'];
$ggnr=$_POST['ggnr'];
$ggrq=$_POST['ggrq'];
$ggzht=$_POST['ggzht'];
$fqr=$_POST['fqr'];
$id=$_POST['id'];

        $query="UPDATE `xtggxx` SET `tshgn`='$tshgn',`ggbt`='$ggbt',`ggnr`='$ggnr',`ggrq`='$ggrq',`ggzht`='$ggzht',`fqr`='$fqr' WHERE `id` ='".$id."'";
        $result=mysql_query($query);
        if(!$result)
        {
          echo mysql_error();
          echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
        }
        else{
          echo "已更新！";
          echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=xtggxx.php\">";
        }

?>