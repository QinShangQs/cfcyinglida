<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');
$yhgldw = $_SESSION[gldw];
$yhid = $_SESSION['yhid'];
$sql = "select gldw from `manager` where `id`='$yhid' ";
$Query_ID = mysql_query($sql);
while ($Record = mysql_fetch_array($Query_ID)) {
    $dwmch = $Record [0];
}

$pagesize = 10;//每页显示的条数：
$url = $_SERVER["REQUEST_URI"];//获取本页地址-网址
$url = parse_url($url);// 解析网址--得到的是一数组
//print_r($url);
$url[query] = preg_replace("/page=[0-9]&/", "", $url[query]);
$url[query] = preg_replace("/page=[0-9]/", "", $url[query]);

if ($url[query] != "") {
    $url = $url[path] . "?" . $url[query] . "&";
} else {
    $url = $url[path] . "?";//得到解析网址的 具体信息
}
$numsql = "SELECT * FROM `kfkcpd` where `dwmch`='$yhgldw'";
if ($_GET[page]) {
    $pageval = $_GET[page];
    $page = ($pageval - 1) * $pagesize;
    $page .= ',';
}
if ($_GET[kshrq] != "" && $_GET[jshrq] != "") {
    $kshrq = $_GET[kshrq];
    $jshrq = $_GET[jshrq];
    $guanjiancisql = "( `pdrq` >= '" . $kshrq . "' and `pdrq` <= '" . $jshrq . "' )";

    $numsql .= " and " . $guanjiancisql;
}

