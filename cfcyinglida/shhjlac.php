<?php

session_start ();
@header ( 'Content-type: text/html;charset=utf-8' );
include ('newdb.php');
$id = $_POST ['id'];
// 是否批准
$shfpzh = $_POST ['shfpzh'];
// 拒绝原因
$jujue = $_POST ['jujue'];
// 是否办理入组
// $shfrzh = $_POST['shfrzh'];
// 预估办理入组时间
$zhshrzshj = $_POST ['rzrq'];
// 医院id
// $qryy = $_POST['qryy'];//判断 0 1
// $zhdyyid = $_POST['zhdyyid'];//判断 0 获取
// $selzhdyyid = $_POST['selzhdyyid'];//判断 1 获取

// 更换药房
// $qryf = $_POST['qryf'];//判断 0 1
// $selzhdyf = $_POST['selzhdyf'];//判断 1 获取

// 手册寄出日期
// $shcrq = $_POST['shcrq'];
// 备注
$bzh = $_POST ['bzh'];
// 是否更换日期 1是0否
// $ygrq = $_POST['ygrq'];
// 更换后日期
// $ygrqgh = $_POST['ygrqgh'];

// 审核人
$shhr = $_SESSION ['yhname'];
// 运单号
// $shcydh = $_POST['shcydh'];
$datenow = date ( 'Y-m-d' );

$yzhxx = 0;

