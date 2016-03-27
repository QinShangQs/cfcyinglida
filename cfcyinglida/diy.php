<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
  $sql = "SELECT `id` FROM `zyff` group by `hzhid` order by `id` desc";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  
    echo $query="UPDATE `zyff` SET `ygxcfyrq`='2014-11-27'  WHERE `id` = '$Record[0]'";
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo " 修改失败 ";
    }
    else{
      echo " 修改成功 </br>";
    }
  }
 /*
  $sql = "SELECT `id` FROM `yfshqzy` group by `yfmch` order by `id` desc";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
  
    echo $query="UPDATE `yfshqzy` SET `ph1`='18' WHERE `id`='$Record[0]'";
    $result=mysql_query($query);
    if(!$result)
    {
      echo mysql_error();
      echo " 修改失败 ";
    }
    else{
      echo " 修改成功 </br>";
    }
  }*/
/*
  $sql = "select * from `hzh` where `shqzht`='入组' ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
    $lyshlnumq=mysql_query("SELECT * FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."' order by id DESC limit 0,1");
    while($lyshlnum = mysql_fetch_array($lyshlnumq)){
        echo $Record[0]."领药了</br>";
         $query="UPDATE `zyff` SET `ygxcfyrq`='2014-11-27'  WHERE `id` = '".$lyshlnum[0]."'";
            $result=mysql_query($query);
            if(!$result)
            {
              echo mysql_error();
              echo " 修改失败 ";
            }
            else{
              echo " 修改成功 zyff-id:".$lyshlnum[0]."  日期:2014-11-27 患者:".$Record[0]."</br>";
            }
        /*$xclyrqsql="select * from  `xclyrq` where `hzhid`='".$Record[0]."'";
        $xclyrqQuery_ID = mysql_query($xclyrqsql);
        while($xclyrqRecord = mysql_fetch_array($xclyrqQuery_ID)){
          if($xclyrqRecord['xclyrq']!=''){
            //$ygxcfyrq=date('Y-m-d',strtotime('-7 day',strtotime($xclyrqRecord['xclyrq'])));
            $ygxcfyrq=$xclyrqRecord['xclyrq'];
            $query="UPDATE `xclyrq` SET `xclyrq`='$ygxcfyrq'  WHERE `id` = '".$lyshlnum[0]."'";
            $result=mysql_query($query);
            if(!$result)
            {
              echo mysql_error();
              echo " 修改失败 ";
            }
            else{
              echo " 修改成功 zyff-id:".$lyshlnum[0]."  日期:".$ygxcfyrq." 患者:".$Record[0]."</br>";
            }
          }//*
        }
    }
}*/
/*for($i=1;$i<=7013;$i++){
  $query="INSERT INTO `xclyrq`( `hzhid`, `xclyrq`) VALUES ('".$i."','2014-10-10')";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo $i." 添加失败 </br>";
  }
  else{
    echo $i." 添加成功 </br>";
  }
}
*/
/*$sql = "SELECT * FROM `hzh` where `hzhid`='' or `hzhid` is NULL order by `id` ASC";
$Query_ID = mysql_query($sql);
while($Record = mysql_fetch_array($Query_ID)){
        echo $Record[0]." ".$Record[3]." ".$Record[4]." OK </br>";
}*/
/*$sql = "SELECT * FROM `hzh` where `hzhid`<>'' and `hzhid` is not NULL order by `hzhid` ASC";
$Query_ID = mysql_query($sql);
while($Record = mysql_fetch_array($Query_ID)){
      $query="insert into `hzhrz` SET `id`='".preg_replace('/^0+/','',$Record[2])."', `hzhid`='".$Record[0]."'";
      $result=mysql_query($query);
      if(!$result)
      {
        echo mysql_error();
        echo "添加下次发药日期失败 <a href=\"shqgl.php\">点击返回重试</a>";
        exit();
      }
      else{
        echo $Record[0]." ".$Record[2]." OK </br>";
      }
}*/

