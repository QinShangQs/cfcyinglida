<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

if(isset($_POST[xgyqy])){
  $xgyqytmp=$_POST[xgyqy];
  $xgyqy= implode(",",$xgyqytmp);
}

//id
$yhid = $_POST['yhid'];
//名称
$yhyl1 = $_POST['Xingming'];
//联系电话
$phones = $_POST['Shouji'];
//是否启用  1启用 2未启用
$yhzht = $_POST['IsApproved'];
if($yhzht!="1"){$yhzht="0";}
  $query="UPDATE `manager` SET `yhyl1` = '$yhyl1' , `phones`='$phones' , yhzht = '$yhzht'";
if($xgyqy!=""){
  $query.=" , `yhyl3`='$xgyqy'";
}
  $query.=" WHERE  `id` = '$yhid'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <a href=\"yhgl.php\">点击返回重试</a>";
  }
  else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=yhgl.php\">";
  }

?>   
  
