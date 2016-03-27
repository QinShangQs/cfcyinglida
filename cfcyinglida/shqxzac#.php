<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

//姓名
$hzhxm = str_replace(" ","",$_POST['Xingming']);;
//证件号码
$zhjlx = $_POST['zhjlx'];
$zhjhm = $_POST['ShenfenHaoma'];
//出生日期
$hzhchshrq = $_POST['hzhchshrq'];
//性别
$hzhxb = $_POST['hzhxingbie'];
//申请病种：
$shqbzh = $_POST['ShenqingBingzhongq'];
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
$rjshr = round($jtnshr/$hzhjtrk, 2);
//参保类型：
$cblx = $_POST['CanBaoLeiXing'];
//参保地区
$cbdqsheng = $_POST['cbdqsheng'];
$cbdqshi = $_POST['cbdqshi'];
//$cbdqqu = $_POST['cbdqqu'];
    if($cbdqsheng=="省份"){$cbdqsheng="";}
    if($cbdqshi=="地级市"){$cbdqshi="";}
    //if($cbdqqu=="市、县级市"){$cbdqqu="";}
//捐助类型：
$jzhlx = $_POST['jzhlx'];
//捐助数量：
$jzhshl = $_POST['JuanZengShuLiang'];
//用药剂量：
$ypgg = $_POST['YongYaoJiLiang'];
//用药方法
$ypyl = $_POST['YongYaoFangFao'];
if($ypyl=="其他"){$ypyl=$_POST['qtshm'];}
//项目申请信息表日期
$xmshqbtxrq = $_POST['XiangmuShenqingXinxiBiaoRiqi'];
//首次申请材料登记日期：
$djrq = $_POST['djrq'];
//首次用药日期：
$shcyyshj = $_POST['ShouciYongyaoRiqi'];
//直系亲属
$zhxqsh[] = $_POST['ZhixiQinshusJson'];
//预估首次用药日期
$ygshcyyrq = $_POST['ygShouciYongyaoRiqi'];

$shqzht = "审核";
$chcshhrq = date('Y-m-d');

$djr=$_SESSION[yhname];
/*新增用户时药房必须是医院制定药房*/
  $yfsql = "select yyzhdyf from `yyyshdq` where `id` = '".$shqyy."'";

  $yfQuery_ID = mysql_query($yfsql);
  while($yfRecord = mysql_fetch_array($yfQuery_ID)){
    $lyyf = $yfRecord[0];
  }
