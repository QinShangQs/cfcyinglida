<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$id = $_POST['id'];
//是否批准
$shfpzh = $_POST['shfpzh'];
//拒绝原因
$jujue = $_POST['jujue'];
//是否重新审核
$shfshh = $_POST['shfshh'];
//是否办理入组
$shfrzh = $_POST['shfrzh'];
//预估办理入组时间
$ygrzhrq = $_POST['ygrzhrq'];
//领药药房id
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
$ygrq = $_POST['ygrq'];
//更换后日期
$ygrqgh = $_POST['ygrqgh'];



//审核人
$shhr = $_SESSION['yhname'];
//运单号
$shcydh = $_POST['shcydh'];
$datenow = date('Y-m-d');

$hzhid=sprintf("%05d", $id);//生成4位数，不足前面补0   
$query="UPDATE `hzh` SET ";
if($shfpzh=='1'){
    $shhyj = "批准-入组";
    $query.= $shqzht." WHERE `id` ='$id'";

    if($qryy=="1"){$rzyy=$selzhdyyid;}else {$rzyy=$zhdyyid;}
    $yysql = "select yyzhdyf,yymch,zhdysh from `yyyshdq` where `id`='".$rzyy."'";
    $yyQuery_ID = mysql_query($yysql);
    while($yyRecord = mysql_fetch_array($yyQuery_ID)){
        $rzyyzhdyf=$yyRecord[0];
        $rzyymch=$yyRecord[1];
        $rzyyzhdysh=$yyRecord[2];
    }
}
else{
$query.= " `shqzht`='拒绝',`shhyj`='$jujue',`jjrq`='$datenow',`dbrzshxshj`='',`zhshrzshj`='' WHERE `id` ='$id'";
}

    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
        if($shfshh !='1'){
        if($shfpzh!='1'){
            $bzh1=$jujue;
        }else{
            $bzh1=$bzh;
        }
        if($shhyj=="批准-入组"){$rzyyxx="入组医院/医生：".$rzyymch." ".$rzyyzhdysh;}else {$rzyyxx="";}
            $shhejlquery="insert into `shhejl`(hzhid,shhr,shhyj,shhrq,bzh)values
                                              ('$id','$shhr','$shhyj','$datenow','".$rzyyxx." ".$bzh1."')";
            $shhejlresult=mysql_query($shhejlquery);
        if(!$shhejlresult)
        {
            echo mysql_error();
            echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
        }else{}
      }
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$id\">";
    }
?>
