<?php

session_start ();
@header ( 'Content-type: text/html;charset=utf-8' );
include ('newdb.php');
$yhgldw = $_SESSION [gldw];
$pagesize = 10; // 每页显示的条数：
$url = $_SERVER ["REQUEST_URI"]; // 获取本页地址-网址
$url = parse_url ( $url ); // 解析网址--得到的是一数组
                      // print_r($url);
$url [query] = preg_replace ( "/page=[0-9]&/", "", $url [query] );
$url [query] = preg_replace ( "/page=[0-9]/", "", $url [query] );

if ($url [query] != "") {
	$url = $url [path] . "?" . $url [query] . "&";
} else {
	$url = $url [path] . "?"; // 得到解析网址的 具体信息
}
if ($_GET [page]) {
	$pageval = $_GET [page];
	$page = ($pageval - 1) * $pagesize;
	$page .= ',';
}
if ($_GET [guanjianci] != "") {
	$guanjiancinr = $_GET [guanjianci];
	
	// if(substr( $guanjiancinr, 0, 1 )=='s'||substr( $guanjiancinr, 0, 1 )=='S'){
	// $guanjiancinr=str_ireplace('s','',$guanjiancinr,$i);
	if (substr ( $guanjiancinr, 0, 1 ) == 'i' || substr ( $guanjiancinr, 0, 1 ) == 'I') {
		$guanjiancinr = str_ireplace ( 'i', '', $guanjiancinr, $i );
		$hzhrzid = $guanjiancinr;
	} else {
		// $guanjiancinr=preg_replace('/^0*/', '', $guanjiancinr);
		$hzhrzid = $guanjiancinr;
	}
	$guanjianci = "(`hzhid`='" . $hzhshqid . "' or `hzhxm` LIKE '%" . $guanjiancinr . "%')";
	$guanjianci1 = "(a.`hzhid`='" . $hzhrzid . "' or a.`hzhxm` LIKE '%" . $guanjiancinr . "%')";
}
if ($_GET [day] != "") {
	$ygrq = $_GET [day] + 7;
	$zdrq = date ( 'Y-m-d', strtotime ( '+' . $ygrq . ' day', strtotime ( date ( 'Y-m-d' ) ) ) );
	$bxclyrq = date ( 'Y-m-d', strtotime ( '+' . $_GET [day] . ' day', strtotime ( date ( 'Y-m-d' ) ) ) );
	if ($guanjianci1 != "") {
		$guanjianci .= " and (select hzhid from `xclyrq` where `xclyrq`<='" . $zdrq . "' and `hzhid`=`hzh`.`id`)')";
		$guanjianci1 .= " and (b.`xclyrq`<='" . $bxclyrq . "' )";
	} else {
		$guanjianci .= " (select hzhid from `xclyrq` where `xclyrq`<='" . $zdrq . "' and `hzhid`=`hzh`.`id`)";
		$guanjianci1 .= " (b.`xclyrq`<='" . $bxclyrq . "' )";
	}
}
$html_title = "药品发放";
include ('spap_head.php');
?>
<div class="main">
	<div class="insmain">
		<div class="thislink">
			当前位置：<a href="yshdfqdgl.php"><?php echo $html_title;?></a>
		</div>
		<div class="inwrap flt top">
			<div class="title w977 flt">
				<strong><?php echo $html_title;?></strong><span></span>
			</div>
			<div class="incontact w955 flt">
				<table width="100%" border="0" cellspacing="0" cellpadding="5">
					<tr>
						<input type="text" id="Guanjianci" name="Guanjianci"
							class="grd-white" value="<?php echo $_GET[guanjianci];?>"
							placeholder="输入患者姓名或编码" />
						<input type="button" value="查找" onclick="chazhao();" class="uusub" />
						预估发药日期在
						<select Style="width: 80px" class="grd-white" id="Day" name="Day"
							onchange="guolv();"></td>
            
    
        
