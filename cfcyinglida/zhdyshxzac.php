<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yyid = $_POST['yyid'];
//医院科室
$yyksh = $_POST['yyksh'];
//指定医生
$zhdysh = $_POST['zhdysh'];
//医生联系方式
$zhdyshdh = $_POST['zhdyshdh'];
//指定医生样张
$zhdyshyzh = $_POST['zhdyshyzh'];
//授权一医生
$shqysh1 = $_POST['shqysh1'];
//授权一医生样张
$shqyshyzh1 = $_POST['shqyshyzh1'];
//授权一联系方式
$shqyshdh1 = $_POST['shqyshdh1'];
//授权二医生
$shqysh2 = $_POST['shqysh2'];
//授权二医生样张
$shqyshyzh2 = $_POST['shqyshyzh2'];
//授权二联系方式
$shqyshdh2 = $_POST['shqyshdh2'];
//授权三医生
$shqysh3 = $_POST['shqysh3'];
//授权三医生样张
$shqyshyzh3 = $_POST['shqyshyzh3'];
//授权三联系方式
$shqyshdh3 = $_POST['shqyshdh3'];
//医生培训期数
$yshpxqsh = $_POST['yshpxqsh'];
//医生培训日期
$yshpxrq = $_POST['yshpxrq'];
//医生是否生效
$yhszht = $_POST['yhszht'];
//是否接收AE回访
$shfjshhf = $_POST['shfjshhf'];
//医生联系方式2
$zhdyshdh2 = $_POST['zhdyshdh2'];
//指定医生电子邮箱
$zhdyshemail = $_POST['zhdyshemail'];

//擅长病种
$shchbzhs=$_POST[shchbzh];
//$shchbzh = implode(",",$shchbzhs);
$$shchbzh = '';
if($yyid!=""){
  $sql = "select yymch,yymchjx,sheng,shengjx,yydhz,yyksh,yyzhdyf,shi,shijx,qu,qujx from `yyyshdq` where `id` = '".$yyid."' ";

  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  
//医院名称：
$yymch = $Record[0];
$yymchjx = $Record[1];
//医院所在城市
$sheng = $Record[2];
$shengjx = $Record[3];
//医院地址
$yydhz = $Record[4];

//医院指定药房
$yyzhdyf = $Record[6];

$shi = $Record[7];
$shijx = $Record[8];
$qu = $Record[9];
$qujx = $Record[10];
} 

/*
//用户名
$names = $_POST['yfyshname'];
//密码
$wpwds = $_POST['yfyshpwd'];
//确认密码
$rpwds = $_POST['yfyshrpwd'];
$shfzt = $_POST['shfzt'];
if($wpwds!=$rpwds)
{echo '<span style="color: red">弹出错误！两次密码不一样</span> <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />';exit();}
else {$pwds= md5($wpwds);}
*/


//名称
$yhyl1 = $yfzhdysh;
//联系电话
$phones = $yfshj;
//是否启用  1启用 2未启用
$yhzht = $shfzt;
if($yhzht!="1"){$yhzht="0";}
/*if($names!=""&&$pwds!=""){
//echo "aaaaa";
$query="insert into `manager`(`names`,`pwds`,`yhyl1`,`phones`,`yhzht`,`gldw`,`yhyl2`)values('$names','$pwds','$yhyl1','$phones','$yhzht','$yfmch','4')";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "添加失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }else{
    $query="insert into `yyyshdq`(sheng,shengjx,yymch,yymchjx,yyksh,zhdysh,zhdyshdh,zhdyshyzh,shqysh1,shqyshyzh1,shqyshdh1,shqysh2,shqyshyzh2,shqyshdh2,shqysh3,shqyshyzh3,shqyshdh3,yshpxqsh,yshpxrq,yydhz,yhszht,yyzhdyf,shfjshhf,shi,shijx,qu,qujx,zhlbzh)values('$sheng','$shengjx','$yymch','$yymchjx','$yyksh','$zhdysh','$zhdyshdh','$zhdyshyzh','$shqysh1','$shqyshyzh1','$shqyshdh1','$shqysh2','$shqyshyzh2','$shqyshdh2','$shqysh3','$shqyshyzh3','$shqyshdh3','$yshpxqsh','$yshpxrq','$yydhz','$yhszht','$yyzhdyf','$shfjshhf','$shi','$shijx','$qu','$qujx','$shchbzh')";

  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <a href=\"manager.php\">点击返回重试</a>";
  }
    else{
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=zhdyygl.php\">";
    }
}
}else
  {
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }*/
  

    $query="insert into `yyyshdq`(sheng,shengjx,yymch,yymchjx,yyksh,zhdysh,zhdyshdh,zhdyshyzh,shqysh1,shqyshyzh1,shqyshdh1,shqysh2,shqyshyzh2,shqyshdh2,shqysh3,shqyshyzh3,shqyshdh3,yshpxqsh,yshpxrq,yydhz,yhszht,yyzhdyf,shfjshhf,shi,shijx,qu,qujx,zhlbzh,zhdyshdh2,zhdyshemail)values('$sheng','$shengjx','$yymch','$yymchjx','$yyksh','$zhdysh','$zhdyshdh','$zhdyshyzh','$shqysh1','$shqyshyzh1','$shqyshdh1','$shqysh2','$shqyshyzh2','$shqyshdh2','$shqysh3','$shqyshyzh3','$shqyshdh3','$yshpxqsh','$yshpxrq','$yydhz','$yhszht','$yyzhdyf','$shfjshhf','$shi','$shijx','$qu','$qujx','$shchbzh','$zhdyshdh2','$zhdyshemail')";
	
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <a href=\"manager.php\">点击返回重试</a>";
  }else{
    echo "成功！<br/>";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=zhdyygl.php\">";
  }
}
?>