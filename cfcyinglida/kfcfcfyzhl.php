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
if ($_GET[page]) {
    $pageval = $_GET[page];
    $page = ($pageval - 1) * $pagesize;
    $page .= ',';
}
$numq = mysql_query("SELECT * FROM `yfshqzy` where `shqzht`='1'");
$num = mysql_num_rows($numq);//获取总条数
$pagenum = ceil($num / $pagesize);

$html_title = "查收CFC发药指令";
include('spap_head.php');
?>
<div class="main">
    <div class="insmain">
        <div class="thislink">当前位置：<a href="kfchukgl.php"><?php echo $html_title; ?></a></div>
        <div class="inwrap flt top">
            <div class="title w977 flt">
                <strong>查收CFC发药指令</strong></span>
            </div>
            <div class="incontact w955 flt">
                <input type="button" value="发运管理" class="uusub2" onclick="javascript:{location.href='kfchkgl.php';}"/>
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
                        <td width="15%" align="center" bgcolor="#FFFFFF">
                            批准日期
                        </td>
                        <td width="15%" align="center" bgcolor="#FFFFFF">
                            申请药品药房
                        </td>
                        <td width="15%" align="center" bgcolor="#FFFFFF">
                            申请数量
                        </td>
                        <td width="15%" align="center" bgcolor="#FFFFFF">
                            规格
                        </td>
                        <td width="15%" align="center" bgcolor="#FFFFFF">
                            批准数量
                        </td>
                        <td width="20%" align="center" bgcolor="#FFFFFF">
                            操作
                        </td>
                    </tr>
                    <?php
                    $sql = "select * from `yfshqzy` where `shqzht`='1' order by id DESC limit $page $pagesize ";
                    $Query_ID = mysql_query($sql);
                    while ($Record = mysql_fetch_array($Query_ID)) {
                        echo "<tr style=\"color:#1f4248; font-size:12px;\">";
                        echo "<td width=\"20%\" align=\"center\" bgcolor=\"#FFFFFF\">" . $Record[18] . "</td>";
                        echo "<td width=\"20%\" align=\"center\" bgcolor=\"#FFFFFF\">";
                            /*$yfsql = "select yfmch from `yf` where `id`='".$Record[1]."'";
                            $yfQuery_ID = mysql_query($yfsql);
                            while($yfRecord = mysql_fetch_array($yfQuery_ID)){echo $yfRecord[0];}*/
                            echo $Record[25];
                        echo "</td>";
                        echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".($Record[4]+$Record[7])."盒</td>";
                        echo "<td align=\"center\" bgcolor=\"#FFFFFF\">".$Record[2]."</td>";
                        echo "<td width=\"20%\" align=\"center\" bgcolor=\"#FFFFFF\">" . ($Record[20] + $Record[21]) . "盒</td>";
                        echo "<td  width=\"20%\" align=\"center\" bgcolor=\"#FFFFFF\">
                                <a href=\"kfcfcywyshb.php?id=" . $Record[0] . "\">详情</a>|
                                <a href=\"kfcfcfy.php?id=" . $Record[0] . "\">发货</a>
                             </td>";

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
    </body>
    </html>