<?php
for($i = 1; $i <= 31; $i ++) {
	if ($_GET [day] != "" && $_GET [day] == $i) {
		$dayselect = "selected=\"selected\"";
	} else if ($i == 20 && ($_GET [day] == "" || $_GET [day] == $i)) {
		$dayselect = "selected=\"selected\"";
	} else {
		$dayselect = "";
	}
	echo "<option " . $dayselect . " value=\"" . $i . "\">" . $i . "</option>";
}
?>
</select>天内&nbsp;(5mg)
						</div>
					</tr>
				</table>
<?php

$yhid = $_SESSION [yhid];
$yhln = $_SESSION [yhln];
$yhsql = "select id,yfmch from `yf` where `yfyshname`='" . $yhln . "'";
$yhQuery_ID = mysql_query ( $yhsql );
while ( $yhRecord = mysql_fetch_array ( $yhQuery_ID ) ) {
	$yshid = $yhRecord [0];
	$yfmch = $yhRecord [1];
}
$yftmsql = "select id from `yf` where `yfmch`='" . $yfmch . "'";
$yftmQuery_ID = mysql_query ( $yftmsql );
while ( $yftmRecord = mysql_fetch_array ( $yftmQuery_ID ) ) {
	$yfid [] = $yftmRecord [0];
}

/*
 * $numsql="SELECT * FROM `hzh` where `shqzht`='入组' and (`lyyf`='$yshid'";
 * for($i=0;$i<count($yfid);$i++)
 * {
 * if($yfid[$i]!=null){
 * $numsql .= " or `lyyf`='".$yfid[$i]."' ";
 * }
 * }
 */
/*
 * $numsql = "select a.* from `hzh` a LEFT JOIN `xclyrq` b on a.`id`=b.`hzhid` where a.`shqzht`='入组' and b.`xclyrq`>='".date('Y-m-d',strtotime('-29 day',strtotime(date('Y-m-d'))))."' and (a.`lyyf`='$yshid'";
 * for($i=0;$i<count($yfid);$i++)
 * {
 * if($yfid[$i]!=null){
 * $numsql .= " or a.`lyyf`='".$yfid[$i]."' ";
 * }
 * }
 * $numsql .=")";
 */
$numsql = "select a.* from `hzh` a LEFT JOIN `xclyrq` b on a.`id`=b.`hzhid` where a.`shqzht`='入组' and b.`xclyrq`>='" . date ( 'Y-m-d', strtotime ( '-29 day', strtotime ( date ( 'Y-m-d' ) ) ) ) . "' and a.`lyyf`='$yhgldw'";
if ($guanjianci != "") {
	$numsql .= " and " . $guanjianci1;
}
// echo $numsql;
$numq = mysql_query ( $numsql );
$num = mysql_num_rows ( $numq ); // 获取总条数
$pagenum = ceil ( $num / $pagesize );

$yshtmsql = "select id from `manager` where `gldw`='" . $yfmch . "'";
$yshtmQuery_ID = mysql_query ( $yshtmsql );
while ( $yshtmRecord = mysql_fetch_array ( $yshtmQuery_ID ) ) {
	$yfyshid [] = $yshtmRecord [0];
}
/*
 * $kcshshdsql="SELECT SUM(pfshl1),SUM(pfshl2) FROM `yfshqzy` where `shqzht`='3' and (`yshid`='$yshid'";
 * for($i=0;$i<count($yfid);$i++)
 * {
 * if($yfid[$i]!=null){
 * $kcshshdsql .= " or `yshid`='".$yfid[$i]."' ";
 * }
 * }
 * $kcshshdsql .=")";
 */
$kcshshdsql = "SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='3' and `yfmch`='$yhgldw'";
$kcshshdQuery_ID = mysql_query ( $kcshshdsql );
while ( $kcshshdRecord = mysql_fetch_array ( $kcshshdQuery_ID ) ) {
	$kcshshd1 = $kcshshdRecord [0];
}
/*
 * $kcshfy1sql="SELECT SUM(fyshl) FROM `zyff` where `fyjl`='1' and (`fyr`='$yhid'";
 * for($i=0;$i<count($yfyshid);$i++)
 * {
 * if($yfid[$i]!=null){
 * $kcshfy1sql .= " or `fyr`='".$yfyshid[$i]."' ";
 * }
 * }
 * $kcshfy1sql .=")";
 */
