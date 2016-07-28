<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$pagesize = 10;//每页显示的条数：
$url = $_SERVER["REQUEST_URI"];//获取本页地址-网址
$url = parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=(\d+)&/", "", $url[query]);
$url[query] = preg_replace("/&page=(\d+)/", "", $url[query]);
$url[query] = preg_replace("/page=(\d+)/", "", $url[query]);

if ($url[query] != "undefined" && $url[query] != "") {
    $url = $url[path] . "?" . $url[query] . "&";
} else {
    $url = $url[path] . "?";//得到解析网址的 具体信息
}

$numq = mysql_query("SELECT * FROM `yfshqzy` where `shqzht` > '1'");
if ($_GET[page]) {
    $pageval = $_GET[page];
    $page = ($pageval - 1) * $pagesize;
    $page .= ',';
}

if ($_GET[kshrq] != "" && $_GET[jshrq] != "") {
    $kshrq = $_GET[kshrq];
    $jshrq = $_GET[jshrq];
    $guanjiancisql = "( `fyrq` >= '" . $kshrq . "' and `fyrq` <= '" . $jshrq . "' )";

    $numq = mysql_query("SELECT * FROM `yfshqzy` where `shqzht` > '1' and " . $guanjiancisql);
}
if ($_GET[yf] != "") {//按药房

    $guanjiancisql = "`yfmch`='" . $_GET[yf] . "'";
    $numq = mysql_query("SELECT * FROM  `yfshqzy` where `shqzht` > '1' and " . $guanjiancisql);

}
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num / $pagesize);

$html_title = "出库管理";
include('spap_head.php');
?>
<div class="main">
<div class="insmain">
<div class="thislink">当前位置：<a href="kfchukgl.php"><?php echo $html_title; ?></a></div>
<div class="inwrap flt top">
<div class="title w977 flt">
    <strong>出库管理</strong></span>
</div>
<div class="incontact w955 flt">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td>

            <div class="insinsins">
                    <span>
                        <input class="grd-white" type="text" id="KaishiRiqi"
                               name="KaishiRiqi" readonly="readonly"
                               placeholder="请输入开始日期" size="12" value="<?php echo $kshrq; ?>"/> -
                        <input
                            class="grd-white" type="text" id="JiezhiRiqi" name="JiezhiRiqi"
                            readonly="readonly" placeholder="请输入结束日期" size="12"
                            value="<?php echo $jshrq; ?>"/>
                        <input type="button" value="按发运日期过滤" onclick="guolv();" class="uusub"/>
                    </span>
            </div>

            <select id="YaoFangId" name="YaoFangId" style="width:400px;" class="grd-white2"
                    onchange="guolvyf();">
                <?php
                if ($_GET[yf] == "") {
                    ?>
                    <option selected="selected" value="">全部药房</option>
                <?php
                } else {
                    ?>
                    <option selected="selected"
                            value="<?php echo $_GET[yf]; ?>"><?php echo $_GET[yf]; ?></option>
                    <option value="">全部药房</option>
                <?php
                }
                ?>
                <?php
                $yfsql = "select id,yfshengjx,yfmch from `yf` where `shfzt`='1' order by yfshengjx ASC";
                $yfQuery_ID = mysql_query($yfsql);
                while ($yfRecord = mysql_fetch_array($yfQuery_ID)) {
                    echo "<option value=\"" . $yfRecord[2] . "\">" . $yfRecord[1] . " " . $yfRecord[2] . "</option>";
                }
                ?>
            </select>
        </td>
    </tr>
</table>
<div>
    <input type="button" class="uusub" value="查收CFC发药指令" class="lgSub"
           onclick="javascript:{location.href='kfcfcfyzhl.php';}"/></div>
<?php