/*include('newdb.php');

$phzshsql = "SELECT SUM(  `bjshl` ) FROM  `kfrk` WHERE  `id` =  '2'";
$phzshQuery_ID = mysql_query($phzshsql);
while($phzshRecord = mysql_fetch_array($phzshQuery_ID)){
$phzsh=$phzshRecord[0];
}
$zyzshsql = "SELECT SUM( `pfshl1` ) FROM  `yfshqzy` WHERE  `ph1` =  '2'";
$zyzshQuery_ID = mysql_query($zyzshsql);
while($zyzshRecord = mysql_fetch_array($zyzshQuery_ID)){
$zyzsh=$zyzshRecord[0];
}
echo $phzsh-$zyzsh;

/*首次材料等级日期修改
$sql = "select * from `hzh`";
$Query_ID = mysql_query($sql);
while($Record = mysql_fetch_array($Query_ID)){
echo $Record[0]."  ".$Record[4]."  ".$Record[43]."  ";
  $shdrq='';
  $clidsql = "select MIN(id) from `clshh` where `hzhid`='".$Record[0]."'";
  $clidQuery_ID = mysql_query($clidsql);
  while($clidRecord = mysql_fetch_array($clidQuery_ID)){
    $clsql = "select * from `clshh` where `id`='".$clidRecord[0]."'";
    $clQuery_ID = mysql_query($clsql);
    while($clRecord = mysql_fetch_array($clQuery_ID)){
      $shdrq .= $clRecord[3];
    }
  }
  $shdrq1=explode(",",$shdrq);
  sort($shdrq1);  //排序后重新组成了。
echo $clshdrq=$shdrq1[count($shdrq1)-1];//数组最后一位
if($Record[43]!=$clshdrq){
echo "  不等于";
  if($Record[43]>$clshdrq){
    echo "  小";
  }else{
    echo "  大";
  }
  $query="UPDATE `hzh` SET `djrq`='$clshdrq'  WHERE `id` = '".$Record[0]."'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo " 修改失败 ";
  }
  else{
    echo " 修改成功 ";
  }
  
}
echo "</br>";
}*/