$kcshfy1sql = "SELECT SUM(fyshl) FROM `zyff` where  `yfmch`='$yhgldw'";
// echo $kcshfy1sql;
$kcshfy1Query_ID = mysql_query ( $kcshfy1sql );
while ( $kcshfy1Record = mysql_fetch_array ( $kcshfy1Query_ID ) ) {
	$kcshfy1 = $kcshfy1Record [0];
}
?>
    <div class="insinsins">
					<span>&nbsp;&nbsp;预估待发药数：<?php echo $num." ";?>盒(5mg) 当前库存数：<?php echo $kcshshd1-$kcshfy1;?> 盒(5mg)  <?php /*(当前药房id: <?php echo $yshid." ";?>开发期间调用)*/?></span>
				</div>
				<table width="100%" border="0" cellspacing="0" cellpadding="5"
					class="top">
					<tr>
						<td>
           <?php
											include ('pagefy.php');
											?>
              </td>
					</tr>
				</table>
				<table width="100%" border="0" cellpadding="5" cellspacing="1"
					bgcolor="#cdcdcd">
					<tr style="color: #1f4248; font-weight: bold; height: 30px;">

						<td width="8%" align="center" bgcolor="#FFFFFF">患者姓名</td>

						<td width="8%" align="center" bgcolor="#FFFFFF">唯一编码(患者编码)</td>

						<td width="12%" align="center" bgcolor="#FFFFFF">已领药品数量</td>
						<td width="12%" align="center" bgcolor="#FFFFFF">已领药品次数</td>
						<td width="12%" align="center" bgcolor="#FFFFFF" id="zzfyrq">最早发药日期</td>
						<td width="12%" align="center" bgcolor="#FFFFFF">随访手册</td>

						<td width="8%" align="center" bgcolor="#FFFFFF">操作</td>
					</tr>
<?php

/*
 * $sql = "select a.* from `hzh` a LEFT JOIN `xclyrq` b on a.`id`=b.`hzhid` where a.`shqzht`='入组' and b.`xclyrq`>='".date('Y-m-d',strtotime('-29 day',strtotime(date('Y-m-d'))))."' and (a.`lyyf`='$yshid'";
 * for($i=0;$i<count($yfid);$i++)
 * {
 * if($yfid[$i]!=null){
 * $sql .= " or a.`lyyf`='".$yfid[$i]."' ";
 * }
 * }
 * $sql .= ")";
 */