//最新要求性别以下内容不填写可用录入
//if($hzhxm!=""&&$zhjlx!=""&&$zhjhm!=""&&$shqbzh!=""&&$shqyy!=""&&$hzhtxdzh!=""&&$hzhshj!=""&&$zhdlx!=""&&$hzhhj!=""&&$hzhjtrk!=""&&$jtnshr!=""&&$cblx!=""&&$cbdqsheng!=""&&$jzhlx!=""&&$jzhshl!=""&&$ypgg!=""&&$ypyl!=""&&$xmshqbtxrq!=""&&$hzhchshrq!=""&&$hzhxb!=""&&$cbdqshi!=""&&$cbdqqu!=""&&$rjshr!=""){
if($hzhxm!=""&&$zhjlx!=""&&$zhjhm!=""&&$hzhchshrq!=""&&$hzhxb!=""&&$djrq!=""){
  $query="INSERT INTO `hzh` (`hzhxm` ,`zhjlx` ,`zhjhm` ,`shqbzh` ,`shqyy` ,`hzhtxdzh` ,`hzhshj` ,`dylxrdh` ,`derlxrdh` ,`zhdlx` ,`hzhhj` ,`hzhjtrk` ,`jtnshr` ,`cblx` ,`cbdqsheng` ,`jzhlx` ,`jzhshl`,`ypgg` ,`ypyl` ,`xmshqbtxrq` ,`shcyyshj` ,`hzhchshrq` ,`hzhxb` ,`cbdqshi`  ,`cbdqqu` ,`rjshr` ,`shqzht` ,`chcshhrq`,`lyyf`,`ygshcyyrq`,`djrq`,`djr`,`wshshq`)VALUES ( '$hzhxm',  '$zhjlx',  '$zhjhm',  '$shqbzh',  '$shqyy',  '$hzhtxdzh',  '$hzhshj',  '$dylxrdh',  '$derlxrdh',  '$zhdlx',  '$hzhhj',  '$hzhjtrk',  '$jtnshr',  '$cblx',  '$cbdqsheng',  '$jzhlx',  '$jzhshl',  '$ypgg',  '$ypyl',  '$xmshqbtxrq',  '$shcyyshj',  '$hzhchshrq',  '$hzhxb',  '$cbdqshi',  '$cbdqqu',  '$rjshr',  '$shqzht',  '$chcshhrq',  '$lyyf',  '$ygshcyyrq',  '$djrq',  '$djr',  '0')";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败 <a href=\"shqgl.php\">点击返回重试</a>";
  }
  else{
    $getID=mysql_insert_id();
    $json = str_replace(']',"",str_replace('[',"",$zhxqsh[0]));
    $json = str_replace("},{","}|{",$json);
    $json = explode("|",$json);
    for($i=0;$i<count($json);$i++)
    {
      $jsonsj = json_decode($json[$i]);
      $zhxxm = $jsonsj->姓名;
      $zhxzhjhm = $jsonsj->公民身份号码;
      $zhxjgzh = $jsonsj->军官证;
      $zhxgx = $jsonsj->与患者关系;
      $zhxlx = $jsonsj->联系方式;
      if($zhxxm!=''&&($zhxzhjhm!=''||$zhxjgzh!='')&&$zhxgx!=''){
        $zhxquery="INSERT INTO `zhxqsh` (`hzhid` ,`xm` ,`zhjhm` ,`yhzhgx` ,`lxfsh`,`jgzh`,`gxzf`)VALUES ( '$getID',  '$zhxxm',  '$zhxzhjhm',  '$zhxgx',  '$zhxlx',  '$zhxjgzh','1')";
        //echo $zhxquery;
        $zhxresult=mysql_query($zhxquery);
        if(!$zhxresult)
        {
          echo mysql_error();
          echo "添加直系亲属失败 <a href=\"shqgl.php\">点击返回重试</a>";
        }
        else{
          echo "添加直系亲属完成</br>";
        }
      }
    }
      $xcfyrqquery="INSERT INTO `xclyrq` (`hzhid` ,`xclyrq`)VALUES ( '$getID',  '$ygshcyyrq')";
      //echo $xcfyrqquery;
      $xcfyrqresult=mysql_query($xcfyrqquery);
      if(!$xcfyrqresult)
      {
        echo mysql_error();
        echo "添加下次发药日期失败 <a href=\"shqgl.php\">点击返回重试</a>";
      }
      else{
        echo "添加下次发药日期完成</br>";
      }
      //首次医学评估确认表 开始
      
      //临床诊断：
$lchzhd =  $_POST['lchzhd'];
//其他说明：
$qtlchzhd =  $_POST['qtlchzhd'];
if($lchzhd=="其他"&&$qtlchzhd!="")
{$lchzhd=$qtlchzhd;}
//诊断日期：
$zhdrq =  $_POST['zhdrq'];
//肿瘤病理类型：
$zhlbl =  $_POST['zhlbl'];
//其他说明：
$qtzhlbl =  $_POST['qtzhlbl'];
if($zhlbl=="其他"&&$qtzhlbl!="")
{$zhlbl=$qtzhlbl;}
//分期
$fq =  $_POST['fq'];
//其他说明：
$qtfq =  $_POST['qtfq'];
if($fq=="其他"&&$qtfq!="")
{$fq=$qtfq;}
//ALK检测：
$alkjc =  $_POST['alkjc'];
//ALK诊断方法：
$alkzhdff =  $_POST['alkzhdff'];
//赛可瑞开始治疗时间：
$skrkshzhlshj =  $_POST['skrkshzhlshj'];
//赛可瑞治疗疗程
$skrzhllch =  $_POST['skrzhllch'];
//赛可瑞治疗效果(RECIST 标准)评估：
$skrzhlxgpg =  $_POST['skrzhlxgpg'];
//出现无法耐受的副作用：
$chxwfnshdfzy =  $_POST['chxwfnshdfzy'];
//是否应该继续赛可瑞治疗：
$shfygjxskrzhl =  $_POST['shfygjxskrzhl'];

//录入日期
$lrrq=date('Y-m-d');
$lrr=$_SESSION[yhname];
       $shcpgquery="INSERT INTO `yxpgbg` (`hzhid` ,`lrrq`,`lrr`,`lchzhd` ,`zhdrq` ,`zhlbl` ,`fq` ,`alkjc` ,`alkzhdff`,`skrkshzhlshj`  ,`skrzhllch` ,`skrzhlxgpg` ,`chxwfnshdfzy` ,`shfygjxskrzhl` ,`bglx`)VALUES ( '$getID',  '$lrrq',  '$lrr',  '$lchzhd',  '$zhdrq',  '$zhlbl',  '$fq',  '$alkjc',  '$alkzhdff',  '$skrkshzhlshj',  '$skrzhllch',  '$skrzhlxgpg',  '$chxwfnshdfzy',  '$shfygjxskrzhl','1')";
      //echo $xcfyrqquery;
      $shcpgresult=mysql_query($shcpgquery);
      if(!$shcpgresult)
      {
        echo mysql_error();
        echo "添加医学条件评估失败 <a href=\"shqgl.php\">点击返回重试</a>";
      }
      else{
        echo "添加医学条件评估完成</br>";
      }
       //首次医学评估确认表 结束     
      
    /*for($i=1;$i<=13;$i++)
    {
      $clquery="INSERT INTO `clshhnr` (`mchid` ,`hzhid` ,`shfshd` ,`shdrq` ,`shfyx` ,`shhrq` ,`shhr` ,`bzhshm`)VALUES ( '$i',  '$getID',  '0',  '未填写',  '0',  '未填写',  '当前用户',  '')";
      $clresult=mysql_query($clquery);
      if(!$clresult)
      {
        echo mysql_error();
        echo "初始化材料审核失败 <a href=\"shqgl.php\">点击返回重试</a>";
      }
      else{
        
      }
    }*/
    echo "成功！<br/>";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=chcshh.php?id=$getID\">";
  }
}else{echo "必填内容为空，返回重试<input type=\"button\" onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";}



                

?>