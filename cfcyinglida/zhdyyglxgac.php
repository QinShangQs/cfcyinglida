<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yyid = $_POST['yyid'];
function chineseFirst($str)
{

    $str= iconv("UTF-8","gb2312", $str);    //如果程序是gbk的，此行就要注释掉

    //判断字符串是否全都是中文
    if (preg_match("/^[\x7f-\xff]/", $str))
    {
        $fchar=ord($str{0});   
        if($fchar>=ord("A") and $fchar<=ord("z") )return strtoupper($str{0});
        $a = $str; 
        $val=ord($a{0})*256+ord($a{1})-65536;
        if($val>=-20319 and $val<=-20284)return "A";   
        if($val>=-20283 and $val<=-19776)return "B";   
        if($val>=-19775 and $val<=-19219)return "C";   
        if($val>=-19218 and $val<=-18711)return "D";   
        if($val>=-18710 and $val<=-18527)return "E";   
        if($val>=-18526 and $val<=-18240)return "F";   
        if($val>=-18239 and $val<=-17923)return "G";   
        if($val>=-17922 and $val<=-17418)return "H";
        if($val>=-17417 and $val<=-16475)return "J";                 
        if($val>=-16474 and $val<=-16213)return "K";                 
        if($val>=-16212 and $val<=-15641)return "L";                 
        if($val>=-15640 and $val<=-15166)return "M";                 
        if($val>=-15165 and $val<=-14923)return "N";                 
        if($val>=-14922 and $val<=-14915)return "O";                 
        if($val>=-14914 and $val<=-14631)return "P";                 
        if($val>=-14630 and $val<=-14150)return "Q";                 
        if($val>=-14149 and $val<=-14091)return "R";                 
        if($val>=-14090 and $val<=-13319)return "S";                 
        if($val>=-13318 and $val<=-12839)return "T";                 
        if($val>=-12838 and $val<=-12557)return "W";                 
        if($val>=-12556 and $val<=-11848)return "X";                 
        if($val>=-11847 and $val<=-11056)return "Y";                 
        if($val>=-11055 and $val<=-10247)return "Z";
    } else
    {
        return false;
    }

} 

//医院名称：
$yymch = $_POST['yymch'];
$yymchjx = chinesechfen($yymch);
//医院所在城市
$sheng = $_POST['sheng'];
$shengjx = chinesechfen($sheng);
$shi = $_POST['shi'];
$shijx = chinesechfen($shi);
$qu = $_POST['qu'];
$qujx = chinesechfen($qu);
    if($sheng=="省份"){$sheng="";}
    if($shi=="地级市"){$shi="";}
    if($qu=="市、县级市"){$qu="";}
//医院地址
$yydhz = $_POST['yydhz'];
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
//擅长病种
//$shchbzhs=$_POST[shchbzh];
//$shchbzh = implode(",",$shchbzhs);
//医院指定药房
$yyzhdyfs=$_POST['yyzhdyfs'];
if($yyzhdyfs!= ''){
    $yyzhdyf = implode(",",$yyzhdyfs);
}
//是否接收AE回访
$shfjshhf = $_POST['shfjshhf'];
//医生联系方式2
$zhdyshdh2 = $_POST['zhdyshdh2'];
//指定医生电子邮箱
$zhdyshemail = $_POST['zhdyshemail'];


function chinesechfen($str)
{

  $list = array();
  $start = 0;
  $lengh = mb_strlen($str,'utf8');//这里可以是指定的长度
  while (count($list)<$lengh) {
      $list[] =  mb_substr($str, $start,1,'utf8');//也可以用$list .=
      $start++;
  }
  $i=0;
    $strr = '';
  for($i;$i<=$start;$i++)
  {
  $strr.=chineseFirst($list[$i]); 
  }
  return $strr;
}
  $query="UPDATE `yyyshdq` SET `sheng` = '$sheng' ,`shengjx` = '$shengjx' ,`yymch` = '$yymch'  ,`yymchjx` = '$yymchjx'  ,`yyksh` = '$yyksh'  ,`zhdysh` = '$zhdysh'  ,`zhdyshdh` = '$zhdyshdh'  ,`zhdyshyzh` = '$zhdyshyzh'  ,`shqysh1` = '$shqysh1'  ,`shqyshyzh1` = '$shqyshyzh1'  ,`shqyshdh1` = '$shqyshdh1'  ,`shqysh2` = '$shqysh2'  ,`shqyshyzh2` = '$shqyshyzh2'  ,`shqyshdh2` = '$shqyshdh2'  ,`shqysh3` = '$shqysh3'  ,`shqyshyzh3` = '$shqyshyzh3'  ,`shqyshdh3` = '$shqyshdh3'  ,`yshpxqsh` = '$yshpxqsh'  ,`yshpxrq` = '$yshpxrq'  ,`yydhz` = '$yydhz'  ,`yhszht` = '$yhszht'  ,`yyzhdyf` = '$yyzhdyf'  ,`shfjshhf` = '$shfjshhf'  ,`shi` = '$shi'  ,`shijx` = '$shijx'  ,`qu` = '$qu'  ,`qujx` = '$qujx' ,`zhlbzh` = '$shchbzh',`zhdyshdh2` = '$zhdyshdh2',`zhdyshemail` = '$zhdyshemail' WHERE `id` ='$yyid'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <a href=\"zhdyygl.php\">点击返回重试</a>";
  }
  else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=zhdyygl.php\">";
  }


?>