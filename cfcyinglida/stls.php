<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
if(isset($_GET[id])){
$id=$_GET[id];
}else{
$id=0;
}
$tid=$id+50;
Mysql_select_db("suotantmp");
$sql="select `C` from `pinggu` where `U`='' group by `C` limit ".$id.",50"; 
$q=mysql_query($sql); 
while($r = mysql_fetch_array($q)){
/*echo $r[0]."</br>";*/
  echo $r[0]."</br>";
  Mysql_select_db("cfcyinglida");
  $hzhsql="select `id` from `hzh` where `hzhid`='".$r[0]."' ";
  $hzhq=mysql_query($hzhsql); 
  while($hzhr = mysql_fetch_array($hzhq)){
    echo $hzhr[0]."</br>";
    Mysql_select_db("suotantmp");
    $usql="UPDATE `pinggu` SET U = '".$hzhr[0]."' where  C = '".$r[0]."' ";
    $ur=mysql_query($usql);
    if(!$ur){     
      echo "<font color=red>失败C:".$r[0]."</font><br>";
    }else{
      echo "成功C:".$r[0]."<br>";
    } 
  }
}
?>
<?php 
//exit();
?>
已采集到id为<?php echo $tid;?>的内容，稍后继续更新下一页...
</br>
<script language="javascript" type="text/javascript"> 
setTimeout("window.location.href=\"stls.php?id=<?php echo $tid;?>\"",1000)
; 
</script>