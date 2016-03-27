<?php session_start();
@header('Content-type: text/html;charset=utf-8');
include('newdb.php');

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
$numsql = "SELECT * FROM `kfkcpd` where `dwmch`='$dwmch'";
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
//2014/06/12徐勤杰修改   开始
$sql_2 = 'select * from `kfrk`';
$query_2 = mysql_query($sql_2);
$num = mysql_num_rows($query_2);//获取总条数
//结束
$pagenum = ceil($num / $pagesize);
$html_title = "入库管理";
include('spap_head.php');
?>
<div class="main">
    <div class="insmain">
        <div class="thislink">当前位置：<a href="kfrkgl.php">入库管理</a></div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong>入库管理</strong><span><a href="kfrkxz.php">新增入库管理</a></span>
            </div>
            <div class="incontact w955 flt">
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                        <td>
                            <div class="insinsins">
                                <input type="text" id="Guanjianci" name="Guanjianci" class="grd-white" type="text"
                                       size="12" value=""
                                       placeholder="请输入赠药批号"/>
                                <input type="button" class="uusub" value="查找" onclick="chazhao();" class="lgSub"/><br/>
                            </div>
                            <div class="insinsins" style="width:100%;">
                                <input type="text" class="grd-white" id="KaishiRiqi" name="KaishiRiqi"
                                       readonly="readonly" placeholder="请输入开始日期"
                                       size="12" value=""
                                       class="input searchInput"/>
                                -
                                <input type="text" class="grd-white" id="JiezhiRiqi" name="JiezhiRiqi"
                                       readonly="readonly" placeholder="请输入结束日期"
                                       size="12" value=""
                                       class="input searchInput"/>
                                <input type="button" value="按登记日期过滤" class="uusub" onclick="guolv();"
                                       class="lgSub"/><br/>
                            </div>
                            <br/>
                        </td>
                    </tr>
                </table>


                <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                    <tr style="color:#1f4248; font-weight:bold; height:30px;">
                        <td width="10%" align="center" bgcolor="#FFFFFF">状态</td>
                        <td width="10%" align="center" bgcolor="#FFFFFF">入库日期</td>
                        <td width="12%" align="center" bgcolor="#FFFFFF">中文名称</td>
                        <td width="10%" align="center" bgcolor="#FFFFFF">英文名称</td>
                        <td width="10%" align="center" bgcolor="#FFFFFF">批号</td>
                        <td width="10%" align="center" bgcolor="#FFFFFF">有效期至</td>
                        <td width="10%" align="center" bgcolor="#FFFFFF">操作</td>
                    </tr>


                    <?php

                    $sql = "select * from `kfrk`";
                    if ($guanjiancisql != "") {
                        $sql .= "where " . $guanjiancisql;
                    }
                    $sql .= " order by id DESC limit $page $pagesize ";
                    $Query_ID = mysql_query($sql);
                    while ($Record = mysql_fetch_array($Query_ID)) {
                        echo "<tr style=\"color:#1f4248; font-size:12px;\">";
                        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
                        if ($Record[6] == "1") {
                            echo "已入库";
                        } else {
                            echo "已作废";
                        }
                        echo "</td>";
                        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[9] . "</td>";
                        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[3] . "</td>";
                        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[4] . "</td>";

                        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[1] . "</td>";
                        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[2] . "</td>";
                        echo "<td width=\"10%\" align=\"center\" bgcolor=\"#FFFFFF\">";
//                        if ($_SESSION['yhln'] == "admin") {
                            echo "<a href=\"kfrkxxxg.php?id=" . $Record[0] . "\">修改</a>|";
//                        }
                        echo "<a href=\"kfrkxx.php?id=" . $Record[0] . "\">详细</a></td>";
                        echo "</tr>";

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
            </div>
        </div>
    </div>
</div>
</div>
</body>
<script type="text/javascript">

    function guolv() {
        var url = 'kfrkgl.php?kshrq=' + $('#KaishiRiqi').val() + '&jshrq=' + $('#JiezhiRiqi').val();
        location.href = url;
    }
    function chazhao() {
        var urlguanjianci = 'kfrkgl.php?guanjianci=' + encodeURIComponent($('#Guanjianci').val());
        location.href = urlguanjianci;
    }
    ;

    $(function () {
        chooseDateRange('KaishiRiqi', 'JiezhiRiqi', true, true);
    });

</script>
</html>