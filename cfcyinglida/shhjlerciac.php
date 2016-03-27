<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id = $_POST['id'];
//是否批准
//$shfpzh = $_POST['shfpzh'];
//拒绝原因
//$jujue = $_POST['jujue'];
//是否办理入组
//$shfrzh = $_POST['shfrzh'];
//预估办理入组时间
//$zhshrzshj = $_POST['rzrq'];
//医院id
$qryy = $_POST['qryy'];//判断 0 1 
$zhdyyid = $_POST['zhdyyid'];//判断 0 获取  
$selzhdyyid = $_POST['selzhdyyid'];//判断 1 获取 

//更换药房
$qryf = $_POST['qryf'];//判断 0 1 
$selzhdyf = $_POST['selzhdyf'];//判断 1 获取 

//手册寄出日期
$shcrq = $_POST['shcrq'];
//备注
$bzh = $_POST['bzh'];
//是否更换日期 1是0否
//$ygrq = $_POST['ygrq'];
//领药日期
$ygrqgh = $_POST['ygrqgh'];


//审核人
$shhr = $_SESSION['yhname'];
//运单号
$shcydh = $_POST['shcydh'];
$datenow = date('Y-m-d');

$yzhxx=0;
  
$query="UPDATE `hzh` SET ";


    if($qryy=="1"){$rzyy=$selzhdyyid;}else {$rzyy=$zhdyyid;}
    $yysql = "select yyzhdyf,yymch,zhdysh from `yyyshdq` where `id`='".$rzyy."'";
    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
       $rzyyzhdyf=$yyRecord[0];
       $rzyymch=$yyRecord[1];
       $rzyyzhdysh=$yyRecord[2];
    }

    if($qryf=="1"){$rzyyzhdyf=$selzhdyf;}
    /*$yfsql = "select id from `yf` where `id`='".$rzyyzhdyf."'";

    $yfQuery_ID = mysql_query($yfsql);
    while($yfRecord = mysql_fetch_array($yfQuery_ID)){
       $lyyfid=$yfRecord[0];
    }*/

    $shqzht = " `shqzht`='入组',`lyyf`='$rzyyzhdyf',`rzyy`='$rzyy',`hzhid`='$hzhid',`shhxcl`='0' ";
    if($ygrq=='1'){
      //$ygrqghxclyrq=date('Y-m-d',strtotime('-7 day',strtotime($ygrqgh)));
      $xcfyrqquery="UPDATE `xclyrq` SET `xclyrq`='$zhshrzshj' where `hzhid`='$id'";
      //echo $xcfyrqquery;
      $xcfyrqresult=mysql_query($xcfyrqquery);
      if(!$xcfyrqresult)
      {
        echo mysql_error();
        echo "添加下次发药日期失败 ";
      }
      else{
        echo "添加预估下次发药日期成功 ";
      }
    }
    $sfshcquery="insert into `sfshc`(hzhid,jchrq,ydh,lyyf,time)values('$id','$shcrq','$shcydh','$rzyyzhdyf','$ygrqgh')";      //随访手册
    $sfshcresult=mysql_query($sfshcquery);
    if(!$sfshcresult)
    {
      echo mysql_error();
      echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";

    }
    $shhyj = "批准-入组";

$query.= $shqzht." WHERE `id` ='$id'";

//die('aaaa');
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
    }
    else{
    if($shfpzh!='1'){$bzh1=$jujue;}else{$bzh1=$bzh;}
    if($shhyj=="批准-入组"){$rzyyxx="入组医院/医生：".$rzyymch." ".$rzyyzhdysh;}else {$rzyyxx="";}
      $shhejlquery="insert into `shhejl`(hzhid,shhr,shhyj,shhrq,bzh)values('$id','$shhr','$shhyj','$datenow','".$rzyyxx." ".$bzh1."')";
      $shhejlresult=mysql_query($shhejlquery);
      if(!$shhejlresult)
      {
      echo mysql_error();
      echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
      }
      else{}
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$id\">";
    }
?>
