<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');   
?>
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
  <tr style="color:#1f4248; height:30px;">
<?php
  $shimch=$_GET[shimch];
  if(isset($_GET['yyid'])){
$yyid = $_GET['yyid'];
$sql = "select `yyzhdyf` from `yyyshdq` where `id` = '$yyid'";
$query = mysql_query($sql);
while($Record = mysql_fetch_array($query)){
  $Recordarr =explode(',',$Record[0]);
}
  }
  $sql = "select * from `yf` where `shfzt`='1' and `yfshi`='".$shimch."' group by yfdzh order by yfshijx ASC ";  
  $Query_ID = mysql_query($sql);
  $yfshimch=1;
  while($Record = mysql_fetch_array($Query_ID)){
      echo "<td align=\"left\" bgcolor=\"#FFFFFF\"><input name='yyzhdyfs[]' type='checkbox' class='np' id='yyzhdyf".$yfshimch."' value='".$Record[1]."'>".$Record[1]."</td>";
//     echo "<td align=\"left\" bgcolor=\"#FFFFFF\"><input name='yyzhdyfs[]' type='checkbox' class='np' id='yyzhdyf".$yfshimch."' value='".$Record[1]."' checked disabled=true>".$Record[1]."</td>";
    $yfshimch=0;
  }
  
  if($yfshimch==1){
    $sql = "select * from `yf` where `shfzt`='1' group by yfdzh order by yfshijx ASC ";  
    $Query_ID = mysql_query($sql);
    $yfjshi=1;
    while($Record = mysql_fetch_array($Query_ID)){
      echo "<td align=\"left\" bgcolor=\"#FFFFFF\"><input name='yyzhdyfs[]' type='checkbox' class='np' id='yyzhdyf".$yfjshi."' value='".$Record[1]."' ";
      if(isset($_GET['yyid'])&&in_array($Record[1],$Recordarr)){echo " checked ";}
      echo ">".$Record[1]."</td>";
      //if($yfjshi>3){exit();}
      if($yfjshi%3==0){echo "</tr><tr style=\"color:#1f4248; font-size:12px;\">";}
      //echo $yfjshi;
      $yfjshi++;
    } 
  }
?>
  </tr>
</table>