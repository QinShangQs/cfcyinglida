<?php session_start(); //空瓶交回国大
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $yhgldw = $_SESSION[gldw];//关联药房名称
  $yhname = $_SESSION[yhname];//药师姓名
  $yhln = $_SESSION[yhln];
  $yhyshid = $_SESSION[yhid];
  $yhsql = "select yfmch,`id` from `yf` where `yfyshname`='".$yhln."'";
  $yhQuery_ID = mysql_query($yhsql);//得到药房名称
  while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yfmch=$yhRecord[0];$yfid=$yhRecord[1];}
  $yfidmchsql = "select id from `yf` where `yfmch`='".$yfmch."'";
  $yfidmchQuery_ID = mysql_query($yfidmchsql);//得到相同药房的编号
  while($yfidmchRecord = mysql_fetch_array($yfidmchQuery_ID)){$yfidmch[]=$yfidmchRecord[0];}
  $yshidsql = "select `id` from `manager` where (`names`='".$yhln."'";
for($i=0;$i<count($yfyshname);$i++)
{
  if($yfyshname[$i]!=null){
    $yshidsql .= " or `names`='".$yfyshname[$i]."' ";
  }
}
$yshidsql .=")";
  $yshidQuery_ID = mysql_query($yshidsql);//得到药师登陆的id
  while($yshidRecord = mysql_fetch_array($yshidQuery_ID)){$yshid[]=$yshidRecord[0];}
  
  /*$numquery="select * from `zyff` WHERE `jhkpshl`>'0' and `kpzht`='1' and (`fyr`='$yhyshid'";
for($i=0;$i<count($yshid);$i++)
{
  if($yshid[$i]!=null){
    $numquery .= " or `fyr`='".$yshid[$i]."' ";
  }
}
  $numquery .= ")"; */
  //1 药房，2 cfc，3 国大,4 销毁
  //$numquery="select * from `zyff` WHERE `jhkpshl`>'0' and `kpzht`='1' and `yfmch`='$yhgldw'";
  $numquery="select SUM(jhkpshl) from `zyff` WHERE `jhkpshl`>'0' and `kpzht`='1' and `yfmch`='$yhgldw'";
  $numresult=mysql_query($numquery);
  //$tjshl = mysql_num_rows($numresult);
  while($numRecord = mysql_fetch_array($numresult)){$tjshl =$numRecord[0];}

  if($tjshl>0)
  {
      $dqrq=date('Y-m-d');
      echo $gdkphshquery="insert into `gdkphsh`(`yshxm`,`fshrq`,`shl`,`zht`,`yfmch`)values('$yhname','$dqrq','$tjshl','1','$yhgldw')";
      $gdkphshresult=mysql_query($gdkphshquery);
      if(!$gdkphshresult)
      {
        echo mysql_error();
        echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub2\" />";
      }
      else{
        $getID=mysql_insert_id();

        //1 药房，2 cfc，3 国大,4 销毁
        $query="UPDATE `zyff` SET `kpzht`='3',`kpdbpc`='$getID' WHERE `jhkpshl`>'0' and `kpzht`='1' and `yfmch`='$yhgldw'";
        $result=mysql_query($query);
        //echo $query;
        if(!$result)
        {
          echo mysql_error();
  echo "药房无空瓶 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub2\" />";
        }else{
          //$tjshl=mysql_affected_rows();
          echo "成功 打包空瓶 $tjshl 瓶<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub2\" />";
        }
      }
  }else{
  echo "药房无空瓶 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub2\" />";
  }
  

?>
