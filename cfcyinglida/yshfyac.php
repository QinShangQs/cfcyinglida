<?php session_start(); 
@header('Content-type: text/html;charset=utf-8');
include('wdb.php');
$db = new DB();

    $hzhid = $_POST['id'];//患者id
    $fyr=$_SESSION['yhname'];//发药人id
    $yfmch=$_SESSION['gldw'];//发药人单位
    $pihao = $_POST['pihao'];
    $lylx = $_POST['lylx']; //领药类型
    $fyjl = ($lylx == "1" ? "5mg*28片/盒":"1mg*14片/盒");
    $woguige = ($lylx == "1" ? "5mg":"1mg");

    $frqshyl = 0;// 发药前剩余数量
    if($pihao != '未知批号' && !empty($pihao)){
    	//当前本批号库存数量,已收到状态
    	$pihaokcArr = $db->getRow("select SUM(`pfshl1`) as s from `yfshqzy` where `shqzht`='3' and gg1 = '".$woguige."' and `yfmch`='".$yfmch."'");
    	//当前本批号赠药发放数   
    	$zyffslArr = $db->getRow("SELECT SUM(fyshl) as s FROM `zyff` where `yfmch`='".$yfmch."' and `fyjl` like '".$woguige."%'");
    	
    	$pihaokc = 0;
    	$zyffsl = 0;
    	if(!empty($pihaokcArr['s']))
    		$pihaokc = intval($pihaokcArr['s']);
    	if(!empty($zyffslArr['s']))
    		$zyffsl = intval($zyffslArr['s']);
    		
    	//当前本批号库存数量 -当前本批号赠药发放数 = 当前本批号库存可用数  （剩余数量）
    	$frqshyl = $pihaokc - $zyffsl;
    	if($frqshyl <= 0){
    		echo "失败，库存不足！";
    		header("refresh:2;url=/yshdfqdgl.php");
    		exit;
    	}    	
    }else{
    	echo "失败，必须选择批号！";
    	header("refresh:2;url=/yshdfqdgl.php");
    	exit;
    }
    
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
    $aqxpg_time = $_POST['aqxpg_time'];
    if($cgjc0!=0 && $cgjc1!=1 && $cgjc2!=2){
        echo "安全性评估三项检查必选！  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
    }else{
        $isfsyjc = 1;
    }

    $recistpg_time = $_POST['recistpg_time'];//RECIST评估日期
    if($lynum%3 == 0 && $lynum !=0){//随访表
        $yxpg = $_POST['yxpg']; //有效性评估
        $jshrhsf = $_POST['jshrhsf']; //是否接受辉瑞公司随访
        $pgxx = $_POST['pgxx']; //本次随访RECIST评估
        $jxsyyld = $_POST['jxsyyld']; //是否建议继续服用英立达
        $dataArray1 = array(
            'hzhid' => $hzhid, 'tjzname' => $fyr, 'tjdwname' => $yfmch, 'syjc' => $isfsyjc, 'bcsfpg' => $pgxx, 'sjjxsyyld' => $jxsyyld,
            'yxpg' => $yxpg, 'jshrhsf' => $jshrhsf,'create_time' => $create_time,'recistpg_time'=>$recistpg_time
        );
    }else{ //处方笺
        $dataArray1 = array(
            'hzhid' => $hzhid, 'tjzname' => $fyr, 'tjdwname' => $yfmch, 'syjc' => $isfsyjc, 'create_time' => $create_time,
         	'recistpg_time'=>$recistpg_time
        );
    }

    $istrue1 = $db->insert('fayao_patyxpg', $dataArray1);
    
    //处方与领药信息
    $yfyl = $_POST['yfyl']; //用法用量

    $lysl = $_POST['lysl']; //领药数量
    //$pihao = $_POST['pihao']; //批号
    $lysj = $_POST['lysj']; //领药时间
    $xclysj = $_POST['xclysj']; //下次领药时间
    $hszgyyhs = $_POST['hszgyyhs'];//回收自购药药盒数
    $hsyzypyhs = $_POST['hsyzypyhs'];//回收援助药品药盒
    if(empty($lysj)){
        $lysj = date('Y-m-d', time());
    }
    if(empty($xclysj)){
        $xclysj = date('Y-m-d', strtotime('+28 days'));
    }
    
    $dataArray2 = array(
        'hzhid' => $hzhid, 'tjzname' => $fyr, 'tjdwname' => $yfmch, 'yfyl' => $yfyl, 'ypph' => $pihao, 'xclysj' => $xclysj , 'create_time' => $lysj, 'hzhlylx' => $lylx, 'hzhlyshl' => $lysl
    		,'hszgyyhs'=>$hszgyyhs,'hsyzypyhs'=>$hsyzypyhs
    );
    $istrue2 = $db->insert('fayao_cflyinfo', $dataArray2);
    
    
    $zyffArray = array(
    	'hzhid'=>$hzhid,
    	'kpzht'=>1,#在药房
    	'lycsh'=>($lynum+1),	# 领药次数 
    	'lyshl'=>$lysl,	# 领药数量 --------  -
    	'fyshl'=>$_POST['hsyzypyhs'],	# 发药数量 --------  收援助药品药盒
    	'fyjl'=>$fyjl,#发药剂量(1 200mg,2 250mg) -------- 
    	'fyqshyl'=>$frqshyl,	#发药前剩余量 -------- 
    	'jhkpshl'=> $_POST['hszgyyhs'], #交回空瓶数量 -------- 回收自购药药盒数
    	'jhshyyyshl'=>0,	#交回剩余药物数量 -------- 
    	'lyr'=>$_POST['lyr'],	# 领药人 -------- 
    	'gx'=>'本人',# 关系 -------- 
    	'lyrzhjhm'=>$_POST['lyrzhjhm'],	# 领药人证件号码 -------- 
    	'rzyy'=>$_POST['rzyy'],	# 入组医院 --------             -
    	'zhshrzrq'=>$_POST['zhshrzrq'],# 正式入组日期
    	'ygxcfyrq'=>$xclyrq,# 预估下次发药日期 -------- 
    	'ygshcyyjshrq'=>'',	# 预估上次用药结束日期 -------- 
    	'ygbcyykshrq'=>'',# 预估本次用药开始日期 -------- 
    	'bzh'=>'',	#病种 -------- 
    	'fyr'=>$fyr,	#发药人 -------- 
    	'yfmch'=>$yfmch,# 药房名称 -------- 
    	'fyrq'=>$lysj,#发药日期 -------- 
    	'ypph'=>$pihao,	# 药品批号 -------- 
    	'tshqk'=>0
    );
    $db->insert('zyff', $zyffArray);
    
    //下次领药时间
    $xclyrq=$_POST['xclysj'];   
    $xcArr= array('hzhid'=>$hzhid,'xclyrq'=>$xclyrq);
    $db->insert('xclyrq', $xcArr);
    
    //修改特殊发药申请状态
    $tsfyArr = $db->getRow("select * from `tshzhtzyfywu` where `hzhid`='{$hzhid}' and `shqzht`='1'");
    if(!empty($tsfyArr)){
    	$db->query("update `tshzhtzyfywu` set `shqzht` = 0 where `id` = '{$tsfyArr['id']}'");
    }

    echo "成功！";
    header("refresh:2;url=/yshdfqdgl.php");
?>