$kfrksql1mg = "select SUM(bjshl) from `kfrk` where gg like '1mg%'";
if ($shyrq != "") {
	$kfrksql1mg .= " where " . $shyrq;
}//添加判断条件
$kfrkQuery_ID = mysql_query($kfrksql1mg);
while ($kfrkRecord = mysql_fetch_array($kfrkQuery_ID)) {
	$rkzsh11mg = $kfrkRecord[0];
}
$kfrksql5mg = "select SUM(bjshl) from `kfrk` where gg like '5mg%'";
if ($shyrq != "") {
	$kfrksql5mg .= " where " . $shyrq;
}//添加判断条件
$kfrkQuery_ID = mysql_query($kfrksql5mg);
while ($kfrkRecord = mysql_fetch_array($kfrkQuery_ID)) {
	$rkzsh15mg = $kfrkRecord[0];
}

$kfchksql1mg = "select SUM(pfshl1) from `yfshqzy` where `shqzht`='2' and gg1 = '1mg'";
if ($fyrq != "") {
	$kfchksql1mg .= " and " . $fyrq;
}//添加判断条件
$kfchkQuery_ID = mysql_query($kfchksql1mg);
while ($kfchkRecord = mysql_fetch_array($kfchkQuery_ID)) {
	$chkztzsh11mg = $kfchkRecord[0];
}

$kfchksql5mg = "select SUM(pfshl1) from `yfshqzy` where `shqzht`='2' and gg1 = '5mg'";
if ($fyrq != "") {
	$kfchksql5mg .= " and " . $fyrq;
}//添加判断条件
$kfchkQuery_ID = mysql_query($kfchksql5mg);
while ($kfchkRecord = mysql_fetch_array($kfchkQuery_ID)) {
	$chkztzsh15mg = $kfchkRecord[0];
}

?>


<?php

$zyfysql = "SELECT SUM(pfshl1) FROM `yfshqzy` where `shqzht`='3'";
if ($guanjiancisql != "") {
    $zyfysql .= " and " . $guanjiancisql;
}
$zyfy = mysql_query($zyfysql);
while ($zyfyRecord = mysql_fetch_array($zyfy)) {
    $zyfyjs = $zyfyRecord[0];
}
$fy1mgcountsql = $zyfysql." and gg1 = '1mg';";
$fy1mg =  mysql_query($fy1mgcountsql);
while ($zyfyRecord = mysql_fetch_array($fy1mg)) {
	$fy1mgcount = $zyfyRecord[0];
}

$fy5mgcountsql = $zyfysql." and gg1 = '5mg'";
$fy5mg =  mysql_query($fy5mgcountsql);
while ($zyfyRecord = mysql_fetch_array($fy5mg)) {
	$fy5mgcount = $zyfyRecord[0];
}
?>
<div class="top"> <span>
    已发运货数： 1mg <?php echo $fy1mgcount?>盒; 5mg <?php echo $fy5mgcount?>盒;
        &nbsp;&nbsp;
        <?php
        //if ($chkztzsh1 > 0 || $chkztzsh2 > 0) {
            echo "在途总数";
            echo "1mg " . ( empty($chkztzsh11mg) ? 0:$chkztzsh11mg ) . "盒;";
            echo "5mg " . ( empty($chkztzsh15mg) ? 0:$chkztzsh15mg ). "盒; ";

        //}
        ?>  &nbsp;&nbsp;当前库房库存：
        
         <?php 
        	 echo "1mg " .($rkzsh11mg - $chkztzsh11mg - $fy1mgcount) . "盒;";
        	 echo "5mg " .($rkzsh15mg - $chkztzsh15mg - $fy5mgcount) . "盒;";
?> 
         
         </span></div>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
    <tr>
        <td>
            <?php
            include('pagefy.php');
            ?>
        </td>
    </tr>