$query = "UPDATE `hzh` SET ";
// echo $shfpzh;
if ($shfpzh == 1) {
	
	if ($zhshrzshj <= $datenow) {
		$shqzht = "代办入组";
	} else {
		$shqzht = "入组";
	}
	
	/* 验证基础信息是否填写完整 开始 */
	$sql = "select `hzhxm`,`zhjhm`,`shqyy`,`hzhtxdzh`,`hzhshj`,`hzhhj`,`hzhjtrk`,`jtnshr`,`rjshr`,`jzhlx`,`hzhchshrq` from `hzh` where id='$id' ";
	/* $sql = "select * from `hzh` where id='$id' "; */
	$Query_ID = mysql_query ( $sql );
	
	while ( $Record = mysql_fetch_array ( $Query_ID ) ) {
		// print_r($Record);
		// echo $Record[7];
		$hzhjzhlx = $Record [10];
		for($i = 0; $i < count ( $Record ) / 2; $i ++) {
			if ($Record [$i] == "") {
				/*
				 * if($i==16){}
				 * else if($i==5){}
				 * else {}
				 */
				echo "失败 患者（基础信息）不完整 </br>";
				echo "空项：" . $i;
				echo "<br>";
				// echo count($Record) ;
				exit ();
				$yzhxx ++;
			} // echo $i;
		}
		$hzhjtrk = $Record [6];
		if ($Record [7] == 0) {
			echo "失败 患者家庭年收入为0 </br><input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
			exit ();
		}
	}
	// echo $sql;
	
	/* 验证基础信息是否填写完整 结束 */
	
	/* 验证直系亲属是否填写完整 开始 */
	$sql = "select * from `zhxqsh` where hzhid='$id' and `gxzf`='1'";
	$Query_ID = mysql_query ( $sql );
	$num = mysql_num_rows ( $Query_ID );
	if ($hzhjtrk != $num) {
		// echo $hzhjtrk."失败 直系亲属 未通过 </br>".$hzhjtrk;
		// $yzhxx++;
	}
	// echo $sql;
	
	/* 验证直系亲属是否填写完整 结束 */
	
	/* 验证材料是否填写完整 开始 */
	$sql = "select `shhyj` from `clshh` where hzhid='$id' and id in (select max(id) from `clshh` where hzhid='$id')";
	
	$Query_ID = mysql_query ( $sql );
	while ( $Record = mysql_fetch_array ( $Query_ID ) ) {
		if ($Record [0] == "0") {
			echo "失败 患者（提供的材料信息）未通过 </br>";
			$yzhxx ++;
			exit();
		}
	}

	if (mysql_num_rows ( $Query_ID ) < 1) {
		echo "失败 患者（提供的材料信息）未填写 </br>";
		$yzhxx ++;
		exit();
	}
	// echo $sql;
	
	/* 验证材料是否填写完整 结束 */
	
	/* 验证社会调查是否属实 开始 */
	$sql = "select `shfshsh`  from `shhdch` where hzhid='$id'";
	$Query_ID = mysql_query ( $sql );
	$shhdchshsh = 0;
	// echo $sql;
	while ( $Record = mysql_fetch_array ( $Query_ID ) ) {
		
		if ($Record [0] == "1") {
			$shhdchshsh = 1;
		}
	}
	if ($shhdchshsh != 1) {
		echo "失败 患者（社会调查）未通过  </br>";
		// exit();
		$yzhxx ++;
		exit();
	}
	/* 验证社会调查是否属实 结束 */
	
	/* 验证医学评估报告 开始 */
	
	include ("wdb.php");
	$db = new DB ();
	$arr = $db->getRow ( 'select * from yxtjpg_new where hzhid=' . $id . ' and isrz = "符合"' );
	
	if (! empty ( $arr )) {
		$yxpg = 1;
	}
	if ($yxpg != 1) {
		echo $yxpg;
		echo "失败 医学评估报告 未通过  </br>";
		echo "<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
		exit ();
	}
	/*
	 * if($qryy=="1"){$rzyy=$selzhdyyid;}else {$rzyy=$zhdyyid;}
	 *
	 * $yysql = "select yyzhdyf,yymch,zhdysh from `yyyshdq` where `id`='".$rzyy."'";
	 * $yyQuery_ID = mysql_query($yysql);
	 * while($yyRecord = mysql_fetch_array($yyQuery_ID)){
	 * $rzyyzhdyf=$yyRecord[0];
	 * $rzyymch=$yyRecord[1];
	 * $rzyyzhdysh=$yyRecord[2];
	 * }
	 */
	
	/* if($qryf=="1"){$rzyyzhdyf=$selzhdyf;} */
	/*
	 * $yfsql = "select id from `yf` where `id`='".$rzyyzhdyf."'";
	 *
	 * $yfQuery_ID = mysql_query($yfsql);
	 * while($yfRecord = mysql_fetch_array($yfQuery_ID)){
	 * $lyyfid=$yfRecord[0];
	 * }
	 */
	
	// 查询患者是否有入组编码 order by id desc
	#生成编码
	  $cxhzhrzsql = "select * from `hzhrz` where `hzhid`='$id' group by hzhid ";
	  $cxhzhrzQuery_ID = mysql_query($cxhzhrzsql);
	  while($cxhzhrzRecord = mysql_fetch_array($cxhzhrzQuery_ID)){
	  	$cxhzhrz=$cxhzhrzRecord[0]; 
	  }
	  if($cxhzhrz>0){
	  	$hzhid=sprintf("%05d", $cxhzhrz);//生成4位数，不足前面补0
	  }else{
	  	$hzhrzquery="insert into `hzhrz`(hzhid)values('$id')";
	  	$hzhrzresult=mysql_query($hzhrzquery);
		  if(!$hzhrzresult)
		  {
		  echo mysql_error();
		  echo "失败 <input type=\"button\" onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
		  }else{
		  $getID=mysql_insert_id();
		  $hzhid=sprintf("%05d", $getID);//生成4位数，不足前面补0
		  }
	  }
	/*
	 * $shqzhtsql = " `shqzht`='$shqzht',`ygshcyyrq`='$zhshrzshj',`hzhid`='$hzhid',`shhxcl`='0',`zhshrzshj`='$zhshrzshj' ";
	 */
	$shqzhtsql = " `shqzht`='$shqzht',`ygshcyyrq`='$zhshrzshj',`shhxcl`='0',`zhshrzshj`='$zhshrzshj' ,`hzhid`='$hzhid'";
	
	$xcfyrqquery = "UPDATE `xclyrq` SET `xclyrq`='$zhshrzshj' where `hzhid`='$id'";
	// echo $xcfyrqquery;
	$xcfyrqresult = mysql_query ( $xcfyrqquery );
	if (! $xcfyrqresult) {
		echo mysql_error ();
		echo "添加下次发药日期失败 ";
	} else {
		echo "添加预估下次发药日期成功 ";
	}
	$shhyj = "批准-入组";
	$query .= $shqzhtsql . " WHERE `id` ='$id'";
	//die(var_dump($xcfyrqquery));
} else {
	$query .= " `shqzht`='拒绝',`shhyj`='$jujue',`jjrq`='$datenow'`zhshrzshj`='',`shhxcl`='0' WHERE `id` ='$id'";
	$shhyj = "拒绝";
}
$result = mysql_query ( $query );
if (! $result) {
	echo mysql_error ();
	echo "失败  <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
} else {
	if ($shfpzh != '1') {
		$bzh1 = $jujue;
	} else {
		$bzh1 = $bzh;
	}
	// if($shhyj=="批准-入组"){$rzyyxx="入组医院/医生：".$rzyymch." ".$rzyyzhdysh;}else {$rzyyxx="";}
	$shhejlquery = "insert into `shhejl`(hzhid,shhr,shhyj,shhrq,bzh)values('$id','$shhr','$shhyj','$datenow','" . $rzyyxx . " " . $bzh1 . "')";
	$shhejlresult = mysql_query ( $shhejlquery );
	if (! $shhejlresult) {
		echo mysql_error ();
		echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"uusub\" />";
	} else {
	}
	echo "成功！<br/>";
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=shqxq.php?id=$id\">";
}
?>
