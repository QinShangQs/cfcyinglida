<?php

session_start ();
@header ( 'Content-type: text/html;charset=utf-8' );
include ('newdb.php');
// 重新入组
$rzer = $_POST ['rzer'];
// 姓名
$hzhxm = str_replace ( " ", "", $_POST ['hzhxm'] );
// 证件号码
$zhjlx = $_POST ['zhjlx'];
$zhjhm = $_POST ['zhjhm'];
// 出生日期
$hzhchshrq = $_POST ['hzhchshrq'];
// 性别
$hzhxb = $_POST ['hzhxb'];
// 申请病种：
$shqbzh = $_POST ['shqlx'];
// 申请指定医院/医生：
$shqyy = $_POST ['shqyyid'];
// 患者通讯住址
$sheng = $_POST ['sheng'];
$shi = $_POST ['shi'];
if ($sheng == $shi) {
	$shi = "";
}
$qu = $_POST ['qu'];
// 街道地址
$Zhuzhi = $_POST ['jddzh'];
if ($sheng == "省份") {
	$sheng = "";
}
if ($shi == "地级市") {
	$shi = "";
}
if ($qu == "市、县级市") {
	$qu = "";
}
$hzhtxdzh = $sheng . $shi . $qu . $Zhuzhi;
// /手机
$hzhshj = $_POST ['shouji'];
// 联系电话1
$dylxrdh = $_POST ['dianhua2'];
$dylxrxm = $_POST ['dianhua2xm'];
$dylxrgx = $_POST ['dianhua2gx'];
// 联系电话2
$derlxrdh = $_POST ['dianhua3'];
$derlxrxm = $_POST ['dianhua3xm'];
$derlxrgx = $_POST ['dianhua3gx'];
// 联系电话3
$dsanlxrdh = $_POST ['dh3'];
$dsanlxrxm = $_POST ['dh3xm']; // 姓名
$dsanlxrgx = $_POST ['dh3gx']; // 关系
                              // 诊断类型：
$zhdlx = $_POST ['Zhengduan'];
// 户籍类型
$hzhhj = $_POST ['hzhhj'];
// 家庭人口
$hzhjtrk = $_POST ['hzhjtrk'];
// 患者年收入：
$hzhnshr = $_POST ['hzhnshr'];
// 家庭年收入：
$jtnshr = $_POST ['hzhjtnshr'];
if ($jtnshr != "" && $hzhjtrk != "") {
	$rjshr = round ( $jtnshr / $hzhjtrk, 2 );
} else {
	$rjshr = 0;
}
// 参保类型：
$cblx = $_POST ['hzhcblx'];
// 参保地区
$cbdqsheng = $_POST ['cbdqsheng'];
$cbdqshi = $_POST ['cbdqshi'];
// $cbdqqu = $_POST['cbdqqu'];
if ($cbdqsheng == "省份") {
	$cbdqsheng = "";
}
if ($cbdqshi == "地级市") {
	$cbdqshi = "";
}
// if($cbdqqu=="市、县级市"){$cbdqqu="";}
// 一线药品名称
$yxypname = $_POST ['yxypname'];
// 入组编码
$ruzhunum = $_POST ['bianmahousiwei'];
// 服用过的数量
$ttpnum = $_POST ['ttpnum'];
// 捐助类型：
if ($_POST ['jzhlx'] == '' || $_POST ['jzhlx'] == null) {
	if ($shqbzh == 'RCC') {
		$jzhlx = '1+1+1';
	} else {
		$jzhlx = '部分';
	}
} else {
	$jzhlx = $_POST ['jzhlx'];
}
// 捐助数量：
// $jzhshl = $_POST['jzhshl'];
// 用药剂量：
// $ypgg = $_POST['YongYaoJiLiang'];
// 药品规格 -------- ypgg
$ypgg = $_POST ['yfjl'];
// 用药方法
$ypyl = $_POST ['yfcsh'] . ',' . $_POST ['yfzhq'];
if ($ypyl == "其他") {
	$ypyl = $_POST ['qtshm'];
}
// 项目申请信息表日期
// $xmshqbtxrq = $_POST['XiangmuShenqingXinxiBiaoRiqi'];
// 首次申请材料登记日期：
$djrq = $_POST ['djrq'];
// 首次用药日期：
// $shcyyshj = $_POST['ShouciYongyaoRiqi'];
// 直系亲属
$zhxqsh [] = $_POST ['ZhixiQinshusJson'];
//var_dump ( $zhxqsh );
// 预估首次用药日期
// $ygshcyyrq = $_POST['ygShouciYongyaoRiqi'];

