<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id=$_POST['hiddenid'];
$ydh=$_POST['hzhydh'];
$hzhid=$_POST['hiddenhzhid'];
$sql="update `sfshc` set `ydh`='$ydh' where `id`=".$id;
$query=mysql_query($sql);
if($query){
//header("Location: shqxq.php?id=".$hzhid);
echo "<script type='text/javascript'>alert('修改成功');window.location.href='shqxq.php?id='+$hzhid;</script>";
}
?>