$sql = "select a.* from `hzh` a LEFT JOIN `xclyrq` b on a.`id`=b.`hzhid` where a.`shqzht`='入组' and b.`xclyrq`>='" . date ( 'Y-m-d', strtotime ( '-1 month', strtotime ( date ( 'Y-m-d' ) ) ) ) . "' and a.`lyyf`='$yhgldw'";
if ($guanjianci1 != "") {
	$sql .= " and " . $guanjianci1;
}
$sql .= " GROUP BY a.`id` order by b.`xclyrq` ASC limit $page $pagesize ";
$_SESSION [ygfysql] = $sql;
// echo $sql;
$Query_ID = mysql_query ( $sql );
while ( $Record = mysql_fetch_array ( $Query_ID ) ) {
	// $hzhshcyyshj=$Record[30];
	$hzhygshcyyshj = $Record [35]; // 预估首次赠药日期
	$hzhjzhlx = $Record [25]; // 捐助类型
	$hzhshqypgg = $Record [28]; // 药品规格
	                         // $hzhjzhshl=$Record[26];
	                         
	// 特殊情况发药 开始
	$shqcxsql = "select id from `tshzhtzyfywu` where `hzhid`='" . $Record [0] . "' and `shqzht`='1'";
	$shqcxQuery_ID = mysql_query ( $shqcxsql );
	while ( $shqcxRecord = mysql_fetch_array ( $shqcxQuery_ID ) ) {
		$shqidzt = $shqcxRecord [0];
	}
	if ($shqidzt > 0) {
		$shqid = 1;
		$shqidzt = 0;
	} else {
		$shqid = 0;
		$shqidzt = 0;
	}
	// 特殊情况发药 结束
	
	// 读取次数
	$lynumq = mysql_query ( "SELECT * FROM `zyff` where  `tshqk`='0' and `hzhid`='" . $Record [0] . "'" );
	$lynum = mysql_num_rows ( $lynumq ); // 获取总条数
	if ($lynum == "") {
		$lynum = "0";
	}
	?>
        <tr style="color: #1f4248; font-size: 12px;">

						<td width="8%" align="center" bgcolor="#FFFFFF"><?php echo $Record[4];?></td>
						<td width="8%" align="center" bgcolor="#FFFFFF">I-<?php echo $Record[2];?></td>
						<td width="12%" align="center" bgcolor="#FFFFFF"><a
							href="yshfyxx.php?id=<?php echo $Record[0];?>"><?php
	$lyshlnumq = mysql_query ( "SELECT SUM(fyshl) FROM `zyff` where `tshqk`='0' and `hzhid`='" . $Record [0] . "'" );
	while ( $lyshlnum = mysql_fetch_array ( $lyshlnumq ) ) {
		if ($lyshlnum [0] != "") {
			echo $lyshlnum [0];
		} else {
			echo "0";
		}
	}
	?>盒</a></td>
						<td width="12%" align="center" bgcolor="#FFFFFF"><a
							href="yshfyxx.php?id=<?php echo $Record[0];?>"><?php
	echo $lynum;
	echo "<input type='hidden' id='lynum' value='".$lynum."'/>"
	?>次</a></td>
						<td width="12%" align="center" bgcolor="#FFFFFF"><?php

		if($lynum=="0"){
			if($hzhygshcyyshj!=""){
				echo $hzhygshcyyshj;
			}else{echo "日期错误";}
		}		
		else if($lynum>"0"){
			$ygxcfyrqshjnumq = mysql_query("select * from xclyrq where hzhid='".$Record[0]."'");
			while ( $ygxcfyrqshjnum = mysql_fetch_array ( $ygxcfyrqshjnumq ) ) {
				$ygxcfyrqshj = $ygxcfyrqshjnum[2];
			}
			if($ygxcfyrqshj!=""){
				echo $ygxcfyrqshj;
			}else {echo "日期错误";}
		}
	
	?></td>
						<td width="8%" align="center" bgcolor="#FFFFFF">
                <?php
	if ($lynum % 3 == 0 && $lynum != 0) {
		echo "医学条件随访表";
	} else {
		echo "处方笺";
	}
	?>
            </td>
						<td width="8%" align="center" bgcolor="#FFFFFF"><?php
	$nowdate = date ( 'Y-m-d' );
	$nowdate_List = explode ( "-", $nowdate );
	$nowdate_d = mktime ( 0, 0, 0, $nowdate_List [1], $nowdate_List [2], $nowdate_List [0] );
	if ($lynum == "0") {
		if ($hzhygshcyyshj != "" || $shqid > 0) {
			
			$hzhygshcyyshj_List = explode ( "-", date ( 'Y-m-d', strtotime ( '-7 day', strtotime ( $hzhygshcyyshj ) ) ) );
			$hzhygshcyyshj_d = mktime ( 0, 0, 0, $hzhygshcyyshj_List [1], $hzhygshcyyshj_List [2], $hzhygshcyyshj_List [0] );
			$Days = ($nowdate_d - $hzhygshcyyshj_d) / 3600 / 24;
			if (($nowdate_d >= $hzhygshcyyshj_d && $Days >= 0 && $Days <= 30) || $shqid > 0) {
				echo "<a href=\"yshfy.php?id=" . $Record [0] . "\">发药</a>";
			} else {
				echo "发药";
			}
		} else if ('1' == '1') {
			echo "<a href=\"yshfy.php?id=" . $Record [0] . "\">发药</a>";
		} else {
			echo "发药";
		}
	} else if ($lynum > "0") {
		$ygxcfyrqq = mysql_query ( "SELECT ygxcfyrq FROM `zyff` where `tshqk`='0' and `hzhid`='" . $Record [0] . "' order by id DESC limit 0,1" );
		while ( $ygxcfyrq = mysql_fetch_array ( $ygxcfyrqq ) ) {
			$ygxcfyrqshj = $ygxcfyrq [0];
		}
		if ($ygxcfyrqshj != "" || $shqid > 0) {
			$ygxcfyshj_List = explode ( "-", $ygxcfyrqshj );
			$ygxcfyshj_d = mktime ( 0, 0, 0, $ygxcfyshj_List [1], $ygxcfyshj_List [2], $ygxcfyshj_List [0] );
			$Days = ($nowdate_d - $ygxcfyshj_d) / 3600 / 24;
			if (($Days >= 0 && $Days <= 30) || $shqid > 0) {
				echo "<a href=\"yshfy.php?id=" . $Record [0] . "\">发药</a>";
			} else {
				echo "发药";
			}
		} else if ('1' == '1') {
			echo "<a href=\"yshfy.php?id=" . $Record [0] . "\">发药</a>";
		} else {
			echo "发药";
		}
	}
	?></td>
					</tr>

<?php
}
?>        

        
    </table>

				&nbsp;&nbsp;
				<table width="100%" border="0" cellspacing="0" cellpadding="5"
					class="top">
					<tr>
						<td>
           <?php
											include ('pagefy.php');
											?>
              </td>
					</tr>
				</table>
				超过时间未领药的患者：
				<table width="100%" border="0" cellpadding="5" cellspacing="1"
					bgcolor="#cdcdcd">
					<tr style="color: #1f4248; font-weight: bold; height: 30px;">

						<td width="8%" align="center" bgcolor="#FFFFFF">患者姓名</td>

						<td width="8%" align="center" bgcolor="#FFFFFF">唯一编码(患者编码)</td>

						<td width="12%" align="center" bgcolor="#FFFFFF">已领药品数量</td>
						<td width="12%" align="center" bgcolor="#FFFFFF">已领药品次数</td>
						<td width="12%" align="center" bgcolor="#FFFFFF">最早发药日期</td>
						<td width="12%" align="center" bgcolor="#FFFFFF">随访手册</td>

						<td width="8%" align="center" bgcolor="#FFFFFF">操作</td>
					</tr>
