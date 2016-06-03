<?php
//药品破损新增
session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

//药房名称
$yfmch = $_POST['yfmch'];
//药师名称
$yshxm = $_POST['yfzhdysh'];

//药品规格
$ypgg = $_POST['ypgg'];
//破损盒数
$pshsh = $_POST['pshsh'];
//批号
$pihao = $_POST['pihao'];

//状态
$state="1";
//创建日期
$createDate=date('Y-m-d');

$query="insert into `psyp`(yshxm,yfmch,ypgg,pshsh,state,createDate,pihao)values('$yshxm','$yfmch','$ypgg','$pshsh','$state','$createDate','$pihao')";
$result=mysql_query($query);
if(!$result)
{
    echo mysql_error();
    echo "失败 <a href=\"yypsxzgl.php\">点击返回重试</a>";
}
else{
    echo "成功！<br/>";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=yppsgl.php\">";
}