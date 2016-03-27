<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$hzhid = $_POST['hzhid'];
//姓名
$hzhxm = $_POST['Xingming'];
//证件号码
$zhjlx = $_POST['zhjlx'];
$zhjhm = $_POST['ShenfenHaoma'];
//出生日期
$hzhchshrq = $_POST['hzhchshrq'];
//性别
$hzhxb = $_POST['hzhxingbie'];
//申请病种：
$shqbzh = $_POST['shqlx'];
//申请指定医院/医生：
$shqyy = $_POST['ShenqingYishengId'];
//患者通讯住址
$sheng = $_POST['sheng'];
$shi = $_POST['shi'];
if($sheng==$shi){$shi="";}
$qu = $_POST['qu'];
//街道地址
$Zhuzhi = $_POST['Zhuzhi'];
    if($sheng=="省份"){$sheng="";}
    if($shi=="地级市"){$shi="";}
    if($qu=="市、县级市"){$qu="";}
$hzhtxdzh = $sheng.$shi.$qu.$Zhuzhi;
///手机
$hzhshj = $_POST['shouji'];
//联系电话1
$dylxrdh = $_POST['dianhua2'];
//联系电话2
$derlxrdh = $_POST['dianhua3'];
//诊断类型：
$zhdlx = $_POST['Zhengduan'];
//户籍类型
$hzhhj = $_POST['hzhhj'];
//家庭人口
$hzhjtrk = $_POST['JiatingRenkou'];
//家庭年收入：
$jtnshr = $_POST['NianShouru'];
$rjshr = $jtnshr/$hzhjtrk;
//患者年收入
$hzhnshr = $_POST['hzhnshr'];
//参保类型：
$cblx = $_POST['CanBaoLeiXing'];
//参保地区
$cbdqsheng = $_POST['cbdqsheng'];
$cbdqshi = $_POST['cbdqshi'];
$cbdqqu = $_POST['cbdqqu'];
    if($cbdqsheng=="省份"){$cbdqsheng="";}
    if($cbdqshi=="地级市"){$cbdqshi="";}
    if($cbdqqu=="市、县级市"){$cbdqqu="";}
//捐助类型：
$jzhlx = $_POST['jzhlx'];
//捐助数量：
//$jzhshl = $_POST['JuanZengShuLiang'];
//用药剂量：
$ypgg = $_POST['yfjl'];
//用药方法
$ypyl = $_POST['yfcsh'].','.$_POST['yfzhq'];
if($ypyl=="其他"){$ypyl=$_POST['qtshm'];}
//项目申请信息表日期
$xmshqbtxrq = $_POST['XiangmuShenqingXinxiBiaoRiqi'];
//首次用药日期：
$shcyyshj = $_POST['ShouciYongyaoRiqi'];
//直系亲属
$zhxqsh[] = $_POST['ZhixiQinshusJson'];

$ygshcyyrq = $_POST['ygShouciYongyaoRiqi'];

/*新增用户时药房必须是医院制定药房*/
  $yfsql = "select yyzhdyf from `yyyshdq` where `id` = '".$shqyy."'";
  //echo $zhxqsh[0];
  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){
    $lyyf = $yfRecord[0];
  }