<?php

/*
 * $sql = "select a.* from `hzh` a LEFT JOIN `xclyrq` b on a.`id`=b.`hzhid` where a.`shqzht`='入组' and b.`xclyrq`<'".date('Y-m-d',strtotime('-29 day',strtotime(date('Y-m-d'))))."' and (a.`lyyf`='$yshid'";
 * for($i=0;$i<count($yfid);$i++)
 * {
 * if($yfid[$i]!=null){
 * $sql .= " or a.`lyyf`='".$yfid[$i]."' ";
 * }
 * }
 * $sql .= ")";
 */
$sql = "select a.* from `hzh` a LEFT JOIN `xclyrq` b on a.`id`=b.`hzhid` where a.`shqzht`='入组' and b.`xclyrq`<'" . date ( 'Y-m-d', strtotime ( '-1 month', strtotime ( date ( 'Y-m-d' ) ) ) ) . "' and a.`lyyf`='$yhgldw'";
if ($guanjianci1 != "") {
	$sql .= " and " . $guanjianci1;
}
$sql .= " GROUP BY a.`id` order by b.`xclyrq` ASC limit $page $pagesize ";
// echo $sql;
$Query_ID = mysql_query ( $sql );
while ( $Record = mysql_fetch_array ( $Query_ID ) ) {
	// $hzhshcyyshj=$Record[30];
	$hzhygshcyyshj = $Record [35]; // 预估首次赠药日期
	$hzhjzhlx = $Record [25]; // 捐助类型
	$hzhshqypgg = $Record [28]; // 药品规格
	                         // $hzhjzhshl=$Record[26];
	                         
	// 特殊情况发药 开始
	$shqcxsql = "select id from `tshzhtzyfywu` where `hzhid`='" . $Record [0] . "' and `shqzht`='1'";
	$shqcxQuery_ID = mysql_query ( $shqcxsql );
	while ( $shqcxRecord = mysql_fetch_array ( $shqcxQuery_ID ) ) {
		$shqidzt = $shqcxRecord [0];
	}
	if ($shqidzt > 0) {
		$shqidchq = 1;
		$shqidzt = 0;
	} else {
		$shqidchq = 0;
		$shqidzt = 0;
	}
	// 特殊情况发药 结束
	
	// 读取次数
	$lynumq = mysql_query ( "SELECT * FROM `zyff` where  `tshqk`='0' and `hzhid`='" . $Record [0] . "'" );
	$lynum = mysql_num_rows ( $lynumq ); // 获取总条数
	if ($lynum == "") {
		$lynum = "0";
	}
	?>
        <tr style="color: #1f4248; font-size: 12px;">

						<td align="center" bgcolor="#FFFFFF"><a
							href="yshfyzhxqsh.php?id=<?php echo $Record[0];?>"><?php echo $Record[4];?></a></td>
						<td align="center" bgcolor="#FFFFFF">I-<?php echo $Record[2];?></td>
						<td align="center" bgcolor="#FFFFFF"><a
							href="yshfyxx.php?id=<?php echo $Record[0];?>"><?php
	$lyshlnumq = mysql_query ( "SELECT SUM(fyshl) FROM `zyff` where `tshqk`='0' and `hzhid`='" . $Record [0] . "'" );
	while ( $lyshlnum = mysql_fetch_array ( $lyshlnumq ) ) {
		if ($lyshlnum [0] != "") {
			echo $lyshlnum [0];
		} else {
			echo "0";
		}
	}
	?>盒</a></td>
						<td align="center" bgcolor="#FFFFFF"><a
							href="yshfyxx.php?id=<?php echo $Record[0];?>"><?php
	echo $lynum;
	?>次</a></td>

						<td align="center" bgcolor="#FFFFFF"><?php
	
	if ($lynum == "0") {
		if ($hzhygshcyyshj != "") {
			echo date ( 'Y-m-d', strtotime ( '-7 day', strtotime ( $hzhygshcyyshj ) ) );
		} else {
			echo "日期错误";
		}
	} 	/*
	 * else if($lynum=="0"&&$hzhjzhlx=="部分"){
	 * if($hzhshcyyshj!=""){
	 * $hzhzfjzhshl=12-$hzhjzhshl;
	 * $hzhzfyyday=$hzhzfjzhshl*30;
	 * echo date('Y-m-d',strtotime('+'.$hzhzfyyday.' day',strtotime($hzhshcyyshj)));
	 *
	 * //date('Y-m-d',strtotime('-7 day',strtotime($hzhshcyyshj)));
	 * }else{echo "日期错误";}
	 * }
	 */
	else if ($lynum > "0") {
		if ($ygxcfyrqshj != "") {
			echo $ygxcfyrqshj;
			// echo date('Y-m-d',strtotime('-7 day',strtotime($ygxcfyrqshj)));
		} else {
			echo "日期错误";
		}
	}
	
	?></td>

						<td align="center" bgcolor="#FFFFFF"> <?php
	if ($lynum % 3 == 0 && $lynum != 0) {
		echo "医学条件随访表";
	} else {
		echo "处方笺";
	}
	?></td>
						<td align="center" bgcolor="#FFFFFF"><?php
	$nowdate = date ( 'Y-m-d' );
	$nowdate_List = explode ( "-", $nowdate );
	$nowdate_d = mktime ( 0, 0, 0, $nowdate_List [1], $nowdate_List [2], $nowdate_List [0] );
	if ($lynum == "0") {
		if ($hzhygshcyyshj != "" || $shqidchq > 0) {
			
			$hzhygshcyyshj_List = explode ( "-", date ( 'Y-m-d', strtotime ( '-7 day', strtotime ( $hzhygshcyyshj ) ) ) );
			$hzhygshcyyshj_d = mktime ( 0, 0, 0, $hzhygshcyyshj_List [1], $hzhygshcyyshj_List [2], $hzhygshcyyshj_List [0] );
			$Days = ($nowdate_d - $hzhygshcyyshj_d) / 3600 / 24;
			if (($nowdate_d >= $hzhygshcyyshj_d && $Days >= 0 && $Days <= 30) || $shqidchq > 0) {
				echo "<a href=\"yshfy.php?id=" . $Record [0] . "\">发药</a>";
			} else {
				echo "发药";
			}
		} else {
			echo "发药";
		}
	}  /*
	   * else if($lynum=="0"&&$hzhjzhlx=="部分"){
	   * if($hzhshcyyshj!=""){
	   * $hzhzfjzhshl=12-$hzhjzhshl;
	   * $hzhzfyyday=$hzhzfjzhshl*30;
	   * $hzhshcyyshj_List=explode("-",date('Y-m-d',strtotime('+'.$hzhzfyyday.' day',strtotime($hzhshcyyshj))));
	   * $hzhshcyyshj_d=mktime(0,0,0,$hzhshcyyshj_List[1],$hzhshcyyshj_List[2],$hzhshcyyshj_List[0]);
	   * $Days=round(($nowdate_d-$hzhshcyyshj_d)/3600/24);
	   * if($Days>=-7&&$Days<=23){echo "<a href=\"yshfy.php?id=".$Record[0]."\">发药</a>";}else{echo "发药";}
	   * }else{echo "发药";}
	   * }
	   */
else if ($lynum > "0") {
		$ygxcfyrqq = mysql_query ( "SELECT ygxcfyrq FROM `zyff` where `tshqk`='0' and `hzhid`='" . $Record [0] . "' order by id DESC limit 0,1" );
		while ( $ygxcfyrq = mysql_fetch_array ( $ygxcfyrqq ) ) {
			$ygxcfyrqshj = $ygxcfyrq [0];
		}
		if ($ygxcfyrqshj != "" || $shqidchq > 0) {
			$ygxcfyshj_List = explode ( "-", $ygxcfyrqshj );
			$ygxcfyshj_d = mktime ( 0, 0, 0, $ygxcfyshj_List [1], $ygxcfyshj_List [2], $ygxcfyshj_List [0] );
			$Days = ($nowdate_d - $ygxcfyshj_d) / 3600 / 24;
			if (($Days >= 0 && $Days <= 30) || $shqidchq > 0) {
				echo "<a href=\"yshfy.php?id=" . $Record [0] . "\">发药</a>";
			} else {
				echo "发药";
			}
		} else {
			echo "发药";
		}
	}
	?></td>
					</tr>

<?php
} /*
   * echo "<tr><td><a href=\"shqxq.php?id=".$Record[0]."\">查看</a></td>";
   * echo "<td><span class=RuxianaiColor>".$Record[7]."</span></td>";
   * echo "<td><span style=\"display: inline-block; width: 60px;\">".$Record[4]."</span><span style=\"display: inline-block; width: 50px; text-align: right;\" class=RuxianaiColor>申请号</span><span style=\"display: inline-block; width: 50px; text-align: right;\" class=RuxianaiColor>编号</span><br />".$Record[6]."</td>";
   * echo "<td style=\"text-align: center;\">".$Record[3]."</td>";
   * echo "<td>";
   * if($Record[31]!=""){echo $Record[31];}else{echo "无";} echo "<br />";
   * if($Record[34]!=""){echo $Record[34];}else{echo "无";} echo "</td><td>";
   * if($Record[33]!=""){echo $Record[33];}else{echo "无";} echo "<br />";
   * if($Record[32]!=""){echo $Record[32];}else{echo "无";} echo "</td>";
   * echo "<td>".$Record[35]."</td><td>";
   * $yysql = "select dq,yymch,zhdysh from `yyyshdq` where id='".$Record[9]."'";
   * $yyQuery_ID = mysql_query($yysql);
   * while($yyRecord = mysql_fetch_array($yyQuery_ID)){
   * echo $yyRecord[0]." ".$yyRecord[1]." ".$yyRecord[2];
   * }
   * echo "<br /></td></tr>";
   */