</table>
</tr>
</table>
<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
    <tr style="color:#1f4248; font-weight:bold; height:30px;">
        <td width="10%" align="center" bgcolor="#FFFFFF">
            状态
        </td>
        <td width="10%" align="center" bgcolor="#FFFFFF">
            发运日期
        </td>
        <td width="10%" align="center" bgcolor="#FFFFFF">
            申请药品药房
        </td>
        <td width="10%" align="center" bgcolor="#FFFFFF">
            发运数量
        </td>
        <td width="10%" align="center" bgcolor="#FFFFFF">
            规格
        </td>
        <td width="10%" align="center" bgcolor="#FFFFFF">
            批号
        </td>
        <td width="10%" align="center" bgcolor="#FFFFFF">
            操作
        </td>
    </tr>
    <?php

    $sql = "select * from `yfshqzy` where `shqzht`>'1' ";
    if ($guanjiancisql != "") {
        $sql .= " and " . $guanjiancisql;
    }
    $sql .= "order by id DESC limit $page $pagesize ";

    $Query_ID = mysql_query($sql);
    while ($Record = mysql_fetch_array($Query_ID)) {
        echo "<tr style=\"color:#1f4248; font-size:12px;\">";
        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
            if ($Record[8] == '2') {
                echo "已发货";
            } else if ($Record[8] == '3') {
                echo "已签收";
            }
        echo "</td>";
        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[13] . "</td>";
        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
        /*$yfsql = "select yfmch from `yf` where `id`='".$Record[1]."'";
        $yfQuery_ID = mysql_query($yfsql);
        while($yfRecord = mysql_fetch_array($yfQuery_ID)){echo $yfRecord[0];}*/
        echo $Record[25];
        echo "</td>";
        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . ($Record[20] + $Record[21]) . "盒</td>";
        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[2] . "</td>";
        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
        if ($Record[15] != "未知批号" && $Record[15] != "0") {
            $ph1 = explode(",", $Record[15]);
            for ($i = 0; $i <= count($ph1); $i++) {
                $ph1sql = "select ph from `kfrk` where `id`='" . $ph1[$i] . "'";
                $ph1Query_ID = mysql_query($ph1sql);
                while ($ph1Record = mysql_fetch_array($ph1Query_ID)) {
                    echo $ph1Record['0'] . " ";
                }
            }
            echo "<br/>";
        }
        if ($Record[19] != "未知批号" && $Record[19] != "0") {
            $ph2 = explode(",", $Record[19]);
            for ($i = 0; $i <= count($ph2); $i++) {
                $ph2sql = "select ph from `kfrk` where `id`='" . $ph2[$i] . "'";
                $ph2Query_ID = mysql_query($ph2sql);
                while ($ph2Record = mysql_fetch_array($ph2Query_ID)) {
                    echo $ph2Record['0'] . " ";
                }
            }
        }
        if (($Record[15] == '0' || $Record[15] == '未知批号') && ($Record[19] == '0' || $Record[19] == '未知批号')) {
            echo "未知批号";
        }
        echo "</td>";
        echo "<td  width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"kfcfcfyxx.php?id=" . $Record[0] . "\">详情</a></td>";
        echo "</tr>";
    }
    ?>

</table>








<?php
include('pagefy.php');
?>

</tr>
</table>
</div>
</div>
</div>
</div>
</div>
</body>
<script type="text/javascript">
    function guolv() {

        var url = 'kfchkgl.php?kshrq=' + $('#KaishiRiqi').val() + '&jshrq=' + $('#JiezhiRiqi').val();

        location.href = url;
    }

    function guolvyf() {
        if ($('#KaishiRiqi').val() != "" || $('#JiezhiRiqi').val() != "") {
            var url = 'kfchkgl.php?kshrq=' + $('#KaishiRiqi').val() + '&jshrq=' + $('#JiezhiRiqi').val() + '&yf=' + $('#YaoFangId').val();
        } else {
            var url = 'kfchkgl.php?yf=' + $('#YaoFangId').val();
        }
        location.href = url;
    }
    $(function () {
        chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
    });
</script>
</html>