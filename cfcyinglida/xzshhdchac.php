<?php
# 社会调查 
session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
include('wdb.php');
$db = new DB();
//患者id：
$hzhid = $_POST['Id'];
//调查日期：
$dchrq = $_POST['DiaochaRiqi'];
//调查部门：
$dchbm = $_POST['DiaochaBumen'];
//其他(详细说明)
$qtbmxx = $_POST['QitaBumen'];
//联系电话
$lxdh = $_POST['LianxiDianhua'];
//是否属实
$shfshsh = $_POST['ShushiQingkuang'];
//不属实描述：
$bshshmsh = $_POST['BuShushiMiaoshu'];
//备注：
$bzh = $_POST['Beizhu'];
//调查人
$dchr = $_SESSION[yhname];

  $query="insert into `shhdch`(hzhid,dchrq,dchr,dchbm,qtbmxx,lxdh,shfshsh,bshshmsh,bzh)values('$hzhid','$dchrq','$dchr','$dchbm','$qtbmxx','$lxdh','$shfshsh','$bshshmsh','$bzh')";
  $result=mysql_query($query);
  if(!$result) {
    echo mysql_error();
    echo "失败 <a href=\"shqxq.php?id=$hzhid\">点击返回重试</a>";
  } else {
    if($shfshsh=='1') {
        //协管员是否确认
        $sql = "select * from hzh where id = $hzhid";
        $arr = $db->getRow($sql);
        //审核记录材料齐全
        $sql = "select * from clshh where hzhid = $hzhid";
        $arr2 = $db->getRow($sql);
        if(!empty($arr['shfs']) && $arr2['shhyj'] == 1) {
            $db->update('hzh', array('shqzht' => '代办入组'), 'id='.$hzhid);
        }
        echo "<a href=\"shhjl.php?id=$hzhid\">办理入组</a>  <a href=\"shqxq.php?id=".$hzhid."\">返回查看详细资料</a> ";
    } else {
        echo "成功！<br/>";
        echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$hzhid\">";
    }
  }

?> 