?>        

        
    </table>

				<script type="text/javascript">
        function guolv() {
            var url = 'yshdfqdgl.php?day=' + $('#Day').val();
            location.href = url;
        }
        function chazhao() {
            var url = 'yshdfqdgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
            location.href = url;
        }
    </script>

				<div class="clearFoot noPrint"></div>
			</div>
		</div>
		<style>
.mindess {
	width: 966px;
	font-size: 12px;
	height: auto;
	position: fixed;
	z-index: 100;
	left: 50%;
	margin: 0 auto 0 -494px; /* margin-left需要是宽度的一半 */
	top: 35%;
	padding: 0px;
	background: #25679c;
	border: 1px #25679c solid;
}
</style>
		<div class="mindess" id="qzyzh"
			style="width: 325px; padding-top: 5px; margin: 0 auto 0 -181px; display: none;">
			<div style="position: absolute; right: 15px; background: #25679c;">
				<a style="color: #ffffff; cursor: pointer;" onclick="qzyzh(0)">关闭</a>
			</div>
			<table style="margin-top: 30px;" width="100%" border="1"
				cellpadding="10" cellspacing="1">
				<tr>
					<td width="30%" bgcolor="#FFFFFF" align="center">指定医生<br />
					<span id='zhdyshxsh'></span></td>
					<td width="70%" bgcolor="#FFFFFF" align="center"><img
						id="zhdyshyzh" width="100" /><img id="zhdyshqzh" width="100" /></td>
				</tr>

				<tr id="qzyzhshq" style="display: none;">
					<td width="30%" bgcolor="#FFFFFF" align="center">授权医生<br />
					<span id='shqyshxsh'></span></td>
					<td width="70%" bgcolor="#FFFFFF" align="center"><div
							id="qzyzhshqysh"></div></td>
				</tr>

			</table>

		</div>
		<div id="footerCon">
			<div id="foot">
				<div id="footNav">
					<div>
						<div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
	<script type="text/javascript">
