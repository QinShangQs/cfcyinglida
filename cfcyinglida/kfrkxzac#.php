<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
//批号
$ph = $_POST['ZengyaoPihao'];
//中文名称
$zhwmch = $_POST['ZhongwenMingcheng'];
//有效期至
$yxrqzh = $_POST['YouxiaoqiZhi'];
//英文名称
$ywmch = $_POST['YingwenMingcheng'];
//检品编号
$jpbh = $_POST['JianpinBianhao'];
//生产单位/产地
$shchdwchd = $_POST['ShengchanDanweiChandi'];
//入库日期
$shyrq = $_POST['ShouyangRiqi'];
//报检单位
$bjdw = $_POST['Baojiandanwei'];
//注册证号
$zhczhh = $_POST['ZhuceZhenghao'];
//检验目的
$jymd = $_POST['jianyanMudi'];
//入库数量
$bjshl = $_POST['BaojianShuliang'];
//规格
$gg = $_POST['Guige'];
//剂型/型号
$jxxh = $_POST['JixingXinghao'];
//批件号
$pjh = $_POST['PijianHao'];
//合同号
$hth = $_POST['HetongHao'];
//包装规格
$bzhgg = $_POST['BaozhuangGuige'];
//状态
$zht = $_POST['Zuofei'];
$jlshjch=microtime_float();//记录时间戳
if($bjshl>"0"){
  $query="insert into `kfrk`(`ph`,`zhwmch`,`yxrqzh`,`ywmch`,`jpbh`,`shchdwchd`,`shyrq`,`bjdw`,`zhczhh`,`jymd`,`bjshl`,`gg`,`jxxh`,`pjh`,`hth`,`bzhgg`,`zht`,`jlshjch`)values('$ph','$zhwmch','$yxrqzh','$ywmch','$jpbh','$shchdwchd','$shyrq','$bjdw','$zhczhh','$jymd','$bjshl','$gg','$jxxh','$pjh','$hth','$bzhgg','$zht','$jlshjch')";
  $result=mysql_query($query);
  if(!$result)
  {
    echo mysql_error();
    echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
  }
  else{
  echo "成功！<br/>";
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=kfrkgl.php\">";
  }
}else{echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";}
?>
