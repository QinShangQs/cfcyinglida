<?php

session_start ();
@header ( 'Content-type: text/html;charset=utf-8' );
include ('newdb.php');
$yhgldw = $_SESSION [gldw];
$dzhny = $_POST ['dzhny']; // 盘点年月
$pdrq = $_POST ['pdrq']; // 盘点日期
$pdr = $_POST ['pdr']; // 盘点人
$jlshjch = microtime_float (); // 记录时间戳精确到毫秒
$dwmch = $_POST ['dwmch']; // 单位名称
if ($dwmch != "") {
	$dzhnykshshjch = strtotime ( $dzhny ); // 盘点月开始第一天
	$dzhnyjshshjch = strtotime ( "$dzhny +1 month" ); // 盘点月结束最后一天(结束也是下月第一天之前所以加一个月)
	
	$firstDay = date ( "Y-m-01", strtotime ( date ( 'Y-m' ) ) ); // 当月的第一天
	$lastDay = date ( "Y-m-d", strtotime ( "$firstDay +1 month -1 day" ) ); // 当月的最后一天
	
	$dqny = date ( 'Y-m' ); // 当前年月
	$dqnyshjch = mktime (); // 当前年月时间戳
	$phshl = $_POST ['phshl']; // 批号数量
	if ($dqnyshjch < $dzhnyjshshjch) {
		$tjshj = 1;
		$dzhnyjshshjch = $dqnyshjch;
	} else {
		$tjshj = 0;
	} // 0为统计上月,1为当月
	$shfchfsql = "select * from `kfkcpd` where `dzhny`='$dzhny' and `dwmch`='$dwmch'";
	$shfchfq = mysql_query ( $shfchfsql );
	$shfchf = mysql_num_rows ( $shfchfq );
	if ($shfchf == 0) {
		
		$phidsql = "select `ph1`,`ph2`,`phshl1`,`phshl2` from `yfshqzy` where `shqzht`='3'  and `jlshjch`>'$dzhnykshshjch' and `jlshjch`<'$dzhnyjshshjch' and `yfmch`='" . $yhgldw . "'";
		$phidQuery_ID = mysql_query ( $phidsql );
		while ( $phidRecord = mysql_fetch_array ( $phidQuery_ID ) ) {
			$ph1ids [] = $phidRecord [0];
			$ph2ids [] = $phidRecord [1];
			$ph1shl [] = $phidRecord [2];
			$ph2shl [] = $phidRecord [3];
		}
		$ph1idstmp = Array ();
		$ph1shltmp = Array ();
		$ph2idstmp = Array ();
		$ph2shltmp = Array ();
		for($i = 0; $i < count ( $ph1ids ); $i ++) {
			$ph1idstmp = array_values ( array_merge ( $ph1idstmp, explode ( ",", $ph1ids [$i] ) ) );
			$ph1shltmp = array_values ( array_merge ( $ph1shltmp, explode ( ",", $ph1shl [$i] ) ) );
			$ph2idstmp = array_values ( array_merge ( $ph2idstmp, explode ( ",", $ph2ids [$i] ) ) );
			$ph2shltmp = array_values ( array_merge ( $ph2shltmp, explode ( ",", $ph2shl [$i] ) ) );
		}
		$ph1idshl = Array ();
		$ph2idshl = Array ();
		for($i = 0; $i < count ( $ph1idstmp ); $i ++) {
			if (count ( $ph1idstmp ) > 1) {
				for($j = $i + 1; $j < count ( $ph1idstmp ); $j ++) {
					if ($ph1idstmp [$i] == $ph1idstmp [$j]) {
						// echo "第".$i."位".$ph1idstmp [$i]."==第".$j."位".$ph1idstmp [$j]."</br>";
						if ($ph1idshl [$ph1idstmp [$i]] == "") {
							// echo "null</br>";
							$ph1idshl [$ph1idstmp [$i]] = $ph1shltmp [$i] + $ph1shltmp [$j];
							$ph1shltmp [$j] = 0;
							// echo "</br>";
						} else {
							// echo "no null ".$ph1idshl[$ph1idstmp [$i]]."</br>";
							$ph1idshl [$ph1idstmp [$i]] = $ph1idshl [$ph1idstmp [$i]] + $ph1shltmp [$j];
							$ph1shltmp [$j] = 0;
							// echo "</br>";
						}
					} else {
						// echo "第".$i."位".$ph1idstmp [$i]."<>第".$j."位".$ph1idstmp [$j]."</br>";
						if ($ph1idshl [$ph1idstmp [$i]] == "") {
							// echo "null</br>";
							$ph1idshl [$ph1idstmp [$i]] = $ph1shltmp [$i];
							// echo "</br>";
						}
						if ($ph1idshl [$ph1idstmp [$j]] == "") {
							// echo "null</br>";
							$ph1idshl [$ph1idstmp [$j]] = $ph1shltmp [$j];
							// echo "</br>";
						}
					}
				}
			} else {
				$ph1idshl [$ph1idstmp [$i]] = $ph1shltmp [$i];
			}
		}
		// print_r($ph1idshl);
		for($i = 0; $i < count ( $ph2idstmp ); $i ++) {
			if (count ( $ph2idstmp ) > 1) {
				for($j = $i + 1; $j < count ( $ph2idstmp ); $j ++) {
					if ($ph2idstmp [$i] == $ph2idstmp [$j]) {
						// echo "第".$i."位".$ph2idstmp [$i]."==第".$j."位".$ph2idstmp [$j]."</br>";
						if ($ph2idshl [$ph2idstmp [$i]] == "") {
							// echo "null</br>";
							$ph2idshl [$ph2idstmp [$i]] = $ph2shltmp [$i] + $ph2shltmp [$j];
							$ph2shltmp [$j] = 0;
							// echo "</br>";
						} else {
							// echo "no null ".$ph2idshl[$ph2idstmp [$i]]."</br>";
							$ph2idshl [$ph2idstmp [$i]] = $ph2idshl [$ph2idstmp [$i]] + $ph2shltmp [$j];
							$ph2shltmp [$j] = 0;
							// echo "</br>";
						}
					} else {
						// echo "第".$i."位".$ph2idstmp [$i]."<>第".$j."位".$ph2idstmp [$j]."</br>";
						if ($ph2idshl [$ph2idstmp [$i]] == "") {
							// echo "null</br>";
							$ph2idshl [$ph2idstmp [$i]] = $ph2shltmp [$i];
							// echo "</br>";
						}
						if ($ph2idshl [$ph2idstmp [$j]] == "") {
							// echo "null</br>";
							$ph2idshl [$ph2idstmp [$j]] = $ph2shltmp [$j];
							// echo "</br>";
						}
					}
				}
			} else {
				$ph2idshl [$ph2idstmp [$i]] = $ph2shltmp [$i];
			}
		}
		// print_r($ph2idshl);exit;echo "</br>";
		$phnsql = "select `id`,`ph` from `kfrk`";
		$phnQuery_ID = mysql_query ( $phnsql );
		while ( $phnRecord = mysql_fetch_array ( $phnQuery_ID ) ) {
			$phn [$phnRecord [0]] = $phnRecord [1];
		}
		
		$shcpdidsql = "select id,jlshjch from `kfkcpd` where `dwmch`='$dwmch' order by id DESC limit 0,1";
		$shcpdidQuery_ID = mysql_query ( $shcpdidsql );
		while ( $shcpdidRecord = mysql_fetch_array ( $shcpdidQuery_ID ) ) {
			$shcpdid = $shcpdidRecord [0];
			$shcpdshjch = $shcpdidRecord [1];
		}
		
		$query = "insert into `kfkcpd`(`dzhny`,`pdrq`,`pdr`,`dwmch`,`jlshjch`)values('$dzhny','$pdrq','$pdr','$dwmch','$jlshjch')";
		$result = mysql_query ( $query );
		if (! $result) {
			echo mysql_error ();
			echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
		} else {
			$getID = mysql_insert_id ();
			$zhtsd = 0;
			$zhtsdi = 0;
			for($i = 1; $i <= $phshl; $i ++) {
				$ypph = $_POST ['ypph' . $i];
				$qchkc = $_POST ['qchkc' . $i];
				$byrk = $_POST ['byrk' . $i];
				$bychk = $_POST ['bychk' . $i];
				$shjkc = $_POST ['shjkc' . $i];
				// 批号
				$phid = array_search ( $ypph, $phn );
				
				if ($ph1idshl [array_search ( $ypph, $phn )] != "") {
					$byrkshl = $ph1idshl [array_search ( $ypph, $phn )];
				} else if ($ph2idshl [array_search ( $ypph, $phn )] != "") {
					$byrkshl = $ph2idshl [array_search ( $ypph, $phn )];
				}
				
				if ($byrkshl == "") {
					$byrkshl = "0";
				}
				if ($qchkc == "") {
					$qchkc = "0";
				}
				if ($byrk == "") {
					$byrk = "0";
				}
				if ($bychk == "") {
					$bychk = "0";
				}
				if ($shjkc == "") {
					$shjkc = "0";
				}
				
				// 当月入库 是 本月的“赠药申请及收到管理”里面当月收到的+“药房调拨”里面收到的
				$yfdbSql = "SELECT SUM(yfshjfyshl) FROM yfdb WHERE fryfid='$dwmch' AND ph='$ypph' AND dbypshdrq >='$firstDay' AND dbypshdrq <= '$lastDay' ";
				$yfdbQueryId = mysql_query ( $yfdbSql );
				while ( $yfdbRecord = mysql_fetch_array ( $yfdbQueryId ) ) {
					$yfdbShdshl = $yfdbRecord [0];
				}
				if ($yfdbShdshl == "") {
					$yfdbShdshl = "0";
				}
				// 本月入库实际数量
				$byrkshjshl = $byrkshl + $yfdbShdshl;
				
				// 当月出库 是“药品发放明细”里面当月发出去的+“药房调拨”里面当月发出去的+“药品破损”里面当月填写的破损的
				// 药房明细发出的数量
				$zyffSql = "SELECT SUM(fyshl) FROM zyff WHERE fyrq >= '$firstDay' AND fyrq < '$lastDay' AND yfmch = '$dwmch' AND ypph='$phid'";
				$zyffQueryId = mysql_query ( $zyffSql );
				while ( $zyffRecord = mysql_fetch_array ( $zyffQueryId ) ) {
					$zyffshl = $zyffRecord [0];
				}
				
				// 药房调拨当月发出的数量
				$yfdbfchSql = "SELECT SUM(yfshjfyshl) FROM yfdb WHERE fcyfid='$dwmch' AND ph='$ypph' AND dbypshdrq >='$firstDay' AND dbypshdrq < '$lastDay' ";
				$yfdbfchQueryId = mysql_query ( $yfdbfchSql );
				while ( $yfdbfchRecord = mysql_fetch_array ( $yfdbfchQueryId ) ) {
					$yfdbfchshl = $yfdbfchRecord [0];
				}
				
				// 药品破损里面当月破损数量
				$psypSql = "SELECT SUM(pshsh) FROM psyp WHERE yfmch='$dwmch' AND pihao='$ypph' AND createDate >= '$firstDay' AND createDate <='$lastDay'";
				$psypQueryId = mysql_query ( $psypSql );
				while ( $psypRecord = mysql_fetch_array ( $psypQueryId ) ) {
					$psypshl = $psypRecord [0];
				}
				
				if ($zyffshl == "") {
					$zyffshl = "0";
				}
				
				if ($yfdbfchshl == "") {
					$yfdbfchshl = "0";
				}
				
				if ($psypshl == "") {
					$psypshl = "0";
				}
				
				// 当月出库数量
				$bychk = $zyffshl + $yfdbfchshl + $psypshl;
				
				if ($shcpdid != "") {
					$shcpdkcshlsql = "select `shjkc` from `kfkcpdmx` where `pdid`='$shcpdid' and `ypph`='$ypph'";
					$shcpdkcshlQuery_ID = mysql_query ( $shcpdkcshlsql );
					while ( $shcpdkcshlRecord = mysql_fetch_array ( $shcpdkcshlQuery_ID ) ) {
						$shcpdkcshl = $shcpdkcshlRecord [0];
					}
					// 初期库存 就是 上个月的实际库存 即 $shcpdkcshl
					if ($shcpdkcshl == "") {
						$shcpdkcshl = 0;
					}

				} else {
					$shcpdkcshl = 0;
				}

				// 实际库存等于期初库存 + 本月入库 -本月出库
				if ($shcpdkcshl + $byrkshjshl - $bychk != $shjkc) {
					$zhtsd = 1;
					$islock = 1;
				} else {
					$zhtsd = 0;
					$islock = 0;
				}

				$kfkcpdisLockSql = "UPDATE `kfkcpd` SET `islock` = {$islock} WHERE id='$getID'";
				$kfkcpdResult = mysql_query ( $kfkcpdisLockSql );
				
				$mxquery = "insert into `kfkcpdmx`(`pdid`,`ypph`,`qchkc`,`byrk`,`bychk`,`shjkc`,`zhtsd`)
                                            values('$getID','$ypph','$shcpdkcshl','$byrkshjshl','$bychk','$shjkc','$zhtsd')";
				$mxresult = mysql_query ( $mxquery );
				if (! $mxresult) {
					echo mysql_error ();
					echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
				}
				$ypph = "";
				$qchkc = "0";
				$byrk = "0";
				$bychk = "0";
				$shjkc = "0";
				$byrkshl = "0";
				$shcpdkcshl = "0";
			}
			if ($zhtsd > 0) {
				$query="UPDATE `manager` SET `yhzht`='0' WHERE `gldw` = '".$dwmch."'";
				$result=mysql_query($query);
				echo "成功！已锁定药房。<br/>";
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=yshkcpdgl.php\">";
				exit ();
				
			} else {
				echo "成功！<br/>";
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=yshkcpdgl.php\">";
				exit ();
			}
		}
	} else {
		echo $dzhny . "已经盘点过<input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
	}
} else {
	echo "失败 <input type=\"button\"  onclick=\"javascript:{history.go(-1);}\" value=\"返回\" class=\"lgSub\" />";
}

