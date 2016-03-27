<?php
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
include('wdb.php');
$db = new DB(); //cfcsuotan
//姓名
$hzhxm = str_replace(" ","",$_POST['hzhxm']);
//证件号码
$zhjlx = $_POST['zhjlx'];
$zhjhm = $_POST['zhjhm'];
//出生日期
$hzhchshrq = $_POST['hzhchshrq'];
//性别
$hzhxb = $_POST['hzhxb'];
//申请病种：
$shqbzh = $_POST['shqlx'];
//申请指定医院/医生：
$shqyy = $_POST['shqyyid'];
//患者通讯住址
$sheng = $_POST['sheng'];
$shi = $_POST['shi'];
if($sheng==$shi){$shi="";}
$qu = $_POST['qu'];
//街道地址
$Zhuzhi = $_POST['jddzh'];
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
//联系电话3
$dsanlxrdh = $_POST['dh3'];
//诊断类型：
$zhdlx = $_POST['Zhengduan'];
//户籍类型
$hzhhj = $_POST['hzhhj'];
//家庭人口
$hzhjtrk = $_POST['hzhjtrk'];
//患者年收入：
$hzhnshr = $_POST['hzhnshr'];
//家庭年收入：
$jtnshr = $_POST['hzhjtnshr'];
if(!empty($jtnshr) && !empty($hzhjtrk)){
$rjshr = round($jtnshr/$hzhjtrk, 2);
}
//参保类型：
$cblx = $_POST['hzhcblx'];
//参保地区
$cbdqsheng = $_POST['cbdqsheng'];
$cbdqshi = $_POST['cbdqshi'];
//$cbdqqu = $_POST['cbdqqu'];
if($cbdqsheng=="省份"){$cbdqsheng="";}
if($cbdqshi=="地级市"){$cbdqshi="";}
$ypgg = $_POST['yfjl'];
//一线药品名称
$yxypname = $_POST['yxypname'];
//入组编码
$ruzhunum = $_POST['bianmahousiwei'];
//服用过的数量
$ttpnum = $_POST['ttpnum'];
//用药方法
$ypyl = $_POST['yfcsh'].','.$_POST['yfzhq'];
if($ypyl=="其他"){$ypyl=$_POST['qtshm'];}
$shqzht = "审核";
$chcshhrq = date('Y-m-d');
$djr=$_SESSION['yhname'];

$ajax = $db->getPost('ajax');
if(!empty($ajax)) {
    $hzhid = $db->getPost('hzhid');
    $leng = mb_strlen($hzhid);
    if($leng < 5) {
        for($i=0; $i < (5 - $leng); $i++) {
            $hzhid = '0'.$hzhid;
        }
    }
    if($hzhid == 00000) {
        exit('0');
    }
    //患者基本信息
    $sql = 'select * from hzh where hzhid ='.$hzhid;
    $data = $db->getRow($sql);
    if(empty($data)) {
        exit('0');
    }
    //查询领药次数
    $sql1 = "select count(*) count from zyff where hzhid =".$hzhid;
    $data1 = $db->getRow($sql1);
    exit(json_encode(array('json' => $data, 'count' => $data1)));
}

/*新增用户时药房必须是医院制定药房*/
$yfsql = "select yyzhdyf from `yyyshdq` where `id` = '".$shqyy."'";

$yfQuery_ID = mysql_query($yfsql);
while($yfRecord = mysql_fetch_array($yfQuery_ID)){
    $lyyf = $yfRecord[0];
}
if($hzhxm!=""&&$zhjlx!=""&&$zhjhm!=""&&$hzhchshrq!=""&&$hzhxb!="") {
//    $query="INSERT INTO `hzh`
//             (`hzhxm` , `yxyaoname`, `ruzhunum`, `chiguonum`, `zhjlx` ,`zhjhm` ,`shqbzh` ,`shqyy` ,`hzhtxdzh` ,`hzhshj` ,`dylxrdh` ,`derlxrdh` ,`dslxrdh`,`zhdlx` ,`hzhhj` ,`hzhjtrk` ,`jtnshr` ,`cblx` ,`cbdqsheng` ,`jzhlx`,`ypgg` ,`ypyl` ,`hzhchshrq` ,`hzhxb` ,`cbdqshi`  ,`cbdqqu` ,`rjshr` ,`shqzht` ,`chcshhrq`,`lyyf`,`djrq`,`djr`,`wshshq`,`hzhnshr`,`erqshq`)VALUES
//             ('$hzhxm','$yxypname', '$ruzhunum', '$ttpnum', '$zhjlx', '$zhjhm',  '$shqbzh',  '$shqyy',  '$hzhtxdzh',  '$hzhshj',  '$dylxrdh',  '$derlxrdh','$dsanlxrdh',  '$zhdlx',  '$hzhhj',  '$hzhjtrk',  '$jtnshr',  '$cblx',  '$cbdqsheng',  '$jzhlx','$ypgg',  '$ypyl',   '$hzhchshrq',  '$hzhxb',  '$cbdqshi',  '$cbdqqu',  '$rjshr',  '$shqzht',  '$chcshhrq',  '$lyyf', '$djrq',  '$djr',  '0','$hzhnshr','$rzer')";
    $query="INSERT INTO `hzh`
             (`hzhxm` , `yxyaoname`, `ruzhunum`, `chiguonum`, `zhjlx` ,`zhjhm` ,`shqbzh` ,`shqyy` ,`hzhtxdzh` ,`hzhshj` ,`dylxrdh` ,`derlxrdh` ,`dslxrdh`,    `zhdlx` ,  `hzhhj` ,  `hzhjtrk` ,  `jtnshr` ,  `cblx` ,  `cbdqsheng` ,  `jzhlx`,    `hzhchshrq` ,  `hzhxb` ,  `cbdqshi` ,  `cbdqqu` ,  `rjshr` ,  `shqzht` ,  `chcshhrq`,   `lyyf`,  `djrq`,   `djr`,   `wshshq`,`hzhnshr`, `erqshq`)VALUES
             ('$hzhxm','$yxypname', '$ruzhunum', '$ttpnum', '$zhjlx', '$zhjhm', '$shqbzh','$shqyy','$hzhtxdzh','$hzhshj','$dylxrdh','$derlxrdh','$dsanlxrdh', '$zhdlx',  '$hzhhj',  '$hzhjtrk',  '$jtnshr',  '$cblx',  '$cbdqsheng',  '$jzhlx',   '$hzhchshrq',  '$hzhxb',  '$cbdqshi',  '$cbdqqu',  '$rjshr',  '$shqzht',  '$chcshhrq',  '$lyyf', '$djrq',  '$djr',  '0',     '$hzhnshr','$rzer' )";
    $result=mysql_query($query);
    if(!$result) {
        echo mysql_error();
        echo "失败 <a href=\"shqgl.php\">点击返回重试</a>";
    } else {
        header("refresh:3;url=/i_patient.php");
    }
}