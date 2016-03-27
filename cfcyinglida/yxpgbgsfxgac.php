<?php 
session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('wdb.php');
$db = new DB();
//操作id
$id= $_POST['id'];
//患者id
$hzhid = $_POST['hzhid'];
//录入人
$lrr = $_SESSION['yhname'];
//疾病进展
$xbzlsb = $_POST['xbzlsb'];
//原因
$xbzlsbkaos = $_POST['xbzlsbkaos'];
//药品名
$yaoname = $_POST['yaoname'];
//治疗时间
$zhiliaotime = $_POST['zhiliaotime'];

//bying
$bying = $_POST['bying'];

//疾病进展
$lasjmsb = $_POST['lasjmsb'];
//原因
$lasjmsg = $_POST['lasjmsg'];
//药品名
$yaoname2 = $_POST['yaoname2'];
//治疗时间
$zhiliaotime2 = $_POST['zhiliaotime2'];


//英利达开始时间
$starttime = $_POST['starttime'];
//英利达评估
$yldpg = $_POST['yldpg'];
//是否随访
$yldsf = $_POST['yldsf'];
//评估时间
$pgtime = $_POST['pgtime'];
//是否继续使用英利达
$sfyld = $_POST['sfyld'];
//该患者诊断为
$docmes = $_POST['docmes'];
//入组标准
$fuhe = $_POST['fuhe'];
//指定医生签字
$docname = $_POST['docname'];
//本次就诊时间
$start_time = $_POST['start_time'];
//录入日期
$lrrq=date('Y-m-d');

$arr = ['lrr' => $lrr, 'xbyzzlsb' => $xbzlsb, 'yuanyin' => $xbzlsbkaos, 'bying' => $bying, 'ypname' => $yaoname, 'zltime' => $zhiliaotime, 'yldstarttime' => $starttime, 'yldrpg' => $yldpg, 'pdjssf' => $yldsf, 'pgtime' => $pgtime,
'isfjxyxd' => $sfyld, 'patzdrcc' => $docmes, 'isrz' => $fuhe, 'docname' => $docname, 'bctime' => $start_time];


$true = $db->update('yxtjpg_new', $arr, 'id='.$id);
      if(!$true) {
        echo mysql_error();die;
        echo "修改医学条件评估失败 <a href=\"shqgl.php\">点击返回重试</a>";
      } else {
         echo "成功！<br/>";
         echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$hzhid\">";
      }
?>