function padLeft(str, lenght) {
  if (str.length >= lenght){
  //alert(str.length+'b'+lenght);
    return str;
    }
  else{
  //alert(str.length+'a'+lenght);
    if(str.length==undefined){
      return padLeft("" + str, lenght);
    }else{
      return padLeft("0" + str, lenght);
    }
    }
}


function qzyzh(v,i){
if(v==0){
document.getElementById('qzyzh').style.display='none';
}
else{
imgsrc=padLeft(v,3);
document.getElementById('zhdyshyzh').src='./qzyzh/'+imgsrc+'-1.jpg';
document.getElementById('zhdyshqzh').src='./qzyzh/'+imgsrc+'-2.jpg';
$('#zhdyshxsh').html($('#zhdysh'+v).val());
$('#shqyshxsh').html($('#shqysh'+v).val());
if(i!=undefined&&i>0){
//alert('怎么来着了?');
document.getElementById('qzyzhshq').style.display='';
var shqimg="";
  for(j=0;j<i;j++){
  shqimg = shqimg+'<img src="./qzyzh/'+imgsrc+'-'+(j+3)+'.jpg"  width="100"/>';
  }
  if(shqimg!=""){
  $('#qzyzhshqysh').html(shqimg);
  }
}else{
document.getElementById('qzyzhshq').style.display='none';
  $('#qzyzhshqysh').html('');
}


document.getElementById('qzyzh').style.display='block';
}

}

$(document).ready(function(){
	$("#zzfyrq").text(parseInt($('#lynum').val()) == 0 ? "最早发药日期":"下次领药日期");
});

</script>
	</html>