<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
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
  for($i;$i<=$start;$i++)
  {
  $strr.=chineseFirst($list[$i]); 
  }
  return $strr;
}

//药房名称：
$yfmch=$_POST['yfmch'];
//药房所在城市
$yfsheng=$_POST['yfsheng'];
$yfshengjx = chinesechfen($yfsheng);
$yfshi=$_POST['yfshi'];
$yfshijx = chinesechfen($yfshi);
$yfqu=$_POST['yfqu'];
$yfqujx = chinesechfen($yfqu);
    if($yfsheng=="省份"){$yfsheng="";}
    if($yfshi=="地级市"){$yfshi="";}
    if($yfqu=="市、县级市"){$yfqu="";}
//药房地址
$yfdzh=$_POST['yfdzh'];
//联系方式(座机)
$yfdh=$_POST['yfdh'];
//联系方式(移动)
$yfshj=$_POST['yfshj'];
//联系方式(传真)
$yfchzh=$_POST['yfchzh'];
//联系方式(email)
$yfemail=$_POST['yfemail'];
//库容
$yfkcrl=$_POST['yfkcrl'];
//指定药师
$yfzhdysh=$_POST['yfzhdysh'];
//是否启用
$shfzt=$_POST['shfzt'];

//指定药师性别：
$yfzhdyshxb=$_POST['yfzhdyshxb'];
//指定药师样张：
$yfzhdyshyzh=$_POST['yfzhdyshyzh'];
//授权药师：
$yfshqysh=$_POST['yfshqysh'];
//授权药师样张：
$yfshqyshyzh=$_POST['yfshqyshyzh'];
//授权药师电话：
$yfshqyshdh=$_POST['yfshqyshdh'];

//培训班：
$pxb=$_POST['pxb'];
//培训日期：
$pxrq=$_POST['pxrq'];

$yfyshnameture=$_POST['yfyshnameture'];
if($yfyshnameture=="1"){

//用户名
$names = $_POST['yfyshname'];
//密码
$wpwds = $_POST['yfyshpwd'];
//确认密码
$rpwds = $_POST['yfyshrpwd'];
if($wpwds!=$rpwds)
{echo '<span style="color: red">弹出错误！两次密码不一样</span> <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />';exit();}
else {$pwds= md5($wpwds);}

//名称
$yhyl1 = $yfzhdysh;
//联系电话
$phones = $yfshj;
//是否启用  1启用 2未启用
$yhzht = $shfzt;
if($yhzht!="1"){$yhzht="0";}
if($names!=""&&$pwds!="")
{
  $query="insert into `manager`(`names`,`pwds`,`yhyl1`,`phones`,`yhzht`,`gldw`,`yhyl2`)values('$names','$pwds','$yhyl1','$phones','$yhzht','$yfmch','3')";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "添加失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
    $query="INSERT INTO `yf` (`yfmch` ,`yfsheng` ,`yfdzh` ,`yfdh` ,`yfshj` ,`yfchzh` ,`yfemail` ,`yfkcrl` ,`yfzhdysh` ,`shfzt` ,`yfshengjx`,`yfyshname`,`yfshi`,`yfshijx`,`yfqu`,`yfqujx`,`yfzhdyshyzh`,`yfshqysh`,`yfshqyshyzh`,`yfzhdyshxb`,`yfshqyshdh`,`pxb`,`pxrq`)VALUES ( '$yfmch',  '$yfsheng',  '$yfdzh',  '$yfdh',  '$yfshj',  '$yfchzh',  '$yfemail',  '$yfkcrl',  '$yfzhdysh',  '$shfzt',  '$yfshengjx',  '$names',  '$yfshi',  '$yfshijx',  '$yfqu',  '$yfqujx',  '$yfzhdyshyzh',  '$yfshqysh',  '$yfshqyshyzh',  '$yfzhdyshxb',  '$yfshqyshdh',  '$pxb',  '$pxrq')";
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }
    else{
      echo "成功！<br/>";
      echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=zhdyfgl.php\">";
    }
  }
}


}else{ echo "用户名已存在 请不要重复提交！ $yfyshnameture<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";}
?>