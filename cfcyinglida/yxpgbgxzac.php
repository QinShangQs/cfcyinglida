<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('wdb.php');
$db = new DB();

#########################新添加医学条件评估
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
$addtime = date ( 'Y-m-d H:i:s' );

$arr = array('hzhid' => $hzhid, 'lrr' => $lrr, 'xbyzzlsb' => $xbzlsb, 'bying' => $bying, 'yuanyin' => $xbzlsbkaos, 'ypname' => $yaoname, 'zltime' => $zhiliaotime, 'yldstarttime' => $starttime, 'yldrpg' => $yldpg, 'pdjssf' => $yldsf, 'pgtime' => $pgtime,
'isfjxyxd' => $sfyld, 'patzdrcc' => $docmes, 'isrz' => $fuhe, 'docname' => $docname, 'bctime' => $start_time,'addtime'=>$addtime);
$shcpgresult = $db->insert('yxtjpg_new', $arr);
      if(!$shcpgresult) {
        echo mysql_error();die;
        echo "添加医学条件评估失败 <a href=\"shqgl.php\">点击返回重试</a>";
      } else {
        echo "添加医学条件评估完成</br>";
        echo "成功！<br/>";
        echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$hzhid\">";
      }
?>