//最新要求性别以下内容不填写可用录入
//if($hzhxm!=""&&$zhjlx!=""&&$zhjhm!=""&&$shqbzh!=""&&$shqyy!=""&&$hzhtxdzh!=""&&$hzhshj!=""&&$zhdlx!=""&&$hzhhj!=""&&$hzhjtrk!=""&&$jtnshr!=""&&$cblx!=""&&$cbdqsheng!=""&&$jzhlx!=""&&$jzhshl!=""&&$ypgg!=""&&$ypyl!=""&&$xmshqbtxrq!=""&&$hzhchshrq!=""&&$hzhxb!=""&&$cbdqshi!=""&&$cbdqqu!=""&&$rjshr!=""){
if($hzhxm!=""&&$zhjlx!=""&&$zhjhm!=""&&$hzhchshrq!=""&&$hzhxb!=""){
  $query="UPDATE `hzh` SET `hzhxm`='$hzhxm' ,`zhjlx`='$zhjlx',`zhjhm`='$zhjhm',`shqbzh`='$shqbzh',`shqyy`='$shqyy',`hzhtxdzh`='$hzhtxdzh',`hzhshj`='$hzhshj',`dylxrdh`='$dylxrdh',`derlxrdh`='$derlxrdh',`zhdlx`='$zhdlx',`hzhhj`='$hzhhj',`hzhjtrk`='$hzhjtrk',`jtnshr`='$jtnshr',`cblx`='$cblx',`cbdqsheng`='$cbdqsheng',`jzhlx`='$jzhlx',`ypgg`='$ypgg',`ypyl`='$ypyl',`xmshqbtxrq`='$xmshqbtxrq',`shcyyshj`='$shcyyshj',`hzhchshrq`='$hzhchshrq',`hzhxb`='$hzhxb',`cbdqshi` ='$cbdqshi',`cbdqqu`='$cbdqqu',`rjshr`='$rjshr',`lyyf`='$lyyf',`jtnshr`='$jtnshr',`hzhnshr` = '$hzhnshr',`ygshcyyrq`='$ygshcyyrq' WHERE `id` = '$hzhid'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{

    $json = str_replace(']',"",str_replace('[',"",$zhxqsh[0]));
    $json = str_replace("},{","}|{",$json);
    $json = explode("|",$json);

  $delzhxquery="UPDATE `zhxqsh` set `gxzf`='0' WHERE `hzhid`='$hzhid'";
  $delzhxresult=mysql_query($delzhxquery);
  if(!$delzhxresult)
  {
    echo mysql_error();
    echo "添加直系亲属失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
  //echo "成功啊";

    for($i=0;$i<count($json);$i++)
    {
      echo "</br>";
//      $jsonsj = json_decode($json[$i]);
        if(get_magic_quotes_gpc())//如果get_magic_quotes_gpc()是打开的
        {

            $jsonsj = json_decode(stripslashes($json[$i]));//将字符串进行处理

        }
      $zhxxm = $jsonsj->姓名;
      $zhxzhjhm = $jsonsj->公民身份号码;
      $zhxjgzh = $jsonsj->军官证;
      $zhxgx = $jsonsj->与患者关系;
      $zhxlx = $jsonsj->联系方式;
      $txtnshr = $jsonsj->年收入;
      if($zhxxm!=''&&($zhxzhjhm!=''||$zhxjgzh!='')&&$zhxgx!=''){

          $zhxquery="INSERT INTO `zhxqsh` (`hzhid` ,`xm` ,`zhjhm` ,`yhzhgx` ,`lxfsh`,`jgzh`,`gxzf`,`nshr`)VALUES ( '$hzhid',  '$zhxxm',  '$zhxzhjhm',  '$zhxgx',  '$zhxlx',  '$zhxjgzh',  '1','$txtnshr')";

        $zhxresult=mysql_query($zhxquery);
        if(!$zhxresult)
        {
          echo mysql_error();
          echo "添加直系亲属失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
        }
        else{
          //echo "成功吗";
        }
      }
    }
  }
      if($ygshcyyrq!=''){
        $xcfyrqquery="UPDATE `xclyrq` SET `xclyrq`='$ygshcyyrq' where `hzhid`='$hzhid'";
        //echo $xcfyrqquery;
        $xcfyrqresult=mysql_query($xcfyrqquery);
        if(!$xcfyrqresult)
        {
          echo mysql_error();
          echo "更新下次发药日期失败 ";
        }
        else{
          echo "更新预估下次发药日期成功 ";
        }
      }
    echo "成功！<br/>";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$hzhid\">";
  }
}else{echo "必填内容为空，返回重试<input type=\"button\" onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";}



?>