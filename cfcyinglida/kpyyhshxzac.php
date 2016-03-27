<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

  $hzhid = $_POST['id'];
  $kpgg=$_POST['kpgg'];
  $kpshl=$_POST['kpshl'];
  $yyshl=$_POST['yyshl'];
  $selectzhxqsh=$_POST['selectzhxqsh'];//lyr
  $gx=$_POST['zhxqshgx'];
  $lyrzhjhm=$_POST['zhxqshzhj'];
  $fyr=$_SESSION['yhname'];
  $yfmch=$_SESSION['gldw'];
  $fyrq=date('Y-m-d');
  $kpzht="1";//空瓶状态
  $yyzht="1";//余药状态
  if($kpgg==1){$kpgg='200mg/'.$kpshl;}
  else if($kpgg==2){$kpgg='250mg/'.$kpshl;}
  else{$kpgg='0';}
if($hzhid!=""&&$kpgg!=""&&$selectzhxqsh!=""&&$yyshl!="")
{
  $query="insert into `zyff`(`hzhid`,`jhkpgg`,`jhkpshl`,`jhshyyyshl`,`lyr`,`gx`,`lyrzhjhm`,`fyr`,`yfmch`,`fyrq`,`kpzht`,`yyzht`,`tshqk`)values('$hzhid','$kpgg','$kpshl','$yyshl','$selectzhxqsh','$gx','$lyrzhjhm','$fyr','$yfmch','$fyrq','$kpzht','$yyzht','1')";
  /*echo $query;*/
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 数据库错误 <input type=\"button\" onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
 echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=yshfygl.php\">";

  }
}else{
echo "失败 必填项目未完成 <input type=\"button\" onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}
?>