/*$aa="未收到：【患者所有直系亲属身份证复印件】 赛可瑞发票
原件（4瓶）：2013-9-13发票无药房公章 【患者本人收入
证明表】：未贴照片；居委会意见未填写 【患者所有直系
亲属收入证明表】：患者及丈夫所在公司的营业执照、公
司章程（工商局盖章）、纳税证明 【房产证明复印件】：
患者丈夫户口所在地房产证明（深圳市南山区天悦园B1203
） 
http://company.ch.gongchang.com/info/53212410_09cd/
2013-9-13发票、【患者本人收入证明表】已寄回，快递单
号：9179451617";

Mysql_select_db("cfcwshshq");
$sql = "select * from `hzh` where `drxt`='1'";
$Query_ID = mysql_query($sql);
$i=0;
while($Record = mysql_fetch_array($Query_ID)){
  echo "网上申请id：".$Record[0]." 姓名：".$Record[2]." 证件：".$Record[4]."";
     Mysql_select_db("CFCSYSTEM");
  $wshsql = "select * from `hzh` where `hzhxm`='".$Record[2]."' and `zhjhm`='".$Record[4]."'";
  $wshQuery_ID = mysql_query($wshsql);
  while($wshRecord = mysql_fetch_array($wshQuery_ID)){
  echo $wshRecord[0]." 导入状态：";
  if($wshRecord[45]==1){echo "网</br>";}else{echo "正常</br>";}
  }
   Mysql_select_db("cfcwshshq");
    $i++;
}
echo $i;

  $sql = "select * from `hzh` ";
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
$lyshlnumq=mysql_query("SELECT SUM(fyshl) FROM `zyff` where `tshqk`='0' and `hzhid`='".$Record[0]."'");
  while($lyshlnum = mysql_fetch_array($lyshlnumq)){
  if($lyshlnum[0]!=""){echo $Record[0]."领药了</br>";}else{
    $xclyrqsql="select * from  `xclyrq` where `hzhid`='".$Record[0]."'";
    $xclyrqQuery_ID = mysql_query($xclyrqsql);
    while($xclyrqRecord = mysql_fetch_array($xclyrqQuery_ID)){
      if($xclyrqRecord['xclyrq']!=''){
      $ygxcfyrq=date('Y-m-d',strtotime('-7 day',strtotime($xclyrqRecord['xclyrq'])));
      $query="UPDATE `xclyrq` SET `xclyrq`='$ygxcfyrq'  WHERE `id` = '".$xclyrqRecord[0]."'";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo " 修改失败 ";
  }
  else{
    echo " 修改成功 前".$xclyrqRecord['xclyrq']." 后 ".$ygxcfyrq." ".$Record[0]."未</br>";
  }
      }
    }
  }
  }
}



$yuri = date('Y-m-d');
$yuri1=strtotime($yuri);

//$yuri = date('d',strtotime(date('Y-m')."+1 month -1 day"));
//echo $yuri;
echo $yuri1;

  $yhln = $_SESSION[yhln];
  $yhsql = "select id,yfmch from `yf` where `yfyshname`='".$yhln."'";
  $yhQuery_ID = mysql_query($yhsql);
  while($yhRecord = mysql_fetch_array($yhQuery_ID)){$yshid=$yhRecord[0];$yfmch=$yhRecord[1];}
  $yftmsql = "select id from `yf` where `yfmch`='".$yfmch."'";
  $yftmQuery_ID = mysql_query($yftmsql);
  while($yftmRecord = mysql_fetch_array($yftmQuery_ID)){$yfid[]=$yftmRecord[0];}
    $phidsql = "select `ph1`,`ph2`,`phshl1`,`phshl2` from `yfshqzy` where `shqzht`='3' and (`yshid`='".$yshid."'";
for($i=0;$i<count($yfid);$i++)
{
  if($yfid[$i]!=null){
    $phidsql  .= " or `yshid`='".$yfid[$i]."' ";
  }
}
$phidsql  .= ")";
    $phidQuery_ID = mysql_query($phidsql);
    while($phidRecord = mysql_fetch_array($phidQuery_ID)){
      $ph1ids[]=$phidRecord[0];
      $ph2ids[]=$phidRecord[1];
      $ph1shl[]=$phidRecord[2];
      $ph2shl[]=$phidRecord[3];
    }
print_r($ph1ids);echo "</br>";
print_r($ph1shl);echo "</br>";
print_r($ph2ids);echo "</br>";
print_r($ph2shl);echo "</br>";
$ph1idstmp=Array();
$ph1shltmp=Array();
$ph2idstmp=Array();
$ph2shltmp=Array();
for($i=0;$i<count($ph1ids);$i++){
$ph1idstmp=array_values(array_merge($ph1idstmp,explode(",",$ph1ids[$i])));
$ph1shltmp=array_values(array_merge($ph1shltmp,explode(",",$ph1shl[$i])));
$ph2idstmp=array_values(array_merge($ph2idstmp,explode(",",$ph2ids[$i])));
$ph2shltmp=array_values(array_merge($ph2shltmp,explode(",",$ph2shl[$i])));
//print_r(array_merge($phid,explode(",",$phidtmp[$i])));
}
print_r($ph1idstmp);echo "</br>";
print_r($ph1shltmp);echo "</br>";
print_r($ph2idstmp);echo "</br>";
print_r($ph2shltmp);echo "</br>";

for($i = 0; $i < count($ph1idstmp); $i ++) {  
  for($j = $i + 1; $j < count($ph1idstmp); $j ++) {  
    if ($ph1idstmp [$i] == $ph1idstmp [$j]) {  
    echo "数组第".$i."位 ".$ph1idstmp [$i]."等于数组第".$j."位 ".$ph1idstmp [$j];echo "</br>";
    if($ph1idshl[$ph1idstmp [$i]]==""){$ph1idshl[$ph1idstmp [$i]]=$ph1shltmp [$i]+$ph1shltmp [$j];$ph1shltmp [$j]=0;}else{$ph1idshl[$ph1idstmp [$i]]=$ph1idshl[$ph1idstmp [$i]]+$ph1shltmp [$j];$ph1shltmp [$j]=0;}
    echo "数组第".$i."位 值共".$ph1idshl[$ph1idstmp [$i]];
    echo "</br>";
    }  
  }  
}
for($i = 0; $i < count($ph2idstmp); $i ++) {  
  for($j = $i + 1; $j < count($ph2idstmp); $j ++) {  
    if ($ph2idstmp [$i] == $ph2idstmp [$j]) {  
    echo "数组第".$i."位 ".$ph2idstmp [$i]."等于数组第".$j."位 ".$ph2idstmp [$j];echo "</br>";
    if($ph2idshl[$ph2idstmp [$i]]==""){$ph2idshl[$ph2idstmp [$i]]=$ph2shltmp [$i]+$ph2shltmp [$j];$ph2shltmp [$j]=0;}else{$ph2idshl[$ph2idstmp [$i]]=$ph2idshl[$ph2idstmp [$i]]+$ph2shltmp [$j];$ph2shltmp [$j]=0;}
    echo "数组第".$i."位 值共".$ph2idshl[$ph2idstmp [$i]];
    echo "</br>";
    }  
  }  
}  
print_r($ph1idshl);echo "</br>";
print_r($ph2idshl);echo "</br>";
    $phnsql = "select `id`,`ph` from `kfrk`";
    $phnQuery_ID = mysql_query($phnsql);
    while($phnRecord = mysql_fetch_array($phnQuery_ID)){
      $phn[$phnRecord[0]]=$phnRecord[1];
    }
print_r($phn);echo "</br>";
$ph1idk=array_keys($ph1idshl);
$ph2idk=array_keys($ph2idshl);
for($i=0;$i<count($ph1idk);$i++){
echo $phn[$ph1idk[$i]]." 数量 ".$ph1idshl[$ph1idk[$i]];    echo "</br>";
}
for($i=0;$i<count($ph2idk);$i++){
echo $phn[$ph2idk[$i]]." 数量 ".$ph2idshl[$ph2idk[$i]];    echo "</br>";
}
if($ph1idshl[array_search("N3587B68",$phn)]!=""){echo $ph1idshl[array_search("N3587B68",$phn)];}else if($ph2idshl[array_search("N3587B68",$phn)]!=""){echo $ph2idshl[array_search("N3587B68",$phn)];}else{echo "错误";}

    


/*
    for($i=1;$i<=38;$i++)
    {
      $sql = "select ygxcfyrq from `zyff`  where `hzhid`='$i' and id in (select max(id) from `zyff` where `hzhid`='$i' and `tshqk`='0')";
      //$sql = "select ygshcyyrq from `hzh`  where `id`='$i'";
  //echo $sql;
  $Query_ID = mysql_query($sql);
  while($Record = mysql_fetch_array($Query_ID)){
      $xcfyrqquery="UPDATE `xclyrq` SET `xclyrq`='$Record[0]' where `hzhid`='$i'";
      //echo $xcfyrqquery;
      $xcfyrqresult=mysql_query($xcfyrqquery);
      if(!$xcfyrqresult)
      {
        echo mysql_error();
        echo "添加下次发药日期失败 <a href=\"shqgl.php\">点击返回重试</a>";
      }
      else{
        echo "OK";
      }

  }
    }
*/
?>