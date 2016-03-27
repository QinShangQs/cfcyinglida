<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//患者Id
$id = $_POST['Id'];
//随访时间
$sfrq = $_POST['sfrq'];
//随访方式
$sffsh = $_POST['sffsh'];
//被随访人
$bsfr = $_POST['bsfr'];
//与患者的关系
$yhzhgx = $_POST['yhzhgx'];
//随访事件详情
$sfshjxx = $_POST['sfshjxx'];
//备注
//$bzh = $_POST['bzh'];

//随访人
$sfr = $_SESSION[yhname];


if($id!=""&&$sfr!=""){

    $query="insert into `xjsfjl`(hzhid,sfrq,sffsh,bsfr,`yhzhgx`,`sfshjxx`,`bzh`,`sfr`)values('$id','$sfrq','$sffsh','$bsfr','$yhzhgx','$sfshjxx','$bzh','$sfr')";
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败 <a href=\"shqxq.php?id=$id\">点击返回重试</a>";
    }
    else{
    echo "成功！<br/>";
echo " <a href=\"shqxq.php?id=$id\">点击返回</a>";
echo " <a href=\"blshjxz.php?id=$id\">新增AE报告</a>";
    }
}else { echo "错误! <a href=\"shqxq.php?id=$id\">点击返回重试</a>";}
?>