$numq = mysql_query($numsql);
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num / $pagesize);
$html_title = "库存盘点";
include('spap_head.php');
?>
<div class="main">
    <div class="insmain">
        <div class="thislink">当前位置：<a href="yshkcpdgl.php">库存盘点</a></div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong>库存盘点</strong><span><?php
                    $xtggxxsql = "select id from `xtggxx` where `ggzht`='1' and `tshgn`='1'";

                    $xtggxxQuery_ID = mysql_query($xtggxxsql);
                    while ($xtggxxRecord = mysql_fetch_array($xtggxxQuery_ID)) {
                        $xtggxx = "1";//读取数据库，特殊情况，系统管理设置可以盘点
                    }
                    $day = date('d');
                    $dayyd = date("d", strtotime("+1 day"));

                    $kfkcpdisLockSql = "select count(*) as num from `kfkcpd` WHERE `dwmch`='$yhgldw' AND `islock`=1";
                    $kfkcpdQueryId = mysql_query($kfkcpdisLockSql);
                    while ($kfkcisLockRecord = mysql_fetch_array($kfkcpdQueryId)) {
                        $kfisLock = $kfkcisLockRecord[0];
                    }

                    if (($day >= 1 && $day <= 5) || $day == 31 || $xtggxx == 1 || $dayyd == 1) {
                        //判断该药房是否因为实际库存数目不对导致药方锁定
                        if($kfisLock == 0){
                        ?>
                        <a href="yshkcpdxz.php">新增库存盘点</a>
                    <?php
                    }
                    }
                    ?></span>
            </div>
            <div class="incontact w955 flt">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                        <td>
                        </td>
                    </tr>
                </table>
                <div class="insinsins"><span><input class="grd-white" type="text" id="KaishiRiqi" name="KaishiRiqi"
                                                    readonly="readonly" placeholder="请输入开始日期" size="12"
                                                    value=""/> - <input class="grd-white" type="text" id="JiezhiRiqi"
                                                                        name="JiezhiRiqi" readonly="readonly"
                                                                        placeholder="请输入结束日期" size="12"
                                                                        value=""/>  <input type="button" value="按盘点日期过滤"
                                                                                           onclick="guolv();"
                                                                                           class="uusub"/></span></div>
                <div class="forB">
                    <?php
                    $xtggxxsql = "select id from `xtggxx` where `ggzht`='1' and `tshgn`='1'";
                    $xtggxxQuery_ID = mysql_query($xtggxxsql);
                    while ($xtggxxRecord = mysql_fetch_array($xtggxxQuery_ID)) {
                        $xtggxx = "1";//读取数据库，特殊情况，系统管理设置可以盘点
                    }
                    $day = date('d');
                    if (($day >= 1 && $day <= 5) || $day == 31 || $xtggxx == 1) {
                        ?>
                        <div>
                            <!--  <input type="button" value="新增库存盘点" class="uusub2" onclick="javascript:{location.href='yshkcpdxz.php';}" />-->
                        </div>
                    <?php
                    }
                    ?>



                    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                        <tr style="color:#1f4248; font-weight:bold; height:30px;">
                            <td rowspan="2" width="10%" align="center" bgcolor="#FFFFFF">覆盖日期</td>
                            <td rowspan="2" width="10%" align="center" bgcolor="#FFFFFF">盘点日期</td>
                            <td rowspan="2" width="10%" align="center" bgcolor="#FFFFFF">盘点人</td>
                            <td colspan="6" width="10%" align="center" bgcolor="#FFFFFF">库存盘点明细</td>
                        </tr>
                        <tr style="color:#1f4248; font-weight:bold; height:30px;">
                            <td width="14%" align="center" bgcolor="#FFFFFF">赠药批号</td>
                            <td width="8%" align="center" bgcolor="#FFFFFF">月初库存量</td>
                            <td width="8%" align="center" bgcolor="#FFFFFF">本月收到药品数量</td>
                            <td width="8%" align="center" bgcolor="#FFFFFF">本月发放药品数量</td>
                            <td width="8%" align="center" bgcolor="#FFFFFF">破损数量</td>
                            <td width="10%" align="center" bgcolor="#FFFFFF">月末库存量</td>
                        </tr>

                        <?php
                        $sql = "select * from `kfkcpd` where `dwmch`='$yhgldw'";
                        if ($guanjiancisql != "") {
                            $sql .= " and " . $guanjiancisql;
                        }
                        $sql .= " order by id DESC limit $page $pagesize ";

                        $Query_ID = mysql_query($sql);
                        while ($Record = mysql_fetch_array($Query_ID)) {
                            ?>

                            <tr style="color:#1f4248; font-size:12px;">
                            <!--td style="text-align: right;"></td-->
                            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[1]; ?></td>
                            <!--td align="center" bgcolor="#FFFFFF"><?php echo date('y/m/d') . "-" . date('y/m/d'); ?></td-->
                            <td align="center" bgcolor="#FFFFFF"><?php echo $Record[2]; ?></td>
                            <td align="center" bgcolor="#FFFFFF"><?php
                                $pdrsql = "select yhyl1 from `manager` where `id`='$Record[3]' ";
                                $pdrQuery_ID = mysql_query($pdrsql);
                                while ($pdrRecord = mysql_fetch_array($pdrQuery_ID)) {
                                    echo $pdrRecord[0];
                                }
                                ?></td>
                            <?php
                            $mxsql = "select `ypph`,`qchkc`,`byrk`,`bychk`,`shjkc`,`zhtsd` from `kfkcpdmx` where `pdid`='" . $Record[0] . "'";
                            $mxQuery_ID = mysql_query($mxsql);
                            $mxi = 0;
                            $mxi1 = 0;
                            while ($mxRecord = mysql_fetch_array($mxQuery_ID)) {
                                if ($mxi > 0 && $mxi1 == 0 && $mxi-$mxi1 > 1) {
                                    echo "<tr style=\"color:#1f4248; font-size:12px;\">
                                     <td align=\"center\" bgcolor=\"#FFFFFF\"></td>
                                     <td align=\"center\" bgcolor=\"#FFFFFF\"></td>
                                     <td align=\"center\" bgcolor=\"#FFFFFF\"></td>";
                                }
                                if ($mxRecord[1] == "0" && $mxRecord[2] == "0" && $mxRecord[3] == "0" && $mxRecord[4] == "0") {
                                    $mxi1++;
                                } else {
                                    $ph = '';
                                    $phsql = "select `id`, `gg` from `kfrk` where `ph`='$mxRecord[0]'";
                                    $phquery = mysql_query($phsql);
                                    while ($phRecord = mysql_fetch_array($phquery)) {
                                        $ph .= $phRecord[0] . ',';
                                        $gg = $phRecord[1];
                                    }
                                    $newph = rtrim($ph, ",");
//                                    $lyrctjsql = "select count(*) from `zyff` where `yfmch`='$yhgldw' and `ypph` in ($newph)";
//                                    $lyrctjquery = mysql_query($lyrctjsql);
//                                    while ($lyrctjRecord = mysql_fetch_array($lyrctjquery)) {
//                                        $lyrc = $lyrctjRecord[0];
//                                    }
                                    $firstDay = date("Y-m-01", strtotime($Record[2]));    //当月的第一天
                                    $lastDay = date("Y-m-d", strtotime("$firstDay +1 month -1 day")); //当月的最后一天

                                    $psypSql = "SELECT SUM(pshsh) FROM psyp WHERE yfmch='$dwmch' AND pihao='$newph' AND createDate >= '$firstDay' AND createDate <='$lastDay'";
									var_dump($psypSql);
                                    $psypQueryId = mysql_query($psypSql);
                                    while ($psypRecord = mysql_fetch_array($psypQueryId)) {
                                        $psypshl = $psypRecord[0];
                                    }
                                    if($psypshl == ""){
                                        $psypshl = 0;
                                    }
                                    if (($mxi-$mxi1)==1) {
                                    echo "<tr style=\"color:#1f4248; font-size:12px;\">
                                        <td align=\"center\" bgcolor=\"#FFFFFF\"></td>
                                        <td align=\"center\" bgcolor=\"#FFFFFF\"></td>
                                        <td align=\"center\" bgcolor=\"#FFFFFF\"></td>";
                                        }
                                    ?>
                                    <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[0]."[".$gg."]"; ?></td>
                                    <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[1]; ?></td>
                                    <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[2]; ?></td>
                                    <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[3]; ?></td>
                                    <td align="center" bgcolor="#FFFFFF"><?php echo $psypshl; ?></td>
                                    <td align="center" bgcolor="#FFFFFF" <?php if($mxRecord[5] > 0){?> style="color: red;"<?php }?>>
                                        <?php echo $mxRecord[4]; ?>
                                    </td>
                                    </tr>
                                    <?php
                                    $hjqchshl += $mxRecord[1];
                                    $hjrkshl += $mxRecord[2];
                                    $hjchkshl += $mxRecord[3];
                                    $hjshjshl += $mxRecord[4];
                                    $hjpsypshl += $psypshl;
                                }
                                $mxi++;
                            }
                            if ($mxi == $mxi1) {
                                ?>
                                <td align="center" bgcolor="#FFFFFF">无</td>
                                <td align="center" bgcolor="#FFFFFF">无</td>
                                <td align="center" bgcolor="#FFFFFF">无</td>
                                <td align="center" bgcolor="#FFFFFF">无</td>
                                <td align="center" bgcolor="#FFFFFF">无</td>
                                <td align="center" bgcolor="#FFFFFF">无</td>
                                </tr>
                            <?php
                            }
                            if ($mxi != $mxi1) {
                                echo "<tr style=\"color:#1f4248; font-size:12px;\">
                                  <td align=\"center\" bgcolor=\"#FFFFFF\"></td>
                                  <td align=\"center\" bgcolor=\"#FFFFFF\"></td>
                                  <td align=\"center\" bgcolor=\"#FFFFFF\"></td>";
                                ?>
                                <td align="center" bgcolor="#FFFFFF">合计：</td>
                                <td align="center" bgcolor="#FFFFFF"><?php echo $hjqchshl;
                                    $hjqchshl = 0; ?></td>
                                <td align="center" bgcolor="#FFFFFF"><?php echo $hjrkshl;
                                    $hjrkshl = 0; ?></td>
                                <td align="center" bgcolor="#FFFFFF"><?php echo $hjchkshl;
                                    $hjchkshl = 0; ?></td>
                                <td align="center" bgcolor="#FFFFFF"><?php echo $hjpsypshl;
                                    $hjpsypshl = 0; ?></td>
                                <td align="center" bgcolor="#FFFFFF"><?php echo $hjshjshl;
                                    $hjshjshl = 0; ?></td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
                        <tr>
                            <td>
                                <?php
                                include('pagefy.php');
                                ?>
                            </td>
                        </tr>
                    </table>
                    <script type="text/javascript">
                        function guolv() {

                            var url = 'yshkcpdgl.php?kshrq=' + $('#KaishiRiqi').val() + '&jshrq=' + $('#JiezhiRiqi').val();

                            location.href = url;
                        }

                        $(function () {
                            chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
