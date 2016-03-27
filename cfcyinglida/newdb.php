<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
if(!Mysql_connect("localhost","root","root")) // cfc.201511 123456
  echo "连接数据库失败";
  Elseif(!Mysql_select_db("cfcyinglida"))
  echo "打开数据库失败";
date_default_timezone_set('prc');
mysql_query("set names utf8");
$path=$_SERVER["PHP_SELF"]; 
$logintf=0;
if($path=="/indexac.php"){$logintf=1;}
if($_SESSION[yhid]==""&&$_SESSION[yhname]==""&&$logintf=="0"){
echo  "未登录 <a href=\"/\">登陆</a>"; exit();
}

if($_SESSION[yhshf]===5&&$xpapqx!=$_SESSION[yhshf]){
    echo  "无权查看"; exit();
}
/** 获取当前时间戳，精确到毫秒 */
function microtime_float()
{
   list($usec, $sec) = explode(" ", microtime());
   return ((float)$usec + (float)$sec);
}

/** 格式化时间戳，精确到毫秒，x代表毫秒 */
function microtime_format($tag, $time)
{
   list($usec, $sec) = explode(".", $time);
   $date = date($tag,$usec);
   return str_replace('x', $sec, $date);
}

//系统日志插入
$xtrzhyhid=$_SESSION[yhid];//jlid
$xtrzhyhname=$_SESSION[yhname];//czr
$xtrzhurl=$path;//url
$xtrzhuser_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
$xtrzhuser_IP = ($xtrzhuser_IP) ? $xtrzhuser_IP : $_SERVER["REMOTE_ADDR"];
$xtrzhip=$xtrzhuser_IP;//ip


/*
//验证药方盘点
    if($_SESSION[yhshf]=='3'){
    
      $yzhpdny = date('Y-m',strtotime("-1 month",strtotime(date('Y-m'))));
      //$yzhpdsql = "select `id` from `kfkcpd` where `dwmch`='".$_SESSION[gldw]."' and `dzhny`='$yzhpdny' ORDER BY `id` DESC ";
      $yzhpdsql = "select `id`,`dzhny` from `kfkcpd` where `dwmch`='".$_SESSION[gldw]."' ORDER BY `id` DESC limit 0,1";
      $yzhpdid='';
      $yzhpdQuery_ID = mysql_query($yzhpdsql);
      while($yzhpdRecord = mysql_fetch_array($yzhpdQuery_ID)){$yzhpdid=$yzhpdRecord[0];$yzhpdidny=$yzhpdRecord[1];}
      if($yzhpdid==''||$yzhpdny>$yzhpdidny){$yzhyfshfpdzht=1;
        if(date('d')>5){
          if($path!="/yshkcpdxz.php"){
            if($path!="/yshkcpdxzac.php"){
              header("location: yshkcpdxz.php");
            }
          }//echo $yzhpdid;
        }
      }else{
        //echo "盘点错误".$yzhpdid;
        $yzhpdzhtsql = "select `zhtsd` from `kfkcpdmx` where `pdid`='".$yzhpdid."'";
        $yzhpdzht='';
        $yzhpdzhtQuery_ID = mysql_query($yzhpdzhtsql);
        while($yzhpdzhtRecord = mysql_fetch_array($yzhpdzhtQuery_ID)){
          $yzhpdzht=$yzhpdzhtRecord[0];
          if($yzhpdzht!=""&&$yzhpdzht!=0){$yzhyfshfpdzht=1;
            if($path!="/yshkcpdxg.php"){
              if($path!="/yshkcpdxgac.php"){
                header("location: yshkcpdxg.php");
                //echo $path;
              }else{
                //echo $path;
              }
            }else{
              //echo $path;
            }
          }
        }
      }
    }//echo $path;
//验证药方盘点
*/

?>

