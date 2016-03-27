<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//发出药房
$fchyf=$_POST['fchyfname'];echo "<br>";
//转入药房
$zhryf=$_POST['fryfname'];
//数量
$shl=$_POST['zhrshl'];
//规格
$zhrgg=$_POST['dbypgg'];
$sql="insert into `yfdb` (`fcyfid`,`fryfid`,`dbzht`,`dbypgg`,`dbyppsh`) values('$fchyf','$zhryf','0','$zhrgg','$shl')";
$result=mysql_query($sql);
if($result){
echo "成功！<br/>";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=yfdbgl.php\">";
}
?>
    
    

