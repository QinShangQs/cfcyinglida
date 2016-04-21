<?php
#  审核记录 - 申请材料
session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
include('wdb.php');
$db = new DB();

if ($_POST['id']!="") {
  $hzhid = $_POST['id'];
  $mchid = $_POST['mch1'];
  $shfshd = $_POST['shd1'];
  $shdrq = $_POST['shdrq1'];
  $shfyx = $_POST['shfyx1'];
  $shhrq = $_POST['shhrq1'];
  $shqbzh = $_POST['bzh1'];
  $shhr = $_POST['shhr1'];;
  $shhyj = $_POST['shhyj'];
  $shscl = $_POST['shscl'];
  $wtgyy = $_POST['wtgyy'];
  


  
  $dqshhr = $_SESSION[yhname];
  $bzhshm = $_POST['bzhshm'];
  $shhrrq = date('Y-m-d');
  
  for($i=2;$i<=24;$i++){
  $mchid .= ",".$_POST['mch'.$i];
  $shfshd .= ",".$_POST['shd'.$i];
  $shdrq .= ",".$_POST['shdrq'.$i];
  $shfyx .= ",".$_POST['shfyx'.$i];
  $shhrq .= ",".$_POST['shhrq'.$i];
  $shqbzh .= ",".$_POST['bzh'.$i];
  $shhr .= ",".$_POST['shhr'.$i];
  }
  $shdrq1 = explode(",",$shdrq);
  $shfshd1 = explode(",",$shfshd);
  $shfyx1 = explode(",",$shfyx);
  $shqbzh1 = explode(",",$shqbzh);
  
  
  $query="INSERT INTO `clshh` (`hzhid` ,`mchid` ,`shfshd` ,`shdrq` ,`shfyx` ,`shhrq`,`shqbzh`,`shhr`,`shhyj`,`wtgyy`,`bzhshm`,`shhrrq`,`shscl`,`dqshhr`)VALUES ( '$hzhid',  '$mchid',  '$shfshd',  '$shdrq',  '$shfyx',  '$shhrq',  '$shqbzh',  '$shhr',  '$shhyj',  '$wtgyy',  '$bzhshm',  '$shhrrq',  '$shscl',  '$dqshhr')";
  //echo $clquery;
  $result=mysql_query($query);
  if(!$result)
  {
  echo mysql_error();
  echo "修改失败 <a href=\"shqgl.php\">点击返回重试</a>";
  }
  else{
    if($shhyj==0){$shhyjzhw="补寄材料";}
    else if($shhyj==1){$shhyjzhw="材料齐全";}
  $bcclshdrq = $_POST['bcclshdrq']; 
if($bcclshdrq!=""){
$clshdrq=$bcclshdrq;
}else{
//arsort($shdrq1);排序
sort($shdrq1);  //排序后重新组成了。
$clshdrq=$shdrq1[count($shdrq1)-1];//数组最后一位
//print_r($shdrq1);
}
sort($shdrq1);  //排序后重新组成了。
//echo $clshdrq." 如果按顺序：".$shdrq1[count($shdrq1)-1];
$shcdjrq='';
$shcdjrqsql="select djrq from `hzh` where id='$hzhid' ";
$shcdjrqQuery_ID = mysql_query($shcdjrqsql);
while($shcdjrqRecord = mysql_fetch_array($shcdjrqQuery_ID)){
$shcdjrq=$shcdjrqRecord[0];
}
if($shcdjrq==''){
  $shcdjrqquery="UPDATE `hzh` SET `djrq`='$clshdrq' where `id`='$hzhid'";
    //echo $clquery;
    $shcdjrqresult=mysql_query($shcdjrqquery);
    if(!$shcdjrqresult)
    {
    echo mysql_error();
    echo "更新首次材料登记日期失败".$query;
    }
    else{
    }
}
  $query="INSERT INTO `shhejl` (`hzhid` ,`shhr` ,`shhyj` ,`shhrq` ,`bzh` ,`clshdrq`)VALUES ( '$hzhid',  '$dqshhr',  '$shhyjzhw',  '$shhrrq',  '".$wtgyy." ".$bzhshm."',  '$clshdrq')";
    //echo $clquery;
    $result=mysql_query($query);
    if(!$result)
    {
    echo mysql_error();
    echo "添加审核记录失败。".$query;
    }
    else{
    $_POST['id']="";
    }
    $_POST['id']="";
    echo "成功";
    if($shhyj=='1'){
        //协管员是否确认
        $sql = "select * from hzh where id = $hzhid";
        $arr = $db->getRow($sql);
        //社会调查是否为空
        $sql = "select * from shhdch where hzhid = $hzhid";
        $arr2 = $db->getRow($sql);
        if(empty($arr['shfs']) || empty($arr2)) {
            $db->update('hzh', array('shqzht' => '审核'), 'id='.$hzhid);
        } else {
            $db->update('hzh', array('shqzht' => '代办入组'), 'id='.$hzhid);
        }
        echo "<a href=\"xzshhdch.php?id=".$hzhid."\">点击进入社会调查</a> <a href=\"shqxq.php?id=".$hzhid."\">返回查看详细资料</a> ";
    } else {
      //echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=".$hzhid."\">";
      header("location: shqxq.php?id=".$hzhid);
    }
  }
}
else {echo  "请关闭！错误！";}

?>