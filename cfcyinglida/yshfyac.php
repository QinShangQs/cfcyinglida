<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('wdb.php');
$db = new DB();
    $hzhid = $_POST['id'];//患者id
    $fyr=$_SESSION['yhname'];//发药人id
    $yfmch=$_SESSION['gldw'];//发药人单位
    
    //患者所需携带资料
    $patsfz = $_POST['patsfz']; //患者身份证是否打勾
    $patzgykyp = $_POST['patzgykyp']; //自购药空药瓶是否打勾
    $zgy = $_POST['zgy']; //自购药瓶数
    $patsfz = $_POST['patsfz']; //检查报告是否打勾
    $zlbg1 = $_POST['zlbg1'];
    $zlbg2 = $_POST['zlbg2'];
    $zlbg3 = $_POST['zlbg3'];
    $zlbg4 = $_POST['zlbg4'];
    $zlbg = $zlbg1.','.$zlbg2.','.$zlbg3.','.$zlbg4;
    $yxtime = $_POST['yxtime']; //检查时间
    $yxtjsfb = $_POST['yxtjsfb']; //医学条件随访表是否打勾
    $cfj = $_POST['cfj']; //处方笺
    $create_time = date('Y-m-d', time());
    $dataArray = array(
        'hzhid' => $hzhid, 'tjzname' => $fyr, 'tjdwname' => $yfmch, 'patsfz' => $patsfz, 'zgykyp' => $patzgykyp, 'yhsyp' => 0, 'shsyp' => $zgy, 'jcbg' => $patsfz,
        'jcbgd' => $zlbg, 'jctime' => $yxtime, 'yxtjsfb' => $yxtjsfb, 'cfj' => $cfj, 'create_time' => $create_time
    );
    $istrue = $db->insert('fayao_patxdinfo', $dataArray);
    
    //医学条件评估
    $lynum = $_POST['lynum']; //领药次数
    $cgjc0 = $_POST['cgjc0'];
    $cgjc1 = $_POST['cgjc1'];
    $cgjc2 = $_POST['cgjc2'];
    if($cgjc0!=0 && $cgjc1!=1 && $cgjc2!=2){
        echo "安全性评估三项检查必选！  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }else{
        $isfsyjc = 1;
    }

    if($lynum%3 == 0 && $lynum !=0){//随访表
        $yxpg = $_POST['yxpg']; //有效性评估
        $jshrhsf = $_POST['jshrhsf']; //是否接受辉瑞公司随访
        $pgxx = $_POST['pgxx']; //本次随访RECIST评估
        $jxsyyld = $_POST['jxsyyld']; //是否建议继续服用英立达
        $dataArray1 = array(
            'hzhid' => $hzhid, 'tjzname' => $fyr, 'tjdwname' => $yfmch, 'syjc' => $isfsyjc, 'bcsfpg' => $pgxx, 'sjjxsyyld' => $jxsyyld,
            'yxpg' => $yxpg, 'jshrhsf' => $jshrhsf,'create_time' => $create_time,
        );
    }else{ //处方笺
        $dataArray1 = array(
            'hzhid' => $hzhid, 'tjzname' => $fyr, 'tjdwname' => $yfmch, 'syjc' => $isfsyjc, 'create_time' => $create_time,
        );
    }

    $istrue1 = $db->insert('fayao_patyxpg', $dataArray1);
    
    //处方与领药信息
    $yfyl = $_POST['yfyl']; //用法用量
    $lylx = $_POST['lylx']; //领药类型
    $lysl = $_POST['lysl']; //领药数量
    $pihao = $_POST['pihao']; //批号
    $lysj = $_POST['lysj']; //领药时间
    $xclysj = $_POST['xclysj']; //下次领药时间
    if(empty($lysj)){
        $lysj = date('Y-m-d', time());
    }
    if(empty($xclysj)){
        $xclysj = date('Y-m-d', strtotime('+28 days'));
    }
    
    $dataArray2 = array(
        'hzhid' => $hzhid, 'tjzname' => $fyr, 'tjdwname' => $yfmch, 'yfyl' => $yfyl, 'ypph' => $pihao, 'xclysj' => $xclysj , 'create_time' => $lysj, 'hzhlylx' => $lylx, 'hzhlyshl' => $lysl
    );
    $istrue2 = $db->insert('fayao_cflyinfo', $dataArray2);
    echo "成功！";
    header("refresh:2;url=/yshdfqdgl.php");
    //当前本批号库存数量
//     $shdshlsql="select SUM(`pfshl1`) from `yfshqzy` where `ph1`='".$ypph."' and `yfmch`='".$yfmch."'";
    //下次领药时间
//     $fyrq=date('Y-m-d');
//     $hzhyytssh=$_POST['hzhyytssh'];//预估本次用药天数
//     if($hzhyytssh<0||$hzhyytssh==""){echo "用药天数错误！";exit();}
//     $ygshcyyjshrq=date('Y-m-d',strtotime('+'.$hzhyytssh.' day',strtotime($ygbcyykshrq)));
//     $ygxcfyrq=date('Y-m-d',strtotime('-7 day',strtotime($ygshcyyjshrq)));
//     $xcfyrqquery="UPDATE `xclyrq` SET `xclyrq`='$ygxcfyrq' where `hzhid`='$hzhid'";
  
?>