$shqzht = "审核";
$chcshhrq = date ( 'Y-m-d' );

$djr = $_SESSION [yhname];
/* 新增用户时药房必须是医院制定药房 */
$yfsql = "select yyzhdyf from `yyyshdq` where `id` = '" . $shqyy . "'";

$yfQuery_ID = mysql_query ( $yfsql );
while ( $yfRecord = mysql_fetch_array ( $yfQuery_ID ) ) {
	$lyyf = $yfRecord [0];
}
// 最新要求性别以下内容不填写可用录入
// if($hzhxm!=""&&$zhjlx!=""&&$zhjhm!=""&&$shqbzh!=""&&$shqyy!=""&&$hzhtxdzh!=""&&$hzhshj!=""&&$zhdlx!=""&&$hzhhj!=""&&$hzhjtrk!=""&&$jtnshr!=""&&$cblx!=""&&$cbdqsheng!=""&&$jzhlx!=""&&$jzhshl!=""&&$ypgg!=""&&$ypyl!=""&&$xmshqbtxrq!=""&&$hzhchshrq!=""&&$hzhxb!=""&&$cbdqshi!=""&&$cbdqqu!=""&&$rjshr!=""){
if ($hzhxm != "" && $zhjlx != "" && $zhjhm != "" && $hzhchshrq != "" && $hzhxb != "") {
	// $query="INSERT INTO `hzh` (`hzhxm` ,`zhjlx` ,`zhjhm` ,`shqbzh` ,`shqyy` ,`hzhtxdzh` ,`hzhshj` ,`dylxrdh` ,`derlxrdh` ,`dslxrdh`,`zhdlx` ,`hzhhj` ,`hzhjtrk` ,`jtnshr` ,`cblx` ,`cbdqsheng` ,`jzhlx`,`ypgg` ,`ypyl` ,`hzhchshrq` ,`hzhxb` ,`cbdqshi` ,`cbdqqu` ,`rjshr` ,`shqzht` ,`chcshhrq`,`lyyf`,`djrq`,`djr`,`wshshq`,`hzhnshr`,`erqshq`)VALUES ( '$hzhxm', '$zhjlx', '$zhjhm', '$shqbzh', '$shqyy', '$hzhtxdzh', '$hzhshj', '$dylxrdh', '$derlxrdh','$dsanlxrdh', '$zhdlx', '$hzhhj', '$hzhjtrk', '$jtnshr', '$cblx', '$cbdqsheng', '$jzhlx','$ypgg', '$ypyl', '$hzhchshrq', '$hzhxb', '$cbdqshi', '$cbdqqu', '$rjshr', '$shqzht', '$chcshhrq', '$lyyf', '$djrq', '$djr', '0','$hzhnshr','$rzer')";
	$query = "INSERT INTO `hzh` (`hzhxm` , `yxyaoname`, `ruzhunum`, `chiguonum`, `zhjlx` ,`zhjhm` ,`shqbzh` ,`shqyy` ,`hzhtxdzh` ,`hzhshj` ,`dylxrdh` ,`derlxrdh` ,`dslxrdh`,`zhdlx` ,`hzhhj` ,`hzhjtrk` ,`jtnshr` ,`cblx` ,`cbdqsheng` ,`jzhlx`,`ypgg` ,`ypyl` ,`hzhchshrq` ,`hzhxb` ,`cbdqshi`  ,`cbdqqu` ,`rjshr` ,`shqzht` ,`chcshhrq`,`lyyf`,`djrq`,`djr`,`wshshq`,`hzhnshr`,`erqshq`,`dylxrxm`,`dylxrgx`,`derlxrxm`,`derlxrgx`,`dslxrxm`,`dslxrgx`) " . "VALUES ( '$hzhxm', '$yxypname', '$ruzhunum', '$ttpnum', '$zhjlx', '$zhjhm',  '$shqbzh',  '$shqyy',  '$hzhtxdzh',  '$hzhshj',  '$dylxrdh',  '$derlxrdh','$dsanlxrdh',  '$zhdlx',  '$hzhhj',  '$hzhjtrk',  '$jtnshr',  '$cblx',  '$cbdqsheng',  '$jzhlx','$ypgg',  '$ypyl',   '$hzhchshrq',  '$hzhxb',  '$cbdqshi',  '$cbdqqu',  '$rjshr',  '$shqzht',  '$chcshhrq',  '$lyyf', '$djrq',  '$djr',  '0','$hzhnshr','$rzer','$dylxrxm','$dylxrgx','$derlxrxm','$derlxrgx','$dsanlxrxm','$dsanlxrgx')";
	$result = mysql_query ( $query );
	if (! $result) {
		echo mysql_error ();
		echo "失败 <a href=\"shqgl.php\">点击返回重试</a>";
	} else {
		$getID = mysql_insert_id ();
		$json = str_replace ( ']', "", str_replace ( '[', "", $zhxqsh [0] ) );
		
		$json = str_replace ( "},{", "}|{", $json );
		$json = explode ( "|", $json );
		
		for($i = 0; $i < count ( $json ); $i ++) {
			$json[$i] = str_replace("\\", "", $json[$i]);
			$jsonsj = json_decode ( $json [$i] );

      $zhxxm = $jsonsj->姓名;
      $zhxzhjhm = $jsonsj->公民身份号码;
      $zhxjgzh = $jsonsj->军官证	;
      $zhxgx = $jsonsj->与患者关系;
      $zhxlx = $jsonsj->联系方式	;
      $nshr = $jsonsj->年收入;

			if ($zhxxm != '' && ($zhxzhjhm != '' || $zhxjgzh != '') && $zhxgx != '') {
				$zhxquery = "INSERT INTO `zhxqsh` (`hzhid` ,`xm` ,`zhjhm` ,`yhzhgx` ,`lxfsh`,`jgzh`,`gxzf`,`nshr`)VALUES ( '$getID',  '$zhxxm',  '$zhxzhjhm',  '$zhxgx',  '$zhxlx',  '$zhxjgzh','1','$nshr')";
				
				// echo $zhxquery;
				$zhxresult = mysql_query ( $zhxquery );
				if (! $zhxresult) {
					echo mysql_error ();
					echo "添加直系亲属失败 <a href=\"shqgl.php\">点击返回重试</a>";
				} else {
					echo "添加直系亲属完成</br>";
					echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=chcshh.php?id=$getID\">";
				}
			}
		}
		// $ygshcyyrqxclyrq=date('Y-m-d',strtotime('-7 day',strtotime($ygshcyyrq)));
		$xcfyrqquery = "INSERT INTO `xclyrq` (`hzhid` ,`xclyrq`)VALUES ( '$getID',  '$chcshhrq')";
		// echo $xcfyrqquery;
		$xcfyrqresult = mysql_query ( $xcfyrqquery );
		if (! $xcfyrqresult) {
			echo mysql_error ();
			echo "添加下次发药日期失败 <a href=\"shqgl.php\">点击返回重试</a>";
		} else {
			echo "添加下次发药日期完成</br>";
			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=chcshh.php?id=$getID\">";
		}
		// 首次医学评估确认表 开始
		
		// 临床诊断：
		$lchzhd = $_POST ['lchzhd'];
		// 其他说明：
		/*
		 * $qtlchzhd = $_POST['qtlchzhd'];
		 * if($lchzhd=="其他"&&$qtlchzhd!="")
		 * {$lchzhd=$qtlchzhd;}
		 */
		// 诊断日期：
		$zhdrq = $_POST ['zhdrq'];
		// 肿瘤病理类型：
		$zhlbl = $_POST ['zhlbl'];
		
		include ("wdb.php");
		$db = new DB ();
		
		// ########################医学条件评估
		// 患者id
		$hzhid = $getID;
		// 录入人
		$lrr = $_SESSION ['yhname'];
		// 疾病进展
		$xbzlsb = $_POST ['xbzlsb'];
		// 原因
		$xbzlsbkaos = $_POST ['xbzlsbkaos'];
		// 药品名
		$yaoname = $_POST ['yaoname'];
		// 治疗时间
		$zhiliaotime = $_POST ['zhiliaotime'];
		// bying
		$bying = $_POST ['bying'];
		// 英利达开始时间
		$starttime = $_POST ['starttime'];
		// 英利达评估
		$yldpg = $_POST ['yldpg'];
		// 是否随访
		$yldsf = $_POST ['yldsf'];
		// 评估时间
		$pgtime = $_POST ['pgtime'];
		// 是否继续使用英利达
		$sfyld = $_POST ['sfyld'];
		// 该患者诊断为
		$docmes = $_POST ['docmes'];
		// 入组标准
		$fuhe = $_POST ['fuhe'];
		// 指定医生签字
		$docname = $_POST ['docname'];
		// 本次就诊时间
		$start_time = $_POST ['start_time'];
		$addtime = date ( 'Y-m-d H:i:s' );
		$arr = array (
				'hzhid' => $hzhid,
				'lrr' => $lrr,
				'xbyzzlsb' => $xbzlsb,
				'bying' => $bying,
				'yuanyin' => $xbzlsbkaos,
				'ypname' => $yaoname,
				'zltime' => $zhiliaotime,
				'yldstarttime' => $starttime,
				'yldrpg' => $yldpg,
				'pdjssf' => $yldsf,
				'pgtime' => $pgtime,
				'isfjxyxd' => $sfyld,
				'patzdrcc' => $docmes,
				'isrz' => $fuhe,
				'docname' => $docname,
				'bctime' => $start_time,
				'addtime'=> $addtime
		);
		$db->insert ( 'yxtjpg_new', $arr );
		if (! $shcpgresult) {
			echo mysql_error ();
			die ();
			echo "添加医学条件评估失败 <a href=\"shqgl.php\">点击返回重试</a>";
		} else {
			echo "添加医学条件评估完成</br>";
		}
		// 首次医学评估确认表 结束
		
		/*
		 * for($i=1;$i<=13;$i++)
		 * {
		 * $clquery="INSERT INTO `clshhnr` (`mchid` ,`hzhid` ,`shfshd` ,`shdrq` ,`shfyx` ,`shhrq` ,`shhr` ,`bzhshm`)VALUES ( '$i', '$getID', '0', '未填写', '0', '未填写', '当前用户', '')";
		 * $clresult=mysql_query($clquery);
		 * if(!$clresult)
		 * {
		 * echo mysql_error();
		 * echo "初始化材料审核失败 <a href=\"shqgl.php\">点击返回重试</a>";
		 * }
		 * else{
		 *
		 * }
		 * }
		 */
		echo "申请信息添加成功！<br/>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=chcshh.php?id=$getID\">";
	}
} else {
	echo "必填内容为空，返回重试<input type=\"button\" onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
}

?>