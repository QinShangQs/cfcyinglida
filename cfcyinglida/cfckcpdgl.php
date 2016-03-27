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
$numsql = "SELECT * FROM `kfkcpd` where '1'='1'";
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
if ($_GET[yf] != "") {//按药房

    $guanjiancisql = "`dwmch`='" . $_GET[yf] . "'";
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

        <div class="thislink">当前位置：
            <?php echo $html_title; ?></div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong>XPAP项目信息导出</strong>
            </div>
            <div class="incontact w955 flt">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                        <td>
                            <div class="insinsins" style="width:100%;">
                                <script type="text/javascript" src="js/jquery.alerts.js" charset="gb2312"
                                        class="grd-white2"></script>
                                <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen"/>
                                <div class="formConN">
                                    <input type="text" id="KaishiRiqi" name="KaishiRiqi" readonly="readonly"
                                           placeholder="请输入开始日期" size="12" value="" class="grd-white"/>
                                    -
                                    <input type="text" id="JiezhiRiqi" name="JiezhiRiqi" readonly="readonly"
                                           placeholder="请输入结束日期" size="12" value="" class="grd-white"/>&nbsp;&nbsp;
                                    <input type="button" value="按盘点日期过滤" onclick="guolv();" class="uusub"/>
                                </div>
                                <div style="padding-top: 5px;">
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
                                </div>
                                <table width="100%" border="0" cellspacing="0" cellpadding="5" class="top">
                                    <tr>
                                        <td>
                                            <?php
                                            include('pagefy.php');
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                                    <tr style="color:#1f4248; font-weight:bold; height:30px;">
                                        <td rowspan="2" align="center" bgcolor="#FFFFFF">单位名称</td>
                                        <td rowspan="2" align="center" bgcolor="#FFFFFF">覆盖日期</td>
                                        <td rowspan="2" align="center" bgcolor="#FFFFFF">盘点日期</td>
                                        <td rowspan="2" align="center" bgcolor="#FFFFFF">盘点人</td>
                                        <td colspan="6" align="center" bgcolor="#FFFFFF">库存盘点明细</td>
                                    </tr>
                                    <tr style="color:#1f4248; font-weight:bold; height:30px;">
                                        <td align="center" bgcolor="#FFFFFF">赠药批号</td>
                                        <td align="center" bgcolor="#FFFFFF">月初库存量</td>
                                        <td align="center" bgcolor="#FFFFFF">本月收到数量</td>
                                        <td align="center" bgcolor="#FFFFFF">本月发放药品数量</td>
                                        <td align="center" bgcolor="#FFFFFF">破损数量</td>
                                        <td align="center" bgcolor="#FFFFFF">实际库存</td>
                                    </tr>

                                    <?php
                                    /*$sql = "select yfmch from `yf` ";
                                    $Query_ID = mysql_query($sql);
                                    while($Record = mysql_fetch_array($Query_ID)){$dwmch=$Record [0];}*/

                                    //$sql = "select * from `kfkcpd` where `dwmch`='$dwmch'";
                                    $sql = "select * from `kfkcpd` where '1'='1'";
                                    if ($guanjiancisql != "") {
                                        $sql .= " and " . $guanjiancisql;
                                    }
                                    $sql .= " order by id DESC limit $page $pagesize ";

                                    $Query_ID = mysql_query($sql);
                                    while ($Record = mysql_fetch_array($Query_ID)) {
                                        ?>

                                        <tr style="color:#1f4248; font-size:12px;">
                                        <td align="center" bgcolor="#FFFFFF"><?php echo $Record[4]; ?></td>
                                        <td align="center" bgcolor="#FFFFFF"><?php echo $Record[1]; ?></td>
                                        <td align="center" bgcolor="#FFFFFF"><?php echo $Record[2]; ?></td>
                                        <td align="center" bgcolor="#FFFFFF">
                                            <?php
                                                $pdrsql = "select yhyl1 from `manager` where `id`='$Record[3]' ";
                                                $pdrQuery_ID = mysql_query($pdrsql);
                                                while ($pdrRecord = mysql_fetch_array($pdrQuery_ID)) {
                                                    echo $pdrRecord[0];
                                                }
                                            ?>
                                        </td>
                                        <?php
                                        $mxsql = "select `ypph`,`qchkc`,`byrk`,`bychk`,`shjkc` from `kfkcpdmx` where `pdid`='" . $Record[0] . "'";
                                        //echo $mxsql;
                                        $mxQuery_ID = mysql_query($mxsql);
                                        $mxi = 0;
                                        $mxi1 = 0;
                                        while ($mxRecord = mysql_fetch_array($mxQuery_ID)) {

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


                                                $firstDay = date("Y-m-01", strtotime($Record[2]));    //当月的第一天
                                                $lastDay = date("Y-m-d", strtotime("$firstDay +1 month -1 day")); //当月的最后一天

                                                $psypSql = "SELECT SUM(pshsh) FROM psyp WHERE yfmch='$Record[1]' AND pihao='$newph' AND createDate >= '$firstDay' AND createDate <='$lastDay'";

                                                $psypQueryId = mysql_query($psypSql);
                                                while ($psypRecord = mysql_fetch_array($psypQueryId)) {
                                                    $psypshl = $psypRecord[0];
                                                }
                                                if($psypshl == ""){
                                                    $psypshl = 0;
                                                }

                                                if ($mxi > 0 && $mxi1 == 0 || ($mxi-$mxi1)==1 || ($mxi - $mxi1) == 2) {
                                                    echo "<tr>
                                                          <td align=\"center\" bgcolor=\"#FFFFFF\"></td>
                                                          <td align=\"center\" bgcolor=\"#FFFFFF\"></td>
                                                          <td align=\"center\" bgcolor=\"#FFFFFF\"></td>
                                                          <td align=\"center\" bgcolor=\"#FFFFFF\"></td>";
                                                }
                                                ?>

                                                <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[0]; ?></td>
                                                <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[1]; ?></td>
                                                <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[2]; ?></td>
                                                <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[3]; ?></td>
                                                <td align="center" bgcolor="#FFFFFF"><?php echo $psypshl; ?></td>
                                                <td align="center" bgcolor="#FFFFFF"><?php echo $mxRecord[4]; ?></td>
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
      <td align=\"center\" bgcolor=\"#FFFFFF\"></td><td align=\"center\" bgcolor=\"#FFFFFF\"></td><td align=\"center\" bgcolor=\"#FFFFFF\"></td><td align=\"center\" bgcolor=\"#FFFFFF\"></td>";
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

                                        var url = 'cfckcpdgl.php?kshrq=' + $('#KaishiRiqi').val() + '&jshrq=' + $('#JiezhiRiqi').val();

                                        location.href = url;
                                    }


                                    function guolvyf() {
                                        if ($('#KaishiRiqi').val() != "" || $('#JiezhiRiqi').val() != "") {
                                            var url = 'cfckcpdgl.php?kshrq=' + $('#KaishiRiqi').val() + '&jshrq=' + $('#JiezhiRiqi').val() + '&yf=' + $('#YaoFangId').val();
                                        } else {
                                            var url = 'cfckcpdgl.php?yf=' + $('#YaoFangId').val();
                                        }
                                        location.href = url;
                                    }

                                    $(function () {
                                        chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
                                        <?php
                                        if($_GET[kshrq]!=""){
                                        ?>
                                        $("#KaishiRiqi").val('<?php echo $_GET[kshrq];?>');
                                        <?php
                                        }
                                        if($_GET[jshrq]!=""){
                                        ?>
                                        $("#JiezhiRiqi").val('<?php echo $_GET[jshrq];?>');
                                        <?php
                                        }
                                        ?>
                                    });
                                </script>
                                </body>
                                </html>
